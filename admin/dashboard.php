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
    <title>Admin Dashboard - AskMe Tour and Travel</title>
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
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .sidebar-link.active {
            background-color: #7AB730;
            color: white;
            box-shadow: 0 4px 15px rgba(122, 183, 48, 0.3);
        }
    </style>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-72 bg-dark text-white flex flex-col p-6 shadow-2xl z-20">
        <div class="mb-12 px-2">
            <h1 class="text-3xl font-bold text-primary"><span class="text-white">Ask</span>Me</h1>
            <p class="text-gray-500 text-[10px] uppercase tracking-[3px] mt-2 font-bold">Admin Portal</p>
        </div>

        <nav class="flex-1 space-y-3">
            <a href="dashboard.php" class="sidebar-link active flex items-center space-x-4 p-4 rounded-xl transition-all duration-300">
                <i class="fas fa-th-large"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-calendar-alt"></i>
                <span class="font-semibold">Registrations</span>
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-envelope"></i>
                <span class="font-semibold">Messages</span>
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-map-marker-alt"></i>
                <span class="font-semibold">Destinations</span>
            </a>
            <a href="#" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-cog"></i>
                <span class="font-semibold">Settings</span>
            </a>
        </nav>

        <div class="pt-6 border-t border-white/10">
            <a href="logout.php" class="flex items-center space-x-4 p-4 text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all duration-300 font-bold">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white border-b border-gray-100 px-10 py-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-dark">Dashboard Overview</h2>
                <p class="text-gray-400 text-sm">Welcome back, <span class="text-primary font-bold">Admin</span></p>
            </div>
            <div class="flex items-center space-x-6">
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Status</p>
                    <span class="flex items-center text-primary text-xs font-bold">
                        <span class="w-2 h-2 bg-primary rounded-full animate-pulse mr-2"></span>
                        Live System
                    </span>
                </div>
                <div class="h-12 w-12 rounded-full border-2 border-primary p-0.5 shadow-lg">
                    <img src="../assets/img/nobody.jpg" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-10 bg-gray-50 flex-1 overflow-y-auto">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-secondary text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Total Bookings</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark">1,284</h3>
                        <span class="text-primary text-xs font-bold">+12%</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i class="fas fa-paper-plane text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Inquiries</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark">452</h3>
                        <span class="text-blue-500 text-xs font-bold">New</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-500 group-hover:text-white transition-all">
                        <i class="fas fa-map-marked-alt text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Active Tours</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark">24</h3>
                        <span class="text-purple-500 text-xs font-bold">Live</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Rating</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark">4.9</h3>
                        <span class="text-orange-500 text-xs font-bold">Global</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                <div class="flex items-center justify-between mb-10">
                    <h4 class="text-xl font-bold text-dark">Recent Registrations</h4>
                    <button class="text-primary font-bold text-sm hover:underline">Download Report</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase tracking-[3px] border-b border-gray-50">
                                <th class="pb-6 font-bold">Client Name</th>
                                <th class="pb-6 font-bold">Destination</th>
                                <th class="pb-6 font-bold">Departure</th>
                                <th class="pb-6 font-bold">Status</th>
                                <th class="pb-6 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-secondary text-primary rounded-full flex items-center justify-center font-bold">AK</div>
                                        <div>
                                            <p class="font-bold text-dark">Abebe Kebede</p>
                                            <p class="text-xs text-gray-400">abebe@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <p class="font-semibold text-dark">Lalibela Tour</p>
                                    <p class="text-xs text-gray-400">3 Days • 2 Persons</p>
                                </td>
                                <td class="py-6 text-sm text-dark font-medium">May 15, 2026</td>
                                <td class="py-6">
                                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase px-3 py-1 rounded-full border border-emerald-100">Confirmed</span>
                                </td>
                                <td class="py-6 text-right">
                                    <button class="w-8 h-8 text-gray-400 hover:text-primary transition-colors"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-secondary text-primary rounded-full flex items-center justify-center font-bold">ST</div>
                                        <div>
                                            <p class="font-bold text-dark">Sara Tesfaye</p>
                                            <p class="text-xs text-gray-400">sara@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <p class="font-semibold text-dark">Semien Mountains</p>
                                    <p class="text-xs text-gray-400">5 Days • 1 Person</p>
                                </td>
                                <td class="py-6 text-sm text-dark font-medium">Jun 02, 2026</td>
                                <td class="py-6">
                                    <span class="bg-blue-50 text-blue-500 text-[10px] font-bold uppercase px-3 py-1 rounded-full border border-blue-100">Pending</span>
                                </td>
                                <td class="py-6 text-right">
                                    <button class="w-8 h-8 text-gray-400 hover:text-primary transition-colors"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
