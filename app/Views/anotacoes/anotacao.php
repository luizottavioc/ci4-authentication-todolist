<div class="default-modal-content">
    <form action="/anotacoes/update_anotacao/<?= $anotacao['id_anotacao'] ?>" method="post" class="w100 td-toast-form gd-spaces-1 gap-1 " data-confirm-title="Editar anotação" data-confirm-text="Deseja realmente editar esta anotação?" data-close-modal="true">
        <div class="aloc-input">
            <select class="select" name="fk_card">
                <option value="" hidden readonly selected>Selecione o Card</option>
                <option value="<?= $current_card['id_card'] ?>" selected><?= $current_card['name_card'] ?></option>
                <?php foreach ($cards as $card): ?>
                    <?php if($card['id_card'] == $current_card['id_card']) continue; ?>
                    <option value="<?= $card['id_card'] ?>"><?= $card['name_card'] ?></option>
                <?php endforeach; ?>
            </select>
            <i class="arrow-down fa-solid fa-angles-down"></i>
            <label class="plch">Card</label>
        </div>
        <div class="aloc-input">
            <textarea name="anotacao" class="input" placeholder=" " rows="15" required><?= $anotacao['anotacao'] ?></textarea>
            <label class="plch">Anotação</label>
        </div>
        <div class="w100 flex-center pd-1">
            <label class="submit-form no-width error td-toast-ajax" data-confirm-title="Excluir Anotação" data-confirm-text="Deseja realmente excluir esta anotação?" data-confirm-success-text="Anotação excluída com sucesso!" data-confirm-url="/anotacoes/delete_anotacao/<?= $anotacao['id_anotacao'] ?>">
                <label class="text-btn">Excluir Anotação</label>
                <span class="bg-btn"></span>
            </label>
        </div>
        <button id="sbm-edit-ant" type="submit" class="d-none"></button>
    </form>
</div>
<div id="footer-ant" class="default-modal-footer">
    <label for="sbm-edit-ant" class="submit-form">
        <label class="text-btn">Editar Anotação</label>
        <span class="bg-btn"></span>
    </label>
</div>