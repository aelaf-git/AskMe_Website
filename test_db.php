<?php
// Override env vars
putenv('DB_HOST=127.0.0.1');
putenv('DB_USER=root'); // usually local dev is root
putenv('DB_PASS=');
putenv('DB_NAME=askmetgy_main');

$host = '127.0.0.1';
$db   = 'askmetgy_main';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $pdo->exec("ALTER TABLE event_registrations CHANGE room_type_preference room_preference VARCHAR(100) DEFAULT NULL;");
    $pdo->exec("ALTER TABLE event_registrations ADD COLUMN special_notes TEXT AFTER room_preference;");
    $pdo->exec("ALTER TABLE event_registrations MODIFY occupation VARCHAR(255) DEFAULT NULL;");
    $pdo->exec("ALTER TABLE event_registrations MODIFY insurance_provider VARCHAR(255) DEFAULT NULL;");
    $pdo->exec("ALTER TABLE event_registrations MODIFY insurance_policy_number VARCHAR(120) DEFAULT NULL;");
    echo "Success!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
