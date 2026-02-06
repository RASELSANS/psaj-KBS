<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Doctors extends BaseController
{
    public function index()
    {
        return view('docters_page');
    }

    public function detail($slug)
    {
        // Sementara kita return view dulu, nanti datanya bisa diambil dari database
        return view('doctor_detail'); 
    }
}
