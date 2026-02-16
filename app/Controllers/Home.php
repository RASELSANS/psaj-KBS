<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing_page');
    }

    public function doctors()
    {
        $data = [
            'title'   => 'Cari Dokter - Klinik Brayan Sehat',
            'doctors' => [
                // --- POLI UMUM ---
                [
                    'slug' => 'anton-sunaryo', 
                    'name' => 'dr. Anton Sunaryo, ST., M.K.K., AIFO-K', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'D6.png'
                ],
                [
                    'slug' => 'adelia-budhie', 
                    'name' => 'dr. Adelia Budhie Puspita Sari', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'dokter_adelia.png'
                ],
                [
                    'slug' => 'tri-setyaningrum', 
                    'name' => 'dr. Tri Setyaningrum', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'D2.png'
                ],
                [
                    'slug' => 'nurkholis-majid', 
                    'name' => 'dr. Nurkholis Majid', 
                    'spec' => 'Poli Umum', 
                    'spec_key' => 'UMUM', 
                    'img' => 'dokter_nurkholis.png'
                ],

                // --- POLI PENYAKIT DALAM ---
                [
                    'slug' => 'joko-rilo', 
                    'name' => 'dr. Joko Rilo Pambudi, Sp.PD (K-R) FINASIM', 
                    'spec' => 'Poli Penyakit Dalam', 
                    'spec_key' => 'DALAM', 
                    'img' => 'D5.png'
                ],

                // --- POLI JANTUNG ---
                [
                    'slug' => 'abraham-avicenna', 
                    'name' => 'dr. Abraham Avicenna, Sp. JP (K), FIHA', 
                    'spec' => 'Poli Jantung & Pembuluh Darah', 
                    'spec_key' => 'JANTUNG', 
                    'img' => 'D10.png'
                ],

                // --- POLI THT ---
                [
                    'slug' => 'tutie-ferika', 
                    'name' => 'dr. Tutie Ferika Utami, Sp. THT-KL., M. Kes.', 
                    'spec' => 'Poli THT-KL', 
                    'spec_key' => 'THT', 
                    'img' => 'D11.png'
                ],

                // --- RADIOLOGI ---
                [
                    'slug' => 'yoan-budiman', 
                    'name' => 'dr. Yoan Budiman, Sp.Rad', 
                    'spec' => 'Poli Radiologi', 
                    'spec_key' => 'RADIOLOGI', 
                    'img' => 'D4.png'
                ],

                // --- PATOLOGI KLINIK ---
                [
                    'slug' => 'vitasari-indriani', 
                    'name' => 'Dr. dr. Vitasari Indriani, M.M., M. Si., Med, Sp. PK', 
                    'spec' => 'Spesialis Patologi Klinik', 
                    'spec_key' => 'PATOLOGI', 
                    'img' => 'D3.png'
                ],

                // --- PSIKIATER & PSIKOLOG (Kesehatan Jiwa) ---
                [
                    'slug' => 'tri-rini', 
                    'name' => 'dr. Tri Rini Budi Setyaningsih, Sp.KJ', 
                    'spec' => 'Psikiater (Kesehatan Jiwa)', 
                    'spec_key' => 'SARAF', 
                    'img' => 'dokter_tririni.png'
                ],
                [
                    'slug' => 'nisaul-maghfiroh', 
                    'name' => 'Nisaul Maghfiroh, M. Psi', 
                    'spec' => 'Psikolog Klinis', 
                    'spec_key' => 'SARAF', 
                    'img' => 'D1.png'
                ],

                // --- POLI ANAK ---
                [
                    'slug' => 'made-dikky', 
                    'name' => 'dr. I Made Dikky Kalsa, Sp. A', 
                    'spec' => 'Poli Anak', 
                    'spec_key' => 'ANAK', 
                    'img' => 'D12.png'
                ],

                // --- POLI GIGI ---
                [
                    'slug' => 'theresa-irina', 
                    'name' => 'drg. Theresa Irina Sukma', 
                    'spec' => 'Poli Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D7.png'
                ],
                [
                    'slug' => 'nur-farida', 
                    'name' => 'drg. Nur Farida Marbun', 
                    'spec' => 'Poli Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D8.png'
                ],
                [
                    'slug' => 'savira-aska', 
                    'name' => 'drg. Savira Aska Nourmalita', 
                    'spec' => 'Poli Gigi', 
                    'spec_key' => 'GIGI', 
                    'img' => 'D9.png'
                ],
            ]
        ];

        return view('doctors_page', $data);
    }

    // --- Method Lainnya ---
    public function layanan() {
        return view('layanan_page', ['title' => 'Detail Layanan - Klinik Brayan Sehat']);
    }

    public function about() {
        return view('about', ['title' => 'Tentang Kami - Klinik Brayan Sehat']); 
    }

    public function artikel() {
        return view('artikel', ['title' => 'Artikel Kesehatan']);
    }

    public function faq() {
        return view('faq', ['title' => 'FAQ - Tanya Jawab']);
    }

    public function kontak() {
        return view('kontak', ['title' => 'Hubungi Kami']);
    }

    public function penunjang_diagnostik() {
        return view('penunjang_diagnostik', ['title' => 'Penunjang Diagnostik']);
    }

    public function poliklinik() {
        return view('poliklinik', ['title' => 'Layanan Poliklinik']);
    }

    public function khitan_center() {
        return view('khitan_center', ['title' => 'Khitan Center']);
    }

    public function vaksin() {
        return view('vaksin', ['title' => 'Layanan Vaksinasi']);
    }
}