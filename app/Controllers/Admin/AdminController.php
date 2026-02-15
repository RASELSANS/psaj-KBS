<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    /**
     * Check if admin is logged in and show appropriate view
     */
    public function isLoggedIn()
    {
        if($this->session->has('admin_id')){
            return view('admin/dashboard');
        }
        else{
            return view('admin/login');
        };
    }

    /**
     * Get current admin id
     */
    protected function getAdminId()
    {
        return $this->session->get('admin_id');
    }

    /**
     * Redirect to login if not authenticated
     */
    protected function requireLogin()
    {
        if (!$this->session->has('admin_id')) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['auth' => 'Anda harus login terlebih dahulu'],
            ])->setStatusCode(401);
        }
        return view('admin/login');
    }

    /**
     * Send validation error response
     */
    protected function validationErrorResponse($errors)
    {
        return $this->response->setJSON([
            'status' => false,
            'errors' => $errors,
        ])->setStatusCode(400);
    }

    /**
     * Send success response
     */
    protected function successResponse($data, $message = 'Operasi berhasil', $statusCode = 200)
    {
        return $this->response->setJSON([
            'status' => true,
            'data' => $data,
        ])->setStatusCode($statusCode);
    }

    /**
     * Send error response
     */
    protected function errorResponse($errors, $statusCode = 400)
    {
        return $this->response->setJSON([
            'status' => false,
            'errors' => is_array($errors) ? $errors : ['error' => $errors],
        ])->setStatusCode($statusCode);
    }

    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    /**
     * Dokter Management View
     */
    public function dokter()
    {
        return view('admin/dokter');
    }

    /**
     * Spesialis Management View
     */
    public function spesialis()
    {
        return view('admin/spesialis');
    }

    /**
     * Poli Management View
     */
    public function poli()
    {
        return view('admin/poli');
    }

    /**
     * Jadwal Management View
     */
    public function jadwal()
    {
        return view('admin/jadwal');
    }

    /**
     * Artikel Management View
     */
    public function artikel()
    {
        return view('admin/artikel');
    }

    /**
     * Artikel Form (Create/Edit) View
     */
    public function artikelForm()
    {
        return view('admin/artikel_form');
    }
}

