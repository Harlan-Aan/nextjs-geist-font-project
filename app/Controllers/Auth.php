<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // If already logged in, redirect to dashboard
        if ($this->isLoggedIn()) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ];
                $this->session->set($sessionData);

                // Update last login timestamp
                $this->userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('success', 'Welcome back, Administrator!');
                }
                return redirect()->to('/dashboard')->with('success', 'Successfully logged in!');
            }

            return redirect()->back()->withInput()
                ->with('error', 'Invalid login credentials');
        }

        $data = [
            'title' => 'Login - INI Clone',
            'additionalStyles' => '
                .auth-container {
                    max-width: 400px;
                    margin: 2rem auto;
                    padding: 2rem;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
            '
        ];

        // Load the login content view
        $data['content'] = view('auth/login_content');

        // Load the main layout with all the data
        return view('layouts/main', $data);
    }

    public function register()
    {
        // If already logged in, redirect to dashboard
        if ($this->isLoggedIn()) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => 'user' // Default role for new registrations
            ];

            try {
                $this->userModel->insert($data);
                return redirect()->to('/auth/login')
                    ->with('success', 'Registration successful! Please login.');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()
                    ->with('error', 'An error occurred during registration. Please try again.');
            }
        }

        $data = [
            'title' => 'Register - INI Clone',
            'additionalStyles' => '
                .auth-container {
                    max-width: 400px;
                    margin: 2rem auto;
                    padding: 2rem;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
            '
        ];

        // Load the register content view
        $data['content'] = view('auth/register_content');

        // Load the main layout with all the data
        return view('layouts/main', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login')
            ->with('success', 'Successfully logged out.');
    }

    public function forgotPassword()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $user = $this->userModel->getUserByEmail($email);

            if ($user) {
                // Generate password reset token
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Store token in database
                $this->userModel->update($user['id'], [
                    'reset_token' => $token,
                    'reset_token_expires' => $expiry
                ]);

                // Send password reset email (implement email sending logic)
                // ...

                return redirect()->back()
                    ->with('success', 'Password reset instructions have been sent to your email.');
            }

            return redirect()->back()
                ->with('error', 'No account found with that email address.');
        }

        $data = [
            'title' => 'Forgot Password - INI Clone',
            'additionalStyles' => '
                .auth-container {
                    max-width: 400px;
                    margin: 2rem auto;
                    padding: 2rem;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
            '
        ];

        // Load the forgot password content view
        $data['content'] = view('auth/forgot_password_content');

        // Load the main layout with all the data
        return view('layouts/main', $data);
    }
}
