<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Only admin can access this page (double-check even though we have filter)
        if ($this->session->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Access Denied');
        }

        // Get user statistics
        $data = [
            'title' => 'Admin Dashboard',
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role'),
            'total_users' => $this->userModel->countAll(),
            'recent_users' => $this->userModel->orderBy('created_at', 'DESC')
                                            ->limit(5)
                                            ->findAll(),
            'user_roles' => [
                'admin' => $this->userModel->where('role', 'admin')->countAllResults(),
                'editor' => $this->userModel->where('role', 'editor')->countAllResults(),
                'user' => $this->userModel->where('role', 'user')->countAllResults()
            ]
        ];

        return view('admin/dashboard', $data);
    }

    public function updateUserRole($userId)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $newRole = $this->request->getPost('role');
        $allowedRoles = ['admin', 'editor', 'user'];

        if (!in_array($newRole, $allowedRoles)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid role']);
        }

        try {
            $this->userModel->update($userId, ['role' => $newRole]);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User role updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update user role'
            ]);
        }
    }
}
