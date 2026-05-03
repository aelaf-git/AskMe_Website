<?php
require_once __DIR__ . '/config.php';
if (is_admin_authenticated()) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AskMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Background Shapes -->
    <div class="absolute top-0 -left-20 w-72 h-72 bg-emerald-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 -right-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-20 left-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>

    <div class="glass w-full max-w-md p-10 rounded-3xl relative z-10">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-white mb-2">Ask<span class="text-emerald-500">Me</span></h1>
            <p class="text-slate-400 font-medium">Administration Portal</p>
        </div>

        <form id="loginForm" class="space-y-6">
            <div>
                <label class="block text-slate-300 text-sm font-bold mb-2 ml-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="email" required class="w-full pl-11 pr-4 py-4 bg-slate-800/50 border border-slate-700 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" placeholder="admin@askmetour.org">
                </div>
            </div>

            <div>
                <label class="block text-slate-300 text-sm font-bold mb-2 ml-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="password" required class="w-full pl-11 pr-4 py-4 bg-slate-800/50 border border-slate-700 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" id="submitBtn" class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                <span>Sign In</span>
                <i class="fas fa-arrow-right ml-2 text-sm"></i>
            </button>
        </form>

        <div id="message" class="mt-6 text-center text-sm hidden"></div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('submitBtn');
            const msg = document.getElementById('message');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
            msg.classList.add('hidden');

            try {
                const response = await fetch('../api/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const result = await response.json();

                if (result.success) {
                    msg.innerHTML = '<span class="text-emerald-500"><i class="fas fa-check-circle mr-1"></i> Success! Redirecting...</span>';
                    msg.classList.remove('hidden');
                    setTimeout(() => window.location.href = 'dashboard.php', 1000);
                } else {
                    throw new Error(result.message);
                }
            } catch (err) {
                msg.innerHTML = `<span class="text-rose-500"><i class="fas fa-exclamation-circle mr-1"></i> ${err.message}</span>`;
                msg.classList.remove('hidden');
                btn.disabled = false;
                btn.innerHTML = '<span>Sign In</span><i class="fas fa-arrow-right ml-2 text-sm"></i>';
            }
        });
    </script>
</body>
</html>
