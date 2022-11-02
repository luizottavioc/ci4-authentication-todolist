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
        'deleted_at',
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
    protected $select_join_columns = [
        'id_user',
        'users_niveis.tipo_nivel',
        'name',
        'lastname',
        'login',
        'email',
        'password_hash',
        'users.created_at as created_at',
        'users.updated_at as updated_at',
        'users.deleted_at as deleted_at',
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

    public function get_all_join() {
        $this->select($this->select_join_columns);
        $this->join('users_niveis', 'users_niveis.id_nivel = users.fk_nivel');
        $query = $this->orderBy('name', 'asc')->withDeleted()->findAll();
        return $query;
    }

    public function get_by_id($id) {
        $this->select($this->select_columns);
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_by_id_columns ($id, $columns = ['*']) {
        $this->select($columns);
        $query = $this->where($this->primaryKey, $id)->first();
        return $query;
    }

    public function get_join_by_id($id_user)
    {
        $this->select($this->select_join_columns);
        $this->join('users_niveis', 'users_niveis.id_nivel = users.fk_nivel');
        $query = $this->where($this->primaryKey, $id_user)->first();
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

    public function get_by_email($email) {
        $this->select($this->select_columns);
        $user = $this->where('email', $email)->first();
        return $user;
    }

    public function set_user($data) {
        $data['password_hash'] = password_hash($data['password_hash'], PASSWORD_DEFAULT);
        $this->insert($data);
        return $this->insertID();
    }

    public function update_user($data) {
        isset($data['password_hash']) ? $data['password_hash'] = password_hash($data['password_hash'], PASSWORD_DEFAULT) : null;
        $this->update($data['id_user'], $data);
    }

    public function confer_password($id_user, $password) {
        $user = $this->get_by_id_columns($id_user, ['password_hash']);
        if (password_verify($password, $user['password_hash'])){
            return true;
        } else {
            return false;
        }
    }

    public function delete_user($id_user) {
        $this->where($this->primaryKey, $id_user)->delete();
    }
    
    public function roolback($id_user) {
        $this->where($this->primaryKey, $id_user)->withDeleted()->set(['deleted_at' => null])->update();
    }
}


?>