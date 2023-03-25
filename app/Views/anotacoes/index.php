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
                                <label class="btn-just-icon btn-edit-card td-modal" data-modal-url="/anotacoes/edit_card/<?= $card['id_card'] ?>" data-modal-id="modal-anotacoes" data-modal-title='Editar anotação - "<?= $card['name_card'] ?>"' data-modal-footer="footer-edit-card" data-modal-size="small">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </label>
                                <p><?= $card['name_card'] ?></p>
                            </div>
                            <div class="aloc-lines-cards">
                                <div class="grid-muuri-line-cards">
                                    <?php if(!empty($card['anotacoes'])): ?>
                                        <?php foreach ($card['anotacoes'] as $anotacao): ?>
                                            <div class="line-card" data-id-ant="<?= $anotacao['id_anotacao'] ?>">
                                                <p><?= $anotacao['anotacao'] ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="has-no-results">
                                            <p>Nenhuma anotação inserida</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="add-line-card">
                                <label class="btn-circle small td-modal" data-modal-url="/anotacoes/new_ant/<?= $card['id_card'] ?>" data-modal-id="modal-anotacoes" data-modal-title='Adicionar anotação - "<?= $card['name_card'] ?>"' data-modal-footer="footer-new-ant" data-modal-size="small">
                                    <i class="fa-solid fa-plus"></i>
                                </label>
                                <label class="btn-circle small td-toast-ajax" data-confirm-title="Excluir card" data-confirm-text='Deseja realmente excluir o card "<?= $card['name_card'] ?>" de anotações?' data-confirm-success-text="Card excluído com sucesso!" data-confirm-url="/anotacoes/delete_card/<?= $card['id_card'] ?>">
                                    <i class="fa-regular fa-trash-can"></i>
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


