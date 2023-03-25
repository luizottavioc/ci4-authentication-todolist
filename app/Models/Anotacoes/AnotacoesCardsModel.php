<?php 

namespace App\Models\Anotacoes;

use CodeIgniter\Model;

class AnotacoesCardsModel extends Model
{
    protected $table = 'ant_cards';
    protected $primaryKey = 'id_card';
    protected $allowedFields = [
        'fk_user',
        'name_card',
    ];
    protected $select_columns = [
        'id_card',
        'fk_user',
        'name_card',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function get_all() {
        $this->select($this->select_columns);
        $query = $this->findAll();
        return $query;
    }

    public function get_by_id($id, $with_deleted = false) {
        $this->select($this->select_columns);
        if($with_deleted) $this->withDeleted();
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_all_by_id_user($id_user, $with_deleted = false) {
        $this->select($this->select_columns);
        $this->where('fk_user', $id_user);
        $this->orderBy('id_card', 'DESC');
        if($with_deleted) $this->withDeleted();
        $query = $this->findAll();
        return $query;
    }

    public function insert_card($data) {
        try {
            $this->insert($data);
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao criar card de anotações!');
            exit;
        }
    }

    public function update_card($id, $data) {
        try {
            $this->set($data)->where($this->primaryKey, $id)->update();
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao atualizar card de anotações!');
            exit;
        }
    }

    public function delete_card($id_card) {
        try {
            $this->delete($id_card);
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao deletar card de anotações!');
            exit;
        }
    }
}


?>