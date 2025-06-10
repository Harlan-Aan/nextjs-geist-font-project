<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\AppConfig;
use Config\Services;

class MaintenanceFilter implements FilterInterface
{
    /**
     * Check if site is in maintenance mode and handle accordingly
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $config = new AppConfig();
        
        // If maintenance mode is not enabled, continue normally
        if (!$config->maintenanceMode['enabled']) {
            return;
        }

        // Get client IP
        $ip = $request->getIPAddress();

        // Allow access if IP is in allowed list
        if (in_array($ip, $config->maintenanceMode['allowedIPs'])) {
            return;
        }

        // Check if this is an API request
        $isApi = strpos($request->getPath(), 'api/') === 0;

        if ($isApi) {
            // Return JSON response for API requests
            return Services::response()
                ->setJSON([
                    'status' => 'error',
                    'message' => $config->maintenanceMode['message']
                ])
                ->setStatusCode(503);
        }

        // For web requests, show maintenance page
        return Services::response()
            ->setBody(view('errors/maintenance', [
                'message' => $config->maintenanceMode['message']
            ]))
            ->setStatusCode(503);
    }

    /**
     * We don't have anything to do here
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
