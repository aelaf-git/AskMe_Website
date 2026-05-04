<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit();
}

$page_title = "Newsletter Subscribers";

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM newsletter WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: newsletter.php?success=deleted');
    exit();
}

// Fetch Subscribers
$stmt = $pdo->query("SELECT * FROM newsletter ORDER BY created_at DESC");
$subscribers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers | AskMe Admin</title>
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
<body class="flex min-h-screen bg-slate-50 text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col">
        <header class="h-24 bg-white border-b border-slate-100 flex items-center justify-between px-10">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter">Newsletter <span class="text-primary">Subscribers</span></h2>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[4px] mt-1">Direct audience reach</p>
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" onclick="alert('Export functionality coming soon!')" class="px-6 py-2.5 bg-primary text-white text-xs font-black rounded-xl uppercase tracking-widest shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                    Export List
                </a>
            </div>
        </header>

        <main class="p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="mb-6 p-4 bg-emerald-500 text-white rounded-2xl font-bold animate-bounce">
                    Subscriber removed successfully!
                </div>
            <?php endif; ?>

            <div class="max-w-4xl bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-xl font-black text-secondary">Active List</h3>
                    <span class="px-4 py-1.5 bg-primary/10 text-primary text-xs font-black rounded-full uppercase tracking-widest">
                        <?php echo count($subscribers); ?> Emails
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Date Subscribed</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Email Address</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($subscribers as $sub): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6">
                                    <div class="text-sm font-bold text-secondary">
                                        <?php echo date('M d, Y', strtotime($sub['created_at'])); ?>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-black text-secondary"><?php echo $sub['email']; ?></div>
                                </td>
                                <td class="p-6 text-right">
                                    <a href="?delete=<?php echo $sub['id']; ?>" onclick="return confirm('Remove this subscriber?')" class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all ml-auto">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($subscribers)): ?>
                                <tr>
                                    <td colspan="3" class="p-20 text-center">
                                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                                            <i class="fas fa-at text-4xl"></i>
                                        </div>
                                        <p class="text-slate-400 font-black uppercase tracking-widest text-sm">No subscribers yet</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
