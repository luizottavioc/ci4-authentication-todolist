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
        'hierarchy_position',
        'is_complete',
    ];
    protected $select_columns = [
        'id_afazer',
        'fk_user',
        'afazer',
        'fk_folder',
        'hierarchy_position',
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

    public function get_by_ids($ids) {
        $this->select($this->select_columns);
        $query = $this->whereIn($this->primaryKey, $ids)->findAll();
        return $query;
    }

    public function get_all_by_id($id) {
        $this->select([
            'afz_afazeres.id_afazer',
            'afz_afazeres.fk_user',
            'afz_afazeres.afazer',
            'afz_afazeres.fk_folder',
            'afz_afazeres.is_complete',
            'afz_afazeres.created_at',
            'afz_afazeres.updated_at',
            'afz_afazeres.deleted_at',
            'afz_folders.name_folder',
            'afz_folders.background_folder',
            'afz_folders.text_color_folder',
        ]);
        $this->join('afz_folders', 'afz_afazeres.fk_folder = afz_folders.id_folder', 'left');
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
        $this->orderBy('hierarchy_position ASC, created_at');

        $query = $this->findAll();
        return $query;
    }

    public function update_hierarchy_user($array_update) {
        try {
            $this->updateBatch($array_update, 'id_afazer');
        }catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao atualizar hierarquia!');
            exit;
        }
    }

    public function update_afazer($id, $dados) {
        try {
            $this->update($id, $dados);
        }catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao atualizar afazer!');
            exit;
        }
    }

    public function delete_afazer($id) {
        try {
            $this->delete($id);
        }catch (\Exception $e) {
            toast_response('error', 'Erro!', 'Erro ao deletar afazer!');
            exit;
        }
    }
}


?>