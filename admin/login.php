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
    <title>Admin Login - AskMe Tour and Travel</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#7AB730',
                            dark: '#527a20',
                        },
                        secondary: '#f4faec',
                        dark: '#212121',
                        light: '#FFFFFF',
                        body: '#656565',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .login-glass {
            background: rgba(33, 33, 33, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(122, 183, 48, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-dark min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <img src="../assets/img/carousel-1.jpg" class="w-full h-full object-cover">
    </div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse delay-700"></div>

    <div class="login-glass w-full max-w-md p-12 rounded-[40px] relative z-10">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-primary mb-3"><span class="text-white">Ask</span>Me</h1>
            <div class="w-12 h-1 bg-primary mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-400 text-xs uppercase tracking-[5px] font-bold">Admin Login</p>
        </div>

        <form id="loginForm" class="space-y-8">
            <div class="space-y-2">
                <label class="block text-gray-300 text-[10px] uppercase tracking-widest font-bold ml-1">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="email" required class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-gray-600 focus:outline-none focus:border-primary transition-all duration-300" placeholder="Email Address">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-gray-300 text-[10px] uppercase tracking-widest font-bold ml-1">Secure Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="password" required class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-gray-600 focus:outline-none focus:border-primary transition-all duration-300" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" id="submitBtn" class="w-full py-5 bg-primary hover:bg-primary-dark text-white font-bold rounded-2xl shadow-xl shadow-primary/20 transition-all duration-300 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center space-x-3">
                <span>Access Dashboard</span>
                <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </form>

        <div id="message" class="mt-8 text-center text-sm hidden animate-bounce"></div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('submitBtn');
            const msg = document.getElementById('message');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Authenticating...</span>';
            msg.classList.add('hidden');

            try {
                const response = await fetch('../api/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const result = await response.json();

                if (result.success) {
                    msg.innerHTML = '<span class="text-primary font-bold"><i class="fas fa-check-circle mr-2"></i> Access Granted</span>';
                    msg.classList.remove('hidden');
                    setTimeout(() => window.location.href = 'dashboard.php', 1000);
                } else {
                    throw new Error(result.message);
                }
            } catch (err) {
                msg.innerHTML = `<span class="text-rose-500 font-bold"><i class="fas fa-times-circle mr-2"></i> ${err.message}</span>`;
                msg.classList.remove('hidden');
                btn.disabled = false;
                btn.innerHTML = '<span>Access Dashboard</span><i class="fas fa-chevron-right text-xs"></i>';
            }
        });
    </script>
</body>
</html>
