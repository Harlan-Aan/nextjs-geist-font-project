<?php

namespace App\Libraries;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Debug\ExceptionHandler;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    use ResponseTrait;

    /**
     * Handle the exception
     */
    public function handle(
        Throwable $exception,
        IncomingRequest $request,
        Response $response,
        int $statusCode,
        int $exitCode
    ): void
    {
        // Check if this is an API request
        $isApi = $request->isAJAX() || strpos($request->getPath(), 'api/') === 0;

        if ($isApi) {
            $this->handleApiException($exception, $response, $statusCode);
            return;
        }

        $this->handleWebException($exception, $request, $response, $statusCode);
    }

    /**
     * Handle API exceptions
     */
    protected function handleApiException(Throwable $exception, Response $response, int $statusCode): void
    {
        $data = [
            'status' => 'error',
            'code' => $statusCode,
            'message' => $this->getDevelopmentMessage($exception, $statusCode)
        ];

        // In production, don't send detailed error information
        if (ENVIRONMENT === 'production') {
            $data['message'] = $this->getProductionMessage($statusCode);
        }

        $response->setStatusCode($statusCode)
                 ->setJSON($data)
                 ->send();
        exit($statusCode);
    }

    /**
     * Handle Web exceptions
     */
    protected function handleWebException(
        Throwable $exception,
        IncomingRequest $request,
        Response $response,
        int $statusCode
    ): void
    {
        $view = '';
        $data = [
            'title' => $this->getErrorTitle($statusCode),
            'code' => $statusCode
        ];

        // Determine which view to use
        switch ($statusCode) {
            case 404:
                $view = 'errors/html/error_404';
                break;
            case 403:
                $view = 'errors/html/error_403';
                break;
            case 500:
                $view = 'errors/html/error_500';
                break;
            default:
                $view = 'errors/html/error_general';
                break;
        }

        // In production, use the production error view
        if (ENVIRONMENT === 'production' && $statusCode >= 500) {
            $view = 'errors/html/production';
            $data['message'] = $this->getProductionMessage($statusCode);
        } else {
            $data['message'] = $this->getDevelopmentMessage($exception, $statusCode);
        }

        // Render the error view
        $viewResponse = view($view, $data);

        // If using the main layout
        if (file_exists(APPPATH . 'Views/layouts/main.php')) {
            $data['content'] = $viewResponse;
            $viewResponse = view('layouts/main', $data);
        }

        $response->setStatusCode($statusCode)
                 ->setBody($viewResponse)
                 ->send();
        exit($statusCode);
    }

    /**
     * Get appropriate error message for production environment
     */
    protected function getProductionMessage(int $statusCode): string
    {
        $messages = [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Access Forbidden',
            404 => 'Page Not Found',
            405 => 'Method Not Allowed',
            408 => 'Request Timeout',
            429 => 'Too Many Requests',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Temporarily Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        ];

        return $messages[$statusCode] ?? 'An error occurred';
    }

    /**
     * Get detailed error message for development environment
     */
    protected function getDevelopmentMessage(Throwable $exception, int $statusCode): string
    {
        if (ENVIRONMENT === 'development') {
            return $exception->getMessage() ?: get_class($exception);
        }

        return $this->getProductionMessage($statusCode);
    }

    /**
     * Get error title based on status code
     */
    protected function getErrorTitle(int $statusCode): string
    {
        $titles = [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            408 => 'Request Timeout',
            429 => 'Too Many Requests',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        ];

        return $titles[$statusCode] ?? 'Error';
    }

    /**
     * Log the exception if logging is enabled
     */
    protected function logException(Throwable $exception, int $statusCode): void
    {
        // Don't log 404s
        if ($statusCode === 404) {
            return;
        }

        log_message('error', '[ERROR] {exception}', ['exception' => $exception]);
    }
}
