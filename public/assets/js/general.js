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
    let urlPath = $(this).data('url') ?? $(this).attr('href');
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
            data: { only_content: 1 },
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

const resultRedirects = async (response, targetUrl, page = undefined) => {
    $('.aloc-sid-line').removeClass('active');

    if (targetUrl == '/users/profile') {
        $('.sid-profile-line').addClass('active');
    }else{
        $('.sid-profile-line').removeClass('active');

        let lineSidebar = $(`[data-sidebar-module="/${targetUrl.split('/')[1]}"]`);
        lineSidebar.addClass('active');
        lineSidebar.hasClass('acc-title') ? $(`#${lineSidebar.data('id-content')}`).removeClass('d-none') : null;
    }

    await $(page ?? '#main-container').hide().html(response).fadeIn('fast');

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

$(document).on('click', '.td-modal', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let element = $(this);
    let url = element.data('modal-url');
    let modal = element.data('modal-id');
    let title = element.data('modal-title');
    let footer = element.data('modal-footer');
    let size = element.data('modal-size');

    ajaxModal({
        url: url,   
        id_modal: modal,
        title: title,
        id_footer: footer,
        size: size
    });
});

$(document).on('click', '.close-modal', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let modal = this.parentNode.parentNode.parentNode;
    closeModal(modal);
});

async function ajaxModal(opt, callback = undefined) {
    let url = opt.url;
    let modal = $(`#${opt.id_modal}`);
    let title = opt.title;
    let footer = opt.id_footer;
    let size = opt.size;
    let typeAjax = opt.typeAjax ?? 'post';

    if ($('html').prop('scrollHeight') > $('html').prop('clientHeight')) $('html').css('overflow-y', 'hidden').css('padding-right', '10px');

    if (modal.length > 0 && (typeof url !== 'undefined' && url != '')) {
        let contentModal = modal.children('.aloc-content-modal');
        typeof size !== 'undefined' ? modal.addClass(size) : false;

        $.ajax({
            type: typeAjax,
            url: url,
            dataType: "html",
            success: async (response) => {
                $(modal).find('.just-title').html(title);
                await $(contentModal).children('.content-modal').html(response);
                footer ? $(contentModal).children('.footer-modal').append($(`#${footer}`)) : false;
                $(modal).addClass('active');

                typeof callback === 'function' ? callback() : false;

            }, error: function (error) {
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

    } else {
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
}

function closeModal(elModal) {
    if ($('html').css('padding-right') != '0px') $('html').css('overflow-y', 'auto').css('padding-right', '0px');

    let modal = $(elModal);
    let title = modal.find('.just-title');
    let content = modal.find('.content-modal');
    let footer = modal.find('.footer-modal');

    title.html('');
    content.html('');
    footer.html('');
    modal.removeClass('active');
}

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

    let element = $(this);
    let urlRefresh = element.data('url-refresh');
    let closeModal = element.data('close-modal');

    confirmAjax(this, () => {
        if(typeof closeModal !== 'undefined' && closeModal){
            $(`.close-modal`).click();
        }

        if(typeof urlRefresh !== 'undefined' && urlRefresh != ''){
            ajaxRedirect(urlRefresh);
        }
    });

    element = null;
});

$(document).on('submit', '.td-toast-form', function (e) {
    e.preventDefault();
    e.stopPropagation(); 

    toastAjax($(this));
});

$(document).on('click', '.td-toast-ajax', function (e) {
    e.preventDefault();
    e.stopPropagation(); 

    toastAjax($(this));
});

function confirmAjax(thisEl, callback = undefined) {
    thisEl = $(thisEl);

    let title = thisEl.data('confirm-title');
    let text = thisEl.data('confirm-text');
    let successText = thisEl.data('confirm-success-text');
    let url = thisEl.data('confirm-url');
    let data  = [];

    if(typeof url === 'undefined') {
        url = thisEl.attr('action');
        data = thisEl.serialize();
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
                    if(typeof response === 'string' && response != '') response = JSON.parse(response);

                    if(typeof response === 'string' || response.status == true){
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

                        return true;
                    }

                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        position: 'top-end',
                        title: response.message,
                        background: getSystemBackground(),
                        color: getSystemColor(),
                        showConfirmButton: false,
                        timer: 3500
                    });

                    return false;

                }, error: function (error) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        position: 'top-end',
                        title: 'Erro ao executar ação!',
                        background: getSystemBackground(),
                        color: getSystemColor(),
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    })
}

function toastAjax(element, callback = undefined) {
    element = $(element);

    let title = element.data('confirm-title') ?? 'Enviar formulário';
    let text = element.data('confirm-text') ?? 'Deseja realmente enviar o formulário?';
    let url = element.attr('action') ?? element.data('confirm-url');
    let type = element.attr('method') ?? 'POST';
    let closeModal = element.data('close-modal');
    let data = element.serialize() ?? [];

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
                type: type,
                url: url,
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.icon == 'success') {
                        response.redirect ? responseRedirect(response.redirect) : false;
                        closeModal ? $(`.close-modal`).click() : false;
                    }

                    response.icon && (response.title || response.text) ? Swal.fire({
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
                    }) : false;

                    typeof callback === 'function' ? callback() : false;

                    return true;

                }, error: function (error) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        position: 'top-end',
                        title: 'Erro no servidor!',
                        background: getSystemBackground(),
                        color: getSystemColor(),
                        showConfirmButton: false,
                        timer: 1500
                    });

                    return false;
                }
            });
        }
    })
}

async function responseRedirect (redirect) {
    if (redirect.page && redirect.url) {
        await $.ajax({
            type: "post",
            url: redirect.url,
            data: { only_content: true },
            success: (res) => resultRedirects(res, redirect.url, redirect.page),
            error: (error) => console.log(error)
        });

        if ($('html').css('padding-right') != '0px') $('html').css('overflow-y', 'auto').css('padding-right', '0px');
    }

    if (redirect.id_element_modal && redirect.url_modal) {
        ajaxModal({
            url: redirect.url_modal,
            id_modal: redirect.id_modal,
            title: redirect.title,
            id_footer: redirect.id_modal_footer,
            size: redirect.size,
        });
    }

    return true;
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
        url: "/users/set_theme",
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

// Optional inputs

$(document).on("change", ".check-optional-input", function (e) {
    e.preventDefault();
    e.stopPropagation();

    let cbxEl = $(this);
    let container = cbxEl.closest('.aloc-input');
    let iptIndex = parseInt(cbxEl.index()) + 1;
    let ipt = $(container.children()[iptIndex]);

    ipt.toggleClass('dsb').attr('disabled', (_, attr) => !attr);

    return true;
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

function generateString() {
    result = Math.random().toString(36).substring(2, 7);
    return result;
}

function copyStructure(jq, idsToRemove = []) {
    let newId = generateString();
    let element = $(jq);

    if (!element.length) return '';

    let elCopied = $(jq).prop('outerHTML').replace(/#####/g, newId);
    if (idsToRemove.length) {
        for (id of idsToRemove) {
            elCopied = elCopied.replace(id, '');
        }

        return elCopied;
    }

    return elCopied;
}