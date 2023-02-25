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
                <label class="afz-new-folder default active td-modal" data-modal-url="/afazeres/new_folder" data-modal-id="modal-afazeres" data-modal-title="Nova pasta de afazeres" data-modal-footer="footer-new-afz-folder" data-modal-size="small">
                    <i class="fa-solid fa-folder-plus"></i>
                </label>
                <?php foreach ($folders as $folder): ?>
                    <label class="afz-folder <?= $folder_selected && $folder_selected['id_folder'] == $folder['id_folder'] ? 'active' : '' ?>" data-id-folder="<?=$folder['id_folder']?>" data-background="<?=$folder['background_folder']?>" style="background-color: <?= $folder['background_folder'] ?? 'transparent' ?>; color: <?= $folder['text_color_folder'] ?? 'var(--text-color)' ?>">
                        <label class="cover-folder"></label>
                        <input type="text" value="<?= $folder['name_folder'] ?>" class="ipt-name-folder" data-db-name="<?= $folder['name_folder'] ?>">
                        <span class="delete-folder td-toast-ajax" data-confirm-title="Excluir pasta" data-confirm-text='Deseja realmente excluir a pasta "<?=$folder['name_folder']?>"?' data-confirm-success-text="Pasta excluída com sucesso!" data-confirm-url="/afazeres/delete_folder/<?=$folder['id_folder']?>">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </label>
                <?php endforeach; ?>
                <label class="afz-new-afz" data-modal-url="/afazeres/new_afazer" data-modal-id="modal-afazeres" data-modal-title="Novo Afazer" data-modal-footer="footer-new-afz" data-modal-size="small">
                    <i class="fa-solid fa-plus"></i>
                </label>
            </div>
            <div class="aloc-afazeres" style="border-color: <?= $folder_selected ? $folder_selected['background_folder'].'30' : '' ?>">
                <div class="grid-muuri-afz"><?= $afazeres ?></div>
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

    <input type="hidden" class="src-script" value="<?= base_url('assets/js/afazeres/afazeres.js'.version_js()) ?>">
</div>
