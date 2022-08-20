<?php 

namespace App\Models\Users;

use CodeIgniter\Model;

class PermissModel extends Model
{
    protected $table = 'permiss';
    protected $primaryKey = 'id_permiss';
    protected $allowedFields = [
        'name_permiss',
        'code_permiss',
    ];
    protected $select_columns = [
        'id_permiss',
        'name_permiss',
        'code_permiss',
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