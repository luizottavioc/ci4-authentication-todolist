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
        exit;
    }

    public function index(){
        $dados = $this->request->getVar();

        if (!isset($dados['only_content'])) {
            echo View('structure/header');
        }

        $id_user = session()->get()['active_user']['id_user'];

        $cards = $this->anotacoes_cards_model->get_all_by_id_user($id_user);
        $anotacoes = $this->anotacoes_model->get_all_by_id_user($id_user, true);

        if(!empty($cards)) foreach($cards as $key => $card) {
            $cards[$key]['anotacoes'] = $anotacoes[$card['id_card']] ?? [];
        }

        $data['cards'] = $cards;
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

    public function new_ant($id_card) {
        if(empty($id_card)) $this->not_permisson();

        $card = $this->anotacoes_cards_model->get_by_id($id_card);
        $data['card'] = $card;
        echo View('anotacoes/new_anotacao', $data);
    }

    public function insert_ant($id_card) {
        if(empty($id_card)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $card = $this->anotacoes_cards_model->get_by_id($id_card);

        if($card['fk_user'] != $id_user) $this->not_permisson();

        $dados = $this->request->getVar();
        $dados['fk_card'] = $id_card;
        $dados['fk_user'] = $id_user;

        $this->anotacoes_model->insert_ant($dados);

        toast_response('success', 'Sucesso!', 'Anotação criada com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
    }

    public function delete_card($id_card) {
        if(empty($id_card)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $card = $this->anotacoes_cards_model->get_by_id($id_card);

        if($card['fk_user'] != $id_user) $this->not_permisson();

        $this->anotacoes_cards_model->delete_card($id_card);

        toast_response('success', 'Sucesso!', 'Card excluído com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
    }

    public function edit_card($id_card) {
        if(empty($id_card)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $card = $this->anotacoes_cards_model->get_by_id($id_card);

        if($card['fk_user'] != $id_user) $this->not_permisson();

        $data['card'] = $card;
        echo View('anotacoes/edit_card', $data);
    }

    public function update_card($id_card) {
        if(empty($id_card)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $card = $this->anotacoes_cards_model->get_by_id($id_card);

        if($card['fk_user'] != $id_user) $this->not_permisson();

        $dados = $this->request->getVar();
        $data = [ 'name_card' => $dados['name_card'] ];
        $this->anotacoes_cards_model->update_card($id_card, $data);

        toast_response('success', 'Sucesso!', 'Card atualizado com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
    }

    public function open_anotacao($id_ant) {
        if(empty($id_ant)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $anotacao = $this->anotacoes_model->get_by_id($id_ant);

        if($anotacao['fk_user'] != $id_user) $this->not_permisson();

        $cards = $this->anotacoes_cards_model->get_all_by_id_user($id_user);
        $current_card = $this->anotacoes_cards_model->get_by_id($anotacao['fk_card'], true);

        $data['anotacao'] = $anotacao;
        $data['cards'] = $cards;
        $data['current_card'] = $current_card;

        echo View('anotacoes/anotacao', $data);
    }

    public function update_anotacao($id_ant) {
        if(empty($id_ant)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $anotacao = $this->anotacoes_model->get_by_id($id_ant);

        if($anotacao['fk_user'] != $id_user) $this->not_permisson();

        $dados = $this->request->getVar();
        $data = [ 
            'fk_card' => $dados['fk_card'],
            'anotacao' => $dados['anotacao'],
        ];
        $this->anotacoes_model->update_anotacao($id_ant, $data);

        toast_response('success', 'Sucesso!', 'Anotação atualizada com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
    }

    public function delete_anotacao($id_ant) {
        if(empty($id_ant)) $this->not_permisson();

        $id_user = session()->get()['active_user']['id_user'];
        $anotacao = $this->anotacoes_model->get_by_id($id_ant);

        if($anotacao['fk_user'] != $id_user) $this->not_permisson();

        $this->anotacoes_model->delete_anotacao($id_ant);

        toast_response('success', 'Sucesso!', 'Anotação excluída com sucesso!', [
            'page' => '#main-container',
            'url' => '/anotacoes',
        ]);
    }
}

?>