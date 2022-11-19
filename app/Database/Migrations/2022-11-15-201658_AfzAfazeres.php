<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AfzAfazeres extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_afazer'          => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_user'            => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'fk_folder'          => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'afazer'             => ['type' => 'varchar', 'constraint' => 80, 'null' => false],
            'hierarchy_position' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'is_complete'        => ['type' => 'boolean', 'null' => false],
            'created_at'         => ['type' => 'DATETIME','null' => true,],
            'updated_at'         => ['type' => 'DATETIME','null' => true,],
            'deleted_at'         => ['type' => 'DATETIME','null' => true,],
        ]);
        $this->forge->addKey('id_afazer', true);
        $this->forge->addForeignKey('fk_user', 'users', 'id_user');
        $this->forge->addForeignKey('fk_folder', 'afz_folders', 'id_folder');

        $this->forge->createTable('afz_afazeres');
    }

    public function down()
    {
        $this->forge->dropTable('afz_afazeres');

    }
}
