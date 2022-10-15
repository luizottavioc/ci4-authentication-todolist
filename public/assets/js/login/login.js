$('#switch-theme').on('change', function() {
    let switchTheme = $(this).prop('checked') ? 1 : 0;

    $.ajax({
        type: "post",
        url: "users/set_theme",
        data: {theme: switchTheme},
        success: function () {
            if (switchTheme) {
                $('html').removeClass('light');
                $('html').addClass('dark');
            } else {
                $('html').removeClass('dark');
                $('html').addClass('light');
            }
        },error: function (error) {
            console.log('Ajax error: ', error);
        }
    });
});

$('#form-register').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let passw1 = $('.password').val();
    let passw2 = $('.password-check').val();


    if (passw1 != passw2) {
        Swal.fire({
            toast: true,
            icon: 'error',
            position: 'top-end',
            title: 'As senhas não coincidem!',
            background: getSystemBackground(),
            color: getSystemColor(),
            showConfirmButton: false,
            timer: 3000
        });

        $('.password').addClass('invalid');
        $('.password-check').addClass('invalid');

        return false;
    }

    let form = $(this);
    let formData = new FormData(form[0]);
    let url = form.attr('action');

    $.ajax({
        type: "post",
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (args) {
            if (args.redirect_page){
                window.location.href = args.redirect_page;
                return false;
            }

            $('input').removeClass('invalid');
            for (column of args.columns_error) {
                $(`input[name=${column}]`).addClass('invalid');
            }

            Swal.fire({
                toast: true,
                icon: 'error',
                position: 'top-end',
                title: 'As credenciais fornecidas já estão em uso!',
                background: getSystemBackground(),
                color: getSystemColor(),
                showConfirmButton: false,
                timer: 3000
            });
        },
        error: function (error) {
            console.log('Ajax error: ', error);
        }
    });
});

function getSystemColor() {
    return $('.wrapper').css('color');
}

function getSystemBackground() {
    return $('.wrapper').css('background-color');
}