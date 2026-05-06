<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit();
}

$page_title = "Detailed Traffic Analysis";

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Fetch Traffic
$stmt = $pdo->prepare("SELECT * FROM site_traffic ORDER BY viewed_at DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$traffic = $stmt->fetchAll();

$totalTraffic = $pdo->query("SELECT COUNT(*) FROM site_traffic")->fetchColumn();
$totalPages = ceil($totalTraffic / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traffic Analysis | AskMe Admin</title>
    <link href="../assets/img/askme.png" rel="icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active {
            background-color: #89C23D;
            color: white;
            box-shadow: 0 10px 20px rgba(137, 194, 61, 0.2);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-6 py-6 lg:px-10 lg:py-8 flex flex-wrap items-center justify-between sticky top-0 z-40 gap-4">
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <button onclick="toggleSidebar()" type="button" class="lg:hidden w-10 h-10 bg-slate-50 text-slate-400 rounded-xl border border-slate-100 flex items-center justify-center hover:text-secondary focus:outline-none shrink-0">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Traffic <span class="text-primary">Intelligence</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Detailed visitor forensics</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="px-6 py-3 bg-slate-50 rounded-[20px] border border-slate-100 flex flex-col items-end">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Lifetime Hits</p>
                    <p class="text-xl font-black text-secondary leading-none"><?php echo number_format($totalTraffic); ?></p>
                </div>
            </div>
        </header>

        <main class="p-6 lg:p-10 space-y-10">
            <!-- Table Container -->
            <div class="bg-white rounded-[50px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <div>
                        <h3 class="text-2xl font-black text-secondary tracking-tight">Visitor Log</h3>
                        <p class="text-xs font-bold text-slate-400 mt-1">Real-time tracking enabled</p>
                    </div>
                    <div class="flex items-center space-x-3 px-4 py-2 bg-emerald-50 rounded-full border border-emerald-100">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Live Monitoring</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-[3px]">
                                <th class="p-10 font-black">Time / Date</th>
                                <th class="p-10 font-black">Location</th>
                                <th class="p-10 font-black">Device & Browser</th>
                                <th class="p-10 font-black">Target Page</th>
                                <th class="p-10 font-black text-right">IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($traffic as $row): 
                                $deviceIcon = 'fa-desktop';
                                if ($row['device_type'] == 'Mobile') $deviceIcon = 'fa-mobile-screen';
                                if ($row['device_type'] == 'Tablet') $deviceIcon = 'fa-tablet-screen';
                            ?>
                            <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                                <td class="p-10">
                                    <div class="text-sm font-black text-secondary">
                                        <?php echo date('H:i:s', strtotime($row['viewed_at'])); ?>
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">
                                        <?php echo date('M d, Y', strtotime($row['viewed_at'])); ?>
                                    </div>
                                </td>
                                <td class="p-10">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                            <i class="fas fa-map-location-dot"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-secondary"><?php echo $row['city']; ?></div>
                                            <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1"><?php echo $row['country']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-10">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-xl">
                                            <i class="fas <?php echo $deviceIcon; ?>"></i>
                                        </div>
                                        <div class="max-w-[200px]">
                                            <div class="text-sm font-black text-secondary truncate"><?php echo $row['device_type']; ?></div>
                                            <div class="text-[10px] text-slate-400 font-bold truncate mt-1" title="<?php echo $row['user_agent']; ?>">
                                                <?php echo substr($row['user_agent'], 0, 40); ?>...
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-10">
                                    <div class="inline-flex items-center px-4 py-2 bg-secondary/5 text-secondary rounded-xl border border-secondary/10">
                                        <i class="fas fa-link text-[10px] mr-2 opacity-50"></i>
                                        <span class="text-xs font-black lowercase tracking-tight"><?php echo $row['page_url']; ?></span>
                                    </div>
                                </td>
                                <td class="p-10 text-right">
                                    <code class="text-xs font-black text-slate-300 group-hover:text-primary transition-colors"><?php echo $row['ip_address']; ?></code>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="p-10 bg-slate-50/50 flex justify-center items-center space-x-3">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-slate-100 text-slate-400 hover:text-primary transition-all shadow-sm"><i class="fas fa-chevron-left"></i></a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="w-12 h-12 flex items-center justify-center rounded-2xl font-black text-sm <?php echo ($page == $i) ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-white text-slate-400 border border-slate-100 hover:text-primary shadow-sm'; ?> transition-all">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-slate-100 text-slate-400 hover:text-primary transition-all shadow-sm"><i class="fas fa-chevron-right"></i></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
