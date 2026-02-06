<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing_page');
    }

    public function layanan()
{
    $data = [
        'title' => 'Detail Layanan - Klinik Brayan Sehat'
    ];
    return view('layanan_page', $data);
}

public function doctors()
{
    $data = [
        'title' => 'Cari Dokter - Klinik Brayan Sehat'
    ];
    return view('doctors_page', $data);
}
}

