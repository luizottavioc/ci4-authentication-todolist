<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersNiveis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nivel'        => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'tipo_nivel'       => ['type' => 'VARCHAR', 'constraint' => 25, 'null' => false],
            'created_at'     => ['type' => 'DATETIME','null' => true,],
            'updated_at'     => ['type' => 'DATETIME','null' => true,],
            'deleted_at'     => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_nivel', true);
        $this->forge->createTable('users_niveis');
    }

    public function down()
    {
        $this->forge->dropTable('users_niveis');
    }
}
