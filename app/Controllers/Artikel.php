<?php

namespace App\Controllers;

class Artikel extends BaseController
{
    public function index(): string
    {
        return view('artikel');
    }
}