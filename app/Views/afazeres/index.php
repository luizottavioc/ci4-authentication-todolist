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
                <?php foreach ($folders as $folder): ?>
                    <span class="afz-folder" data-id-folder="<?=$folder['id_folder']?>" style="background-color: <?=$folder['background_folder']?>; color: <?=$folder['text_color_folder']?>"><?=$folder['name_folder']?></span>
                <?php endforeach; ?>
            </div>
            <div class="aloc-afazeres">
                <?= $afazeres ?>
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
