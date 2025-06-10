<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'username' => $this->session->get('username'),
            'role' => $this->session->get('role')
        ];

        return view('dashboard/index', $data);
    }
}
