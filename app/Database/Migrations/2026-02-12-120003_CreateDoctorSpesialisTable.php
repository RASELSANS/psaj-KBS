<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDoctorSpesialisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
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
            'id_spesialis' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', false, true);
        $this->forge->addForeignKey('id_doctor', 'tbl_doctor', 'id_doctor', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_spesialis', 'tbl_spesialis', 'id_spesialis', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_doctor_spesialis');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_doctor_spesialis');
    }
}
