<?php
require_once __DIR__ . '/config.php';
if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AskMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-72 bg-slate-900 text-white flex flex-col p-6 hidden lg:flex">
        <div class="mb-10 px-4">
            <h1 class="text-2xl font-black">Ask<span class="text-emerald-500">Me</span></h1>
            <p class="text-slate-500 text-xs mt-1 uppercase tracking-widest font-bold">Admin Panel</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="#" class="flex items-center space-x-3 p-4 bg-emerald-500 text-white rounded-2xl shadow-lg shadow-emerald-500/20 font-bold transition-all">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                <i class="fas fa-users"></i>
                <span>Registrations</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                <i class="fas fa-images"></i>
                <span>Destinations</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 text-slate-400 hover:text-white hover:bg-slate-800 rounded-2xl transition-all">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </nav>

        <div class="mt-auto">
            <a href="logout.php" class="flex items-center space-x-3 p-4 text-rose-400 hover:bg-rose-500/10 rounded-2xl transition-all font-bold">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Topbar -->
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Welcome Back, Admin</h2>
                <p class="text-slate-500 text-sm">Here is what's happening today.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold uppercase">System Healthy</div>
                <img src="../assets/img/nobody.jpg" class="w-10 h-10 rounded-full border-2 border-emerald-500">
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-xl hover:border-emerald-100 transition-all">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total Bookings</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">128</h3>
                    <p class="text-emerald-500 text-xs mt-2 font-bold"><i class="fas fa-arrow-up mr-1"></i> +12% this week</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-xl hover:border-blue-100 transition-all">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i class="fas fa-paper-plane text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">New Messages</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">45</h3>
                    <p class="text-blue-500 text-xs mt-2 font-bold"><i class="fas fa-clock mr-1"></i> 3 unread</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-xl hover:border-purple-100 transition-all">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-500 group-hover:text-white transition-all">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Active Tours</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">12</h3>
                    <p class="text-purple-500 text-xs mt-2 font-bold">Currently ongoing</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-xl hover:border-orange-100 transition-all">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-orange-500 group-hover:text-white transition-all">
                        <i class="fas fa-star text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Avg Rating</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">4.9</h3>
                    <p class="text-orange-500 text-xs mt-2 font-bold">Based on 500+ reviews</p>
                </div>
            </div>

            <!-- Recent Activity Placeholder -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl font-bold text-slate-800">Recent Bookings</h4>
                        <a href="#" class="text-emerald-500 text-sm font-bold hover:underline">View All</a>
                    </div>
                    <div class="space-y-6">
                        <!-- Booking Item -->
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-200 transition-all">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="fas fa-user text-slate-400"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800 text-sm">Abebe Kebede</h5>
                                    <p class="text-slate-500 text-xs">Lalibela Tour • 3 days</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-800">$350</p>
                                <span class="text-[10px] uppercase font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">Paid</span>
                            </div>
                        </div>
                        <!-- More items... -->
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl font-bold text-slate-800">System Logs</h4>
                        <a href="#" class="text-slate-400 hover:text-slate-600 transition-all"><i class="fas fa-sync-alt"></i></a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex space-x-3 items-start">
                            <div class="w-2 h-2 mt-2 rounded-full bg-emerald-500"></div>
                            <div>
                                <p class="text-sm text-slate-600"><span class="font-bold">Login Successful:</span> admin@askmetour.org from IP 192.168.1.1</p>
                                <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold">Just Now</p>
                            </div>
                        </div>
                        <div class="flex space-x-3 items-start">
                            <div class="w-2 h-2 mt-2 rounded-full bg-blue-500"></div>
                            <div>
                                <p class="text-sm text-slate-600"><span class="font-bold">New Booking:</span> A new registration was received for Semien Mountains.</p>
                                <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold">2 Hours Ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
