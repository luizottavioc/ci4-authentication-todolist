<?php

namespace App\Controllers;

use App\Controllers\Users;
use App\Models\Users\UsersModel;

class Login extends BaseController
{
    private $user_model;

    function __construct()
    {
        $this->user_controller = new Users();
        $this->user_model = new UsersModel();
    }

    public function index()
    {            
       	session()->destroy();
        return view('login/index');
    }

    public function auth()
    {
        $dados = $this->request->getVar();             

        $user = $this->user_model->get_by_login($dados['login']);
        $login = $this->user_model->auth_verify($dados, $user);

        return $login ? redirect()->to('/') : redirect()->to('/login');
    }

    public function logout()
    {
        session()->setFlashdata('alert', 'Logout realizado com sucesso');
        session()->setFlashdata('type_alert', 'success');
        
        return redirect()->to('/login'); 
    }

    public function refresh_session() {
        $this->auth_verify->verify_login();
    }

    public function cadastro() {
       	session()->destroy();
        echo view('login/cadastro');
    }

    public function create_user() {
        $dados = $this->request->getVar();
        $dados['fk_nivel'] = 2;

        $user_email = $this->user_model->get_by_email($dados['email']);
        $user_login = $this->user_model->get_by_login($dados['login']);

        $columns_error = array();
        isset($user_email) ? $columns_error[] = 'email' : false;
        isset($user_login) ? $columns_error[] = 'login' : false;

        $redirect_page = '';
        if(empty($columns_error)) {
            $this->user_controller->insert_default_user($dados);

            session()->setFlashdata('alert', 'Cadastro criado com sucesso!');
            session()->setFlashdata('type_alert', 'success');

            $redirect_page = '/login';

        }else{
            $redirect_page = null;
        }

        $return_args = array(
            'columns_error' => $columns_error,
            'redirect_page' => $redirect_page,
        );

        return json_encode($return_args);
    }
}