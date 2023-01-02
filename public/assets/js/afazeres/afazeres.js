var $afzPage = $('#afazeres-page');

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

// $afzPage.on('click', '.delete-folder', function(e) {
//     e.preventDefault();
//     e.stopPropagation();

//     let element = $(this);

//     confirmAjax(element, () => {

//     });
// });
