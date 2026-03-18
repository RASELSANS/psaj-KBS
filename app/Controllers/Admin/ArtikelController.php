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

        $page = (int)($this->request->getGet('page') ?? 1);
        $search = $this->request->getGet('search') ?? '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Build query with search
        $builder = $this->artikelModel->builder();
        
        if ($search) {
            $builder->groupStart()
                    ->like('judul', $search)
                    ->orLike('isi', $search)
                    ->groupEnd();
        }

        // Get total count
        $total = $builder->countAllResults(false);

        // Get artikel with pagination
        $artikel = $builder->orderBy('tanggal_publish', 'DESC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();

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
        $kategori = $this->request->getPost('kategori');
        $isi = $this->request->getPost('isi');
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        $thumbnail = $this->request->getFile('thumbnail');
        $galleryImage = $this->request->getPost('gallery_image');
        $id_admin = $this->getAdminId();

        // Validation
        $errors = [];
        if (!$judul) $errors['judul'] = 'Judul harus diisi';
        if (!$isi) $errors['isi'] = 'Isi artikel harus diisi';
        if (!$tanggal_publish) $errors['tanggal_publish'] = 'Tanggal publish harus diisi';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        // Handle thumbnail upload or gallery image
        $thumbnailName = null;
        
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            // Upload new file
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
        } elseif ($galleryImage) {
            // Copy from gallery
            $sourcePath = FCPATH . 'uploads/' . $galleryImage;
            
            if (file_exists($sourcePath)) {
                $newName = time() . '_' . basename($galleryImage);
                $destPath = FCPATH . 'uploads/articles/' . $newName;
                
                if (copy($sourcePath, $destPath)) {
                    $thumbnailName = $newName;
                } else {
                    return $this->validationErrorResponse(['thumbnail' => 'Gagal menyalin foto dari galeri']);
                }
            } else {
                return $this->validationErrorResponse(['thumbnail' => 'Foto galeri tidak ditemukan']);
            }
        }

        $id_artikel = $this->artikelModel->insert([
            'id_admin' => $id_admin,
            'judul' => $judul,
            'kategori' => $kategori,
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
        $kategori = $this->request->getPost('kategori');  // TAMBAH INI
        $isi = $this->request->getPost('isi');
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        $thumbnail = $this->request->getFile('thumbnail');
        $galleryImage = $this->request->getPost('gallery_image');

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
            'kategori' => $kategori,  // TAMBAH INI
            'isi' => $isi,
            'tanggal_publish' => $tanggal_publish,
        ];

        // Handle thumbnail upload or gallery image
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            // Upload new file
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
        } elseif ($galleryImage) {
            // Copy from gallery
            $sourcePath = FCPATH . 'uploads/' . $galleryImage;
            
            if (file_exists($sourcePath)) {
                // Delete old thumbnail
                if ($artikel['thumbnail']) {
                    $oldPath = 'uploads/articles/' . $artikel['thumbnail'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $newName = time() . '_' . basename($galleryImage);
                $destPath = FCPATH . 'uploads/articles/' . $newName;
                
                if (copy($sourcePath, $destPath)) {
                    $updateData['thumbnail'] = $newName;
                } else {
                    return $this->validationErrorResponse(['thumbnail' => 'Gagal menyalin foto dari galeri']);
                }
            } else {
                return $this->validationErrorResponse(['thumbnail' => 'Foto galeri tidak ditemukan']);
            }
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
