<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'       => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_nivel'      => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
            'lastname'      => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
            'login'         => ['type' => 'VARCHAR', 'constraint' => 128, 'unique' => true, 'null' => false],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 128, 'unique' => true, 'null' => false],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
            'created_at'    => ['type' => 'DATETIME','null' => true,],
            'updated_at'    => ['type' => 'DATETIME','null' => true,],
            'deleted_at'    => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('fk_nivel', 'users_niveis', 'id_nivel');

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
