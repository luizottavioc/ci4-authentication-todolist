<?php 
    $path_user = 'files/user_images/'.$user['id_user'].'/profile.png';
    $path_default = '/files/user_images/default_image_profile.png';
    $img_user = !file_exists($path_user) ? $path_default : '/'.$path_user;
?>

<div class="content-modal">
    <img src="<?=$img_user?>" alt="">
    <div class="gd-spaces-2 gap-1 w100 pd-3">
        <div class="aloc-fake-input">
            <div class="fake-input"><?=$user['name']?></div>
            <label class="plch">Nome:</label>
        </div>
        <div class="aloc-fake-input">
            <div class="fake-input"><?=$user['lastname']?></div>
            <label class="plch">Sobrenome:</label>
        </div>
        <div class="aloc-fake-input">
            <div class="fake-input"><?=$user['tipo_nivel']?></div>
            <label class="plch">Nível:</label>
        </div>
        <div class="aloc-fake-input">
            <div class="fake-input"><?=$user['login']?></div>
            <label class="plch">Login:</label>
        </div>
        <div class="aloc-fake-input">
            <div class="fake-input"><?=$user['email']?></div>
            <label class="plch">E-mail:</label>
        </div>
        <?php foreach($permissoes as $permissao): ?>
            <div class="column-toggle-user">
                <label><?=$permissao['name_permiss']?></label>
                <div class="aloc-user-toggle">
                    <label class="fake-toggle small <?= in_array($permissao['id_permiss'], $permissoes_user) ? 'checked' : '' ?>">
                        <span class="toggle-circle"></span>
                    </label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
