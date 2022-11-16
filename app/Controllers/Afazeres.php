<?php 

namespace App\Controllers;

use App\Models\Afazeres\AfazeresModel;
use App\Models\Afazeres\AfazeresFoldersModel;

class Afazeres extends BaseController {
    private $afazeres_model;
    private $afazeres_folders_model;

    function __construct(){
        $this->afazeres_model = new AfazeresModel();
        $this->afazeres_folders_model = new AfazeresFoldersModel();
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

            $data['titulo'] = 'Afazeres';

            echo View('afazeres/index', $data);
            
            if (!isset($dados['only_content'])) {
                echo View('structure/footer');
            }
        }else{
            $this->not_permisson();
        }
    }
}

?>