<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDoctorPoliTable extends Migration
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
            'id_poli' => [
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
        $this->forge->addForeignKey('id_poli', 'tbl_poli', 'id_poli', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_doctor_poli');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_doctor_poli');
    }
}
