<form id="change-own-password" action="/users/update_own_password" method="post" data-confirm-title="Alterar senha" data-confirm-text="Deseja realmente alterar sua senha?" data-confirm-success-text="Senha alterada com sucesso!" class="card-change-own-password">
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
</form>

<div id="footer-change-password" class="default-modal-footer">
    <label for="sbm-update-own-password" class="submit-form">
        <label class="text-btn">Editar senha</label>
        <label class="bg-btn"></label>
    </label>
</div>