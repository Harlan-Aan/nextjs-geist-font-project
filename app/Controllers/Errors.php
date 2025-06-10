<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Errors extends BaseController
{
    public function show404()
    {
        // Check if this is an API request
        $isApi = $this->request->isAJAX() || strpos($this->request->getPath(), 'api/') === 0;

        if ($isApi) {
            return $this->response->setJSON([
                'status' => 'error',
                'code' => 404,
                'message' => 'Resource not found'
            ])->setStatusCode(404);
        }

        $data = [
            'title' => '404 - Page Not Found',
            'content' => view('errors/html/error_404')
        ];

        return view('layouts/main', $data, ['cache' => 0]);
    }

    public function show403()
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'code' => 403,
                'message' => 'Access forbidden'
            ])->setStatusCode(403);
        }

        $data = [
            'title' => '403 - Access Forbidden',
            'content' => view('errors/html/error_403')
        ];

        return view('layouts/main', $data, ['cache' => 0]);
    }

    public function show500()
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error'
            ])->setStatusCode(500);
        }

        $data = [
            'title' => '500 - Internal Server Error',
            'content' => view('errors/html/error_500')
        ];

        return view('layouts/main', $data, ['cache' => 0]);
    }

    public function showError($code)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'code' => $code,
                'message' => 'An error occurred'
            ])->setStatusCode($code);
        }

        $data = [
            'title' => $code . ' - Error',
            'code' => $code,
            'content' => view('errors/html/error_general', ['code' => $code])
        ];

        return view('layouts/main', $data, ['cache' => 0]);
    }

    public function production($title = '', $message = '')
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $message ?: 'An error occurred'
            ])->setStatusCode(500);
        }

        $data = [
            'title' => $title ?: 'Error',
            'message' => $message,
            'content' => view('errors/html/production', [
                'title' => $title,
                'message' => $message
            ])
        ];

        return view('layouts/main', $data, ['cache' => 0]);
    }

    public function cli($title = '', $message = '')
    {
        $error  = "\nERROR: " . ($title ?: 'An error occurred') . "\n";
        $error .= "DETAILS: " . ($message ?: 'No additional information available') . "\n\n";

        CLI::error($error);
        exit(1);
    }
}
