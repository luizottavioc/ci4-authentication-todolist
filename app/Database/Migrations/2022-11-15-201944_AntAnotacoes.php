<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AntAnotacoes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anotacao' => ['type' => 'INT', 'constraint' => 11, 'usigned' => true, 'auto_increment' => true],
            'fk_user'     => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'anotacao'    => ['type' => 'varchar', 'constraint' => 450, 'null' => false],
            'fk_card'     => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'created_at'  => ['type' => 'DATETIME','null' => true,],
            'updated_at'  => ['type' => 'DATETIME','null' => true,],
            'deleted_at'  => ['type' => 'DATETIME','null' => true,],
        ]);
        $this->forge->addKey('id_anotacao', true);
        $this->forge->addForeignKey('fk_user', 'users', 'id_user');
        $this->forge->addForeignKey('fk_card', 'ant_cards', 'id_card');

        $this->forge->createTable('ant_anotacoes');
    }

    public function down()
    {
        $this->forge->dropTable('ant_anotacoes');
    }
}
