<?php 

function permissoes_helper($permissao_code) {
    $permiss = new App\Libraries\AuthVerify;

    return $permiss->permissoes($permissao_code);
}