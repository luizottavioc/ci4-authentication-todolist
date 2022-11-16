<?php 

namespace App\Controllers;

use App\Models\Anotacoes\AnotacoesModel;

class Anotacoes extends BaseController {
    private $anotacoes_model;

    function __construct(){
        $this->anotacoes_model = new AnotacoesModel();
    }

    function not_permisson() {
        echo view('errors/not_permisson');
        exit();
    }

    public function index(){
        if(permissoes_helper('acessar_usuarios')){
            $dados = $this->request->getVar();

            if (!isset($dados['only_content'])) {
                echo View('structure/header');
            }

            $data['titulo'] = 'Anotações';

            echo View('anotacoes/index', $data);
            
            if (!isset($dados['only_content'])) {
                echo View('structure/footer');
            }
        }else{
            $this->not_permisson();
        }
    }
}

?>