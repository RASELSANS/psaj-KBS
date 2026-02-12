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
     * Check if admin is logged in
     */
    protected function isLoggedIn()
    {
        return $this->session->has('admin_id');
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
        if (!$this->isLoggedIn()) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['auth' => 'Anda harus login terlebih dahulu'],
            ])->setStatusCode(401);
        }
        return null;
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
}
