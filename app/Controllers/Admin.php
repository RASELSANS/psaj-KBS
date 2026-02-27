<?php

namespace App\Controllers;

class Admin extends BaseController
{
    /**
     * Halaman Utama Dashboard
     */
    public function index()
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard Overview',
            'page'  => 'dashboard',
            // Data dummy untuk statistik di Dashboard
            'stats' => [
                'total_pasien' => '1,250',
                'total_dokter' => '12',
                'total_chat'   => '1,250',
                'rating'       => '4.6'
            ]
        ]);
    }

    /**
     * Halaman Daftar Dokter (Index)
     */
    public function doctors()
    {
        // Data dummy untuk tabel dokter
        $data_dokter = [
            [
                'id'        => 1, 
                'nama'      => 'drg. Theresa Irina Sukma', 
                'nip'       => '198203012010122003', 
                'spesialis' => 'Poli Gigi', 
                'status'    => 'Aktif'
            ],
            [
                'id'        => 2, 
                'nama'      => 'dr. Budi Santoso', 
                'nip'       => '199005122018011002', 
                'spesialis' => 'Poli Umum', 
                'status'    => 'Aktif'
            ],
            [
                'id'        => 3, 
                'nama'      => 'dr. Siti Aminah, Sp.A', 
                'nip'       => '198507212015032001', 
                'spesialis' => 'Poli Anak', 
                'status'    => 'Tidak Aktif'
            ]
        ];

        return view('admin/doctors/index', [
            'title'   => 'Kelola Tenaga Medis',
            'page'    => 'doctors',
            'doctors' => $data_dokter
        ]);
    }

    /**
     * Halaman Form Tambah Artikel
     */
    public function add_artikel()
    {
        return view('admin/artikel/create', [
            'title' => 'Tulis Artikel Baru',
            'page'  => 'artikel' // 'artikel' agar sidebar tahu mana yang aktif
        ]);
    }

    /**
     * Proses Simpan Artikel ke Database
     */
    public function store_artikel()
    {
        // 1. Ambil data dari form
        $judul    = $this->request->getPost('judul');
        $isi      = $this->request->getPost('isi');
        $kategori = $this->request->getPost('kategori');

        // 2. Logika Upload Gambar (Nanti diaktifkan kalau sudah ada tabel DB)
        /*
        $fileGambar = $this->request->getFile('foto');
        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaBaru = $fileGambar->getRandomName();
            $fileGambar->move('img/artikel', $namaBaru);
        }
        */

        // 3. Sementara redirect dulu ke dashboard dengan pesan sukses
        return redirect()->to('/admin')->with('success', 'Gokil! Artikel "' . $judul . '" berhasil diterbitkan.');
    }

    /**
     * Logout System
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}