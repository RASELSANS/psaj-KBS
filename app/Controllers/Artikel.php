<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Artikel as ArtikelModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    /**
     * Get list of all artikel with pagination
     */
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total = $this->artikelModel->countAll();
        $artikel = $this->artikelModel->orderBy('tanggal_publish', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $artikel,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit),
            ],
        ]);
    }

    /**
     * Get detail of a specific artikel
     */
    public function detail($id_artikel)
    {
        $artikel = $this->artikelModel->find($id_artikel);

        if (!$artikel) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['artikel' => 'Artikel tidak ditemukan'],
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $artikel,
        ]);
    }

    /**
     * Display list of all artikel (Frontend View)
     */
    public function page()
    {
        $artikel = $this->artikelModel->orderBy('tanggal_publish', 'DESC')->findAll();

        return view('artikel', [
            'title' => 'Artikel Kesehatan - Klinik Brayan Sehat',
            'artikels' => $artikel
        ]);
    }

    /**
     * Display artikel detail by ID (Frontend View)
     */
    public function detailPage($id_artikel = null)
    {
        if (!$id_artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $artikel = $this->artikelModel->find($id_artikel);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get other articles for sidebar (exclude current article)
        $otherArtikels = $this->artikelModel
            ->where('id_artikel !=', $id_artikel)
            ->orderBy('tanggal_publish', 'DESC')
            ->limit(5)
            ->findAll();

        return view('artikel_detail', [
            'title' => $artikel['judul'],
            'artikel' => $artikel,
            'otherArtikels' => $otherArtikels
        ]);
    }
}
