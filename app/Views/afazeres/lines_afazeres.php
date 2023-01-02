<div class="td-fade-in-down has-no-results <?= empty($afazeres) ? '' : 'd-none' ?>">
    Não há afazeres para serem exibidos.
</div>
<?php foreach ($afazeres as $afazer): ?>
    <div class="td-fade-in-down line-afazer" style="background-color: <?= $folder ? $folder['background_folder'].'50' : '' ?>">
        <label for="afz-<?=$afazer['id_afazer']?>" class="aloc-check-afz">
            <input id="afz-<?=$afazer['id_afazer']?>" type="checkbox" name="" id="" style="accent-color: <?= $folder ? $folder['background_folder'] : '' ?>">
        </label>
        <div class="aloc-text-afz">
            <label style="color: <?= $folder ? $folder['text_color_folder'] : '' ?>"><?=$afazer['afazer']?></label>
        </div>
    </div>
<?php endforeach; ?>