<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AfzFolders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_folder'         => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_user'           => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'name_folder'       => ['type' => 'VARCHAR', 'constraint' => 64, 'null' => false],
            'background_folder' => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],
            'text_color_folder' => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],
            'created_at'        => ['type' => 'DATETIME','null' => true,],
            'updated_at'        => ['type' => 'DATETIME','null' => true,],
            'deleted_at'        => ['type' => 'DATETIME','null' => true,],
        ]);

        $this->forge->addKey('id_folder', true);
        $this->forge->addForeignKey('fk_user', 'users', 'id_user');

        $this->forge->createTable('afz_folders');
    }

    public function down()
    {
        $this->forge->dropTable('afz_folders');
    }
}
