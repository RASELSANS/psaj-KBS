<?php

namespace App\Controllers\Admin;

use App\Models\Jadwal;

class JadwalController extends AdminController
{
    protected $jadwalModel;

    public function __construct()
    {
        parent::__construct();
        $this->jadwalModel = new Jadwal();
    }

    /**
     * Get jadwal by doctor id
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $id_doctor = $this->request->getGet('id_doctor');
        $page = (int)($this->request->getGet('page') ?? 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Build query
        $builder = $this->jadwalModel->builder();
        
        if ($id_doctor) {
            $builder->where('id_doctor', $id_doctor);
        }

        // Get total count
        $total = $builder->countAllResults(false);

        // Get jadwal with pagination
        $jadwal = $builder->limit($limit, $offset)
                        ->get()
                        ->getResultArray();

        return $this->successResponse([
            'jadwal' => $jadwal,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit),
            ],
        ]);
    }

    /**
     * Create new jadwal
     */
    public function create()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $id_doctor = $this->request->getPost('id_doctor');
        $hari = $this->request->getPost('hari');
        $jam_mulai = $this->request->getPost('jam_mulai');
        $jam_selesai = $this->request->getPost('jam_selesai');
        $jadwal_khusus = $this->request->getPost('jadwal_khusus');

        // Validation
        $errors = [];
        if (!$id_doctor) $errors['id_doctor'] = 'ID dokter harus diisi';
        if (!$hari) $errors['hari'] = 'Hari harus diisi';
        
        // Jika ada jadwal_khusus, jam tidak wajib. Jika tidak ada jadwal_khusus, jam_mulai wajib
        if (!$jadwal_khusus && !$jam_mulai) {
            $errors['jam_mulai'] = 'Jam mulai harus diisi atau isi jadwal khusus';
        }

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        $id_jadwal = $this->jadwalModel->insert([
            'id_doctor' => $id_doctor,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai ?: null,
            'jam_selesai' => $jam_selesai ?: null,
            'jadwal_khusus' => $jadwal_khusus ?: null,
        ]);

        $jadwal = $this->jadwalModel->find($id_jadwal);

        return $this->successResponse($jadwal, 'Jadwal berhasil ditambahkan', 201);
    }

    /**
     * Update jadwal
     */
    public function update($id_jadwal)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $jadwal = $this->jadwalModel->find($id_jadwal);
        if (!$jadwal) {
            return $this->errorResponse(['jadwal' => 'Jadwal tidak ditemukan'], 404);
        }

        $id_doctor = $this->request->getPost('id_doctor');
        $hari = $this->request->getPost('hari');
        $jam_mulai = $this->request->getPost('jam_mulai');
        $jam_selesai = $this->request->getPost('jam_selesai');
        $jadwal_khusus = $this->request->getPost('jadwal_khusus');

        // Validation
        $errors = [];
        if (!$id_doctor) $errors['id_doctor'] = 'ID dokter harus diisi';
        if (!$hari) $errors['hari'] = 'Hari harus diisi';
        
        // Jika ada jadwal_khusus, jam tidak wajib. Jika tidak ada jadwal_khusus, jam_mulai wajib
        if (!$jadwal_khusus && !$jam_mulai) {
            $errors['jam_mulai'] = 'Jam mulai harus diisi atau isi jadwal khusus';
        }

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        $this->jadwalModel->update($id_jadwal, [
            'id_doctor' => $id_doctor,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai ?: null,
            'jam_selesai' => $jam_selesai ?: null,
            'jadwal_khusus' => $jadwal_khusus ?: null,
        ]);

        $jadwal = $this->jadwalModel->find($id_jadwal);

        return $this->successResponse($jadwal);
    }

    /**
     * Delete jadwal
     */
    public function delete($id_jadwal)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $jadwal = $this->jadwalModel->find($id_jadwal);
        if (!$jadwal) {
            return $this->errorResponse(['jadwal' => 'Jadwal tidak ditemukan'], 404);
        }

        $this->jadwalModel->delete($id_jadwal);

        return $this->successResponse(null);
    }
}
