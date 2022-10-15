<?php 

namespace App\Controllers;

use App\Models\Users\UsersModel;
use App\Models\Users\UsersNiveisModel;
use App\Models\Users\PermissModel;
use App\Models\Users\UsersPermissModel;

class Users extends BaseController {
    private $user_model;
    private $user_niveis_model;
    private $permiss_model;
    private $users_permiss_model;
    private $fk_default_permiss;

    function __construct(){
        $this->user_model = new UsersModel();
        $this->user_niveis_model = new UsersNiveisModel();
        $this->permiss_model = new PermissModel();
        $this->users_permiss_model = new UsersPermissModel();
        $this->fk_default_permiss = [7, 8];
    }

    function not_permisson() {
        echo view('errors/not_permisson');
        exit();
    }

    public function index(){
        if(permissoes_helper('acessar_usuarios')){
            $dados = $this->request->getVar();

            $usuarios = $this->user_model->get_all_join();
            $data['users'] = $usuarios;

            $data['titulo'] = 'Usuários';

            if (!isset($dados['only_content'])) {
                echo View('structure/header');
            }

            echo View('user/index', $data);
            
            if (!isset($dados['only_content'])) {
                echo View('structure/footer');
            }
        }else{
            $this->not_permisson();
        }
    }

    public function create() {
        if(permissoes_helper('create_usuario')){
            $data['niveis'] = $this->user_niveis_model->get_all();
            if(!permissoes_helper('edit_permiss')) {
                $data['niveis'] = array_filter($data['niveis'], function($nivel) {
                    return $nivel['id_nivel'] != 1;
                });
            }
            $data['permissoes'] = $this->permiss_model->get_all();
 
            echo View('user/create', $data);
        }else{
            $this->not_permisson();
        }
    }

    public function edit($id_user) {
        if(permissoes_helper('edit_usuario')){
            $data['user'] = $this->user_model->get_by_id($id_user);
            $data['user']['password_hash'] = null;
            $data['niveis'] = $this->user_niveis_model->get_all();
            if(!permissoes_helper('edit_permiss')) {
                $data['niveis'] = array_filter($data['niveis'], function($nivel) {
                    return $nivel['id_nivel'] != 1;
                });
            }
            $data['permissoes'] = $this->permiss_model->get_all();
            $data['permissoes_user'] = $this->users_permiss_model->get_permiss_by_user($id_user);
            
            echo View('user/edit', $data);

        }else{
            $this->not_permisson();
        }
    }

    public function view($id_user) {
        if(permissoes_helper('acessar_usuarios')){
            $data['user'] = $this->user_model->get_join_by_id($id_user);
            $data['user']['password_hash'] = null;
            $data['permissoes'] = $this->permiss_model->get_all();
            $data['permissoes_user'] = $this->users_permiss_model->get_permiss_by_user($id_user);
            
            echo view('user/view', $data);
            
        }else{
            $this->not_permisson();
        }
    }

    public function insert_new_user(){
        if(permissoes_helper('create_usuario')){
            $dados = $this->request->getVar();

            $id_user = $this->user_model->set_user($dados);
            if(!permissoes_helper('edit_permiss')) {
                $default_permiss = $this->fk_default_permiss;
                $permissoes = array_map(function($permiss) use ($id_user, $default_permiss) {
                    return [
                        'fk_user' => $id_user,
                        'fk_permiss' => $permiss
                    ];
                }, $default_permiss);
                $this->users_permiss_model->insert_batch($permissoes);
                exit;
            }

            if(isset($dados['permiss_user'])){
                $permissoes = array_map(function($permiss) use ($id_user){
                    return [
                        'fk_user' => $id_user,
                        'fk_permiss' => $permiss,
                    ];
                }, $dados['permiss_user']);

                $this->users_permiss_model->insert_batch($permissoes);
            }
            exit;

        }else{
            $this->not_permisson();
        }
    }

    public function insert_default_user($data) {
        $id_user = $this->user_model->set_user($data);

        $default_permiss = $this->fk_default_permiss;
        $permissoes = array_map(function($permiss) use ($id_user, $default_permiss) {
            return [
                'fk_user' => $id_user,
                'fk_permiss' => $permiss
            ];
        }, $default_permiss);
        $this->users_permiss_model->insert_batch($permissoes);
    }

    public function update_data_user(){
        if(permissoes_helper('edit_usuario')){
            $dados = $this->request->getVar();

            $this->user_model->update_user($dados);

            if(empty($dados['change_permiss']) || !permissoes_helper('edit_permiss')){
                exit;
            }

            if(isset($dados['permiss_user'])){
                $permissoes = array_map(function($permiss) use ($dados){
                    return [
                        'fk_user' => $dados['id_user'],
                        'fk_permiss' => $permiss,
                    ];
                }, $dados['permiss_user']);
    
                $this->users_permiss_model->delete_by_user($dados['id_user']);
                $this->users_permiss_model->insert_batch($permissoes);

                exit;
            }

            $this->users_permiss_model->delete_by_user($dados['id_user']);
        }else{
            $this->not_permisson();
        }

    }

    public function edit_user(){
        if(permissoes_helper('edit_usuario')){
            if(!empty($dados['id_user'])){
                $this->user_model->update($dados['id_user'], $dados);
            }

        }else{
            $this->not_permisson();
        }
    }

    public function delete_user($id_user) {
        if(permissoes_helper('delete_usuario')){
            $this->user_model->delete_user($id_user);
            
        }else{
            $this->not_permisson();
        }
    }

    public function roolback_user($id_user) {
        if(permissoes_helper('delete_usuario')){
            $this->user_model->roolback($id_user);
        }else{
            $this->not_permisson();
        }
    }

    public function set_theme(){
        $dados = $this->request->getVar();
        session()->set('user_theme',  intval($dados['theme']));
    }
}

?>