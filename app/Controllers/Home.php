<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string { return view('landing_page'); }

    // DATA MASTER - Gue tambahin 'jadwal' & 'spec_key' biar GAK ERROR
  private function _allDoctors() {
        return [
            [
                'slug' => 'anton-sunaryo', 
                'name' => 'dr. Anton Sunaryo, ST., M.K.K., AIFO-K', 
                'spec' => 'Poli Umum', 
                'spec_key' => 'UMUM', 
                'img' => 'D6.png', 
                'jadwal' => 'Senin - Sabtu (08.00 - 14.00)',
                'desc' => 'Dokter umum yang berdedikasi tinggi dalam memberikan pelayanan kesehatan dasar dan edukasi pola hidup sehat bagi keluarga.'
            ],
            [
                'slug' => 'adelia-budhie', 
                'name' => 'dr. Adelia Budhie Puspita Sari', 
                'spec' => 'Poli Umum', 
                'spec_key' => 'UMUM', 
                'img' => 'DEFAULT.JPG', 
                'jadwal' => 'Senin - Jumat (08.00 - 12.00)',
                'desc' => 'Melayani konsultasi kesehatan umum dengan pendekatan yang ramah dan teliti untuk memastikan diagnosa yang akurat.'
            ],
            [
                'slug' => 'tri-setyaningrum', 
                'name' => 'dr. Tri Setyaningrum', 
                'spec' => 'Poli Umum', 
                'spec_key' => 'UMUM', 
                'img' => 'DEFAULT.JPG', 
                'jadwal' => 'Hubungi Admin',
                'desc' => 'Tenaga medis profesional yang siap memberikan penanganan pertama dan konsultasi keluhan kesehatan harian Anda.'
            ],
            [
                'slug' => 'nurkholis-majid', 
                'name' => 'dr. Nurkholis Majid', 
                'spec' => 'Poli Umum', 
                'spec_key' => 'UMUM', 
                'img' => 'DEFAULT.JPG', 
                'jadwal' => 'Hubungi Admin',
                'desc' => 'Fokus pada pelayanan kesehatan preventif dan kuratif untuk menjaga kebugaran tubuh pasien secara menyeluruh.'
            ],
            [
                'slug' => 'joko-rilo', 
                'name' => 'dr. Joko Rilo Pambudi, Sp.PD (K-R) FINASIM', 
                'spec' => 'Poli Penyakit Dalam', 
                'spec_key' => 'DALAM', 
                'img' => 'D5.png', 
                'jadwal' => 'Senin & Kamis (16.00 - Selesai)',
                'desc' => 'Ahli penyakit dalam (Internis) yang spesifik menangani masalah kesehatan organ dalam yang kompleks dengan metode terkini.'
            ],
            [
                'slug' => 'abraham-avicenna', 
                'name' => 'dr. Abraham Avicenna, Sp. JP (K), FIHA', 
                'spec' => 'Poli Jantung & Pembuluh Darah', 
                'spec_key' => 'JANTUNG', 
                'img' => 'D10.png', 
                'jadwal' => 'Selasa & Rabu (15.00 - 18.00)',
                'desc' => 'Spesialis jantung yang berpengalaman dalam mendiagnosa serta memberikan tindakan preventif bagi kesehatan jantung Anda.'
            ],
            [
                'slug' => 'tutie-ferika', 
                'name' => 'dr. Tutie Ferika Utami, Sp. THT-KL., M. Kes.', 
                'spec' => 'Poli THT-KL', 
                'spec_key' => 'THT', 
                'img' => 'D11.png', 
                'jadwal' => 'Senin - Jumat (09.00 - 12.00)',
                'desc' => 'Ahli THT-KL yang fokus pada penanganan masalah telinga, hidung, dan tenggorokan dengan pelayanan yang nyaman.'
            ],
            [
                'slug' => 'yoan-budiman', 
                'name' => 'dr. Yoan Budiman, Sp.Rad', 
                'spec' => 'Poli Radiologi', 
                'spec_key' => 'RADIOLOGI', 
                'img' => 'D4.png', 
                'jadwal' => 'Senin - Sabtu (24 Jam On Call)',
                'desc' => 'Pakar radiologi yang membantu proses diagnosa penyakit melalui interpretasi pencitraan medis (X-Ray, USG, dll) secara presisi.'
            ],
            [
                'slug' => 'vitasari-indriani', 
                'name' => 'Dr. dr. Vitasari Indriani, M.M., M. Si., Med, Sp. PK', 
                'spec' => 'Spesialis Patologi Klinik', 
                'spec_key' => 'PATOLOGI', 
                'img' => 'D3.png', 
                'jadwal' => 'Senin - Sabtu (08.00 - 16.00)',
                'desc' => 'Mengelola diagnosa laboratorium untuk memberikan data medis yang valid sebagai penunjang kesembuhan pasien.'
            ],
            [
                'slug' => 'tri-rini', 
                'name' => 'dr. Tri Rini Budi Setyaningsih, Sp.KJ', 
                'spec' => 'Psikiater (Kesehatan Jiwa)', 
                'spec_key' => 'SARAF', 
                'img' => 'D2.png', 
                'jadwal' => 'Rabu & Jumat (14.00 - 17.00)',
                'desc' => 'Membantu pasien mencapai kesehatan mental yang stabil melalui konsultasi kejiwaan dan terapi medis yang tepat.'
            ],
            [
                'slug' => 'nisaul-maghfiroh', 
                'name' => 'Nisaul Maghfiroh, M. Psi', 
                'spec' => 'Psikolog Klinis', 
                'spec_key' => 'SARAF', 
                'img' => 'D1.png', 
                'jadwal' => 'Sesuai Perjanjian',
                'desc' => 'Pendampingan psikologis melalui konseling untuk membantu mengatasi berbagai masalah emosional dan perilaku.'
            ],
            [
                'slug' => 'made-dikky', 
                'name' => 'dr. I Made Dikky Kalsa, Sp. A', 
                'spec' => 'Poli Anak', 
                'spec_key' => 'ANAK', 
                'img' => 'D12.png', 
                'jadwal' => 'Senin - Jumat (09.00 - 13.00)',
                'desc' => 'Spesialis anak yang ramah, memastikan tumbuh kembang buah hati Anda terpantau dengan baik dan sehat.'
            ],
            [
                'slug' => 'theresa-irina', 
                'name' => 'drg. Theresa Irina Sukma', 
                'spec' => 'Poli Gigi', 
                'spec_key' => 'GIGI', 
                'img' => 'D7.png', 
                'jadwal' => 'Senin - Sabtu (08.00 - 21.00)',
                'desc' => 'Dokter gigi profesional yang ahli dalam perawatan estetika gigi dan menjaga kesehatan mulut keluarga Anda.'
            ],
            [
                'slug' => 'nur-farida', 
                'name' => 'drg. Nur Farida Marbun', 
                'spec' => 'Poli Gigi', 
                'spec_key' => 'GIGI', 
                'img' => 'D8.png', 
                'jadwal' => 'Senin - Sabtu (08.00 - 21.00)',
                'desc' => 'Memberikan solusi kesehatan gigi mulai dari pencabutan, penambalan, hingga pembersihan karang gigi.'
            ],
            [
                'slug' => 'savira-aska', 
                'name' => 'drg. Savira Aska Nourmalita', 
                'spec' => 'Poli Gigi', 
                'spec_key' => 'GIGI', 
                'img' => 'D9.png', 
                'jadwal' => 'Senin - Sabtu (08.00 - 21.00)',
                'desc' => 'Melayani perawatan gigi harian dengan sentuhan yang lembut dan informatif mengenai kesehatan gigi.'
            ],
        ];
    }

    public function doctors() {
        return view('doctors_page', [
            'title'   => 'Cari Dokter - Klinik Brayan Sehat',
            'doctors' => $this->_allDoctors()
        ]);
    }

    public function doctors_detail($slug) {
        $doctors = $this->_allDoctors();
        $found = null;
        foreach ($doctors as $d) {
            if ($d['slug'] === $slug) { 
                $found = $d; 
                break; 
            }
        }

        if (!$found) { 
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        }

        return view('doctor_detail', [
            'title'  => $found['name'],
            'doctor' => $found // Variable ini yang dipanggil di View detail
        ]);
    }

    // Method pendukung
    public function layanan() { return view('layanan_page', ['title' => 'Layanan']); }
    public function about() { return view('about', ['title' => 'About']); }
    public function artikel() { return view('artikel', ['title' => 'Artikel']); }
    public function faq() { return view('faq', ['title' => 'FAQ']); }
    public function kontak() { return view('kontak', ['title' => 'Kontak']); }
    public function penunjang_diagnostik() { return view('penunjang_diagnostik', ['title' => 'Penunjang']); }
    public function poliklinik() { return view('poliklinik', ['title' => 'Poliklinik']); }
    public function khitan_center() { return view('khitan_center', ['title' => 'Khitan']); }
    public function vaksin() { return view('vaksin', ['title' => 'Vaksin']); }
}