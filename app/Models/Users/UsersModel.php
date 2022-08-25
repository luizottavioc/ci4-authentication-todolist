<?php 

namespace App\Models\Users;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'fk_nivel',
        'name',
        'lastname',
        'login',
        'email',
        'password_hash',
    ];
    protected $select_columns = [
        'id_user',
        'fk_nivel',
        'name',
        'lastname',
        'login',
        'email',
        'password_hash',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function auth_verify($dados, $user) {
        $session = session();
        if(!empty($user)) {
            if (password_verify($dados['password'], $user['password_hash'])){
                $treat_user = $user;
                $treat_user['password_hash'] = null;
                session()->set('active_user', $treat_user);
                return true;
            } else {
                $session->setFlashdata('last_login', $dados['login']);
                $session->setFlashdata('alert', 'Senha incorreta!');
                $session->setFlashdata('type_alert', 'error');
                return false; 
            }
        } else {
            $session->setFlashdata('alert', 'Login não encontrado ou desativado!');
            $session->setFlashdata('type_alert', 'error');
            return false; 
        }
    }

    public function get_all() {
        $this->select($this->select_columns);
        $query = $this->orderBy('name', 'asc')->findAll();
        return $query;
    }

    public function get_by_id($id) {
        $this->select($this->select_columns);
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_all_by_id($id) {
        $this->select($this->select_columns);
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_by_login($login) {
        $this->select($this->select_columns);
        $user = $this->where('login', $login)->first();
        return $user;
    }

    // public function set_user($data) {
    //     $this->set($data)->where('id_user', $data['id_user'])->insert();
    // }

    // public function update_user($data) {
    //     $this->insert($data);
    // }

    // public function delete_user($id) {
    //     $this->where($this->primaryKey, $id)->delete();
    // }
}


?>