<?php 

namespace App\Controllers;

use App\Libraries\AuthVerify;
use App\Models\Anotacoes\AnotacoesModel;
use App\Models\Anotacoes\AnotacoesCardsModel;

class Anotacoes extends BaseController {
    protected $auth_verify;
    private $anotacoes_model;
    private $anotacoes_cards_model;

    public function __construct(){
        $this->auth_verify = new AuthVerify();
        if(!$this->auth_verify->permissoes('anotacoes')) return $this->not_permisson();

        $this->anotacoes_model = new AnotacoesModel();
        $this->anotacoes_cards_model = new AnotacoesCardsModel();
    }

    public function not_permisson() {
        echo view('errors/not_permisson');
        exit();
    }

    public function index(){
        $dados = $this->request->getVar();

        if (!isset($dados['only_content'])) {
            echo View('structure/header');
        }

        $id_user = session()->get()['active_user']['id_user'];

        $data['cards'] = $this->anotacoes_cards_model->get_all_by_id_user($id_user);
        $data['titulo'] = 'Anotações';

        echo View('anotacoes/index', $data);
        
        if (!isset($dados['only_content'])) {
            echo View('structure/footer');
        }
    }

    public function new_card() {
        echo View('anotacoes/new_card');
    }

    public function insert_card() {
        $dados = $this->request->getVar();

        $data = [
            'name_card' => $dados['name_card'],
            'fk_user' => session()->get()['active_user']['id_user']
        ];

        $this->anotacoes_cards_model->insert_card($data);

        toast_response('success', 'Sucesso!', 'Card criado com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
        exit;
    }
}

?>