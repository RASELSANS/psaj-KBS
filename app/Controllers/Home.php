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
        // KUMPULIN SEMUA DATA DOKTER DI SINI
        $data = [
            'title'   => 'Cari Dokter - Klinik Brayan Sehat',
            'doctors' => [
                [
                    'slug' => 'theresa', 
                    'name' => 'drg. Theresa Irina Sukma', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'D1.png'
                ],
                [
                    'slug' => 'farida', 
                    'name' => 'drg. Nur Farida Marbun', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'D2.png'
                ],
                [
                    'slug' => 'savira', 
                    'name' => 'drg. Savira Aska Nourmalita', 
                    'spec' => 'Spesialis Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D3.png'
                ],
                [
                    'slug' => 'anton', 
                    'name' => 'dr. Anton Sunaryo, ST.,M.K.K.', 
                    'spec' => 'Spesialis Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D4.png'
                ],
                [
                    'slug' => 'joko', 
                    'name' => 'dr. Joko Rilo Pambudi, Sp.PD', 
                    'spec' => 'Spesialis Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D5.png'
                ],
                [
                    'slug' => 'abraham', 
                    'name' => 'dr. Abraham Avicenna, Sp. JP', 
                    'spec' => 'Spesialis Jantung', 
                    'spec_key' => 'JANTUNG', 
                    'img' => 'D6.png'
                ],
                [
                    'slug' => 'tutie', 
                    'name' => 'dr. Tutie Ferika Utami, Sp. THT', 
                    'spec' => 'Spesialis THT-KL', 
                    'spec_key' => 'THT', 
                    'img' => 'D7.png'
                ],
                [
                    'slug' => 'yoan', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D8.png'
                ],
                [
                    'slug' => 'yoan', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D9.png'
                ],
                [
                    'slug' => 'yoan', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D10.png'
                ],
                [
                    'slug' => 'yoan', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D11.png'
                ],
                [
                    'slug' => 'yoan', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D12.png'
                ],
            ]
        ];

        return view('doctors_page', $data);
    }

    public function about()
    {
        return view('about', ['title' => 'Tentang Kami - Klinik Brayan Sehat']); 
    }

    public function artikel()
    {
        return view('artikel', ['title' => 'Artikel Kesehatan']);
    }

    public function faq()
    {
        return view('faq', ['title' => 'FAQ - Tanya Jawab']);
    }

    public function kontak()
    {
        return view('kontak', ['title' => 'Hubungi Kami']);
    }

    public function penunjang_diagnostik()
    {
        return view('penunjang_diagnostik', ['title' => 'Penunjang Diagnostik']);
    }

    public function poliklinik()
    {
        return view('poliklinik', ['title' => 'Layanan Poliklinik']);
    }

    public function khitan_center()
    {
        return view('khitan_center', ['title' => 'Khitan Center']);
    }

    public function vaksin()
    {
        return view('vaksin', ['title' => 'Layanan Vaksinasi']);
    }
}