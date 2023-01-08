<div class="default-modal-content">
    <form action="/afazeres/insert_afazer" method="post" class="aloc-data-new-afz td-toast-form" data-confirm-title="Criar afazer" data-confirm-text="Deseja realmente criar um novo afazer?">
        <div class="aloc-input">
            <select class="select" name="fk_folder">
                <option value="" hidden readonly selected>Selecione a Pasta</option>
                <option value="" selected>Não atribuir a nenhuma pasta</option>
                <?php foreach ($folders as $folder): ?>
                    <option value="<?= $folder['id_folder'] ?>" <?= isset($id_folder) && $id_folder == $folder['id_folder'] ? 'selected' : '' ?>><?= $folder['name_folder'] ?></option>
                <?php endforeach; ?>
            </select>
            <i class="arrow-down fa-solid fa-angles-down"></i>
            <label class="plch">Pasta de referência:</label>
        </div>
        <div class="aloc-input">
            <textarea name="afazer" class="input" placeholder=" " required></textarea>
            <label class="plch">Afazer</label>
        </div>
        <button id="sbm-new-afz" type="submit" class="d-none"></button>
    </form>
</div>

<div id="footer-new-afz" class="default-modal-footer">
    <label for="sbm-new-afz" class="submit-form">
        <label class="text-btn">Criar Afazer</label>
        <span class="bg-btn"></span>
    </label>
</div>