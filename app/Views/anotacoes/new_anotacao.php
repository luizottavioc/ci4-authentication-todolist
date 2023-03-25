<div class="default-modal-content">
    <form action="/anotacoes/insert_ant/<?= $card['id_card'] ?>" method="post" class="w100 td-toast-form" data-confirm-title="Criar nova anotação" data-confirm-text='Deseja realmente criar uma nova anotação no card "<?= $card['name_card'] ?>"?' data-close-modal="true">
        <div class="aloc-input">
            <textarea name="anotacao" class="input" placeholder=" " rows="15" required></textarea>
            <label class="plch">Anotação</label>
        </div>
        <button id="sbm-new-ant" type="submit" class="d-none"></button>
    </form>
</div>
<div id="footer-new-ant" class="default-modal-footer">
    <label for="sbm-new-ant" class="submit-form">
        <label class="text-btn">Criar Anotação</label>
        <span class="bg-btn"></span>
    </label>
</div>