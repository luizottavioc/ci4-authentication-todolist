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

