<?php

namespace App\Controllers\Admin;

class DebugController extends AdminController
{
    /**
     * Check current session status
     */
    public function sessionStatus()
    {
        $session = session();
        
        return $this->response->setJSON([
            'session_has_admin_id' => $session->has('admin_id'),
            'session_admin_id' => $session->get('admin_id'),
            'session_admin_username' => $session->get('admin_username'),
            'session_data' => $session->getFlashdata(),
            'cookie_name' => (new \Config\Session())->cookieName,
            'csrf_token_name' => (new \Config\Security())->tokenName,
            'request_method' => $this->request->getMethod(),
            'request_path' => $this->request->getPath(),
            'request_uri' => $this->request->getUri(),
            'headers' => [
                'cookie' => $this->request->getHeaderLine('Cookie'),
                'referer' => $this->request->getHeaderLine('Referer'),
                'user-agent' => $this->request->getHeaderLine('User-Agent'),
            ],
            'timestamp' => time(),
        ])->setStatusCode(200);
    }

    /**
     * Test session creation
     */
    public function testSessionCreate()
    {
        $session = session();
        $session->set('test_admin_id', 999);
        $session->set('test_admin_username', 'testuser');
        
        return $this->response->setJSON([
            'message' => 'Session values set',
            'set_admin_id' => 999,
            'set_admin_username' => 'testuser',
            'session_id' => session_id(),
        ])->setStatusCode(200);
    }

    /**
     * Verify session persists
     */
    public function verifySession()
    {
        $session = session();
        
        return $this->response->setJSON([
            'test_admin_id' => $session->get('test_admin_id'),
            'test_admin_username' => $session->get('test_admin_username'),
            'session_id' => session_id(),
            'has_test_values' => $session->has('test_admin_id') && $session->has('test_admin_username'),
        ])->setStatusCode(200);
    }
}
