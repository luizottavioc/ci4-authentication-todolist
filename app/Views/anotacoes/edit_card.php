<div class="default-modal-content">
    <form action="/anotacoes/update_card/<?= $card['id_card'] ?>" method="post" class="w100 td-toast-form" data-confirm-title="Editar Card de Anotações" data-confirm-text='Deseja realmente editr o card "<?= $card['name_card'] ?>" de anotações?' data-close-modal="true">
        <div class="aloc-input">
            <input type="text" name="name_card" class="input" placeholder=" " value="<?= $card['name_card'] ?>" required>
            <label class="plch">Nome do card</label>
        </div>
        <button id="sbm-edit-card" type="submit" class="d-none"></button>
    </form>
</div>
<div id="footer-edit-card" class="default-modal-footer">
    <label for="sbm-edit-card" class="submit-form">
        <label class="text-btn">Editar Card</label>
        <span class="bg-btn"></span>
    </label>
</div>