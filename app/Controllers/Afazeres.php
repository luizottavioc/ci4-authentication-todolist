<?php 

namespace App\Controllers;

use App\Models\Afazeres\AfazeresModel;
use App\Models\Afazeres\AfazeresFoldersModel;
use App\Libraries\AuthVerify;

class Afazeres extends BaseController {
    protected $auth_verify;
    private $afazeres_model;
    private $afazeres_folders_model;

    function __construct(){
        $this->auth_verify = new AuthVerify();
        if(!$this->auth_verify->permissoes('afazeres')) exit('Ops.. Seu usuário não possui permissão para acessar este módulo!');

        $this->afazeres_model = new AfazeresModel();
        $this->afazeres_folders_model = new AfazeresFoldersModel();
    }

    // function not_permisson() {
    //     echo view('errors/not_permisson');
    //     exit();
    // }

    public function index($id_folder = null){
        $dados = $this->request->getVar();

        if (!isset($dados['only_content'])) {
            echo View('structure/header');
        }

        $id_user = session()->get()['active_user']['id_user'];
        $data['titulo'] = 'Afazeres';
        $data['folders'] = $this->afazeres_folders_model->get_all_by_id_user($id_user);
        $data['afazeres'] = $this->line_afazeres($id_folder);
        $data['folder_selected'] = $this->afazeres_folders_model->get_by_id($id_folder);

        echo View('afazeres/index', $data);
        
        if (!isset($dados['only_content'])) {
            echo View('structure/footer');
        }
    }

    public function line_afazeres($id_folder = null) {
        empty($id_folder) ? $id_folder = null : $id_folder = $id_folder;
        $id_user = session()->get()['active_user']['id_user'];
        $data['folder'] = $this->afazeres_folders_model->get_by_id($id_folder);
        $data['afazeres'] = $this->afazeres_model->get_all_by_id_user($id_user, $id_folder);

        return View('afazeres/lines_afazeres', $data);
    }

    public function new_afazer($id_folder = null) {
        $id_user = session()->get()['active_user']['id_user'];
        $data['folders'] = $this->afazeres_folders_model->get_all_by_id_user($id_user);
        $data['id_folder'] = $id_folder;        

        echo View('afazeres/new_afazer', $data);
    }

    public function new_folder() {
        echo View('afazeres/new_folder');
    }

    public function insert_folder() {
        $dados = $this->request->getVar();

        $dados['fk_user'] = session()->get()['active_user']['id_user'];
        $dados['background_folder'] = !empty($dados['want_bg']) ? $dados['background_folder'] : null;
        $dados['text_color_folder'] = !empty($dados['want_color']) ? $dados['text_color_folder'] : null;
        
        $this->afazeres_folders_model->insert_folder($dados);

        toast_response('success', 'Sucesso!', 'Pasta de afazeres criada com sucesso!',[
            'page' => '#main-container',
            'url' => '/afazeres',
        ]);
        exit;
    }

    public function update_name_folder() {
        $dados = $this->request->getVar();

        $id_user = session()->get()['active_user']['id_user'];
        $folder = $this->afazeres_folders_model->get_by_id($dados['id_folder']);

        if($folder['fk_user'] != $id_user){
            toast_response('error', 'Erro!', 'Você não pode alterar a pasta de afazeres de um outro usuário');
            exit;
        }

        if(empty($dados['id_folder'])){
            toast_response('error', 'Ops...', 'Algo deu errado, tente novamente mais tarde!');
            exit;
        }

        if(empty($dados['name_folder'])){
            toast_response('error', 'Erro!', 'O nome da pasta não pode ser vazio!');
            exit;
        }

        $this->afazeres_folders_model->update_folder($dados['id_folder'], $dados);

        toast_response('success', 'Sucesso!', 'Nome da pasta de afazeres alterado com sucesso!');
        exit;
    }

    public function delete_folder($id_folder) {
        $this->afazeres_folders_model->delete_folder($id_folder);

        toast_response('success', 'Sucesso!', 'Pasta de afazeres excluída com sucesso!',[
            'page' => '#main-container',
            'url' => '/afazeres',
        ]);
        exit;
    }

    public function get_user_folders() {
        $id_user = session()->get()['active_user']['id_user'];
        $folders = $this->afazeres_folders_model->get_all_by_id_user($id_user);

        return json_encode($folders);
    }

    public function insert_afazer() {
        $dados = $this->request->getVar();

        $dados['fk_user'] = session()->get()['active_user']['id_user'];
        $dados['fk_folder'] = empty($dados['fk_folder']) ? null : $dados['fk_folder'];
        $dados['hierarchy_position'] = 0;
        $dados['is_complete'] = 0;

        $this->afazeres_model->insert_afazer($dados);

        toast_response('success', 'Sucesso!', 'Afazer criado com sucesso!',[
            'page' => '#main-container',
            'url' => $dados['fk_folder'] ? '/afazeres/index/'.$dados['fk_folder'] : '/afazeres',
        ]);
        exit;
    }

    public function toggle_is_complete_afz($id_afz, $is_complete = 0) {
        $afazer = $this->afazeres_model->get_by_id($id_afz);
        $id_user = session()->get()['active_user']['id_user'];

        if(empty($afazer)) {
            return $this->showError(500, 'Afazer não encontrado');
            exit;
        }

        if($afazer['fk_user'] != $id_user){
            return $this->showError(500, 'Você não pode alterar o afazer de um outro usuário');
            exit;
        }

        $this->afazeres_model->update_afazer($id_afz, ['is_complete' => $is_complete]);
    }

    public function update_hierarchy_afz() {
        $dados = $this->request->getVar();

        if(empty($dados['data'])) exit;

        $id_user = session()->get()['active_user']['id_user'];
        $id_lines = array_column($dados['data'], 'id_afazer');
        $lines = $this->afazeres_model->get_by_ids($id_lines);

        foreach($lines as $line) if($line['fk_user'] != $id_user) exit;
        $this->afazeres_model->update_hierarchy_user($dados['data']);
    }

    public function change_afz_folder($id_afz) {
        $afazer = $this->afazeres_model->get_all_by_id($id_afz);
        $id_user = session()->get()['active_user']['id_user'];

        if($afazer['fk_user'] != $id_user){
            toast_response('error', 'Erro!', 'Você não pode alterar o afazer de um outro usuário');
            exit;
        }
        
        $data['afazer'] = $afazer;
        $data['folders'] = $this->afazeres_folders_model->get_all_by_id_user($id_user);
        echo View('afazeres/change_afz_folder', $data);
    }

    public function get_folder_data($id_folder) {
        $folder = $this->afazeres_folders_model->get_by_id($id_folder);
        $id_user = session()->get()['active_user']['id_user'];

        if($folder['fk_user'] != $id_user) exit;

        $folder['lines_afazeres'] = $this->afazeres_model->get_all_by_id_user($id_user, $id_folder);

        echo json_encode($folder);
        exit;
    }

    public function update_afz_folder() {
        $dados = $this->request->getVar();

        $id_user = session()->get()['active_user']['id_user'];
        $afazer = $this->afazeres_model->get_by_id($dados['id_afazer']);

        if($afazer['fk_user'] != $id_user){
            toast_response('error', 'Erro!', 'Você não pode alterar o afazer de um outro usuário');
            exit;
        }

        if($dados['actual_folder'] == $dados['fk_folder']) {
            toast_response('info', 'Ops...', 'O afazer já está na pasta selecionada!');
            exit;
        }

        $dados['fk_folder'] = empty($dados['fk_folder']) ? null : $dados['fk_folder'];
        $this->afazeres_model->update_afazer($dados['id_afazer'], $dados);    

        toast_response('success', 'Sucesso!', 'Afazer alterado com sucesso!',[
            'page' => '#main-container',
            'url' => '/afazeres',
        ]);
        exit;
    }

    public function delete_afz($id_afz) {
        $id_user = session()->get()['active_user']['id_user'];
        $afazer = $this->afazeres_model->get_by_id($id_afz);

        if($afazer['fk_user'] != $id_user){
            toast_response('error', 'Erro!', 'Você não pode apagar o afazer de um outro usuário');
            exit;
        }

        $this->afazeres_model->delete_afazer($id_afz);

        toast_response('success', 'Sucesso!', 'Afazer excluído com sucesso!',[
            'page' => '#main-container',
            'url' => $afazer['fk_folder'] ? '/afazeres/index/'.$afazer['fk_folder'] : '/afazeres',
        ]);
    }
}

?>