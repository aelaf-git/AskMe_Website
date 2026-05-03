<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../admin/config.php';
require_once __DIR__ . '/../includes/jwt_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if ($email === ADMIN_EMAIL && password_verify($password, ADMIN_PASSWORD_HASH)) {
    // Generate JWT
    $payload = [
        'email' => $email,
        'exp' => time() + (60 * 60 * 24), // 24 hours
        'iat' => time()
    ];
    
    $token = JWT::encode($payload);
    
    // Set HttpOnly cookie
    setcookie('admin_token', $token, [
        'expires' => time() + (60 * 60 * 24),
        'path' => '/',
        'domain' => '', // Set your domain here
        'secure' => false, // Set to true if using HTTPS
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    echo json_encode(['success' => true, 'message' => 'Login successful']);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
}
?>
