<?php
// Admin Configuration
define('ADMIN_EMAIL', 'admin@askmetour.org');
// Hashed version of 'AskMe@2026!Admin'
define('ADMIN_PASSWORD_HASH', '$2y$12$lSriFhiWZClfyOZh7BGOq.rtO1di9ZDGaYq/6Cc1tDEdOK1XcLoxe'); 
define('JWT_SECRET', 'a8f9b0c1d2e3f4g5h6i7j8k9l0m1n2o3p4q5r6s7t8u9v0w1x2y3z4');

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
