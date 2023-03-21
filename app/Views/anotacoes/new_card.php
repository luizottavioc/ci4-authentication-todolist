<div class="default-modal-content">
    <form action="/anotacoes/insert_card" method="post" class="w100 td-toast-form" data-confirm-title="Criar card de anotações" data-confirm-text="Deseja realmente criar um novo card de anotações?" data-close-modal="true">
        <div class="aloc-input">
            <input type="text" name="name_card" class="input" placeholder=" " required>
            <label class="plch">Nome do card</label>
        </div>
        <button id="sbm-new-card" type="submit" class="d-none"></button>
    </form>
</div>
<div id="footer-new-card" class="default-modal-footer">
    <label for="sbm-new-card" class="submit-form">
        <label class="text-btn">Criar Card</label>
        <span class="bg-btn"></span>
    </label>
</div>