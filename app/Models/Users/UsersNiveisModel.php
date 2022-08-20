<?php 

namespace App\Models\Users;

use CodeIgniter\Model;

class UsersNiveisModel extends Model
{
    protected $table = 'users_niveis';
    protected $primaryKey = 'id_nivel';
    protected $allowedFields = [
        'tipo_nivel',
    ];
    protected $select_columns = [
        'id_nivel',
        'tipo_nivel',
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

    public function get_name_by_id($id) {
        $this->select('tipo_nivel');
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }
}


?>