<?php 

namespace App\Controllers;

use App\Models\Users\UsersModel;

class Users extends BaseController {
    private $user_model;

    function __construct(){
        $this->user_model = new UsersModel();
    }

    public function index(){
        $dados = $this->request->getVar();

        $usuarios = $this->user_model->get_all();
        $data['users'] = $usuarios;

        $data['titulo'] = 'Usuários';

        if (!isset($dados['only_content'])) {
            echo View('structure/header');
        }

        echo View('user/index', $data);
        
        if (!isset($dados['only_content'])) {
            echo View('structure/footer');
        }
    }

    public function view($id_user) {
        $data['user'] = $this->user_model->get_by_id($id_user);
        
        echo View('user/view', $data);
    }

    public function edit($id_user) {
        $dados = $this->request->getVar();
        $data['type_page'] = 'edit';
        $data['user'] = $this->user_model->get_by_id($id_user);
        
        echo View('user/data_user', $data);
    }

    public function create() {
        echo View('user/data_user');
    }

    public function insert_user(){
        $dados = $this->request->getVar();
        if(!empty($dados['id_user'])){
            if($dados['password_hash'] == ''){
                unset($dados['password_hash']);
            }
            $this->user_model->update($dados['id_user'], $dados);
        } else {
            $this->user_model->set_user($dados);
        }
    }

    public function delete_user($id_user) {
        $this->user_model->delete($id_user);
    }

    public function set_theme(){
        $dados = $this->request->getVar();
        is_int($dados['theme']) ? session()->set('user_theme', $dados['theme']) : null;
    }
}

?>