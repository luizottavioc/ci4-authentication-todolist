// Navegação na página:

$(document).ready(function (e) {
    let urlPath = window.location.pathname;
    urlPath = (urlPath == '/' || urlPath == '') ? '/home' : urlPath;
    ajaxRedirect(urlPath);
});

$(window).on('popstate', function (e) {
    e.preventDefault();
    e.stopPropagation();
    let urlPath = e.originalEvent.state ? e.originalEvent.state : window.location.pathname;
    ajaxRedirect(urlPath);
});

$(document).on("click", ".ajax-redirect", function (e) {
    e.preventDefault();
    e.stopPropagation();
    let urlPath = $(this).data('url');
    // verificação do caso de ser uma 'subpage' e, no caso de ser, usar como url o primeiro dado pra que o active dos campos na sidebar sejam respeitados
    try { window.google = {}; } catch (error) { console.log(error); }
    ajaxRedirect(urlPath);
});

const ajaxRedirect = (urlPath, callback = undefined) => {
    if (urlPath != null) {
        openPageLoad();
        $.ajax({
            type: "POST",
            url: urlPath,
            data: { 'only_content': 1 },
            dataType: "html",
            success: async function (response) {
                await resultRedirects(response, urlPath);

                setTimeout(() => {
                    closePageLoad();
                }, 500);

                if (typeof callback === 'function' && callback()) {
                    callback();
                }

            }, error: function (error) {
                console.log('erro document ready: ', error);
            }
        });
    } else {
        console.log('url_path nulo');
        $('#main-container').html('Erro ao carregar página');
    }
}

const resultRedirects = async (response, targetUrl) => {
    $('.aloc-sid-line').removeClass('active');
    $(`[data-sidebar-module="/${targetUrl.split('/')[1]}"]`).addClass('active');

    await $('#main-container').hide().html(response).fadeIn('fast');

    insertEspecifJs(response);

    (targetUrl != window.location.pathname) ? window.history.pushState(targetUrl, '', targetUrl) : null;

    changeTitlePage(targetUrl);
}

const insertEspecifJs = async (page) => {
    $('#aloc-specif-js').html('');

    let especifsJs = Array.from($(page).find('.src-script'));
    especifsJs.forEach(js => {
        let scpt = document.createElement("script");
        scpt.setAttribute('src', js.value);
        $('#aloc-specif-js').append(scpt);
    });
}

// Cookie

function getCookie(name) {
    function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
    let match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
}

// Modal

$(document).on('click', '.td-modal', async function (e) {
    let url = $(this).data('modal-url');
    let modal = $(`#${$(this).data('modal-id')}`);
    let title = $(this).data('modal-title');
    let footer = $(this).data('modal-footer');
    let size = $(this).data('modal-size');

    if($(modal).length > 0 && (typeof url !== 'undefined' && url != '')){
        let contentModal = $(modal).children('.aloc-content-modal');
        typeof size !== 'undefined' ? await $(modal).addClass(size) : false;

        $.ajax({
            type: "post",
            url: url,
            dataType: "html",
            success: async (response) => {
                $(modal).find('.just-title').html(title);
                await $(contentModal).children('.content-modal').html(response);
                typeof footer !== 'undefined' ? $(contentModal).children('.footer-modal').append($(`#${footer}`)) : false;
                $(modal).addClass('active');

            },error: function (error) {
                console.log('erro ajax modal: ', error);
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    position: 'top-end',
                    title: 'Ajax modal error!',
                    background: getSystemBackground(),
                    color: getSystemColor(),
                    showConfirmButton: false,
                    timer: 1500
                });
            },
        });
    }else{
        Swal.fire({
            toast: true,
            icon: 'error',
            position: 'top-end',
            title: 'Erro na passagem dos parâmetros da modal!',
            background: getSystemBackground(),
            color: getSystemColor(),
            showConfirmButton: false,
            timer: 1500
        });
    }
});

$(document).on('click', '.close-modal', function (e) {
    let modal = this.parentNode.parentNode.parentNode;
    let title = $(modal).find('.just-title');
    let content = $(modal).find('.content-modal');
    let footer = $(modal).find('.footer-modal');

    $(title).html('');
    $(content).html('');
    $(footer).html('');
    $(modal).removeClass('active');
});

// Ajax confirm e submit form
 
$(document).on('click', '.td-ajax-confirm', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let urlRefresh = $(this).data('url-refresh');
    let closeModal = $(this).data('close-modal');

    confirmAjax(this, () => {
        if (typeof closeModal !== 'undefined' && closeModal) {
            $(`.close-modal`).click();
        }
        
        if (typeof urlRefresh !== 'undefined' && urlRefresh != '') {
            ajaxRedirect(urlRefresh);
        }
    });
});

$(document).on('submit', '.td-default-form', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let urlRefresh = $(this).data('url-refresh');
    let closeModal = $(this).data('close-modal');

    confirmAjax(this, ()=>{
        if(typeof closeModal !== 'undefined' && closeModal){
            $(`.close-modal`).click();
        }

        if(typeof urlRefresh !== 'undefined' && urlRefresh != ''){
            ajaxRedirect(urlRefresh);
        }
    });
});

function confirmAjax(thisEl, callback = undefined) {
    let title = $(thisEl).data('confirm-title');
    let text = $(thisEl).data('confirm-text');
    let successText = $(thisEl).data('confirm-success-text');
    let url = $(thisEl).data('confirm-url');
    let data  = [];

    if(typeof url === 'undefined') {
        url = $(thisEl).attr('action');
        data = $(thisEl).serialize();
    }

    Swal.fire({
        icon: 'question',
        title: title,
        html: text,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: true,
        background: getSystemBackground(),
        color: getSystemColor(),
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                data: data,
                url: url,
                success: function (response) {
                    if (typeof successText !== 'undefined' && successText != '') {
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            position: 'top-end',
                            title: successText,
                            background: getSystemBackground(),
                            color: getSystemColor(),
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }

                    if(typeof callback !== 'undefined'){
                        callback();
                    }
                }
            });
        }
    })
}

// Accordion

$(document).on("click", ".acc-title", function (e) {
    e.preventDefault();
    e.stopPropagation();

    let idTitle = '#'+$(this).prop('id');
    let idContent = '#'+$(this).data('id-content');

    if ($(idContent).hasClass('d-none')) {
        $(idTitle + ' .acc-arrow i.first').css('transform', 'translate(-50%, calc(-50% + 2px)) rotate(180deg)');
        $(idTitle + ' .acc-arrow i.second').css('transform', 'translate(-50%, calc(-50% - 2px)) rotate(-180deg)');

        setTimeout(() => {
            $(idContent).removeClass('d-none');
        }, 200);

    }else{
        $(idTitle + ' .acc-arrow i.first').css('transform', 'translate(-50%, calc(-50% + 2px))');
        $(idTitle + ' .acc-arrow i.second').css('transform', 'translate(-50%, calc(-50% - 2px))');

        $(idContent).addClass('d-none');
    }
});

// Sidebar

$(document).on("click", ".sidebar-btn", function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    $('.default-sidebar').addClass('active');

    $(document).on("click", '.wrapper', function (e) {
        e.preventDefault();
        e.stopPropagation();

        if($('.default-sidebar').has($(e.target)).length === 0) {
            $('.default-sidebar').removeClass('active');

            setTimeout(() => {
                $(document).off('click', '.wrapper');
                $(document).off('keyup', 'html');
            }, 200);
        }
    });

    $(document).on("keyup", 'html', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let key = e.keyCode;

        if (key == 27) {
            $('.default-sidebar').removeClass('active');

            setTimeout(() => {
                $(document).off('click', '.wrapper');
                $(document).off('keyup', 'html');
            }, 200);
        }
    });
    
});

// Switch Theme

$('#switch-theme').on('change', function () {
    let switchTheme = $(this).prop('checked') ? 1 : 0;

    $.ajax({
        type: "post",
        url: "users/set_theme",
        data: { theme: switchTheme },
        success: function () {
            if (switchTheme) {
                $('html').removeClass('light');
                $('html').addClass('dark');
            } else {
                $('html').removeClass('dark');
                $('html').addClass('light');
            }
        }, error: function (error) {
            console.log('Ajax error: ', error);
        }
    });
});

// Common functions

function openPageLoad() {
    $('#main-container').css('overflow', 'hidden');
    $('#load-mutation-page').removeClass('d-none');
}

function closePageLoad() {
    $('#main-container').css('overflow', 'unset');
    $('#load-mutation-page').addClass('d-none');
}

function getSystemColor(){
    return $('.wrapper').css('color');
}

function getSystemBackground() {
    return $('.wrapper').css('background-color');
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function changeTitlePage(urlTitle) {
    let separate = urlTitle.split('/');
    let secondPartTitle = ''
    separate.forEach(word => {
        secondPartTitle += capitalizeFirstLetter(word)+' ';
    });

    $('.title-page').html(`Afazeres - ${secondPartTitle}`);
}

