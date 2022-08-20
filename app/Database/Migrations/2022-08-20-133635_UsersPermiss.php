<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersPermiss extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_permiss'  => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_user'          => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'fk_permiss'       => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'created_at'       => ['type' => 'DATETIME','null' => true,],
            'updated_at'       => ['type' => 'DATETIME','null' => true,],
            'deleted_at'       => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_user_permiss', true);
        $this->forge->addForeignKey('fk_user', 'users', 'id_user');
        $this->forge->addForeignKey('fk_permiss', 'permiss', 'id_permiss');

        $this->forge->createTable('users_permiss');
    }

    public function down()
    {
        //users_permiss
    }
}
