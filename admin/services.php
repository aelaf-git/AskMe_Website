<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit;
}

$message = '';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Handle Delete
if ($action == 'delete' && isset($_GET['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: services.php?msg=Service Deleted');
        exit;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = $_POST['title'];
    $icon = $_POST['icon_class'];
    $description = $_POST['description'];

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE services SET title=?, icon_class=?, description=? WHERE id=?");
            $stmt->execute([$title, $icon, $description, $id]);
            $message = "Service updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO services (title, icon_class, description) VALUES (?, ?, ?)");
            $stmt->execute([$title, $icon, $description]);
            $message = "Service added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

$editItem = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editItem = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - AskMe Admin</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#89C23D',
                        secondary: '#1D609E',
                        dark: '#0f172a',
                    },
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active { background-color: #89C23D; color: white; }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col">
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-10 py-6 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-2xl font-black text-secondary tracking-tighter">Core Services</h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Brand Value Management</p>
            </div>
            <?php if ($action == 'list'): ?>
                <a href="services.php?action=add" class="bg-primary text-white px-8 py-3 rounded-2xl font-black shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all text-sm uppercase tracking-widest">Add Service</a>
            <?php else: ?>
                <a href="services.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-sm uppercase tracking-widest"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
            <?php endif; ?>
        </header>

        <main class="p-10 flex-1 overflow-y-auto">
            <?php if (isset($_GET['msg'])): ?>
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-8 font-black border border-emerald-100 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i> <?php echo $_GET['msg']; ?>
                </div>
            <?php endif; ?>
            <?php if ($message): ?>
                <div class="bg-blue-50 text-blue-600 p-4 rounded-2xl mb-8 font-black border border-blue-100 flex items-center">
                    <i class="fas fa-info-circle mr-3"></i> <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <?php if ($action == 'list'): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
                    while ($row = $stmt->fetch()):
                    ?>
                    <div class="bg-white p-10 rounded-[40px] shadow-sm border border-slate-100 group hover:bg-secondary transition-all duration-500 hover:-translate-y-4">
                        <div class="w-20 h-20 bg-primary/10 text-primary rounded-[30px] flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-sm">
                            <i class="<?php echo $row['icon_class']; ?> text-3xl"></i>
                        </div>
                        <h5 class="text-2xl font-black text-secondary group-hover:text-white mb-4 transition-colors"><?php echo $row['title']; ?></h5>
                        <p class="text-slate-500 group-hover:text-white/70 transition-colors text-sm leading-relaxed mb-8"><?php echo $row['description']; ?></p>
                        <div class="flex items-center space-x-6 pt-6 border-t border-slate-50 group-hover:border-white/10">
                            <a href="services.php?action=edit&id=<?php echo $row['id']; ?>" class="text-secondary font-black text-[10px] uppercase tracking-widest group-hover:text-white hover:underline transition-colors">Edit</a>
                            <a href="services.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this service?')" class="text-rose-400 group-hover:text-rose-200 transition-colors"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white p-12 rounded-[40px] shadow-xl border border-slate-100">
                        <form action="services.php" method="POST" class="space-y-10">
                            <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Service Title</label>
                                    <input type="text" name="title" required value="<?php echo $editItem['title'] ?? ''; ?>" placeholder="e.g. Worldwide Coverage" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Icon Class (FontAwesome)</label>
                                    <input type="text" name="icon_class" required value="<?php echo $editItem['icon_class'] ?? 'fas fa-globe-africa'; ?>" placeholder="e.g. fas fa-plane" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold font-mono text-sm">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Service Description</label>
                                <textarea name="description" required rows="5" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-3xl focus:border-primary focus:bg-white focus:outline-none transition-all font-medium"><?php echo $editItem['description'] ?? ''; ?></textarea>
                            </div>

                            <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl shadow-xl shadow-secondary/20 hover:-translate-y-1 transition-all uppercase tracking-[4px] text-sm">
                                <?php echo ($action == 'edit') ? 'Update Service' : 'Add Service'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
