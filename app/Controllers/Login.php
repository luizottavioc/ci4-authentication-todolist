<?php

namespace App\Controllers;

use App\Models\Users\UsersModel;

class Login extends BaseController
{
    private $user_model;

    function __construct()
    {
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
        echo view('login/cadastro');
    }
}