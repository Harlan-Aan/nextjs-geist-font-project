<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Helpers extends BaseConfig
{
    /**
     * List of helper files that will be loaded automatically.
     *
     * @var array
     */
    public $helpers = [
        'url',      // For base_url(), site_url(), etc.
        'form',     // For form helper functions
        'html',     // For HTML helper functions
        'text',     // For text helper functions
        'security', // For security helper functions
        'app',      // Our custom helper
    ];

    /**
     * List of custom helper files that will be loaded.
     * These should be relative to the application directory.
     *
     * @var array
     */
    public $customHelpers = [
        'Helpers/app_helper.php',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Load all the default helpers
        foreach ($this->helpers as $helper) {
            helper($helper);
        }

        // Load all custom helpers
        foreach ($this->customHelpers as $helper) {
            if (file_exists(APPPATH . $helper)) {
                require_once APPPATH . $helper;
            }
        }
    }
}
