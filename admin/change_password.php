<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit;
}

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (strlen($new) < 8) {
        $message = 'New password must be at least 8 characters.';
    } elseif ($new !== $confirm) {
        $message = 'New passwords do not match.';
    } else {
        try {
            // Verify current password
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
            $stmt->execute([ADMIN_EMAIL]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($current, $admin['password_hash'])) {
                $newHash = password_hash($new, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE admins SET password_hash = ? WHERE email = ?");
                $stmt->execute([$newHash, ADMIN_EMAIL]);

                $success = true;
                $message = 'Password changed successfully!';
            } else {
                $message = 'Current password is incorrect.';
            }
        } catch (PDOException $e) {
            $message = 'Database error. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - AskMe Admin</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#89C23D', secondary: '#1D609E', dark: '#0f172a' },
                    fontFamily: { sans: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active { background-color: #89C23D; color: white; }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-10 py-8 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Change <span class="text-primary">Password</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Update your admin credentials</p>
            </div>
            <a href="dashboard.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-xs uppercase tracking-widest">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
        </header>

        <main class="p-10 flex-1">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-[40px] shadow-xl border border-slate-100 p-12">
                    <?php if ($message): ?>
                    <div class="mb-8 p-4 rounded-2xl font-bold text-sm <?php echo $success ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200'; ?>">
                        <i class="fas <?php echo $success ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                        <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!$success): ?>
                    <form method="POST" class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[2px] text-slate-400 mb-2">Current Password *</label>
                            <input type="password" name="current_password" required class="w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[2px] text-slate-400 mb-2">New Password * (min 8 chars)</label>
                            <input type="password" name="new_password" required minlength="8" class="w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[2px] text-slate-400 mb-2">Confirm New Password *</label>
                            <input type="password" name="confirm_password" required minlength="8" class="w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        </div>

                        <button type="submit" class="w-full py-5 bg-secondary text-white font-black rounded-2xl hover:opacity-90 transition-all uppercase tracking-[4px] text-sm">
                            <i class="fas fa-key mr-3"></i> Update Password
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
