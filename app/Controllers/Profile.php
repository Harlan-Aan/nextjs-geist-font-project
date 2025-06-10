<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/auth/login')
                ->with('error', 'Please login to access your profile.');
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/auth/logout');
        }

        $data = [
            'title' => 'My Profile - INI Clone',
            'user' => $user,
            'content' => view('profile/profile_content', ['user' => $user])
        ];

        return view('layouts/main', $data);
    }

    public function update()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/auth/login');
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/auth/logout');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => "required|min_length[3]|is_unique[users.username,id,{$userId}]",
                'email' => "required|valid_email|is_unique[users.email,id,{$userId}]",
            ];

            // If password is being updated, validate it
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $rules['password'] = 'required|min_length[6]';
                $rules['confirm_password'] = 'required|matches[password]';
            }

            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            // Update data
            $updateData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ];

            // Only update password if a new one was provided
            if (!empty($password)) {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            try {
                $this->userModel->update($userId, $updateData);

                // Update session data
                $this->session->set([
                    'username' => $updateData['username'],
                    'email' => $updateData['email']
                ]);

                return redirect()->to('/profile')
                    ->with('success', 'Profile updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'An error occurred while updating your profile.');
            }
        }

        return redirect()->back()
            ->with('error', 'Invalid request method.');
    }

    public function changePassword()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'current_password' => 'required',
                'new_password' => 'required|min_length[6]',
                'confirm_new_password' => 'required|matches[new_password]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $userId = $this->session->get('user_id');
            $user = $this->userModel->find($userId);

            if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
                return redirect()->back()
                    ->with('error', 'Current password is incorrect.');
            }

            try {
                $this->userModel->update($userId, [
                    'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
                ]);

                return redirect()->to('/profile')
                    ->with('success', 'Password changed successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'An error occurred while changing your password.');
            }
        }

        return redirect()->back()
            ->with('error', 'Invalid request method.');
    }

    public function deleteAccount()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/auth/login');
        }

        if ($this->request->getMethod() === 'post') {
            $userId = $this->session->get('user_id');
            $password = $this->request->getPost('confirm_password');

            $user = $this->userModel->find($userId);

            if (!password_verify($password, $user['password'])) {
                return redirect()->back()
                    ->with('error', 'Invalid password. Account deletion cancelled.');
            }

            try {
                $this->userModel->delete($userId);
                $this->session->destroy();

                return redirect()->to('/')
                    ->with('success', 'Your account has been successfully deleted.');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'An error occurred while deleting your account.');
            }
        }

        return redirect()->back()
            ->with('error', 'Invalid request method.');
    }
}
