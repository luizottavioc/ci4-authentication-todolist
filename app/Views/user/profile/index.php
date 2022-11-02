<?php 
    $path_user = 'files/user_images/'.$user['id_user'].'/profile.png';
    $path_default = '/files/user_images/default_image_profile.png';
    $img_user = !file_exists($path_user) ? $path_default : '/'.$path_user;
?>

<div id="profile-content" class="content-wrapper">
    <img class="image-perofile" src="<?=$img_user?>" alt="">
    <input type="file" name="" id="img-profile" accept="image/*">

    <form action="/users/update_own_user" method="post" class="td-default-form" data-confirm-title="Alterar dados do perfil" data-confirm-text="Deseja realmente alterar os dados do seu perfil?" data-confirm-success-text="Dados alterados com sucesso!">
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
        <button id="sbm-update-own-user" type="submit" class="d-none"></button>
        <div class="aloc-input">
            <label for="sbm-update-own-user" class="submit-form">
                <label class="text-btn">Editar dados</label>
                <label class="bg-btn"></label>
            </label>
        </div>
    </form>

    <form id="change-own-password" action="/users/update_own_password" method="post" data-confirm-title="Alterar senha" data-confirm-text="Deseja realmente alterar sua senha?" data-confirm-success-text="Senha alterada com sucesso!">
        <div class="aloc-input">
            <input type="password" name="actual_password" class="input " value="" placeholder=" " required>
            <label class="plch">Senha atual</label>
        </div>
        <div class="aloc-input">
            <input type="password" name="new_password" class="input password-check" value="" placeholder=" " required>
            <label class="plch">Nova Senha</label>
        </div>
        <div class="aloc-input">
            <input type="password" name="" class="input password-confirm-check" value="" placeholder=" " required>
            <label class="plch">Confirmar nova senha</label>
        </div>
        <button id="sbm-update-own-password" type="submit" class="d-none"></button>
        <div class="aloc-input">
            <label for="sbm-update-own-password" class="submit-form">
                <label class="text-btn">Editar senha</label>
                <label class="bg-btn"></label>
            </label>
        </div>
    </form>

    <div id="modal-ajust-image" class="smooth-modal">
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
