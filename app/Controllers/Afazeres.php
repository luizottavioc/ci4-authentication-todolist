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

            $id_user = session()->get()['active_user']['id_user'];
            $data['titulo'] = 'Afazeres';
            $data['folders'] = $this->afazeres_folders_model->get_all_by_id_user($id_user);
            $data['afazeres'] = $this->line_afazeres();

            echo View('afazeres/index', $data);
            
            if (!isset($dados['only_content'])) {
                echo View('structure/footer');
            }
        }else{
            $this->not_permisson();
        }
    }

    public function line_afazeres($id_folder = null) {
        $id_user = session()->get()['active_user']['id_user'];
        $data['afazeres'] = $this->afazeres_model->get_all_by_id_user($id_user, $id_folder);

        return View('afazeres/lines_afazeres', $data);
    }

    public function new_afazer() {
        $id_user = session()->get()['active_user']['id_user'];
        $data['folders'] = $this->afazeres_folders_model->get_all_by_id_user($id_user);

        echo View('afazeres/new_afazer', $data);
    }

    public function new_folder() {
        echo View('afazeres/new_folder');
    }

    public function insert_folder() {
        $dados = $this->request->getVar();

        $dados['fk_user'] = session()->get()['active_user']['id_user'];
        $this->afazeres_folders_model->insert_folder($dados);

        toast_response('success', 'Sucesso!', 'Pasta de afazeres criada com sucesso!',[
            'url' => '/afazeres',
            'page' => '#main-container',
        ]);
        exit;
    }

    public function insert_afazer() {
        $dados = $this->request->getVar();

        $dados['fk_user'] = session()->get()['active_user']['id_user'];
        $dados['fk_folder'] = empty($dados['fk_folder']) ? null : $dados['fk_folder'];
        $dados['hierarchy_position'] = 0;
        $dados['is_complete'] = 0;

        $this->afazeres_model->insert_afazer($dados);

        toast_response('success', 'Sucesso!', 'Afazer criado com sucesso!',[
            'url' => '/afazeres',
            'page' => '#main-container',
        ]);
        exit;
    }
}

?>