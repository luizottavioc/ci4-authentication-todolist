<?php
    switch ($type_page) {
        case 'edit':
            $text_submit = 'Atualizar Usuário';
            $text_confirm = 'Você realmente deseja atualizar este usuário?';
            $text_confirm_success = 'Usuário atualizado com sucesso!';
            break;
        case 'create':
            $text_submit = 'Criar Usuário';
            $text_confirm = 'Você realmente deseja criar este usuário?';
            $text_confirm_success = 'Usuário criado com sucesso!';
            break;
        default:
            $text_submit = '';
            $text_confirm = '';
            $text_confirm_success = '';
            break;
    }
?>

<div class="content-modal">
    <form action="/user/insert_user" method="post" class="td-default-form" data-confirm-title="<?=$text_submit?>" data-confirm-text="<?=$text_confirm?>" data-confirm-success-text="<?=$text_confirm_success?>" data-url-refresh="/user" data-close-modal="true">
        <input type="hidden" name="id_user" value="<?=isset($user['id_user']) ? $user['id_user'] : ''?>">
        <div class="aloc-input">
            <input class="input" name="name" type="text" placeholder=" " value="<?=isset($user['name']) ? $user['name'] : ''?>" required>
            <label class="plch">Nome:</label>
        </div>
        <div class="aloc-input">
            <input class="input" name="email" type="email" placeholder=" " value="<?=isset($user['email']) ? $user['email'] : ''?>" required>
            <label class="plch">E-mail:</label>
        </div>
        <div class="aloc-input pass">
            <input class="input" name="password_hash" type="password" placeholder=" " <?=$type_page == 'create' ? 'required' : ''?>>
            <label class="plch">Senha:</label>
        </div>
        <button id="sbm-user" type="submit" class="d-none"></button>
    </form>
  
    <div id="footer-data-user" class="default-modal-footer">
        <label for="sbm-user" class="submit-form medium">
            <label><?=$text_submit?></label>
            <i class="fa-solid fa-arrow-right"></i>
        </label>
    </div>
</div>
