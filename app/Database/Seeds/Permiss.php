<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Permiss extends Seeder
{
    public function run()
    {

        foreach ($this->permissoes() as $permissao) {

            $this->db->table('permiss')->insert([
                'name_permiss' => $permissao[0],
                'code_permiss' => $permissao[1],
            ]);

        }
    }

    public function permissoes()
    {
        return [ 
            ['Acessar Usuários', 'acessar_usuarios'],
            ['Gerenciar Usuários', 'gerenciar_usuarios'],
            ['Afazeres', 'afazeres'],
            ['Anotações', 'anotacoes'],
        ];
    }
}
