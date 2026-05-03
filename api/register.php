<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// Support both JSON and FormData
if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    $data = $_POST;
}

$name = $data['Name'] ?? '';
$email = $data['Email'] ?? '';
$phone = $data['Phone'] ?? '';
$destination = $data['Destination'] ?? '';
$departure = $data['Departuredate'] ?? '';
$return = $data['Returndate'] ?? '';
$purpose = $data['Purpose'] ?? '';

if (!$name || !$email || !$destination) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Required fields are missing']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO registrations (name, email, phone, destination, departure_date, return_date, purpose) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $destination, $departure, $return, $purpose]);
    
    echo json_encode(['success' => true, 'message' => 'Registration successful']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
