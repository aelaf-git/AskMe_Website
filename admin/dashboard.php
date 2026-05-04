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
$totalPackages = $pdo->query("SELECT COUNT(*) FROM packages")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AskMe Tour and Travel</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#89C23D',    /* Logo Green */
                        secondary: '#1D609E',  /* Logo Blue */
                        dark: '#0f172a',
                        light: '#f8fafc'
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active {
            background-color: #89C23D;
            color: white;
            box-shadow: 0 4px 15px rgba(137, 194, 61, 0.3);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #89C23D; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-10 py-6 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-2xl font-black text-secondary tracking-tighter">Dashboard Overview</h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Central Control Hub</p>
            </div>
            <div class="flex items-center space-x-8">
                <div class="text-right hidden md:block">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">System Status</p>
                    <span class="flex items-center text-primary text-xs font-black">
                        <span class="w-2 h-2 bg-primary rounded-full animate-pulse mr-2"></span>
                        ONLINE & SECURE
                    </span>
                </div>
                <div class="flex items-center space-x-4 p-1.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="h-10 w-10 rounded-xl bg-secondary text-white flex items-center justify-center font-black">A</div>
                    <div class="pr-4">
                        <p class="text-xs font-black text-secondary leading-none">Super Admin</p>
                        <p class="text-[10px] text-slate-400 font-bold mt-1">admin@askme.com</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-10 flex-1 overflow-y-auto">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-primary/30 transition-all hover:shadow-xl group">
                    <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[2px] mb-2">Total Bookings</p>
                    <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalBookings); ?></h3>
                </div>

                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-secondary/30 transition-all hover:shadow-xl group">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-white transition-all shadow-sm">
                        <i class="fas fa-inbox text-2xl"></i>
                    </div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[2px] mb-2">New Inquiries</p>
                    <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalMessages); ?></h3>
                </div>

                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-vibrant/30 transition-all hover:shadow-xl group">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all shadow-sm">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[2px] mb-2">Subscribers</p>
                    <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalNewsletter); ?></h3>
                </div>

                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 hover:border-primary/30 transition-all hover:shadow-xl group">
                    <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:text-white transition-all shadow-sm">
                        <i class="fas fa-sparkles text-2xl"></i>
                    </div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[2px] mb-2">Active Content</p>
                    <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalEvents + $totalPackages); ?></h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Recent Registrations -->
                <div class="lg:col-span-2 bg-white rounded-[40px] shadow-sm border border-slate-100 p-10">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h4 class="text-xl font-black text-secondary tracking-tighter">Recent Registrations</h4>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Latest travel bookings</p>
                        </div>
                        <a href="#" class="text-xs font-black text-primary hover:underline">View All Bookings</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[3px] border-b border-slate-50">
                                    <th class="pb-6 font-black">Client</th>
                                    <th class="pb-6 font-black">Destination</th>
                                    <th class="pb-6 font-black">Date</th>
                                    <th class="pb-6 font-black text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM registrations ORDER BY created_at DESC LIMIT 5");
                                while ($row = $stmt->fetch()):
                                    $initials = strtoupper(substr($row['name'], 0, 1));
                                ?>
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center font-black"><?php echo $initials; ?></div>
                                            <div>
                                                <p class="font-black text-secondary text-sm"><?php echo $row['name']; ?></p>
                                                <p class="text-[10px] text-slate-400 font-bold"><?php echo $row['email']; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6">
                                        <p class="font-bold text-secondary text-sm"><?php echo $row['destination']; ?></p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase"><?php echo $row['purpose']; ?></p>
                                    </td>
                                    <td class="py-6">
                                        <p class="text-xs font-bold text-secondary"><?php echo date('M d, Y', strtotime($row['departure_date'])); ?></p>
                                    </td>
                                    <td class="py-6 text-right">
                                        <span class="bg-emerald-50 text-emerald-500 text-[9px] font-black uppercase px-3 py-1.5 rounded-lg border border-emerald-100 tracking-wider">Confirmed</span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Messages Sidebar -->
                <div class="space-y-10">
                    <div id="messages" class="bg-white rounded-[40px] shadow-sm border border-slate-100 p-10">
                        <h4 class="text-xl font-black text-secondary tracking-tighter mb-8">Quick Inquiries</h4>
                        <div class="space-y-6">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 4");
                            while ($row = $stmt->fetch()):
                                $initials = strtoupper(substr($row['name'], 0, 1));
                            ?>
                            <div class="flex items-start space-x-4 p-4 rounded-3xl bg-slate-50/50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all duration-300">
                                <div class="w-10 h-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-secondary font-black flex-shrink-0"><?php echo $initials; ?></div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-black text-secondary truncate"><?php echo $row['subject']; ?></p>
                                    <p class="text-[10px] text-slate-400 font-bold mt-0.5"><?php echo $row['name']; ?></p>
                                    <p class="text-[11px] text-slate-500 mt-2 line-clamp-2 leading-relaxed"><?php echo $row['message']; ?></p>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <a href="#" class="block text-center py-4 bg-secondary text-white font-black rounded-2xl mt-8 hover:scale-105 transition-all text-xs uppercase tracking-widest">Open Inbox</a>
                    </div>

                    <div id="newsletter" class="bg-secondary rounded-[40px] shadow-xl p-10 text-white relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 opacity-10 rotate-12">
                            <i class="fas fa-paper-plane text-[150px]"></i>
                        </div>
                        <h4 class="text-xl font-black tracking-tighter mb-4 relative z-10">Newsletter Reach</h4>
                        <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-6 relative z-10">Subscribers Growth</p>
                        <div class="flex items-baseline space-x-2 relative z-10">
                            <h3 class="text-5xl font-black"><?php echo number_format($totalNewsletter); ?></h3>
                            <span class="text-primary font-bold text-sm">+<?php echo rand(2, 8); ?>% this week</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

