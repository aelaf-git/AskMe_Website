<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../includes/db.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    exit;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

if(empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo json_encode(["message" => "Invalid input"]);
  exit;
}

try {
    // Save to database
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $subject, $message]);

    // Send email (optional/keep existing logic if needed)
    $to = "info@askmetour.org"; 
    $header = "From: $email\n";
    $header .= "Reply-To: $email";	

    // mail($to, $subject, $message, $header); // Uncomment if mail server is configured

    echo json_encode(["success" => true, "message" => "Message sent and saved"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
}
?>
