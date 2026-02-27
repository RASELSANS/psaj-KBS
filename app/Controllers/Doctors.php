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
     * Get list of all doctors with pagination
     */
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total = $this->doctorModel->countAll();
        $doctors = $this->doctorModel->limit($limit, $offset)->findAll();

        // Append spesialis, poli, and jadwal for each doctor
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
     * Get detail of a specific doctor
     */
    public function detail($id_doctor)
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

    public function dummy()
    {
        return view('doctor_detail');
    }
}
