<?php  

namespace App\Libraries;

use App\Models\Users\UsersModel;
use App\Models\Users\UsersNiveisModel;
use App\Models\Users\UsersPermissModel;

class AuthVerify extends UsersModel {

    private $user_model;
    private $session;
    private $permissoes;

    function __construct()
    {
        $this->user_model = new UsersModel();
        $this->permissoes = new UsersPermissModel();
        $this->session = session();
    } 

    public function permissoes($chamada) {
        $user_session = $this->session->get('active_user');
        
        if (!empty($user_session)) {
            if ($user_session['fk_nivel'] == 1) {
                return true;
            }

            $permissoes = $this->permissoes->select('permiss.code_permiss')
                            ->join('permiss', 'users_permiss.fk_permiss = permiss.id_permiss')
                            ->where('fk_user', $user_session['id_user'])->findAll();

            if (!empty($permissoes)) {
                foreach ($permissoes as $permissao) {
                    if($permissao['code_permiss'] == $chamada){
                        return true;
                    }
                }
            }
            
            return false;
        }
        return false;
    }

    public function deslogar() {
        $this->session->destroy();

        echo '
        <script>
            window.location.href = "/login";
        </script>
        ';

        exit();
    }

    // public function deslogar_no_session () {
    //     $this->session->setFlashdata('alert', 'Sua sessão expirou! Digite seu login e senha.');
    //     $this->session->setFlashdata('type_alert', 'info');
    //     $user = $this->session->get('user_active');
    //     $token = $this->session->get('token');
    //     if (isset($user) && isset($token)) {
    //          //update em active e token
    //         $this->data_login_model->delete_data_login_token();
    //     }
    //     echo '
    //         <script>
    //             window.location.href = "/login";
    //         </script>
    //     ';
    //     // Caso nao redirecione, trave a aplicação com um exit(); 
    //     echo "Javascript disabled - Login required";
    //     exit();
    // }

    public function verify_login() {
        $user_session = $this->session->get('active_user');
        
        if (!isset($user_session)) {
            $this->deslogar();
        }
    }
   
}