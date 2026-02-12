<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_doctor' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jam_mulai' => [
                'type' => 'TIME',
            ],
            'jam_selesai' => [
                'type' => 'TIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_jadwal', false, true);
        $this->forge->addForeignKey('id_doctor', 'tbl_doctor', 'id_doctor', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jadwal');
    }
}
