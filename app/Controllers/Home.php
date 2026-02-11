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
        $data = ['title' => 'Detail Layanan - Klinik Brayan Sehat'];
        return view('layanan_page', $data);
    }

    public function doctors()
    {
        $data = ['title' => 'Cari Dokter - Klinik Brayan Sehat'];
        return view('doctors_page', $data);
    }

    // WAJIB SAMA DENGAN ROUTES (Home::about)
    public function about()
    {
        return view('about'); 
    }

    public function artikel()
{
    return view('artikel');
}

public function faq()
{
    return view('faq');
}

public function kontak()
{
    return view('kontak');
}

public function penunjang_diagnostik()
{
    $data = [
        'title' => 'Penunjang Diagnostik - Klinik Brayan Sehat'
    ];
    return view('penunjang_diagnostik', $data);
}
public function poliklinik()
{
    $data = [
        'title' => 'Layanan Poliklinik - Klinik Brayan Sehat'
    ];
    return view('poliklinik', $data);
}

public function khitan_center()
{
    $data = ['title' => 'Khitan Center - Klinik Brayan Sehat'];
    return view('khitan_center', $data);
}

public function vaksin()
{
    $data = [
        'title' => 'Layanan Vaksinasi - Klinik Brayan Sehat'
    ];
    return view('vaksin', $data);
}

}