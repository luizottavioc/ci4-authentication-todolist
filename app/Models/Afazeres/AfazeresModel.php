<?php 

namespace App\Models\Afazeres;

use CodeIgniter\Model;

class AfazeresModel extends Model
{
    protected $table = 'afz_afazeres';
    protected $primaryKey = 'id_afazer';
    protected $allowedFields = [
        'fk_user',
        'afazer',
        'fk_folder',
        'is_complete',
    ];
    protected $select_columns = [
        'id_afazer',
        'fk_user',
        'afazer',
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

    public function insert_afazer($dados) {
        try {
            $this->insert($dados);
        }catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao criar afazer!');
            exit;
        }
    }

    public function get_all_by_id_user($id_user, $id_folder = null) {
        $this->select($this->select_columns);
        $this->where('fk_user', $id_user);
        if ($id_folder) {
            $this->where('fk_folder', $id_folder);
        }else{
            $this->where('fk_folder', null);
        }

        $query = $this->findAll();
        return $query;
    }
}


?>