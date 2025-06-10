<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\MaintenanceFilter;
use App\Filters\ApiRateLimit;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'     => Honeypot::class,
        'invalidchars' => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthFilter::class,
        'maintenance'   => MaintenanceFilter::class,
        'apiRateLimit' => ApiRateLimit::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'maintenance',
            'honeypot',
            'csrf',
            'invalidchars',
        ],
        'after' => [
            'toolbar',
            'honeypot',
            'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     */
    public array $filters = [
        // Protect admin routes
        'auth:admin' => ['before' => ['admin/*']],
        
        // Protect editor routes
        'auth:editor,admin' => ['before' => ['editor/*']],
        
        // Protect user dashboard
        'auth' => [
            'before' => [
                'dashboard',
                'dashboard/*',
                'profile',
                'profile/*'
            ]
        ],
        
        // Apply rate limiting to API routes
        'apiRateLimit' => [
            'before' => [
                'api/*'
            ]
        ],
        
        // CSRF protection except for API routes
        'csrf' => [
            'before' => [
                '/*',
                'auth/*',
                'admin/*',
                'editor/*'
            ],
            'except' => [
                'api/*'
            ]
        ]
    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns for API routes.
     */
    public array $apiFilters = [
        'before' => [
            'apiRateLimit'
        ]
    ];

    /**
     * List of filter aliases that should be skipped for certain routes
     */
    public array $skipFilters = [
        // Skip maintenance filter for these routes
        'maintenance' => [
            'auth/login',
            'auth/logout',
            'admin/*'  // Allow admins to access during maintenance
        ]
    ];
}
