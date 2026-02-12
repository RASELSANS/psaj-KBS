<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePoliTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_poli' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_poli' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_poli', false, true);
        $this->forge->createTable('tbl_poli');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_poli');
    }
}
