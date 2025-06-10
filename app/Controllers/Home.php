<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Prepare data for the view
        $data = [
            'title' => 'Welcome to INI Clone',
            'isLoggedIn' => $this->isLoggedIn(),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role'),
            // Additional styles specific to home page
            'additionalStyles' => '
                .hero-section {
                    margin-top: -76px; /* Offset the fixed navbar */
                }
            ',
        ];

        // Load the home content view
        $data['content'] = view('home_content', $data);

        // Load the main layout with all the data
        return view('layouts/main', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us - INI Clone',
            'isLoggedIn' => $this->isLoggedIn(),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        // Load about content (you'll need to create this view)
        $data['content'] = view('about_content', $data);

        return view('layouts/main', $data);
    }

    public function contact()
    {
        if ($this->request->getMethod() === 'post') {
            // Handle contact form submission
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'message' => 'required|min_length[10]'
            ];

            if ($this->validate($rules)) {
                // Here you would typically send an email or save to database
                $this->setFlashMessage('success', 'Thank you for your message. We will get back to you soon.');
                return redirect()->to('/contact');
            }

            $this->setFlashMessage('error', 'Please check the form for errors.');
            return redirect()->back()->withInput();
        }

        $data = [
            'title' => 'Contact Us - INI Clone',
            'isLoggedIn' => $this->isLoggedIn(),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        // Load contact content (you'll need to create this view)
        $data['content'] = view('contact_content', $data);

        return view('layouts/main', $data);
    }

    public function terms()
    {
        $data = [
            'title' => 'Terms of Service - INI Clone',
            'isLoggedIn' => $this->isLoggedIn(),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        // Load terms content (you'll need to create this view)
        $data['content'] = view('terms_content', $data);

        return view('layouts/main', $data);
    }

    public function privacy()
    {
        $data = [
            'title' => 'Privacy Policy - INI Clone',
            'isLoggedIn' => $this->isLoggedIn(),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        // Load privacy content (you'll need to create this view)
        $data['content'] = view('privacy_content', $data);

        return view('layouts/main', $data);
    }
}
