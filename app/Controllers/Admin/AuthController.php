<?php

namespace App\Controllers\Admin;

use App\Models\Admin;

class AuthController extends AdminController
{
    protected $adminModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new Admin();
    }

    /**
     * Admin login
     */
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validation
        if (!$username || !$password) {
            return $this->validationErrorResponse([
                'username' => $username ? '' : 'Username harus diisi',
                'password' => $password ? '' : 'Password harus diisi',
            ]);
        }

        // Find admin by username
        $admin = $this->adminModel->where('username', $username)->first();

        if (!$admin) {
            return $this->errorResponse(['auth' => 'Username atau password salah'], 401);
        }

        // Verify password
        if (!password_verify($password, $admin['password'])) {
            return $this->errorResponse(['auth' => 'Username atau password salah'], 401);
        }

        // Set session
        $this->session->set('admin_id', $admin['id_admin']);
        $this->session->set('admin_username', $admin['username']);

        return redirect("api/admin/dashboard");
    }

    /**
     * Admin logout
     */
    public function logout()
    {
        $this->session->destroy();

        return view('admin/login');
    }

    /**
     * Get current admin profile
     */
    public function profile()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $admin = $this->adminModel->find($this->getAdminId());

        if (!$admin) {
            return $this->errorResponse(['admin' => 'Admin tidak ditemukan'], 404);
        }

        unset($admin['password']);

        return $this->successResponse($admin);
    }
}
