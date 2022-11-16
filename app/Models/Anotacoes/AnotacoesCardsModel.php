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
        'background_card',
    ];
    protected $select_columns = [
        'id_card',
        'fk_user',
        'name_card',
        'background_card',
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
}


?>