var $afzPage = $('#afazeres-page');
// var $afzModal = $('#modal-afazeres .aloc-content-modal .content-modal');

$afzPage.on('click', '.afz-folder', function(e) {
    e.preventDefault();
    // e.stopPropagation();

    let element = $(this);
    let click = $(e.target);

    if(click.hasClass('delete-folder')) return;

    let idFolder = element.data('id-folder');
    let background = element.data('background');
    let container = $('.aloc-afazeres');
    let btnFolders = $('.afz-folder');
    let opened = element.hasClass('active');

    btnFolders.removeClass('active');
    
    if(opened) {
        idFolder = 0;
        background = null;
    }else{
        element.addClass('active');
    }

    $.ajax({
        type: "get",
        url: `/afazeres/line_afazeres/${idFolder}`,
        success: function (response) {
            background ? container.css('border-color', background + '30') : container.removeAttr('style');
            container.html(response);

            element, container, btnFolders = null;
        },
        error: function (error) {
            console.log(error);
            element, container, btnFolders = null;
        },
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