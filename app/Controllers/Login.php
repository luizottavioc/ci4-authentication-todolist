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
       	$session = session();
        $session->destroy();
        
        $data['session'] = $session;

        return view('login/index', $data);
    }

    public function auth()
    {           
        $dados = $this->request->getVar();             

        // $usuario = $this->user_model->where('login', $dados['login'])->first();
      
        // $login = $this->user_model->auth_verify($dados, $usuario);

        // if ($login) {
            // $verify_data_login = $this->data_login_model->exists_data_login($usuario['id_user']);
            // if (empty($verify_data_login)) {
            //     $this->data_login_model->set_data_login($usuario['id_user']);
            // } else {
            //     $this->data_login_model->update_data_login($verify_data_login->id_data_login);
            // }
            // return redirect()->to('/');
        // } else {
        //     return redirect()->to('/login');
        // }

    }

    public function logout()
    {           
        $session = session();
        $user = $session->get('user_active');
        $token = $session->get('token');
        if (isset($user) && isset($token)) {
             //update em active e token
            $verify_data_login = $this->data_login_model->exists_data_login($user['id_user']);
            if (!empty($verify_data_login)) {
                $this->data_login_model->delete_data_login($verify_data_login->id_data_login);
            }
            $this->user_model->set('active' , 0)->where('id_user' , $user['id_user'])->update();
        }
        // Msg alert
        $session->setFlashdata('alert', 'Logout realizado com sucesso');
        $session->setFlashdata('type_alert', 'success');
        // A sessão é destuida toda vez que é redirecionado ao login 
        // Antes do HTML da pagina, existe um código de session_destroy
        return redirect()->to('/login'); 
    }    

    public function refresh_session() {
        $this->auth_verify->verify_login();
    }

    public function delete_data_login($id_data_login) {
        $this->data_login_model->delete_data_login($id_data_login);
        toast_response('success', 'Sucesso!', 'Deslogado com sucesso', ['url' => '/users/profile', 'page' => '#main-container']);
    }

    public function delete_data_login_all() {
        $this->data_login_model->delete_data_login_all();
        toast_response('success', 'Sucesso!', 'Deslogado com sucesso', ['url' => '/users/profile', 'page' => '#main-container']);
    }
}