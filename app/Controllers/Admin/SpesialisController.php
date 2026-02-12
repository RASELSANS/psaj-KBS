<?php

namespace App\Controllers\Admin;

use App\Models\Spesialis;

class SpesialisController extends AdminController
{
    protected $spesialisModel;

    public function __construct()
    {
        parent::__construct();
        $this->spesialisModel = new Spesialis();
    }

    /**
     * Get list of all spesialis
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $spesialis = $this->spesialisModel->findAll();

        return $this->successResponse(['spesialis' => $spesialis]);
    }

    /**
     * Create new spesialis
     */
    public function create()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $nama_spesialis = $this->request->getPost('nama_spesialis');

        // Validation
        if (!$nama_spesialis) {
            return $this->validationErrorResponse(['nama_spesialis' => 'Nama spesialis harus diisi']);
        }

        $id_spesialis = $this->spesialisModel->insert(['nama_spesialis' => $nama_spesialis]);

        $spesialis = $this->spesialisModel->find($id_spesialis);

        return $this->successResponse($spesialis, 'Spesialis berhasil ditambahkan', 201);
    }

    /**
     * Update spesialis
     */
    public function update($id_spesialis)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $spesialis = $this->spesialisModel->find($id_spesialis);
        if (!$spesialis) {
            return $this->errorResponse(['spesialis' => 'Spesialis tidak ditemukan'], 404);
        }

        $nama_spesialis = $this->request->getPost('nama_spesialis');

        // Validation
        if (!$nama_spesialis) {
            return $this->validationErrorResponse(['nama_spesialis' => 'Nama spesialis harus diisi']);
        }

        $this->spesialisModel->update($id_spesialis, ['nama_spesialis' => $nama_spesialis]);

        $spesialis = $this->spesialisModel->find($id_spesialis);

        return $this->successResponse($spesialis);
    }

    /**
     * Delete spesialis
     */
    public function delete($id_spesialis)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $spesialis = $this->spesialisModel->find($id_spesialis);
        if (!$spesialis) {
            return $this->errorResponse(['spesialis' => 'Spesialis tidak ditemukan'], 404);
        }

        $this->spesialisModel->delete($id_spesialis);

        return $this->successResponse(null);
    }
}
