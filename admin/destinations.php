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
        $stmt = $pdo->prepare("DELETE FROM destinations WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: destinations.php?msg=Destination Deleted');
        exit;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $_POST['name'];
    $category = $_POST['category'];
    $discount_tag = $_POST['discount_tag'];
    
    $image_path = handle_image_upload($_FILES['image'], $_POST['current_image'] ?: 'assets/img/ethiopia.jpg');

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE destinations SET name=?, category=?, discount_tag=?, image_path=? WHERE id=?");
            $stmt->execute([$name, $category, $discount_tag, $image_path, $id]);
            $message = "Destination updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO destinations (name, category, discount_tag, image_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $category, $discount_tag, $image_path]);
            $message = "Destination added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

$editItem = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM destinations WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editItem = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Destinations - AskMe Admin</title>
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
        <header class="bg-white border-b border-slate-100 px-6 py-6 lg:px-10 lg:py-8 flex flex-wrap items-center justify-between sticky top-0 z-40 gap-4">
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <button onclick="toggleSidebar()" type="button" class="lg:hidden w-10 h-10 bg-slate-50 text-slate-400 rounded-xl border border-slate-100 flex items-center justify-center hover:text-secondary focus:outline-none shrink-0">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h2 class="text-3xl font-black text-secondary tracking-tighter">Travel <span class="text-primary">Destinations</span></h2>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[4px] mt-1">Location Management</p>
            </div>
            </div>
            <?php if ($action == 'list'): ?>
                <a href="destinations.php?action=add" class="bg-primary text-white px-8 py-3 rounded-[20px] font-black shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all text-xs uppercase tracking-widest">Add Destination</a>
            <?php else: ?>
                <a href="destinations.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-xs uppercase tracking-widest"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
            <?php endif; ?>
        </header>

        <main class="p-6 lg:p-10 flex-1 overflow-y-auto">
            <?php if (isset($_GET['msg'])): ?>
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-8 font-black border border-emerald-100 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i> <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') : ''; ?>
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
                    $stmt = $pdo->query("SELECT * FROM destinations ORDER BY created_at DESC");
                    while ($row = $stmt->fetch()):
                    ?>
                    <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            <img src="../<?php echo $row['image_path']; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/80 to-transparent"></div>
                            <div class="absolute bottom-6 left-6">
                                <span class="bg-primary/20 backdrop-blur-md text-primary text-[10px] font-black uppercase px-3 py-1 rounded-full border border-primary/30 tracking-widest mb-2 inline-block"><?php echo $row['category']; ?></span>
                                <h3 class="text-xl font-black text-white"><?php echo $row['name']; ?></h3>
                            </div>
                            <?php if ($row['discount_tag']): ?>
                                <div class="absolute top-6 right-6 bg-rose-500 text-white text-[10px] font-black px-4 py-2 rounded-xl shadow-lg"><?php echo $row['discount_tag']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6 flex items-center justify-between bg-white">
                            <a href="destinations.php?action=edit&id=<?php echo $row['id']; ?>" class="text-secondary font-black text-xs uppercase tracking-widest hover:text-primary transition-colors">Edit Location</a>
                            <a href="destinations.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this destination?')" class="text-rose-400 hover:text-rose-600 transition-colors"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white p-12 rounded-[40px] shadow-xl border border-slate-100">
                        <form action="destinations.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                            <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $editItem['image_path'] ?? ''; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-1 md:grid-cols-2 gap-6 lg:gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Destination Name</label>
                                    <input type="text" name="name" required value="<?php echo $editItem['name'] ?? ''; ?>" placeholder="e.g. Blue Nile Falls" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Category</label>
                                    <select name="category" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold appearance-none">
                                        <option value="Ethiopia" <?php echo (isset($editItem['category']) && $editItem['category'] == 'Ethiopia') ? 'selected' : ''; ?>>Ethiopia</option>
                                        <option value="Global" <?php echo (isset($editItem['category']) && $editItem['category'] == 'Global') ? 'selected' : ''; ?>>Global</option>
                                        <option value="Special" <?php echo (isset($editItem['category']) && $editItem['category'] == 'Special') ? 'selected' : ''; ?>>Special Deals</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Discount/Offer Tag (Optional)</label>
                                <input type="text" name="discount_tag" value="<?php echo $editItem['discount_tag'] ?? ''; ?>" placeholder="e.g. 15% OFF" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Destination Image</label>
                                <div class="flex items-center space-x-8 p-6 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                    <?php if (isset($editItem['image_path'])): ?>
                                        <img src="../<?php echo $editItem['image_path']; ?>" class="w-32 h-24 rounded-2xl object-cover shadow-md">
                                    <?php endif; ?>
                                    <input type="file" name="image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary file:text-white hover:file:bg-primary/80 transition-all">
                                </div>
                            </div>

                            <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl shadow-xl shadow-secondary/20 hover:-translate-y-1 transition-all uppercase tracking-[4px] text-sm">
                                <?php echo ($action == 'edit') ? 'Update Destination' : 'Add Destination'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
