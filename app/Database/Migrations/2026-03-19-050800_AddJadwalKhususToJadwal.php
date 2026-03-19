<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJadwalKhususToJadwal extends Migration
{
    public function up()
    {
        // Add jadwal_khusus field
        $this->forge->addColumn('tbl_jadwal', [
            'jadwal_khusus' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'jam_selesai',
            ],
        ]);

        // Modify jam_mulai to be nullable
        $this->forge->modifyColumn('tbl_jadwal', [
            'jam_mulai' => [
                'type' => 'TIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Remove jadwal_khusus field
        $this->forge->dropColumn('tbl_jadwal', 'jadwal_khusus');

        // Revert jam_mulai to NOT NULL
        $this->forge->modifyColumn('tbl_jadwal', [
            'jam_mulai' => [
                'type' => 'TIME',
                'null' => false,
            ],
        ]);
    }
}
