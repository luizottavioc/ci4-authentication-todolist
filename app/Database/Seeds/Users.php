<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'fk_nivel'         => 1,
            'name'             => 'Administrador',
            'lastname'         => 'Sistema',
            'login'            => 'admin',
            'email'            => 'ilustracao@email.com',
            'password_hash'    => password_hash('admin', PASSWORD_DEFAULT),
        ]);
        
        $this->db->table('users')->insert([
            'fk_nivel'         => 2,
            'name'             => 'Usuário',
            'lastname'         => 'Default',
            'login'            => 'user',
            'email'            => 'ilustracao2@email.com',
            'password_hash'    => password_hash('user', PASSWORD_DEFAULT),
        ]);
    }
}
