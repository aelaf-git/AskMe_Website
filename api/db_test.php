<?php
require_once __DIR__ . '/../includes/db.php';

try {
    $pdo->query("SELECT 1");
    echo "<h1>✅ Success! Database is connected perfectly.</h1>";
    echo "<p>You can now use the website and admin dashboard.</p>";
} catch (Exception $e) {
    echo "<h1>❌ Connection Failed</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<hr>";
    echo "<h3>Troubleshooting Steps:</h3>";
    echo "<ul>";
    echo "<li>Ensure MySQL is running in your XAMPP/WAMP panel.</li>";
    echo "<li>Check if you created the database named '<b>askme_tour</b>' in phpMyAdmin.</li>";
    echo "<li>Verify that you imported '<b>database.sql</b>' into that database.</li>";
    echo "</ul>";
}
?>
