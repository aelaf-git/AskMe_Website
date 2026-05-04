<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit();
}

$page_title = "Tour Registrations";

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: registrations.php?success=deleted');
    exit();
}

// Fetch Registrations
$stmt = $pdo->query("SELECT * FROM registrations ORDER BY created_at DESC");
$registrations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrations | AskMe Admin</title>
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
<body class="flex min-h-screen bg-slate-50 text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-10 py-8 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Tour <span class="text-primary">Registrations</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Passenger list and booking management</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="px-6 py-3 bg-slate-50 rounded-[20px] border border-slate-100 flex flex-col items-end">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Bookings</p>
                    <p class="text-xl font-black text-secondary leading-none"><?php echo count($registrations); ?></p>
                </div>
            </div>
        </header>

        <main class="p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="mb-6 p-4 bg-emerald-500 text-white rounded-2xl font-bold animate-bounce">
                    Registration record deleted successfully!
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-xl font-black text-secondary">Recent Bookings</h3>
                    <span class="px-4 py-1.5 bg-primary/10 text-primary text-xs font-black rounded-full uppercase tracking-widest">
                        <?php echo count($registrations); ?> Total
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Customer</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Destination</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Dates</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Purpose</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($registrations as $reg): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6">
                                    <div class="text-sm font-black text-secondary"><?php echo $reg['name']; ?></div>
                                    <div class="text-xs text-primary font-bold"><?php echo $reg['email']; ?></div>
                                    <div class="text-[10px] text-slate-400 font-bold"><?php echo $reg['phone']; ?></div>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-bold text-secondary"><?php echo $reg['destination']; ?></div>
                                </td>
                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-600">From: <?php echo date('M d, Y', strtotime($reg['departure_date'])); ?></span>
                                        <span class="text-xs font-bold text-slate-400">To: <?php echo date('M d, Y', strtotime($reg['return_date'])); ?></span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg uppercase tracking-widest">
                                        <?php echo $reg['purpose']; ?>
                                    </span>
                                </td>
                                <td class="p-6 text-right">
                                    <a href="?delete=<?php echo $reg['id']; ?>" onclick="return confirm('Delete this record?')" class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all ml-auto">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($registrations)): ?>
                                <tr>
                                    <td colspan="5" class="p-20 text-center">
                                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                                            <i class="fas fa-id-card text-4xl"></i>
                                        </div>
                                        <p class="text-slate-400 font-black uppercase tracking-widest text-sm">No registrations found</p>
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
