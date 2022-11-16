<?php 

namespace App\Models\Afazeres;

use CodeIgniter\Model;

class AfazeresModel extends Model
{
    protected $table = 'afz_afazeres';
    protected $primaryKey = 'id_afazer';
    protected $allowedFields = [
        'fk_user',
        'fk_folder',
        'is_complete',
    ];
    protected $select_columns = [
        'id_afazer',
        'fk_user',
        'fk_folder',
        'is_complete',
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