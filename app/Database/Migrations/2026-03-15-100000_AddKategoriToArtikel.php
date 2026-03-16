<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKategoriToArtikel extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_artikel', [
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'judul'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_artikel', 'kategori');
    }
}
