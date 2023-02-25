<?php if(empty($afazeres)): ?>
    <div class="item-afz">
        <div class="td-fade-in-down has-no-results">
            <p>Não há afazeres para serem exibidos.</p>
        </div>
    </div>
<?php endif; ?>
<?php foreach ($afazeres as $afazer): ?>
    <div class="item-afz">
        <div class="td-fade-in-down line-afazer <?= $afazer['is_complete'] ? 'checked' : '' ?>" style="background-color: <?= $folder ? $folder['background_folder'].'50' : '' ?>" data-id-afz="<?= $afazer['id_afazer'] ?>">
            <label for="afz-<?=$afazer['id_afazer']?>" class="aloc-check-afz">
                <input id="afz-<?=$afazer['id_afazer']?>" type="checkbox" class="check-afz" <?= $afazer['is_complete'] ? 'checked' : '' ?> value="<?=$afazer['id_afazer']?>" style="accent-color: <?= $folder ? $folder['background_folder'] : '' ?>">
            </label>
            <div class="aloc-text-afz">
                <label style="color: <?= $folder ? $folder['text_color_folder'] : '' ?>"><?=$afazer['afazer']?></label>
                <div class="aloc-btns-act-afz">
                    <label class="change-afz-folder btn-act-afz muuri td-fade-in-down" style="color: <?= $folder ? $folder['text_color_folder'] : '' ?>">
                        <i class="fa-solid fa-arrows-up-down-left-right"></i>
                    </label>
                    <label class="change-afz-folder btn-act-afz td-modal" data-modal-url="/afazeres/change_afz_folder/<?=$afazer['id_afazer']?>" data-modal-id="modal-afazeres" data-modal-title="Alterar pasta de afazer" data-modal-footer="footer-change-folder" data-modal-size="small" style="color: <?= $folder ? $folder['text_color_folder'] : '' ?>">
                        <i class="fa-solid fa-right-left"></i>
                    </label>
                    <label class="change-afz-folder btn-act-afz td-toast-ajax" data-confirm-url="/afazeres/delete_afz/<?=$afazer['id_afazer']?>" data-confirm-title="Excluir afazer" data-confirm-text="Deseja realmente excluir este afazer?" style="color: <?= $folder ? $folder['text_color_folder'] : '' ?>">
                        <i class="fa-solid fa-xmark"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>