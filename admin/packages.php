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
        $stmt = $pdo->prepare("DELETE FROM packages WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: packages.php?msg=Package Deleted');
        exit;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = $_POST['title'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    // Handle Image Upload
    $image_path = handle_image_upload($_FILES['image'], $_POST['current_image'] ?: 'assets/img/package-1.jpg');

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE packages SET title=?, location=?, duration=?, price=?, image_path=?, description=?, is_featured=? WHERE id=?");
            $stmt->execute([$title, $location, $duration, $price, $image_path, $description, $is_featured, $id]);
            $message = "Package updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO packages (title, location, duration, price, image_path, description, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $location, $duration, $price, $image_path, $description, $is_featured]);
            $message = "Package added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Fetch single package for editing
$editItem = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editItem = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - AskMe Admin</title>
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
        <header class="bg-white border-b border-slate-100 px-10 py-8 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter">Manage <span class="text-primary">Tours</span></h2>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[4px] mt-1">Inventory Control</p>
            </div>
            <?php if ($action == 'list'): ?>
                <a href="packages.php?action=add" class="bg-primary text-white px-8 py-3 rounded-[20px] font-black shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all text-xs uppercase tracking-widest">Add New Package</a>
            <?php else: ?>
                <a href="packages.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-xs uppercase tracking-widest"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
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
                <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 p-10">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[3px] border-b border-slate-50">
                                    <th class="pb-6 font-black">Package Info</th>
                                    <th class="pb-6 font-black">Location</th>
                                    <th class="pb-6 font-black">Price/Duration</th>
                                    <th class="pb-6 font-black">Featured</th>
                                    <th class="pb-6 text-right font-black">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM packages ORDER BY created_at DESC");
                                while ($row = $stmt->fetch()):
                                ?>
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm border-2 border-white">
                                                <img src="../<?php echo $row['image_path']; ?>" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-black text-secondary text-base"><?php echo $row['title']; ?></p>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">ID: #PK-<?php echo $row['id']; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6">
                                        <div class="flex items-center text-slate-500 font-bold text-sm">
                                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                            <?php echo $row['location']; ?>
                                        </div>
                                    </td>
                                    <td class="py-6">
                                        <p class="font-black text-secondary text-sm">$<?php echo number_format($row['price'], 2); ?></p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1"><?php echo $row['duration']; ?></p>
                                    </td>
                                    <td class="py-6">
                                        <?php if ($row['is_featured']): ?>
                                            <span class="bg-amber-50 text-amber-500 text-[9px] font-black uppercase px-3 py-1.5 rounded-lg border border-amber-100 tracking-wider">Featured</span>
                                        <?php else: ?>
                                            <span class="text-slate-300 text-[9px] font-black uppercase px-3 py-1.5 tracking-wider">Standard</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-6 text-right space-x-4">
                                        <a href="packages.php?action=edit&id=<?php echo $row['id']; ?>" class="text-secondary hover:text-primary font-black text-xs uppercase tracking-widest transition-colors">Edit</a>
                                        <a href="packages.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="text-rose-400 hover:text-rose-600 font-black text-xs uppercase tracking-widest transition-colors">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <div class="max-w-5xl mx-auto">
                    <div class="bg-white p-12 rounded-[40px] shadow-xl border border-slate-100">
                        <form action="packages.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                            <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $editItem['image_path'] ?? ''; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Package Title</label>
                                    <input type="text" name="title" required value="<?php echo $editItem['title'] ?? ''; ?>" placeholder="e.g. Historic North Journey" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Location</label>
                                    <input type="text" name="location" required value="<?php echo $editItem['location'] ?? ''; ?>" placeholder="e.g. Lalibela, Ethiopia" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Duration</label>
                                    <input type="text" name="duration" required value="<?php echo $editItem['duration'] ?? ''; ?>" placeholder="e.g. 5 Days / 4 Nights" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Price (USD)</label>
                                    <input type="number" step="0.01" name="price" required value="<?php echo $editItem['price'] ?? ''; ?>" placeholder="e.g. 850.00" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Package Image</label>
                                <div class="flex items-center space-x-8 p-6 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                    <?php if (isset($editItem['image_path'])): ?>
                                        <img src="../<?php echo $editItem['image_path']; ?>" class="w-24 h-24 rounded-2xl object-cover shadow-md">
                                    <?php endif; ?>
                                    <input type="file" name="image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary file:text-white hover:file:bg-primary/80 transition-all">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Detailed Description</label>
                                <textarea name="description" rows="6" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-3xl focus:border-primary focus:bg-white focus:outline-none transition-all font-medium"><?php echo $editItem['description'] ?? ''; ?></textarea>
                            </div>

                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="is_featured" id="is_featured" <?php echo (isset($editItem['is_featured']) && $editItem['is_featured']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary">
                                <label for="is_featured" class="text-sm font-black text-secondary uppercase tracking-widest">Feature this package on homepage</label>
                            </div>

                            <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl shadow-xl shadow-secondary/20 hover:-translate-y-1 transition-all uppercase tracking-[4px] text-sm">
                                <?php echo ($action == 'edit') ? 'Save Changes' : 'Publish Package'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
