<?php

namespace Config;

use App\Libraries\CustomExceptionHandler;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Debug\ExceptionHandler;
use CodeIgniter\Debug\Exceptions;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use Throwable;

class ExceptionsConfig extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * LOG EXCEPTIONS?
     * --------------------------------------------------------------------------
     * If true, then exceptions will be logged
     * through Services::Log.
     *
     * Default: true
     */
    public bool $log = true;

    /**
     * --------------------------------------------------------------------------
     * DO NOT LOG STATUS CODES
     * --------------------------------------------------------------------------
     * Any status codes here will NOT be logged if logging is turned on.
     * By default, only 404 (Page Not Found) exceptions are ignored.
     */
    public array $ignoreCodes = [404];

    /**
     * --------------------------------------------------------------------------
     * ERROR VIEWS DIRECTORY
     * --------------------------------------------------------------------------
     * This is the directory where the views for the error pages are stored.
     */
    public string $errorViewPath = APPPATH . 'Views/errors/';

    /**
     * --------------------------------------------------------------------------
     * HIDE FROM DEBUG TRACE
     * --------------------------------------------------------------------------
     * Any data that you would like to hide from the debug trace.
     * In order to specify specific data, you must define the key.
     */
    public array $sensitiveDataInTrace = [];

    /**
     * --------------------------------------------------------------------------
     * CUSTOM EXCEPTION HANDLER
     * --------------------------------------------------------------------------
     * Use our custom exception handler instead of the default one.
     */
    public function handler(Throwable $exception, IncomingRequest $request, Response $response, $code)
    {
        $handler = new CustomExceptionHandler($this);
        return $handler->handle($exception, $request, $response, $code, 1);
    }
}
