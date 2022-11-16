<?php 

namespace App\Models\Afazeres;

use CodeIgniter\Model;

class AfazeresFoldersModel extends Model
{
    protected $table = 'afz_folders';
    protected $primaryKey = 'id_folder';
    protected $allowedFields = [
        'fk_user',
        'name_folder',
        'background_folder',
    ];
    protected $select_columns = [
        'id_folder',
        'fk_user',
        'name_folder',
        'background_folder',
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