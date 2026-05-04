<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../admin/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/jwt_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

try {
    // Fetch admin from database
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        // Generate JWT
        $payload = [
            'email' => $admin['email'],
            'exp' => time() + (60 * 60 * 24), // 24 hours
            'iat' => time()
        ];
        
        $token = JWT::encode($payload);
        
        // Set HttpOnly cookie
        setcookie('admin_token', $token, [
            'expires' => time() + (60 * 60 * 24),
            'path' => '/',
            'domain' => '',
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    error_log("Login error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}
?>
