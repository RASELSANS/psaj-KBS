<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Jadwal as JadwalModel;

class Jadwal extends BaseController
{
    protected $jadwalModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
    }

    /**
     * Get jadwal by doctor id
     */
    public function index()
    {
        $id_doctor = $this->request->getGet('id_doctor');

        if (!$id_doctor) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['id_doctor' => 'Parameter id_doctor harus disediakan'],
            ])->setStatusCode(400);
        }

        $jadwal = $this->jadwalModel->where('id_doctor', $id_doctor)->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $jadwal,
        ]);
    }
}
