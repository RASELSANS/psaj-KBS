<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSpesialisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spesialis' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_spesialis' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_spesialis', false, true);
        $this->forge->createTable('tbl_spesialis');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_spesialis');
    }
}
