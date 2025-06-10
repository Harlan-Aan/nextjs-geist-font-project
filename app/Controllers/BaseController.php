<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form', 'security'];

    /**
     * Session instance
     */
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
    }

    /**
     * Check if user is logged in
     *
     * @return bool
     */
    protected function isLoggedIn()
    {
        return (bool) $this->session->get('isLoggedIn');
    }

    /**
     * Check if user has required role
     *
     * @param string|array $roles
     * @return bool
     */
    protected function hasRole($roles)
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        $userRole = $this->session->get('role');
        
        if (is_array($roles)) {
            return in_array($userRole, $roles);
        }

        return $userRole === $roles;
    }

    /**
     * Return JSON response
     *
     * @param array $data
     * @param int $code
     * @return ResponseInterface
     */
    protected function jsonResponse($data, $code = 200)
    {
        return $this->response->setStatusCode($code)
                            ->setJSON($data);
    }

    /**
     * Set flash message
     *
     * @param string $type success|error|warning|info
     * @param string $message
     * @return void
     */
    protected function setFlashMessage($type, $message)
    {
        $this->session->setFlashdata($type, $message);
    }
}
