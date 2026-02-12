<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDoctorTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_doctor' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_doctor' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'profil' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_doctor', false, true);
        $this->forge->createTable('tbl_doctor');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_doctor');
    }
}
