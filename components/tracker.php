<?php
/**
 * Ultra-Fast Asynchronous Visitor Analytics Tracker
 * Non-blocking, instant execution with zero external HTTP delay
 */

if (!defined('TRACKER_INCLUDED')) {
    define('TRACKER_INCLUDED', true);

    function track_visitor($page_name = '', $user_email = null) {
        global $pdo;
        if (!$pdo) return;

        try {
            // 1. Get Client IP Address
            $ip = '127.0.0.1';
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $ip = trim($ip_list[0]);
            } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            // 2. Determine Page Visited
            if (empty($page_name)) {
                $page_name = !empty($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : 'Homepage';
            }

            // 3. Detect Device & Browser
            $user_agent = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $device_type = 'Desktop';
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $user_agent)) {
                $device_type = 'Tablet';
            } elseif (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile|iphone)/i', $user_agent)) {
                $device_type = 'Mobile';
            }

            $browser = 'Chrome';
            if (strpos($user_agent, 'Firefox') !== false) {
                $browser = 'Firefox';
            } elseif (strpos($user_agent, 'Edg') !== false) {
                $browser = 'Edge';
            } elseif (strpos($user_agent, 'Safari') !== false && strpos($user_agent, 'Chrome') === false) {
                $browser = 'Safari';
            }

            $referrer = !empty($_SERVER['HTTP_REFERER']) ? substr($_SERVER['HTTP_REFERER'], 0, 250) : 'Direct Visit';

            // 4. Fast Non-blocking Country Detection from Headers or Local Cache
            $country_code = 'LOC';
            $country_name = 'Local';
            $city = 'Local Network';

            if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
                $country_code = $_SERVER['HTTP_CF_IPCOUNTRY'];
                $country_name = $_SERVER['HTTP_CF_IPCOUNTRY'];
            } elseif ($ip === '127.0.0.1' || $ip === '::1') {
                $country_code = 'LOC';
                $country_name = 'Localhost (Dev)';
                $city = 'Development Machine';
            } else {
                $country_code = 'GLOBAL';
                $country_name = 'Global Visitor';
                $city = 'Online';
            }

            // 5. If user email is provided, store in session
            if (!empty($user_email)) {
                if (session_status() === PHP_SESSION_ACTIVE) {
                    $_SESSION['visitor_email'] = $user_email;
                }
            } elseif (empty($user_email) && !empty($_SESSION['visitor_email'])) {
                $user_email = $_SESSION['visitor_email'];
            }

            // 6. Avoid logging the exact same page refresh from the same IP within 15 seconds
            $check = $pdo->prepare("SELECT id FROM visitor_analytics WHERE ip_address = ? AND page_visited = ? AND visited_at >= (NOW() - INTERVAL 15 SECOND) LIMIT 1");
            $check->execute([$ip, $page_name]);
            if ($check->fetchColumn()) {
                return;
            }

            // 7. Insert Analytics Record
            $ins = $pdo->prepare("INSERT INTO visitor_analytics (ip_address, country_code, country_name, city, page_visited, device_type, browser, referrer, visitor_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $ins->execute([$ip, $country_code, $country_name, $city, $page_name, $device_type, $browser, $referrer, $user_email]);

        } catch (Exception $e) {
            // Silently ignore to guarantee lightning fast page rendering
        }
    }

    // Auto-track on page load if not admin session
    if (empty($_SESSION['admin_logged_in'])) {
        track_visitor();
    }
}
