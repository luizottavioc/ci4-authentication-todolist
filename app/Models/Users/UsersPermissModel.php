<?php 

namespace App\Models\Users;

use CodeIgniter\Model;

class UsersPermissModel extends Model
{
    protected $table = 'users_permiss';
    protected $primaryKey = 'id_user_permiss';
    protected $allowedFields = [
        'fk_user',
        'fk_permiss',
    ];
    protected $select_columns = [
        'id_user_permiss',
        'fk_user',
        'fk_permiss',
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

    public function get_permiss_by_id($id) {
        $this->select(['fk_permiss']);
        $query = $this->where('fk_user', $id)->findAll();
        return $query;
    }

    public function get_by_user($id_user) {
        $this->select($this->select_columns);
        $query = $this->where('fk_user', $id_user)->findAll();
        return $query;
    }

    public function get_permiss_by_user($id_user) {
        $this->select(['fk_permiss']);
        $query = $this->where('fk_user', $id_user)->findAll();
        if(count($query) > 0) {
            $query = array_map(function($item) {
                return $item['fk_permiss'];
            }, $query);
        }

        return $query;
    }

    public function insert_batch($data) {
        $query = $this->insertBatch($data);
        return $query;
    }

    public function delete_by_user($id_user) {
        $query = $this->where('fk_user', $id_user)->delete();
        return $query;
    }
}


?>