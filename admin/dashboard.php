<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit;
}

// Fetch stats
$totalBookings = $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn();
$totalMessages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$totalNewsletter = $pdo->query("SELECT COUNT(*) FROM newsletter")->fetchColumn();
$totalEvents = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #7AB730; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-72 bg-dark text-white flex flex-col p-6 shadow-2xl z-20 sticky top-0 h-screen">
        <div class="mb-12 px-2">
            <h1 class="text-3xl font-bold text-primary"><span class="text-white">Ask</span>Me</h1>
            <p class="text-gray-500 text-[10px] uppercase tracking-[3px] mt-2 font-bold">Admin Portal</p>
        </div>

        <nav class="flex-1 space-y-3">
            <a href="dashboard.php" class="sidebar-link active flex items-center space-x-4 p-4 rounded-xl transition-all duration-300">
                <i class="fas fa-th-large"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="events.php" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-calendar-alt"></i>
                <span class="font-semibold">Events</span>
            </a>
            <a href="#messages" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-envelope"></i>
                <span class="font-semibold">Messages</span>
            </a>
            <a href="#newsletter" class="sidebar-link flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-newspaper"></i>
                <span class="font-semibold">Newsletter</span>
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
        <header class="bg-white border-b border-gray-100 px-10 py-6 flex items-center justify-between sticky top-0 z-10">
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
                        <h3 class="text-3xl font-black text-dark"><?php echo number_format($totalBookings); ?></h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <i class="fas fa-paper-plane text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Inquiries</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark"><?php echo number_format($totalMessages); ?></h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-500 group-hover:text-white transition-all">
                        <i class="fas fa-newspaper text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Subscribers</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark"><?php echo number_format($totalNewsletter); ?></h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary transition-colors group">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Events</p>
                    <div class="flex items-baseline space-x-2">
                        <h3 class="text-3xl font-black text-dark"><?php echo number_format($totalEvents); ?></h3>
                    </div>
                </div>
            </div>

            <!-- Recent Registrations -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 mb-12">
                <div class="flex items-center justify-between mb-10">
                    <h4 class="text-xl font-bold text-dark">Recent Registrations</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase tracking-[3px] border-b border-gray-50">
                                <th class="pb-6 font-bold">Client Name</th>
                                <th class="pb-6 font-bold">Destination</th>
                                <th class="pb-6 font-bold">Departure</th>
                                <th class="pb-6 font-bold">Purpose</th>
                                <th class="pb-6 font-bold text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM registrations ORDER BY created_at DESC LIMIT 5");
                            while ($row = $stmt->fetch()):
                                $initials = strtoupper(substr($row['name'], 0, 1));
                            ?>
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-secondary text-primary rounded-full flex items-center justify-center font-bold"><?php echo $initials; ?></div>
                                        <div>
                                            <p class="font-bold text-dark"><?php echo $row['name']; ?></p>
                                            <p class="text-xs text-gray-400"><?php echo $row['email']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <p class="font-semibold text-dark"><?php echo $row['destination']; ?></p>
                                    <p class="text-xs text-gray-400"><?php echo $row['phone']; ?></p>
                                </td>
                                <td class="py-6 text-sm text-dark font-medium"><?php echo date('M d, Y', strtotime($row['departure_date'])); ?></td>
                                <td class="py-6">
                                    <span class="bg-blue-50 text-blue-500 text-[10px] font-bold uppercase px-3 py-1 rounded-full border border-blue-100"><?php echo $row['purpose']; ?></span>
                                </td>
                                <td class="py-6 text-right text-xs text-gray-400 font-medium"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Messages (Contacts) -->
            <div id="messages" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 mb-12">
                <div class="flex items-center justify-between mb-10">
                    <h4 class="text-xl font-bold text-dark">Recent Messages</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase tracking-[3px] border-b border-gray-50">
                                <th class="pb-6 font-bold">From</th>
                                <th class="pb-6 font-bold">Subject</th>
                                <th class="pb-6 font-bold">Message</th>
                                <th class="pb-6 font-bold text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 10");
                            while ($row = $stmt->fetch()):
                                $initials = strtoupper(substr($row['name'], 0, 1));
                            ?>
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center font-bold"><?php echo $initials; ?></div>
                                        <div>
                                            <p class="font-bold text-dark"><?php echo $row['name']; ?></p>
                                            <p class="text-xs text-gray-400"><?php echo $row['email']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <p class="font-semibold text-dark"><?php echo $row['subject']; ?></p>
                                </td>
                                <td class="py-6 text-sm text-gray-500 w-1/3">
                                    <p class="line-clamp-2"><?php echo $row['message']; ?></p>
                                </td>
                                <td class="py-6 text-right text-xs text-gray-400 font-medium"><?php echo date('M d, H:i', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Newsletter Subscribers -->
            <div id="newsletter" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                <div class="flex items-center justify-between mb-10">
                    <h4 class="text-xl font-bold text-dark">Newsletter Subscribers</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-[10px] uppercase tracking-[3px] border-b border-gray-50">
                                <th class="pb-6 font-bold">Email Address</th>
                                <th class="pb-6 font-bold text-right">Subscription Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM newsletter ORDER BY created_at DESC");
                            while ($row = $stmt->fetch()):
                            ?>
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center"><i class="fas fa-at"></i></div>
                                        <p class="font-bold text-dark"><?php echo $row['email']; ?></p>
                                    </div>
                                </td>
                                <td class="py-6 text-right text-xs text-gray-400 font-medium"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

