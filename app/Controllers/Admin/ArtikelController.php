<?php

namespace App\Controllers\Admin;

use App\Models\Artikel;

class ArtikelController extends AdminController
{
    protected $artikelModel;

    public function __construct()
    {
        parent::__construct();
        $this->artikelModel = new Artikel();
    }

    /**
     * Get list of all artikel
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search') ?? '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Build query with search
        $query = $this->artikelModel;
        if ($search) {
            $query = $query->like('judul', $search)->orLike('isi', $search);
        }

        $total = $query->countAllResults(false); // false = don't reset query
        $query = $this->artikelModel; // Reset for main query
        if ($search) {
            $query = $query->like('judul', $search)->orLike('isi', $search);
        }
        $artikel = $query->orderBy('tanggal_publish', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        return $this->successResponse([
            'artikel' => $artikel,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit),
            ],
        ]);
    }

    /**
     * Get single artikel by ID
     */
    public function show($id_artikel)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $artikel = $this->artikelModel->find($id_artikel);
        if (!$artikel) {
            return $this->errorResponse(['artikel' => 'Artikel tidak ditemukan'], 404);
        }

        return $this->successResponse($artikel);
    }

    /**
     * Create new artikel
     */
    public function create()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        $thumbnail = $this->request->getFile('thumbnail');
        $id_admin = $this->getAdminId();

        // Validation
        $errors = [];
        if (!$judul) $errors['judul'] = 'Judul harus diisi';
        if (!$isi) $errors['isi'] = 'Isi artikel harus diisi';
        if (!$tanggal_publish) $errors['tanggal_publish'] = 'Tanggal publish harus diisi';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        // Handle thumbnail upload
        $thumbnailName = null;
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            if ($thumbnail->getSize() > 2097152) {
                return $this->validationErrorResponse(['thumbnail' => 'Ukuran thumbnail maksimal 2MB']);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($thumbnail->getMimeType(), $allowedTypes)) {
                return $this->validationErrorResponse(['thumbnail' => 'Tipe file harus JPG, PNG, atau GIF']);
            }

            $newName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/articles', $newName);
            $thumbnailName = $newName;
        }

        $id_artikel = $this->artikelModel->insert([
            'id_admin' => $id_admin,
            'judul' => $judul,
            'isi' => $isi,
            'tanggal_publish' => $tanggal_publish,
            'thumbnail' => $thumbnailName,
        ]);

        $artikel = $this->artikelModel->find($id_artikel);

        return $this->successResponse($artikel, 'Artikel berhasil ditambahkan', 201);
    }

    /**
     * Update artikel
     */
    public function update($id_artikel)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $artikel = $this->artikelModel->find($id_artikel);
        if (!$artikel) {
            return $this->errorResponse(['artikel' => 'Artikel tidak ditemukan'], 404);
        }

        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        $thumbnail = $this->request->getFile('thumbnail');

        // Validation
        $errors = [];
        if (!$judul) $errors['judul'] = 'Judul harus diisi';
        if (!$isi) $errors['isi'] = 'Isi artikel harus diisi';
        if (!$tanggal_publish) $errors['tanggal_publish'] = 'Tanggal publish harus diisi';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        $updateData = [
            'judul' => $judul,
            'isi' => $isi,
            'tanggal_publish' => $tanggal_publish,
        ];

        // Handle thumbnail upload
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            if ($thumbnail->getSize() > 2097152) {
                return $this->validationErrorResponse(['thumbnail' => 'Ukuran thumbnail maksimal 2MB']);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($thumbnail->getMimeType(), $allowedTypes)) {
                return $this->validationErrorResponse(['thumbnail' => 'Tipe file harus JPG, PNG, atau GIF']);
            }

            // Delete old thumbnail
            if ($artikel['thumbnail']) {
                $oldPath = 'uploads/articles/' . $artikel['thumbnail'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $newName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/articles', $newName);
            $updateData['thumbnail'] = $newName;
        }

        $this->artikelModel->update($id_artikel, $updateData);

        $artikel = $this->artikelModel->find($id_artikel);

        return $this->successResponse($artikel);
    }

    /**
     * Delete artikel
     */
    public function delete($id_artikel)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $artikel = $this->artikelModel->find($id_artikel);
        if (!$artikel) {
            return $this->errorResponse(['artikel' => 'Artikel tidak ditemukan'], 404);
        }

        // Delete thumbnail
        if ($artikel['thumbnail']) {
            $path = 'uploads/articles/' . $artikel['thumbnail'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->artikelModel->delete($id_artikel);

        return $this->successResponse(null);
    }
}
