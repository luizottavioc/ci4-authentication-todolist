var userListeners = 0;

if(userListeners == 0) {
    userListeners++;
    initUserListeners();
}

function initUserListeners() {
    $('#user-content').on('submit', '.create-user-form, .edit-password-user-form', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let passw1 = $('.password-check').val();
        let passw2 = $('.password-confirm-check').val();
  

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

            return false;  
        }
    
        
        confirmAjax(this, () => {
            let urlRefresh = $(this).data('url-refresh');

            $(`.close-modal`).click();
            ajaxRedirect(urlRefresh);
        });
    });
}

