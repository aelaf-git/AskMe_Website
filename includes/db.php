<?php
// Load .env file
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            putenv($line);
        }
    }
}

// Database Configuration - Production
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'askmetgy_main';
$user = getenv('DB_USER') ?: 'askmetgy_main';
$pass = getenv('DB_PASS') ?: 'M6rQCCZT6QjZED8Ew6Hk';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // Auto-track visits
     require_once __DIR__ . '/traffic_tracker.php';
 } catch (\PDOException $e) {
     // Log error in production, don't expose details
     error_log("Database connection failed: " . $e->getMessage());
     die("Database connection failed. Please try again later.");
 }
?>
