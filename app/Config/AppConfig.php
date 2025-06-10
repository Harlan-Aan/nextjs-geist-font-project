<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppConfig extends BaseConfig
{
    /**
     * Application name
     *
     * @var string
     */
    public $appName = 'INI Clone';

    /**
     * Application version
     *
     * @var string
     */
    public $appVersion = '1.0.0';

    /**
     * Site description
     *
     * @var string
     */
    public $siteDescription = 'A modern web application built with CodeIgniter 4';

    /**
     * Admin email address
     *
     * @var string
     */
    public $adminEmail = 'admin@example.com';

    /**
     * Available user roles
     *
     * @var array
     */
    public $userRoles = [
        'admin'  => 'Administrator',
        'editor' => 'Editor',
        'user'   => 'User'
    ];

    /**
     * Default role for new registrations
     *
     * @var string
     */
    public $defaultRole = 'user';

    /**
     * Password requirements
     *
     * @var array
     */
    public $passwordPolicy = [
        'minLength' => 6,
        'requireSpecialChar' => true,
        'requireNumber' => true,
        'requireUppercase' => true,
    ];

    /**
     * Session timeout in minutes
     *
     * @var int
     */
    public $sessionTimeout = 120;

    /**
     * Maximum login attempts before lockout
     *
     * @var int
     */
    public $maxLoginAttempts = 5;

    /**
     * Lockout duration in minutes
     *
     * @var int
     */
    public $lockoutDuration = 15;

    /**
     * Items per page for pagination
     *
     * @var array
     */
    public $paginationPerPage = [
        'default' => 10,
        'admin' => 20,
        'articles' => 12
    ];

    /**
     * Allowed file upload types
     *
     * @var array
     */
    public $allowedFileTypes = [
        'image' => ['jpg', 'jpeg', 'png', 'gif'],
        'document' => ['pdf', 'doc', 'docx'],
        'video' => ['mp4', 'avi', 'mov']
    ];

    /**
     * Maximum file upload size in MB
     *
     * @var array
     */
    public $maxFileSize = [
        'image' => 5,
        'document' => 10,
        'video' => 50
    ];

    /**
     * Social media links
     *
     * @var array
     */
    public $socialLinks = [
        'facebook' => 'https://facebook.com/iniclone',
        'twitter' => 'https://twitter.com/iniclone',
        'instagram' => 'https://instagram.com/iniclone',
        'linkedin' => 'https://linkedin.com/company/iniclone'
    ];

    /**
     * Contact information
     *
     * @var array
     */
    public $contactInfo = [
        'email' => 'info@iniclone.com',
        'phone' => '(123) 456-7890',
        'address' => '123 Web Street, Internet City'
    ];

    /**
     * API rate limiting
     *
     * @var array
     */
    public $apiRateLimit = [
        'enabled' => true,
        'maxRequests' => 100,
        'perMinutes' => 60
    ];

    /**
     * Maintenance mode settings
     *
     * @var array
     */
    public $maintenanceMode = [
        'enabled' => false,
        'message' => 'We are currently performing maintenance. Please check back soon.',
        'allowedIPs' => ['127.0.0.1']
    ];

    /**
     * Feature flags
     *
     * @var array
     */
    public $features = [
        'registration' => true,
        'socialLogin' => false,
        'comments' => true,
        'articleRating' => true,
        'userProfiles' => true
    ];

    /**
     * Get configuration value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->$key ?? $default;
    }

    /**
     * Check if a feature is enabled
     *
     * @param string $feature
     * @return bool
     */
    public function isFeatureEnabled($feature)
    {
        return $this->features[$feature] ?? false;
    }

    /**
     * Get user role display name
     *
     * @param string $role
     * @return string
     */
    public function getRoleDisplayName($role)
    {
        return $this->userRoles[$role] ?? 'Unknown Role';
    }

    /**
     * Get pagination limit for a specific context
     *
     * @param string $context
     * @return int
     */
    public function getPaginationLimit($context = 'default')
    {
        return $this->paginationPerPage[$context] ?? $this->paginationPerPage['default'];
    }

    /**
     * Check if file type is allowed
     *
     * @param string $type
     * @param string $extension
     * @return bool
     */
    public function isAllowedFileType($type, $extension)
    {
        return isset($this->allowedFileTypes[$type]) && 
               in_array(strtolower($extension), $this->allowedFileTypes[$type]);
    }

    /**
     * Get maximum file size for a type
     *
     * @param string $type
     * @return int
     */
    public function getMaxFileSize($type)
    {
        return $this->maxFileSize[$type] ?? 0;
    }
}
