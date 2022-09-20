<div class="content-modal">
    <form action="/users/insert_user" method="post" class="td-default-form h100" data-confirm-title="Atualizar Usuário" data-confirm-text="Você realmente deseja atualizar os dados deste usuário?" data-confirm-success-text="Usuário atualizado com sucesso!" data-url-refresh="/users" data-close-modal="true">
        <input type="hidden" name="id_user" value="<?=$user['id_user']?>">
        <div class="aloc-input">
            <input class="input" name="name" type="text" placeholder=" " value="<?=$user['name']?>" required>
            <label class="plch">Nome:</label>
        </div>
        <div class="aloc-input">
            <input class="input" name="lastname" type="text" placeholder=" " value="<?=$user['lastname']?>" required>
            <label class="plch">Sobrenome:</label>
        </div>
        <div class="aloc-input">
            <select class="select" name="fk_nivel" required>
                <?php foreach ($niveis as $nivel): ?>
                    <option value="<?=$nivel['id_nivel']?>" <?=($nivel['id_nivel'] == $user['fk_nivel']) ? 'selected' : ''?>><?=$nivel['tipo_nivel']?></option>
                <?php endforeach; ?>
            </select>
            <i class="arrow-down fa-solid fa-angles-down"></i>
            <label class="plch">Nível:</label>
        </div>
        <div class="aloc-input">
            <input class="input" name="login" type="text" placeholder=" " value="<?=$user['login']?>" required>
            <label class="plch">Login:</label>
        </div>
        <div class="aloc-input">
            <input class="input" name="email" type="email" placeholder=" " value="<?=$user['email']?>" required>
            <label class="plch">E-mail:</label>
        </div>
        <?php foreach($permissoes as $permissao): ?>
            <div class="column-toggle-user">
                <label for="toggle-permiss-<?=$permissao['id_permiss']?>"><?=$permissao['name_permiss']?></label>
                <div class="aloc-user-toggle">
                    <input id="toggle-permiss-<?=$permissao['id_permiss']?>" type="checkbox" class="toggle-input" name="permiss_user[]" value="<?=$permissao['id_permiss']?>" <?= in_array($permissao['id_permiss'], $permissoes_user) ? 'checked' : ''?>>
                    <label for="toggle-permiss-<?=$permissao['id_permiss']?>" class="toggle small">
                        <span class="toggle-circle"></span>
                    </label>
                </div>
            </div>
        <?php endforeach; ?>
        <button id="sbm-edit-user" type="submit" class="d-none"></button>
    </form>
    
    <form action="/users/insert_user" method="post" class="edit-password-user-form" data-confirm-title="Atualizar Senha do Usuário" data-confirm-text="Você realmente deseja atualizar a senha deste usuário?" data-confirm-success-text="Senha atualizada com sucesso!" data-url-refresh="/users" data-close-modal="true">
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
    </form>
  
    <div id="footer-data-user" class="default-modal-footer">
        <label for="sbm-edit-user" class="submit-form">
            <label class="text-btn">Atualizar Dados do Usuário</label>
            <span class="bg-btn"></span>
        </label>
        <label for="sbm-edit-password-user" class="submit-form">
            <label class="text-btn">Atualizar Senha do Usuário</label>
            <span class="bg-btn"></span>
        </label>
    </div>
</div>
