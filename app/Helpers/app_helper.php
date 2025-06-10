<?php

if (!function_exists('format_date')) {
    /**
     * Format a date string
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'M d, Y')
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('get_role_badge')) {
    /**
     * Get HTML badge for user role
     *
     * @param string $role
     * @return string
     */
    function get_role_badge($role)
    {
        $badges = [
            'admin' => 'danger',
            'editor' => 'success',
            'user' => 'primary'
        ];

        $color = $badges[$role] ?? 'secondary';
        return "<span class='badge bg-{$color}'>" . ucfirst($role) . "</span>";
    }
}

if (!function_exists('is_active_route')) {
    /**
     * Check if current route matches given route
     *
     * @param string $route
     * @return bool
     */
    function is_active_route($route)
    {
        $currentURL = current_url();
        return strpos($currentURL, $route) !== false;
    }
}

if (!function_exists('get_gravatar')) {
    /**
     * Get Gravatar URL for an email
     *
     * @param string $email
     * @param int $size
     * @return string
     */
    function get_gravatar($email, $size = 80)
    {
        $hash = md5(strtolower(trim($email)));
        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=mp";
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text to a specific length
     *
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    function truncate_text($text, $length = 100, $suffix = '...')
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . $suffix;
    }
}

if (!function_exists('flash_messages')) {
    /**
     * Display flash messages
     *
     * @return string
     */
    function flash_messages()
    {
        $types = ['success', 'error', 'warning', 'info'];
        $html = '';

        foreach ($types as $type) {
            if (session()->getFlashdata($type)) {
                $alertType = ($type === 'error') ? 'danger' : $type;
                $html .= sprintf(
                    '<div class="alert alert-%s alert-dismissible fade show" role="alert">
                        %s
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>',
                    $alertType,
                    session()->getFlashdata($type)
                );
            }
        }

        return $html;
    }
}

if (!function_exists('time_elapsed_string')) {
    /**
     * Returns human readable elapsed time
     *
     * @param string $datetime
     * @param bool $full
     * @return string
     */
    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('format_number')) {
    /**
     * Format numbers for social media style display
     *
     * @param int $number
     * @return string
     */
    function format_number($number)
    {
        $suffixes = ['', 'K', 'M', 'B', 'T'];
        $suffixIndex = 0;

        while ($number >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $number /= 1000;
            $suffixIndex++;
        }

        if ($suffixIndex > 0) {
            return number_format($number, 1) . $suffixes[$suffixIndex];
        }

        return $number;
    }
}

if (!function_exists('is_allowed')) {
    /**
     * Check if user has required role(s)
     *
     * @param string|array $roles
     * @return bool
     */
    function is_allowed($roles)
    {
        if (!session()->get('isLoggedIn')) {
            return false;
        }

        $userRole = session()->get('role');
        
        if (is_array($roles)) {
            return in_array($userRole, $roles);
        }

        return $userRole === $roles;
    }
}
