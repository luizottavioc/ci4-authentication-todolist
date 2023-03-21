<div id="anotacoes-page" class="content-wrapper">
    <div class="aloc-header-page">
        <div class="aloc-title">
            <?= $titulo?>
        </div>
        <div class="aloc-route">
            <label class="text-nolink"><?= $titulo?></label>
            <label class="text-nolink">/</label>
            <a class="link-page ajax-redirect" data-url="/">Home</a>
        </div>
    </div>
    <div class="aloc-content-page">
        <div class="grid-anotacoes">
            <div class="aloc-btn-add-cards">
                <label class="btn-circle td-modal" data-modal-url="/anotacoes/new_card" data-modal-id="modal-anotacoes" data-modal-title="Adicionar card de anotações" data-modal-footer="footer-new-card" data-modal-size="small">
                    <i class="fa-solid fa-plus"></i>
                </label>
            </div>
            <div class="aloc-cards">
                <?php if(!empty($cards)): ?>
                    <?php foreach ($cards as $card): ?>
                        <div class="card td-fade-in-down">
                            <div class="title-card">
                                <?= $card['name_card'] ?>
                            </div>
                            <div class="aloc-lines-cards">
                                <div class="grid-muuri-line-cards">
                                    <?php for ($j=0; $j < 10; $j++): ?>
                                        <div class="line-card">
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolore, vel natus. Tempora distinctio vero iusto odio obcaecati nihil repellendus adipisci doloremque, cupiditate veritatis. Suscipit quaerat pariatur, provident natus quidem voluptatem? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur velit tenetur laboriosam tempora soluta voluptatibus corporis. Facere consectetur voluptatum possimus, iure totam, harum reprehenderit beatae sint explicabo recusandae natus odit?</p>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="add-line-card">
                                <label class="btn-circle small">
                                    <i class="fa-solid fa-plus"></i>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="has-no-results">
                        <p>Nenhum card de anotações foi encontrado para o seu usuário.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div id="modal-anotacoes" class="smooth-modal">
        <div class="aloc-content-modal">
            <div class="title-modal">
                <label class="just-title"></label>
                <span class="close-modal"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="content-modal"></div>
            <div class="footer-modal"></div>
        </div>
    </div>

    <input type="hidden" class="src-script" value="<?= base_url('assets/js/anotacoes/anotacoes.js'.version_js()) ?>">
</div>


