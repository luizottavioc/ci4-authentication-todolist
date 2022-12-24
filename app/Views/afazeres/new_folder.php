<div class="default-modal-content">
    <form action="/afazeres/insert_folder" method="post" class="aloc-data-new-afz-folder td-toast-form" data-confirm-title="Criar pasta de afazeres" data-confirm-text="Deseja realmente criar uma nova pasta de afazeres?">
        <div class="aloc-input">
            <input type="text" name="name_folder" class="input" placeholder=" " required>
            <label class="plch">Nome da pasta</label>
        </div>
        <div class="aloc-input">
            <input type="color" name="background_folder" class="color-picker" value="#9868e9" required>
            <label class="plch has-open">Cor de referência</label>
        </div>
        <div class="aloc-input">
            <input type="color" name="text_color_folder" class="color-picker" value="#ffffff" required>
            <label class="plch has-open">Cor do texto</label>
        </div>
        <button id="sbm-new-afz" type="submit" class="d-none"></button>
    </form>
</div>

<div id="footer-new-afz-folder" class="default-modal-footer">
    <label for="sbm-new-afz" class="submit-form">
        <label class="text-btn">Criar Pasta de Afazeres</label>
        <span class="bg-btn"></span>
    </label>
</div>