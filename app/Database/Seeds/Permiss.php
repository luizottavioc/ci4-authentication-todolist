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
            ['Criar Usuários', 'create_usuario'],
            ['Editar Usuários', 'edit_usuario'],
            ['Excluir Usuários', 'delete_usuario'],
            ['Visualizar Permissões', 'view_permiss'],
            ['Alterar Permissões', 'edit_permiss'],
            ['Afazeres', 'afazeres'],
            ['Anotações', 'anotacoes'],
        ];
    }
}
