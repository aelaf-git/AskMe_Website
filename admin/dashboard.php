<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit;
}

$page_title = "Admin Dashboard";

// Fetch Traffic Stats
$totalTraffic = $pdo->query("SELECT COUNT(*) FROM site_traffic")->fetchColumn();
$todayTraffic = $pdo->query("SELECT COUNT(*) FROM site_traffic WHERE DATE(viewed_at) = CURDATE()")->fetchColumn();

// Fetch Traffic Data for Graph (Last 7 Days)
$trafficLabels = [];
$trafficValues = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $count = $pdo->query("SELECT COUNT(*) FROM site_traffic WHERE DATE(viewed_at) = '$date'")->fetchColumn();
    $trafficLabels[] = date('M d', strtotime($date));
    $trafficValues[] = $count;
}

$labels = json_encode($trafficLabels);
$data = json_encode($trafficValues);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | AskMe Tour and Travel</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            box-shadow: 0 10px 20px rgba(137, 194, 61, 0.2);
        }
        .stat-card { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px -12px rgba(0,0,0,0.08); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #89C23D; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen text-slate-600 overflow-x-hidden">
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="bg-white border-b border-slate-100 px-10 py-8 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter">Intelligence <span class="text-primary">Command</span></h2>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[4px] mt-1">Real-time visitor analytics</p>
            </div>
            <div class="flex items-center space-x-8">
                <div class="hidden lg:flex flex-col items-end">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Live Feed</p>
                    <p class="text-xs font-bold text-secondary"><?php echo $todayTraffic; ?> visitors today</p>
                </div>
                <div class="flex items-center space-x-4 p-2 bg-slate-50 rounded-[24px] border border-slate-100">
                    <div class="h-12 w-12 rounded-[18px] bg-secondary text-white flex items-center justify-center font-black shadow-lg shadow-secondary/20 text-xl">
                        <i class="fas fa-tower-broadcast"></i>
                    </div>
                    <div class="pr-6">
                        <p class="text-sm font-black text-secondary leading-none">Global Reach</p>
                        <p class="text-[10px] text-primary font-black uppercase tracking-widest mt-1.5">Tracking Enabled</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-10 space-y-10">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stat-card bg-white p-10 rounded-[50px] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[3px] mb-2">Total Visitors</p>
                        <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalTraffic); ?></h3>
                    </div>
                    <div class="absolute -right-6 -bottom-6 text-slate-50 text-8xl opacity-50 group-hover:text-primary/10 transition-colors">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>

                <div class="stat-card bg-white p-10 rounded-[50px] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[3px] mb-2">Today's Traffic</p>
                        <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($todayTraffic); ?></h3>
                    </div>
                    <div class="absolute -right-6 -bottom-6 text-slate-50 text-8xl opacity-50 group-hover:text-secondary/10 transition-colors">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>

                <div class="stat-card bg-white p-10 rounded-[50px] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-amber-500/10 text-amber-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <i class="fas fa-ticket-alt text-2xl"></i>
                        </div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[3px] mb-2">Total Bookings</p>
                        <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalBookings); ?></h3>
                    </div>
                    <div class="absolute -right-6 -bottom-6 text-slate-50 text-8xl opacity-50 group-hover:text-amber-500/10 transition-colors">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                </div>

                <div class="stat-card bg-white p-10 rounded-[50px] shadow-sm border border-slate-100 relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-indigo-500/10 text-indigo-500 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <i class="fas fa-comment-dots text-2xl"></i>
                        </div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[3px] mb-2">Inquiries</p>
                        <h3 class="text-4xl font-black text-secondary tracking-tighter"><?php echo number_format($totalMessages); ?></h3>
                    </div>
                    <div class="absolute -right-6 -bottom-6 text-slate-50 text-8xl opacity-50 group-hover:text-indigo-500/10 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>

            <!-- Analytics and Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Main Traffic Chart -->
                <div class="lg:col-span-2 bg-white p-12 rounded-[60px] shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-12">
                        <div>
                            <h3 class="text-2xl font-black text-secondary">Traffic Analytics</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Daily visitor trends</p>
                        </div>
                    </div>
                    <div class="h-96">
                        <canvas id="engagementChart"></canvas>
                    </div>
                </div>

                <!-- Device Distribution -->
                <div class="bg-dark rounded-[60px] p-12 text-white shadow-2xl relative overflow-hidden">
                    <h3 class="text-2xl font-black mb-10 tracking-tight flex items-center">
                        <span class="w-10 h-1.5 bg-primary mr-4 rounded-full"></span>
                        Live Traffic
                    </h3>
                    <div class="space-y-6 max-h-[500px] overflow-y-auto custom-scrollbar pr-4">
                        <?php
                        $stmt = $pdo->query("SELECT * FROM site_traffic ORDER BY viewed_at DESC LIMIT 8");
                        while ($row = $stmt->fetch()):
                            $deviceIcon = 'fa-desktop';
                            if ($row['device_type'] == 'Mobile') $deviceIcon = 'fa-mobile-screen';
                            if ($row['device_type'] == 'Tablet') $deviceIcon = 'fa-tablet-screen';
                        ?>
                        <div class="flex items-center space-x-5 p-4 rounded-3xl bg-white/5 border border-white/5 hover:bg-white/10 transition-all">
                            <div class="w-10 h-10 bg-primary/20 text-primary rounded-xl flex items-center justify-center text-lg">
                                <i class="fas <?php echo $deviceIcon; ?>"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black truncate"><?php echo $row['city'] . ', ' . $row['country']; ?></p>
                                    <span class="text-[9px] text-slate-500 font-bold"><?php echo date('H:i', strtotime($row['viewed_at'])); ?></span>
                                </div>
                                <p class="text-[10px] text-slate-400 truncate mt-1"><?php echo $row['page_url']; ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="mt-8 pt-8 border-t border-white/10">
                        <a href="traffic.php" class="block text-center py-4 bg-primary text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all">Detailed Analytics</a>
                    </div>
                </div>
            </div>

            <!-- Management Tools Quick Access -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="packages.php" class="p-8 bg-white rounded-[40px] border border-slate-100 shadow-sm flex items-center justify-between group hover:border-primary transition-all">
                    <div class="flex items-center space-x-6">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary/10 group-hover:text-primary transition-all">
                            <i class="fas fa-plus-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-secondary">Manage Tours</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1"><?php echo $totalPackages; ?> Active</p>
                        </div>
                    </div>
                    <i class="fas fa-arrow-right text-slate-200 group-hover:text-primary group-hover:translate-x-2 transition-all"></i>
                </a>
                <a href="team.php" class="p-8 bg-white rounded-[40px] border border-slate-100 shadow-sm flex items-center justify-between group hover:border-primary transition-all">
                    <div class="flex items-center space-x-6">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary/10 group-hover:text-primary transition-all">
                            <i class="fas fa-user-friends text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-secondary">Team Directory</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1"><?php echo $totalTeam; ?> Visionaries</p>
                        </div>
                    </div>
                    <i class="fas fa-arrow-right text-slate-200 group-hover:text-primary group-hover:translate-x-2 transition-all"></i>
                </a>
                <a href="registrations.php" class="p-8 bg-white rounded-[40px] border border-slate-100 shadow-sm flex items-center justify-between group hover:border-primary transition-all">
                    <div class="flex items-center space-x-6">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary/10 group-hover:text-primary transition-all">
                            <i class="fas fa-clock-rotate-left text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-secondary">Booking Center</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1"><?php echo $totalBookings; ?> Total</p>
                        </div>
                    </div>
                    <i class="fas fa-arrow-right text-slate-200 group-hover:text-primary group-hover:translate-x-2 transition-all"></i>
                </a>
            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('engagementChart').getContext('2d');
        const engagementChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Visitors',
                    data: <?php echo $data; ?>,
                    borderColor: '#89C23D',
                    backgroundColor: 'rgba(137, 194, 61, 0.05)',
                    borderWidth: 6,
                    fill: true,
                    tension: 0.45,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#89C23D',
                    pointBorderWidth: 4,
                    pointRadius: 8,
                    pointHoverRadius: 12,
                    pointHoverBackgroundColor: '#89C23D',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { family: 'Outfit', size: 14, weight: '900' },
                        bodyFont: { family: 'Outfit', size: 13, weight: 'bold' },
                        padding: 20,
                        displayColors: false,
                        cornerRadius: 15,
                        callbacks: {
                            label: (context) => ` ${context.raw} Active Visitors`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                        ticks: { font: { family: 'Outfit', weight: 'bold', size: 12 }, padding: 15 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Outfit', weight: 'bold', size: 12 }, padding: 15 }
                    }
                }
            }
        });
    </script>
</body>
</html>
