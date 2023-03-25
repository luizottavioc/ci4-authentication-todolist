<?php 

namespace App\Models\Anotacoes;

use CodeIgniter\Model;

class AnotacoesModel extends Model
{
    protected $table = 'ant_anotacoes';
    protected $primaryKey = 'id_anotacao';
    protected $allowedFields = [
        'fk_user',
        'anotacao',
        'fk_card',
    ];
    protected $select_columns = [
        'id_anotacao',
        'fk_user',
        'anotacao',
        'fk_card',
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

    public function get_by_id($id) {
        $this->select($this->select_columns);
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_all_by_id_user($id_user, $assoc = false) {
        $this->select($this->select_columns);
        $this->where('fk_user', $id_user);
        $this->orderBy('id_anotacao', 'DESC');
        $query = $this->findAll();

        if(!$assoc) return $query;

        $assoc = [];
        foreach($query as $row) {
            $assoc[$row['fk_card']][] = $row;
        }

        return $assoc;
    }

    public function insert_ant($data) {
        try {
            $this->insert($data);
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao criar anotação!');
            exit;
        }
    }

    public function update_anotacao($id, $data) {
        try {
            $this->update($id, $data);
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao atualizar anotação!');
            exit;
        }
    }

    public function delete_anotacao($id) {
        try {
            $this->delete($id);
        } catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao deletar anotação!');
            exit;
        }
    }
}


?>