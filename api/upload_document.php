<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

// Check if user is authenticated if necessary, but for registrations it's usually public
// However, we should limit the file types and sizes strictly.

function normalize_upload_name($name) {
    $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($name));
    return $safe ?: 'document';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

if (!isset($_FILES['file'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
    exit;
}

$file = $_FILES['file'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Upload failed with error code ' . $file['error']]);
    exit;
}

// 5MB limit
if ($file['size'] > 5 * 1024 * 1024) {
    echo json_encode(['success' => false, 'message' => 'File is too large (max 5MB).']);
    exit;
}

$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowed, true)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Use PDF, JPG, or PNG.']);
    exit;
}

$uploadDir = __DIR__ . '/../uploads/event_registrations/' . date('Y/m');
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
    echo json_encode(['success' => false, 'message' => 'Could not create upload directory.']);
    exit;
}

$targetName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '_' . normalize_upload_name($file['name']);
$targetPath = $uploadDir . '/' . $targetName;

if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo json_encode([
        'success' => true, 
        'path' => 'uploads/event_registrations/' . date('Y/m') . '/' . $targetName,
        'filename' => $file['name']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not save uploaded file.']);
}
