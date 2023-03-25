<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AntCards extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_card'         => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_user'         => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'name_card'       => ['type' => 'VARCHAR', 'constraint' => 32, 'null' => false],
            'created_at'      => ['type' => 'DATETIME','null' => true,],
            'updated_at'      => ['type' => 'DATETIME','null' => true,],
            'deleted_at'      => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_card', true);
        $this->forge->addForeignKey('fk_user', 'users', 'id_user');

        $this->forge->createTable('ant_cards');
    }

    public function down()
    {
        $this->forge->dropTable('ant_cards');

    }
}
