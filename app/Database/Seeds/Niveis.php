<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Niveis extends Seeder
{
    public function run()
    {
        $this->db->table('users_niveis')->insert([
            'tipo_nivel' => 'administrador',
        ]);
        $this->db->table('users_niveis')->insert([
            'tipo_nivel' => 'usuário',
        ]);
    }
}
