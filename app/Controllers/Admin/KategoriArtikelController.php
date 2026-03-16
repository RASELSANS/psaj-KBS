<?php

namespace App\Controllers\Admin;

use App\Models\KategoriArtikel;

class KategoriArtikelController extends AdminController
{
    protected $kategoriModel;

    public function __construct()
    {
        parent::__construct();
        $this->kategoriModel = new KategoriArtikel();
    }

    /**
     * Get all kategori
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $kategori = $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll();

        return $this->successResponse(['kategori' => $kategori]);
    }

    /**
     * Create new kategori
     */
    public function create()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $nama_kategori = $this->request->getPost('nama_kategori');
        $deskripsi = $this->request->getPost('deskripsi');

        // Validation
        $errors = [];
        if (!$nama_kategori) $errors['nama_kategori'] = 'Nama kategori harus diisi';

        // Check duplicate
        $existing = $this->kategoriModel->where('nama_kategori', $nama_kategori)->first();
        if ($existing) $errors['nama_kategori'] = 'Kategori sudah ada';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        $id_kategori = $this->kategoriModel->insert([
            'nama_kategori' => $nama_kategori,
            'deskripsi' => $deskripsi,
        ]);

        $kategori = $this->kategoriModel->find($id_kategori);

        return $this->successResponse($kategori, 'Kategori berhasil ditambahkan', 201);
    }

    /**
     * Delete kategori
     */
    public function delete($id_kategori)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $kategori = $this->kategoriModel->find($id_kategori);
        if (!$kategori) {
            return $this->errorResponse(['kategori' => 'Kategori tidak ditemukan'], 404);
        }

        $this->kategoriModel->delete($id_kategori);

        return $this->successResponse(null);
    }
}
