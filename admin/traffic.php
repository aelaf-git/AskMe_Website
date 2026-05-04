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

    <div class="flex-1 flex flex-col">
        <header class="h-24 bg-white border-b border-slate-100 flex items-center justify-between px-10">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter">Traffic <span class="text-primary">Intelligence</span></h2>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[4px] mt-1">Detailed visitor forensics</p>
            </div>
            <div class="flex items-center space-x-6">
                 <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Hits</p>
                    <p class="text-sm font-black text-secondary"><?php echo number_format($totalTraffic); ?></p>
                </div>
            </div>
        </header>

        <main class="p-10">
            <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-xl font-black text-secondary">Visitor Log</h3>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Live Monitoring</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Timestamp</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Location</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Device / Browser</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Page Viewed</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($traffic as $row): 
                                $deviceIcon = 'fa-desktop';
                                if ($row['device_type'] == 'Mobile') $deviceIcon = 'fa-mobile-screen';
                                if ($row['device_type'] == 'Tablet') $deviceIcon = 'fa-tablet-screen';
                            ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6">
                                    <div class="text-sm font-bold text-secondary">
                                        <?php echo date('M d, H:i:s', strtotime($row['viewed_at'])); ?>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center text-primary">
                                            <i class="fas fa-location-dot"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-secondary"><?php echo $row['city']; ?></div>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest"><?php echo $row['country']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas <?php echo $deviceIcon; ?> text-slate-400"></i>
                                        <div class="text-xs font-bold text-slate-600 max-w-[200px] truncate" title="<?php echo $row['user_agent']; ?>">
                                            <?php echo $row['device_type']; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest">
                                        <?php echo $row['page_url']; ?>
                                    </span>
                                </td>
                                <td class="p-6">
                                    <code class="text-xs font-bold text-slate-400"><?php echo $row['ip_address']; ?></code>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="p-8 bg-slate-50 flex justify-center space-x-2">
                    <?php for ($i = 1; $i <= min(5, $totalPages); $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="w-10 h-10 flex items-center justify-center rounded-xl font-black text-xs <?php echo ($page == $i) ? 'bg-primary text-white shadow-lg' : 'bg-white text-slate-400 hover:text-primary'; ?> transition-all">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
