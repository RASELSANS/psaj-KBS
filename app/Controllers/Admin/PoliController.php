<?php

namespace App\Controllers\Admin;

use App\Models\Poli;

class PoliController extends AdminController
{
    protected $poliModel;

    public function __construct()
    {
        parent::__construct();
        $this->poliModel = new Poli();
    }

    /**
     * Get list of all poli
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $poli = $this->poliModel->findAll();

        return $this->successResponse(['poli' => $poli]);
    }

    /**
     * Get single poli
     */
    public function show($id_poli)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $poli = $this->poliModel->find($id_poli);
        if (!$poli) {
            return $this->errorResponse(['poli' => 'Poli tidak ditemukan'], 404);
        }

        return $this->successResponse($poli);
    }

    /**
     * Create new poli
     */
    public function create()
    {
        try {
            $authCheck = $this->requireLogin();
            if ($authCheck) return $authCheck;

            $nama_poli = $this->request->getPost('nama_poli');
            $deskripsi = $this->request->getPost('deskripsi');

            // Validation
            $errors = [];
            if (!$nama_poli) $errors['nama_poli'] = 'Nama poli harus diisi';
            if (!$deskripsi) $errors['deskripsi'] = 'Deskripsi harus diisi';

            if ($errors) {
                return $this->validationErrorResponse($errors);
            }

            $id_poli = $this->poliModel->insert([
                'nama_poli' => $nama_poli,
                'deskripsi' => $deskripsi,
            ]);

            $poli = $this->poliModel->find($id_poli);

            return $this->successResponse($poli, 'Poli berhasil ditambahkan', 201);
        } catch (\Exception $e) {
            return $this->errorResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update poli
     */
    public function update($id_poli)
    {
        try {
            $authCheck = $this->requireLogin();
            if ($authCheck) return $authCheck;

            $poli = $this->poliModel->find($id_poli);
            if (!$poli) {
                return $this->errorResponse(['poli' => 'Poli tidak ditemukan'], 404);
            }

            $nama_poli = $this->request->getPost('nama_poli');
            $deskripsi = $this->request->getPost('deskripsi');

            // Validation
            $errors = [];
            if (!$nama_poli) $errors['nama_poli'] = 'Nama poli harus diisi';
            if (!$deskripsi) $errors['deskripsi'] = 'Deskripsi harus diisi';

            if ($errors) {
                return $this->validationErrorResponse($errors);
            }

            $this->poliModel->update($id_poli, [
                'nama_poli' => $nama_poli,
                'deskripsi' => $deskripsi,
            ]);

            $poli = $this->poliModel->find($id_poli);

            return $this->successResponse($poli);
        } catch (\Exception $e) {
            return $this->errorResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete poli
     */
    public function delete($id_poli)
    {
        try {
            $authCheck = $this->requireLogin();
            if ($authCheck) return $authCheck;

            $poli = $this->poliModel->find($id_poli);
            if (!$poli) {
                return $this->errorResponse(['poli' => 'Poli tidak ditemukan'], 404);
            }

            $this->poliModel->delete($id_poli);

            return $this->successResponse(null);
        } catch (\Exception $e) {
            return $this->errorResponse(['error' => $e->getMessage()], 500);
        }
    }
}
