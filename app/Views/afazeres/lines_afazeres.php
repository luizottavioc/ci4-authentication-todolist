<div class="has-no-results <?= empty($afazeres) ? '' : 'd-none' ?>">
    Não há afazeres para serem exibidos.
</div>
<?php foreach ($afazeres as $afazer): ?>
    <div class="line-afazer">
        <label for="afz-<?=$afazer['id_afazer']?>" class="aloc-check-afz">
            <input id="afz-<?=$afazer['id_afazer']?>" type="checkbox" name="" id="">
        </label>
        <div class="aloc-text-afz">
            <label><?=$afazer['afazer']?></label>
        </div>
    </div>
<?php endforeach; ?>