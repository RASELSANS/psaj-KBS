<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriArtikelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
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
        $this->forge->addKey('id_kategori', false, true);
        $this->forge->createTable('tbl_kategori_artikel');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_kategori_artikel');
    }
}
