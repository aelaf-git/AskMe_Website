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

// Admin Configuration
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'admin@askmetour.org');
// Hashed version of 'AskMe@2026!Admin'
define('ADMIN_PASSWORD_HASH', password_hash(getenv('ADMIN_PASS') ?: 'AskMe@2026!Admin', PASSWORD_DEFAULT));
define('JWT_SECRET', getenv('JWT_SECRET') ?: '8f9b0c1d2e3f4g5h6i7j8k9l0m1n2o3p4q5r6s7t8u9v0w1x2y3z4a5b6c7d8e9f0');

// Utility to verify JWT
function is_admin_authenticated() {
    if (!isset($_COOKIE['admin_token'])) return false;
    require_once __DIR__ . '/../includes/jwt_helper.php';
    $payload = JWT::decode($_COOKIE['admin_token']);
    return ($payload && isset($payload['email']) && $payload['email'] === ADMIN_EMAIL);
}

/**
 * Handle Image Upload
 * @param array $file The $_FILES['input_name'] array
 * @param string $currentPath The current image path in DB (for updates)
 * @return string The new image path or current path on failure/no file
 */
function handle_image_upload($file, $currentPath = '') {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return $currentPath;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return $currentPath;
    }

    $uploadDir = __DIR__ . '/../assets/img/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('img_', true) . '.' . $extension;
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Return relative path for DB
        return 'assets/img/uploads/' . $fileName;
    }

    return $currentPath;
}
?>
