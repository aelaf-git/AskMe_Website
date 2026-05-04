<?php
/**
 * Advanced Traffic Tracker for AskMe Tour and Travel
 * Captures: IP, Location (via ip-api), Device Type, Page URL, and Time
 */

function track_visit($pdo) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['visitor_session_id'])) {
        $_SESSION['visitor_session_id'] = bin2hex(random_bytes(16));
    }
    $session_id = $_SESSION['visitor_session_id'];

    // 1. Capture Basic Info
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $page_url = $_SERVER['REQUEST_URI'] ?? '/';
    $referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';

    // 2. Simple Device Detection
    $device_type = 'Desktop';
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $user_agent)) {
        $device_type = 'Tablet';
    } elseif (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $user_agent)) {
        $device_type = 'Mobile';
    }

    // 3. Geolocation (Country/City) - Using ip-api.com (Free)
    if (!isset($_SESSION['visitor_geo'])) {
        try {
            if ($ip === '127.0.0.1' || $ip === '::1') {
                $country = 'Localhost';
                $city = 'Development';
            } else {
                $ctx = stream_context_create(['http' => ['timeout' => 2]]);
                $geo_data = @file_get_contents("http://ip-api.com/json/{$ip}", false, $ctx);
                if ($geo_data) {
                    $geo = json_decode($geo_data, true);
                    if ($geo && $geo['status'] === 'success') {
                        $country = $geo['country'] ?? 'Unknown';
                        $city = $geo['city'] ?? 'Unknown';
                    } else {
                        $country = 'Unknown';
                        $city = 'Unknown';
                    }
                } else {
                    $country = 'Unknown';
                    $city = 'Unknown';
                }
            }
            $_SESSION['visitor_geo'] = ['country' => $country, 'city' => $city];
        } catch (Exception $e) {
            $country = 'Unknown';
            $city = 'Unknown';
        }
    } else {
        $country = $_SESSION['visitor_geo']['country'];
        $city = $_SESSION['visitor_geo']['city'];
    }

    // 4. Log to Database
    try {
        $stmt = $pdo->prepare("INSERT INTO site_traffic (ip_address, session_id, user_agent, device_type, page_url, referrer, country, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$ip, $session_id, $user_agent, $device_type, $page_url, $referrer, $country, $city]);
    } catch (PDOException $e) {
        // Silently fail to not interrupt user experience
    }
}

// Automatically run if $pdo is available
if (isset($pdo)) {
    track_visit($pdo);
}
?>
