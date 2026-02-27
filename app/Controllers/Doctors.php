<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Doctor as DoctorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Doctors extends BaseController
{
    protected $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    /**
     * Display list of all doctors (Frontend View)
     */
    public function index()
    {
        $doctors = $this->doctorModel->findAll();

        // Transform data to match frontend view expectations
        foreach ($doctors as &$doctor) {
            $doctor['name'] = $doctor['nama_doctor'];
            $doctor['img'] = $doctor['foto'];
            $doctor['slug'] = strtolower(str_replace(' ', '-', $doctor['nama_doctor']));
            $doctor['desc'] = $doctor['profil'];
            $doctor['spec'] = $this->_getFirstSpesialis($doctor['id_doctor']);
            $doctor['spec_key'] = $this->_getFirstSpesialisKey($doctor['id_doctor']);
            $doctor['spesialis'] = $this->doctorModel->getSpesialis($doctor['id_doctor']);
            $doctor['poli'] = $this->doctorModel->getPoli($doctor['id_doctor']);
            $doctor['jadwal_array'] = $this->doctorModel->getJadwal($doctor['id_doctor']);
            $doctor['jadwal'] = $this->_formatJadwal($doctor['jadwal_array']);
        }

        return view('doctors_page', [
            'title'   => 'Cari Dokter - Klinik Brayan Sehat',
            'doctors' => $doctors
        ]);
    }

    /**
     * Display doctor detail by ID (Frontend View)
     */
    public function detail($id_doctor = null)
    {
        if (!$id_doctor) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $doctor = $this->doctorModel->find($id_doctor);

        if (!$doctor) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Transform data to match frontend view expectations
        $doctor['name'] = $doctor['nama_doctor'];
        $doctor['img'] = $doctor['foto'];
        $doctor['desc'] = $doctor['profil'];
        $doctor['spec'] = $this->_getFirstSpesialis($id_doctor);
        $doctor['spesialis'] = $this->doctorModel->getSpesialis($id_doctor);
        $doctor['poli'] = $this->doctorModel->getPoli($id_doctor);
        $doctor['jadwal_array'] = $this->doctorModel->getJadwal($id_doctor);
        $doctor['jadwal'] = $this->_formatJadwal($doctor['jadwal_array']);

        return view('doctor_detail', [
            'title'  => $doctor['name'],
            'doctor' => $doctor
        ]);
    }

    /**
     * API: Get list of all doctors with pagination (JSON Response)
     */
    public function apiIndex()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total = $this->doctorModel->countAll();
        $doctors = $this->doctorModel->limit($limit, $offset)->findAll();

        // Append relationships for each doctor
        foreach ($doctors as &$doctor) {
            $doctor['spesialis'] = $this->doctorModel->getSpesialis($doctor['id_doctor']);
            $doctor['poli'] = $this->doctorModel->getPoli($doctor['id_doctor']);
            $doctor['jadwal'] = $this->doctorModel->getJadwal($doctor['id_doctor']);
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $doctors,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit),
            ],
        ]);
    }

    /**
     * API: Get detail of a specific doctor
     */
    public function apiDetail($id_doctor)
    {
        $doctor = $this->doctorModel->find($id_doctor);

        if (!$doctor) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['doctor' => 'Dokter tidak ditemukan'],
            ])->setStatusCode(404);
        }

        $doctor['spesialis'] = $this->doctorModel->getSpesialis($id_doctor);
        $doctor['poli'] = $this->doctorModel->getPoli($id_doctor);
        $doctor['jadwal'] = $this->doctorModel->getJadwal($id_doctor);

        return $this->response->setJSON([
            'status' => true,
            'data' => $doctor,
        ]);
    }

    /**
     * Dummy method (placeholder for old route)
     */
    public function dummy()
    {
        return view('doctor_detail');
    }

    // ============= HELPER METHODS =============

    /**
     * Get first spesialis name for a doctor
     */
    private function _getFirstSpesialis($id_doctor)
    {
        $spesialis = $this->doctorModel->getSpesialis($id_doctor);
        return !empty($spesialis) ? $spesialis[0]['nama_spesialis'] : 'Umum';
    }

    /**
     * Get first spesialis key for filtering
     */
    private function _getFirstSpesialisKey($id_doctor)
    {
        $spesialisMap = [
            'Poli Gigi' => 'GIGI',
            'Poli Umum' => 'UMUM',
            'Poli Jantung & Pembuluh Darah' => 'JANTUNG',
            'Poli THT-KL' => 'THT',
            'Poli Anak' => 'ANAK',
            'Poli Penyakit Dalam' => 'DALAM',
            'Spesialis Patologi Klinik' => 'PATOLOGI',
            'Poli Radiologi' => 'RADIOLOGI',
            'Psikiater (Kesehatan Jiwa)' => 'SARAF',
            'Psikolog Klinis' => 'SARAF',
        ];

        $spesialis = $this->doctorModel->getSpesialis($id_doctor);
        if (!empty($spesialis)) {
            $name = $spesialis[0]['nama_spesialis'];
            return $spesialisMap[$name] ?? 'UMUM';
        }
        return 'UMUM';
    }

    /**
     * Format jadwal array to readable string
     */
    private function _formatJadwal($jadwal_array)
    {
        if (empty($jadwal_array)) {
            return 'Hubungi Admin untuk Jadwal';
        }

        // Simple format: combine jadwal items into readable string
        $jadwal_strings = array_map(function($item) {
            // Adjust based on your jadwal table structure (hari, jam_mulai, jam_selesai, dll)
            if (isset($item['jam_mulai']) && isset($item['jam_selesai'])) {
                return "{$item['jam_mulai']} - {$item['jam_selesai']}";
            }
            return isset($item['hari']) ? $item['hari'] : '';
        }, $jadwal_array);

        $jadwal_strings = array_filter($jadwal_strings);
        return !empty($jadwal_strings) ? implode(', ', $jadwal_strings) : 'Hubungi Admin untuk Jadwal';
    }
}