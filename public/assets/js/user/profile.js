var cp = undefined;

$('#img-profile').on('change', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let file = e.target.files[0];
    if (file.size > 7000000) {
        Swal.fire({
            toast: true,
            icon: 'error',
            position: 'top-end',
            title: 'Arquivo muito grande! O tamanho máximo é de 7MB',
            background: getSystemBackground(),
            color: getSystemColor(),
            showConfirmButton: false,
            timer: 3000
        });
        $(this).val('');

        return false;
    }

    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = e => {
        ajaxModal({
            url: '/users/ajust_user_image',
            id_modal: 'modal-ajust-image',
            title: 'Ajustar Imagem',
            id_footer: 'footer-ajust-image',
            size: 'small'
        }, () => {
            cp = $('.aloc-croppie');
            cp.croppie({
                url: e.target.result,
                viewport: {
                    width: 240,
                    height: 240,
                    type: 'circle',
                },
                boundary: {
                    width: 320,
                    height: 320,
                },
                customClass: 'croppie-container-td'
            });
            cp.croppie('bind', e.target.result);
            
            let slider = $('.cr-slider-wrap');
            $(slider).appendTo('#footer-ajust-image');
        }); 
    };
});

$('#profile-content').on('click', '.btn-complete-edit', function (e) {
    e.preventDefault();
    e.stopPropagation();

    cp.croppie('result', {
        type: 'base64',
        size: 'viewport',
    }).then(function (base64) {
        let data = new FormData();
        data.append('img', base64);
        $.ajax({
            url: '/users/insert_user_img',
            type: 'POST',
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (res) {
                $('.close-modal').click();
                $('#img-profile').val('');
                $('.sid-image-profile img').attr('src', `${res.src_img}?${generateString()}}`);
                $('.image-perofile').attr('src', `${res.src_img}?${generateString()}}`);
                
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    position: 'top-end',
                    title: 'Imagem atualizada com sucesso!',
                    background: getSystemBackground(),
                    color: getSystemColor(),
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            error: function (res) {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    position: 'top-end',
                    title: 'Erro ao atualizar imagem!',
                    background: getSystemBackground(),
                    color: getSystemColor(),
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.close-modal').click();
            },
        });
    });
});

$('#profile-content').on('submit', '#change-own-password', function (e) {
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

    confirmAjax(this);
});