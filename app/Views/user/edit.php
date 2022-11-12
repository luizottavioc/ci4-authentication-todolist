<?php 
    $path_user = 'files/user_images/'.$user['id_user'].'/profile.png';
    $path_default = '/files/user_images/default_image_profile.png';
    $img_user = !file_exists($path_user) ? $path_default : '/'.$path_user;
?>

<div class="content-modal">
    <div class="aloc-user-structure">
        <div class="aloc-all-user-data">
            <div class="aloc-user-image">
                <img src="<?=$img_user?>" alt="user image">
            </div>
            <form id="form-update-user" action="/users/update_data_user" method="post" class="td-default-form aloc-user-data edit" data-confirm-title="Atualizar Usuário" data-confirm-text="Você realmente deseja atualizar os dados deste usuário?" data-confirm-success-text="Usuário atualizado com sucesso!" data-url-refresh="/users" data-close-modal="true">
                <input type="hidden" name="id_user" value="<?=$user['id_user']?>">
                <div class="aloc-input name">
                    <input class="input" name="name" type="text" placeholder=" " value="<?=$user['name']?>" required>
                    <label class="plch">Nome:</label>
                </div>
                <div class="aloc-input lastname">
                    <input class="input" name="lastname" type="text" placeholder=" " value="<?=$user['lastname']?>" required>
                    <label class="plch">Sobrenome:</label>
                </div>
                <div class="aloc-input nivel">
                    <select class="select" name="fk_nivel" required>
                        <?php foreach ($niveis as $nivel): ?>
                            <option value="<?=$nivel['id_nivel']?>" <?=($nivel['id_nivel'] == $user['fk_nivel']) ? 'selected' : ''?>><?=$nivel['tipo_nivel']?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="arrow-down fa-solid fa-angles-down"></i>
                    <label class="plch">Nível:</label>
                </div>
                <div class="aloc-input login">
                    <input class="input" name="login" type="text" placeholder=" " value="<?=$user['login']?>" required>
                    <label class="plch">Login:</label>
                </div>
                <div class="aloc-input email">
                    <input class="input" name="email" type="email" placeholder=" " value="<?=$user['email']?>" required>
                    <label class="plch">E-mail:</label>
                </div>
                <button id="sbm-edit-user" type="submit" class="d-none"></button>
            </form>
            <?php if(permissoes_helper('edit_permiss')): ?>
                <div class="aloc-user-permiss">
                    <input form="form-update-user" type="hidden" name="change_permiss" value="1">
                    <?php foreach($permissoes as $permissao): ?>
                        <div class="column-toggle-user">
                            <label class="name-permiss"  for="toggle-permiss-<?=$permissao['id_permiss']?>"><?=$permissao['name_permiss']?></label>
                            <div class="aloc-user-toggle">
                                <input form="form-update-user" id="toggle-permiss-<?=$permissao['id_permiss']?>" type="checkbox" class="toggle-input" name="permiss_user[]" value="<?=$permissao['id_permiss']?>" <?= in_array($permissao['id_permiss'], $permissoes_user) ? 'checked' : ''?>>
                                <label for="toggle-permiss-<?=$permissao['id_permiss']?>" class="toggle small">
                                    <span class="toggle-circle"></span>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="user-change-password">
                <div id="acc-password" data-id-content="acc-content-change-password" class="acc-title title-acc-change-pass">
                    <div class="acc-arrow">
                        <i class="fa-solid fa-chevron-down first"></i>
                        <i class="fa-solid fa-chevron-down second"></i>
                    </div>
                    Alterar senha
                </div>
                <form id="acc-content-change-password" action="/users/update_data_user" method="post" class="edit-password-user-form content-acc-change-pass acc-content d-none" data-confirm-title="Atualizar Senha do Usuário" data-confirm-text="Você realmente deseja atualizar a senha deste usuário?" data-confirm-success-text="Senha atualizada com sucesso!" data-url-refresh="/users" data-close-modal="true">
                    <input type="hidden" name="id_user" value="<?=$user['id_user']?>">
                    <div class="aloc-input pass">
                        <input class="input password-check" name="password_hash" type="password" placeholder=" ">
                        <label class="plch">Nova senha:</label>
                    </div>
                    <div class="aloc-input pass">
                        <input class="input password-confirm-check" type="password" placeholder=" ">
                        <label class="plch">Confirmar nova senha:</label>
                    </div>
                    <button id="sbm-edit-password-user" type="submit" class="d-none"></button>
                    <div class="aloc-btn-submit-pass">
                        <label for="sbm-edit-password-user" class="submit-form no-width">
                            <label class="text-btn">Atualizar Senha do Usuário</label>
                            <span class="bg-btn"></span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
  
    <div id="footer-data-user" class="default-modal-footer">
        <label for="sbm-edit-user" class="submit-form">
            <label class="text-btn">Atualizar Dados do Usuário</label>
            <span class="bg-btn"></span>
        </label>
    </div>
</div>
