<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersPermiss extends Seeder
{
    public function run()
    {

        foreach ($this->permissoes_usuarios() as $permissao_user) {

            $this->db->table('users_permiss')->insert([
                'fk_user' => $permissao_user['fk_user'],
                'fk_permiss' => $permissao_user['fk_permiss'],
            ]);

        }
    }

    public function permissoes_usuarios()
    {
        return [ 
            ['fk_user' => 2, 'fk_permiss' => 3],
            ['fk_user' => 2, 'fk_permiss' => 4],
        ];
    }
}