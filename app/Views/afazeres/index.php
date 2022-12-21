<div id="afazeres-page" class="content-wrapper">
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
        <div class="grid-afazeres">
            <div class="aloc-folders">
                <span class="afz-new-afz td-modal" data-modal-url="/afazeres/new_afazer" data-modal-id="modal-afazeres" data-modal-title="Novo Afazer" data-modal-footer="footer-new-afz" data-modal-size="small">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span class="afz-folder default active td-modal" data-modal-url="/afazeres/new_folder" data-modal-id="modal-afazeres" data-modal-title="Nova pasta de afazeres" data-modal-footer="footer-new-afz-folder" data-modal-size="small">
                    <i class="fa-solid fa-folder-open"></i>
                </span>
                <span class="afz-folder">
                    Trabalho
                </span>
                <span class="afz-folder">
                    Faculdade
                </span>
            </div>
            <div class="aloc-afazeres">
                <?php for ($i=0; $i < 10; $i++): ?>
                    <div class="line-afazer">
                        <label for="test<?=$i?>" class="aloc-check-afz">
                            <input id="test<?=$i?>" type="checkbox" name="" id="">
                        </label>
                        <div class="aloc-text-afz">
                            <label>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</label>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <div id="modal-afazeres" class="smooth-modal">
        <div class="aloc-content-modal">
            <div class="title-modal">
                <label class="just-title"></label>
                <span class="close-modal"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="content-modal"></div>
            <div class="footer-modal"></div>
        </div>
    </div>

    <input type="hidden" class="src-script" value="/assets/js/afazeres/afazeres.js">
</div>
