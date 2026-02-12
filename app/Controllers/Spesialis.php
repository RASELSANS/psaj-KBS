<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Spesialis as SpesialisModel;

class Spesialis extends BaseController
{
    protected $spesialisModel;

    public function __construct()
    {
        $this->spesialisModel = new SpesialisModel();
    }

    /**
     * Get list of all spesialis
     */
    public function index()
    {
        $spesialis = $this->spesialisModel->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $spesialis,
        ]);
    }
}
