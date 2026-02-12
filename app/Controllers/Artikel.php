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
}
