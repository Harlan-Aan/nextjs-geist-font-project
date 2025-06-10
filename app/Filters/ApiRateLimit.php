<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\AppConfig;
use Config\Services;

class ApiRateLimit implements FilterInterface
{
    /**
     * Rate limiting cache prefix
     *
     * @var string
     */
    protected $prefix = 'rate_limit_';

    /**
     * Check rate limit before processing request
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $config = new AppConfig();

        // If rate limiting is disabled, continue normally
        if (!$config->apiRateLimit['enabled']) {
            return;
        }

        $ip = $request->getIPAddress();
        $cache = Services::cache();
        $key = $this->prefix . md5($ip);

        // Get current requests count and time
        $rateLimitData = $cache->get($key);
        $time = time();

        if (!$rateLimitData) {
            // First request
            $rateLimitData = [
                'requests' => 1,
                'reset_time' => $time + ($config->apiRateLimit['perMinutes'] * 60)
            ];
        } else {
            // Check if we should reset the counter
            if ($time >= $rateLimitData['reset_time']) {
                $rateLimitData = [
                    'requests' => 1,
                    'reset_time' => $time + ($config->apiRateLimit['perMinutes'] * 60)
                ];
            } else {
                // Increment request count
                $rateLimitData['requests']++;
            }
        }

        // Save rate limit data
        $cache->save($key, $rateLimitData, $config->apiRateLimit['perMinutes'] * 60);

        // Check if rate limit exceeded
        if ($rateLimitData['requests'] > $config->apiRateLimit['maxRequests']) {
            $response = Services::response();
            
            // Set rate limit headers
            $response->setHeader('X-RateLimit-Limit', $config->apiRateLimit['maxRequests']);
            $response->setHeader('X-RateLimit-Remaining', 0);
            $response->setHeader('X-RateLimit-Reset', $rateLimitData['reset_time']);
            
            return $response
                ->setStatusCode(429)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Rate limit exceeded. Please try again later.',
                    'reset_time' => $rateLimitData['reset_time']
                ]);
        }

        // Set rate limit headers for successful requests
        $response = Services::response();
        $response->setHeader('X-RateLimit-Limit', $config->apiRateLimit['maxRequests']);
        $response->setHeader('X-RateLimit-Remaining', 
            $config->apiRateLimit['maxRequests'] - $rateLimitData['requests']);
        $response->setHeader('X-RateLimit-Reset', $rateLimitData['reset_time']);
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
