<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit();
}

$page_title = "Contact Messages";

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: messages.php?success=deleted');
    exit();
}

// Fetch Messages
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | AskMe Admin</title>
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
                <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Inquiry <span class="text-primary">Center</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Management of contact messages</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="px-6 py-3 bg-slate-50 rounded-[20px] border border-slate-100 flex flex-col items-end">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Inbox</p>
                    <p class="text-xl font-black text-secondary leading-none"><?php echo count($messages); ?></p>
                </div>
            </div>
        </header>

        <main class="p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="mb-6 p-4 bg-emerald-500 text-white rounded-2xl font-bold animate-bounce">
                    Message deleted successfully!
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-xl font-black text-secondary">Inbox</h3>
                    <span class="px-4 py-1.5 bg-primary/10 text-primary text-xs font-black rounded-full uppercase tracking-widest">
                        <?php echo count($messages); ?> Total
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Date</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">From</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Subject</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Message</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($messages as $msg): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-6">
                                    <div class="text-sm font-bold text-secondary">
                                        <?php echo date('M d, Y', strtotime($msg['created_at'])); ?>
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                        <?php echo date('H:i A', strtotime($msg['created_at'])); ?>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-black text-secondary"><?php echo $msg['name']; ?></div>
                                    <div class="text-xs text-primary font-bold"><?php echo $msg['email']; ?></div>
                                </td>
                                <td class="p-6">
                                    <div class="text-sm font-bold text-slate-600"><?php echo $msg['subject']; ?></div>
                                </td>
                                <td class="p-6 max-w-xs">
                                    <p class="text-xs text-slate-500 truncate"><?php echo $msg['message']; ?></p>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <button onclick='alert("Full Message:\n\n<?php echo addslashes($msg['message']); ?>")' class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="?delete=<?php echo $msg['id']; ?>" onclick="return confirm('Delete this message?')" class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($messages)): ?>
                                <tr>
                                    <td colspan="5" class="p-20 text-center">
                                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                                            <i class="fas fa-inbox text-4xl"></i>
                                        </div>
                                        <p class="text-slate-400 font-black uppercase tracking-widest text-sm">Inbox is empty</p>
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
