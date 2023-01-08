<div class="default-modal-content">
    <form method="post" action="/afazeres/update_afz_folder" class="td-toast-form aloc-all-change-folder" data-confirm-title="Alterar pasta de afazer" data-confirm-text="Deseja realmente alterar pasta de referência deste afazer?">
        <button id="sbm-change-folder" type="submit" class="d-none"></button>
        <input type="hidden" name="id_afazer" value="<?= $afazer['id_afazer'] ?>">
        <input type="hidden" name="actual_folder" value="<?= $afazer['fk_folder'] ?>">
        <div class="aloc-fake-input dsb">
            <div class="fake-input"><?= $afazer['afazer'] ?></div>
            <label class="plch">Afazer</label>
        </div>
        <div class="aloc-fake-input dsb">
            <div class="fake-input"><?= $afazer['name_folder']  ?? 'Nenhuma pasta atribuída' ?></div>
            <label class="plch">Pasta atual</label>
        </div>
        <div class="aloc-input">
            <select class="select sel-view-folder" name="fk_folder" required>
                <option value="" readonly selected>Selecione a Pasta</option>
                <option value="0" selected>Não atribuir a nenhuma pasta</option>
                <?php foreach ($folders as $folder): ?>
                    <option value="<?= $folder['id_folder'] ?>"><?= $folder['name_folder'] ?></option>
                <?php endforeach; ?>
            </select>
            <i class="arrow-down fa-solid fa-angles-down"></i>
            <label class="plch has-open">Nova Pasta</label>
        </div>
        <div class="container-view-folder">
            <div class="has-no-results">
                Nenhuma pasta foi selecionada para ser exibida.
            </div>
        </div>
    </form>
</div>

<span class="disappear">
    <div id="default-line-view-afz" class="line-view-afz td-fade-in-down"><p></p></div>
    <div id="default-no-results-line-view-afz" class="has-no-results td-fade-in-down"><p></p></div>
</span>

<div id="footer-change-folder" class="default-modal-footer">
    <label for="sbm-change-folder" class="submit-form">
        <label class="text-btn">Alterar pasta do afazer</label>
        <span class="bg-btn"></span>
    </label>
</div>