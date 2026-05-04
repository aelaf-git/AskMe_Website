<?php
/**
 * One-time admin setup script
 * Upload this file, run it once, then DELETE it immediately
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

// Restrict to localhost/initial setup only
if (file_exists(__DIR__ . '/.setup_done')) {
    die('Setup already completed. Delete this file for security.');
}

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$email) {
        $message = 'Please enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $message = 'Password must be at least 8 characters.';
    } elseif ($password !== $confirm) {
        $message = 'Passwords do not match.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT IGNORE INTO admins (email, password_hash) VALUES (?, ?)");
            $stmt->execute([$email, $hash]);

            if ($stmt->rowCount() > 0) {
                $success = true;
                file_put_contents(__DIR__ . '/.setup_done', date('Y-m-d H:i:s'));
                $message = 'Admin account created successfully! DELETE this file now.';
            } else {
                $message = 'Admin account already exists. Delete this file.';
            }
        } catch (PDOException $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Setup - AskMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#89C23D', secondary: '#1D609E' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl">
        <h1 class="text-3xl font-black text-secondary mb-2">Admin Setup</h1>
        <p class="text-gray-400 text-xs uppercase tracking-widest mb-8">Create your admin account</p>

        <?php if ($message): ?>
        <div class="mb-6 p-4 rounded-2xl font-bold text-sm <?php echo $success ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200'; ?>">
            <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <?php endif; ?>

        <?php if (!$success): ?>
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Email</label>
                <input type="email" name="email" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Password (min 8 chars)</label>
                <input type="password" name="password" required minlength="8" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" required minlength="8" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none">
            </div>
            <button type="submit" class="w-full py-4 bg-primary text-white font-black rounded-2xl hover:opacity-90 transition-all uppercase tracking-widest text-sm">
                Create Admin Account
            </button>
        </form>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
            <p class="text-yellow-700 font-bold text-sm"><i class="fas fa-exclamation-triangle mr-2"></i>Security Action Required</p>
            <p class="text-yellow-600 text-sm mt-2">Delete <code>setup.php</code> from your server immediately!</p>
        </div>
        <a href="login.php" class="block mt-6 text-center py-4 bg-secondary text-white font-black rounded-2xl">Go to Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
