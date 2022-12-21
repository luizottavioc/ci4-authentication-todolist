<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permiss extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_permiss'   => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'name_permiss' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => false],
            'code_permiss' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => false],
            'created_at'   => ['type' => 'DATETIME','null' => true,],
            'updated_at'   => ['type' => 'DATETIME','null' => true,],
            'deleted_at'   => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_permiss', true);

        $this->forge->createTable('permiss');
    }

    public function down()
    {
        $this->forge->dropTable('permiss');
    }
}
