<?php 
    $path_user = 'files/user_images/'.$user['id_user'].'/profile.png';
    $path_default = '/files/user_images/default_image_profile.png';
    $img_user = !file_exists($path_user) ? $path_default : '/'.$path_user;
?>

<div id="profile-content" class="content-wrapper">
    <div class="aloc-header-page">
        <div class="aloc-title">
            <?= $titulo?>
        </div>
        <div class="aloc-route">
            <label class="text-nolink"><?= $titulo?></label>
            <label class="text-nolink">/</label>
            <a class="link-page ajax-redirect" data-url="/">Home</a>
        </div>
    </div>
    <div class="aloc-content-page">
        <div class="card-content-page">
            <div class="aloc-profile-page">
                <div class="container-image">
                    <div class="aloc-image">
                        <img class="image-profile" src="<?=$img_user?>">
                        <input type="file" id="img-profile" accept="image/*" class="d-none">
                        <label for="img-profile" class="btn-change-img">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </label>
                    </div>
                    <label class="user-login">@<?=$user['login']?></label>
                </div>
                <form action="/users/update_own_user" method="post" class="td-default-form container-user-data" data-confirm-title="Alterar dados do perfil" data-confirm-text="Deseja realmente alterar os dados do seu perfil?" data-confirm-success-text="Dados alterados com sucesso!">
                    <div class="aloc-input">
                        <input type="text" name="name" class="input" value="<?= $user['name'] ?>" required>
                        <label class="plch">Nome</label>
                    </div>
                    <div class="aloc-input">
                        <input type="text" name="lastname" class="input" value="<?= $user['lastname'] ?>" required>
                        <label class="plch">Sobrenome</label>
                    </div>
                    <div class="aloc-input">
                        <input type="text" name="login" class="input" value="<?= $user['login'] ?>" required>
                        <label class="plch">Login</label>
                    </div>
                    <div class="aloc-input">
                        <input type="email" name="email" class="input" value="<?= $user['email'] ?>" required>
                        <label class="plch">E-mail</label>
                    </div>
                    <div class="aloc-btn-password">
                        <label class="btn-default td-modal" data-modal-url="/users/change_own_password" data-modal-id="modal-profile" data-modal-title="Alterar Senha" data-modal-footer="footer-change-password" data-modal-size="small">Alterar senha</label>
                    </div>
                    <button id="sbm-update-own-user" type="submit" class="d-none"></button>
                    <div class="submit-data">
                        <label for="sbm-update-own-user" class="submit-form">
                            <label class="text-btn">Editar dados</label>
                            <label class="bg-btn"></label>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-profile" class="smooth-modal">
        <div class="aloc-content-modal">
            <div class="title-modal">
                <label class="just-title"></label>
                <span class="close-modal"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="content-modal"></div>
            <div class="footer-modal"></div>
        </div>
    </div>
    
    <input type="hidden" class="src-script" value="<?= base_url('assets/js/user/profile.js'.version_js()) ?>">
</div>