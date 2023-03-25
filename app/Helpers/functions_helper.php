<?php 

function version_js() {
   return '?v1.14';
}

function permissoes_helper($permissao_code) {
    $permiss = new App\Libraries\AuthVerify;
    return $permiss->permissoes($permissao_code);
}

function toast_response($icon, $title, $text, $redirect = null) {
    $alert = [
        'icon' => $icon,
        'title' => $title,
        'text' => $text,
        'redirect' => $redirect
    ];

    echo json_encode($alert);
}

function date_us_to_br_helper($dateUS, $if_hour = false) {
    if(is_null($dateUS)) {
        return '-';
    }

    if($if_hour){
        $date = new DateTime($dateUS); 
        $dateReturn = $date->format('d/m/Y h:i:s');
    }else{
        $date = new DateTime($dateUS); 
        $dateReturn = $date->format('d/m/Y');
    }

    return $dateReturn;
}

function date_br_to_us_helper($dateBR, $if_hour = false) {
    if(is_null($dateBR)) {
        return '';
    }

    $dateBR = str_replace('/', '-', $dateBR);
    if($if_hour){
        $date = new DateTime($dateBR); 
        $dateReturn = $date->format('Y-m-d h:i:s');
    }else{
        $date = new DateTime($dateBR); 
        $dateReturn = $date->format('Y-m-d');
    }

    return $dateReturn;
}

function text_dif_days_helper($dateUS) {
    $date = new DateTime();
    $dataAtual = $date->format('Y-m-d');
    $diff = strtotime($dataAtual) - strtotime(substr($dateUS,0,10));
    $dias = floor($diff / (60 * 60 * 24));
    if ($dias == 0) {
        return "Hoje";
    } elseif ($dias == 1) {
        return $dias." dia atrás";
    } else {
        return $dias." dias atrás";
    }
}

function get_user_afz_folders_helper(){
    $afazeres_controller = new App\Controllers\Afazeres();
    return json_decode($afazeres_controller->get_user_folders(), true);
}