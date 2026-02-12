<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Poli as PoliModel;

class Poli extends BaseController
{
    protected $poliModel;

    public function __construct()
    {
        $this->poliModel = new PoliModel();
    }

    /**
     * Get list of all poli
     */
    public function index()
    {
        $poli = $this->poliModel->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $poli,
        ]);
    }
}
