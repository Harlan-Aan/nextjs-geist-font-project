<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // If user is not logged in, redirect to login page
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // If arguments (roles) are provided, check if user has required role
        if ($arguments !== null) {
            $userRole = $session->get('role');
            
            // If user's role is not in the allowed roles array, redirect to dashboard
            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/dashboard')->with('error', 'Access Denied. Insufficient permissions.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after the request
    }
}
