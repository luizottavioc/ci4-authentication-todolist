var $afzPage = $('#afazeres-page');
var targetClickFolder = undefined;
var executeFolder = undefined;

function toggleAfzFolder(folderEl, type) {
    let idFolder = type == 'open' ? folderEl.data('id-folder') : 0;
    let background = type == 'open' ? folderEl.data('background') : null;
    let container = $('.aloc-afazeres');
    let btnFolders = $('.afz-folder');
    
    btnFolders.removeClass('active');
    type == 'open' ? folderEl.addClass('active') : folderEl.removeClass('active');

    $.ajax({
        type: "get",
        url: `/afazeres/line_afazeres/${idFolder}`,
        success: function (response) {
            background ? container.css('border-color', background + '30') : container.removeAttr('style');
            container.html(response);

            folderEl, container, btnFolders = null;
        },
        error: function (error) {
            console.log(error);
            folderEl, container, btnFolders = null;
        },
    });
}

$afzPage.on('click', '.cover-folder', function(e) {
    e.preventDefault();

    let element = $(this);
    let folderEl = element.closest('.afz-folder')
    let opened = folderEl.hasClass('active');
    
    if ($(e.target).hasClass('delete-folder')) return false;

    if(!(targetClickFolder && targetClickFolder[0] === folderEl[0])) {
        toggleAfzFolder(folderEl, 'open');
        
        targetClickFolder = folderEl;
        return true;
    }

    clearTimeout(executeFolder);
    executeFolder = setTimeout(() => toggleAfzFolder(folderEl, opened ? 'close' : 'open'), 300);
    return true;
});

$afzPage.on('dblclick', '.cover-folder', function(e) {
    e.preventDefault();
    e.stopPropagation();

    clearTimeout(executeFolder);
    
    let element = $(this);
    let folderEl = element.closest('.afz-folder');
    let opened = folderEl.hasClass('active');
    let inputName = element.siblings('.ipt-name-folder');

    if(!opened) toggleAfzFolder(folderEl, 'open');

    inputName.focus();
    inputName.select();
    return false;
});

$afzPage.on('focusin', '.ipt-name-folder', function (e) {
    let element = $(this);
    let coverEl = element.siblings('.cover-folder');

    coverEl.addClass('d-none');
});

$afzPage.on('focusout', '.ipt-name-folder', function (e) {
    let element = $(this);
    let coverEl = element.siblings('.cover-folder');

    coverEl.removeClass('d-none');  
});

$afzPage.on('change', '.ipt-name-folder', function(e) {
    e.stopPropagation();

    let element = $(this);
    let folderEl = element.closest('.afz-folder');
    let idFolder = folderEl.data('id-folder');
    let newName = element.val();

    $.ajax({
        type: "post",
        url: "/afazeres/update_name_folder",
        data: {
            id_folder: idFolder,
            name_folder: newName
        },
        dataType: "json",
        success: function (response) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: response.icon,
                title: response.title,
                html: response.text,
                color: getSystemColor(),
                background: getSystemBackground(),
                color: getSystemColor(),
                showConfirmButton: false,
                timer: 3500
            });
        },
        error: function (error) {
            console.log(error);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Erro ao atualizar nome da pasta.',
                html: 'Ocorreu algum erro com o servidor, tente novamente mais tarde!',
                color: getSystemColor(),
                background: getSystemBackground(),
                color: getSystemColor(),
                showConfirmButton: false,
                timer: 3500
            });
        }
    });
});

$afzPage.on('click', '.afz-new-afz', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let element = $(this);
    let url = element.data('modal-url');
    let modal = element.data('modal-id');
    let title = element.data('modal-title');
    let footer = element.data('modal-footer');
    let size = element.data('modal-size');

    let folderSelected = $('.afz-folder.active');
    if(folderSelected.length) url += `/${folderSelected.data('id-folder')}`;

    ajaxModal({
        url: url,
        id_modal: modal,
        title: title,
        id_footer: footer,
        size: size
    });
});

$afzPage.on('change', '.sel-view-folder', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let element = $(this);
    let idFolder = element.val();
    let container = $('.container-view-folder');

    if(!idFolder || idFolder == 0) {
        let strtCopy = $($.parseHTML(copyStructure('#default-no-results-line-view-afz', ['default-no-results-line-view-afz'])));
        strtCopy.find('p').html('Pasta de não atribuição.');

        container.html(strtCopy).removeAttr('style');
        return;
    }

    $.ajax({
        type: "get",
        url: "/afazeres/get_folder_data/" + idFolder,
        dataType: "json",
        success: function (response) {
            if(!response) {
                container.html('').removeAttr('style');
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    position: 'top-end',
                    title: 'Erro ao carregar dados da pasta',
                    background: getSystemBackground(),
                    color: getSystemColor(),
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            let strtInsert = [];
            if (response.lines_afazeres.length) {
                response.lines_afazeres.forEach(afz => {
                    let strtCopy = $($.parseHTML(copyStructure('#default-line-view-afz', ['default-line-view-afz'])));
                    strtCopy.find('p').html(afz.afazer);

                    strtInsert.push(strtCopy);
                });
            }else{
                let strtCopy = $($.parseHTML(copyStructure('#default-no-results-line-view-afz', ['default-no-results-line-view-afz'])));
                strtCopy.find('p').html('Nenhum afazer encontrado nesta pasta.');

                strtInsert.push(strtCopy);
            }

            container.html(strtInsert);
            response.background_folder ? container.css('border-color', response.background_folder) : container.removeAttr('style');
            strtInsert = null;
        },
        error: function (error) {
            console.log(error);
            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                title: 'Ajax error!',
                background: getSystemBackground(),
                color: getSystemColor(),
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

});