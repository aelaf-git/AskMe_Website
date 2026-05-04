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
        $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: testimonials.php?msg=Testimonial Deleted');
        exit;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $_POST['client_name'];
    $profession = $_POST['profession'];
    $feedback = $_POST['feedback'];
    $rating = (int)$_POST['rating'];
    
    $image_path = handle_image_upload($_FILES['image'], $_POST['current_image'] ?: 'assets/img/user.jpg');

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE testimonials SET client_name=?, profession=?, feedback=?, rating=?, client_image=? WHERE id=?");
            $stmt->execute([$name, $profession, $feedback, $rating, $image_path, $id]);
            $message = "Testimonial updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO testimonials (client_name, profession, feedback, rating, client_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $profession, $feedback, $rating, $image_path]);
            $message = "Testimonial added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

$editItem = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editItem = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Testimonials - AskMe Admin</title>
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
        .sidebar-link.active { background-color: #89C23D; color: white; shadow: 0 4px 15px rgba(137, 194, 61, 0.3); }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col">
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-10 py-6 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-2xl font-black text-secondary tracking-tighter">Client Testimonials</h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Feedback Management</p>
            </div>
            <?php if ($action == 'list'): ?>
                <a href="testimonials.php?action=add" class="bg-primary text-white px-8 py-3 rounded-2xl font-black shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all text-sm uppercase tracking-widest">Add Review</a>
            <?php else: ?>
                <a href="testimonials.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-sm uppercase tracking-widest"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
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
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC");
                    while ($row = $stmt->fetch()):
                    ?>
                    <div class="bg-white rounded-[40px] shadow-sm border border-slate-100 p-10 flex space-x-8 group hover:shadow-xl transition-all duration-500">
                        <div class="w-24 h-24 rounded-3xl overflow-hidden shadow-md flex-shrink-0 border-4 border-slate-50">
                            <img src="../<?php echo $row['client_image']; ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h5 class="text-lg font-black text-secondary tracking-tight"><?php echo $row['client_name']; ?></h5>
                                    <p class="text-[10px] text-primary font-black uppercase tracking-widest"><?php echo $row['profession']; ?></p>
                                </div>
                                <div class="flex text-amber-400 text-xs">
                                    <?php for($i=0; $i<$row['rating']; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 leading-relaxed italic line-clamp-3">"<?php echo $row['feedback']; ?>"</p>
                            <div class="flex items-center space-x-6 mt-6 pt-6 border-t border-slate-50">
                                <a href="testimonials.php?action=edit&id=<?php echo $row['id']; ?>" class="text-secondary font-black text-[10px] uppercase tracking-widest hover:text-primary transition-colors">Edit Review</a>
                                <a href="testimonials.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Remove this testimonial?')" class="text-rose-400 hover:text-rose-600 transition-colors"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white p-12 rounded-[40px] shadow-xl border border-slate-100">
                        <form action="testimonials.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                            <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $editItem['client_image'] ?? ''; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Client Name</label>
                                    <input type="text" name="client_name" required value="<?php echo $editItem['client_name'] ?? ''; ?>" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Profession / Title</label>
                                    <input type="text" name="profession" value="<?php echo $editItem['profession'] ?? ''; ?>" placeholder="e.g. CEO, Adventure Enthusiast" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Rating (1-5)</label>
                                    <select name="rating" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold appearance-none">
                                        <?php for($i=5; $i>=1; $i--): ?>
                                            <option value="<?php echo $i; ?>" <?php echo (isset($editItem['rating']) && $editItem['rating'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?> Stars</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Client Image</label>
                                    <div class="flex items-center space-x-6 p-2 bg-slate-50 rounded-2xl border border-slate-100">
                                        <?php if (isset($editItem['client_image'])): ?>
                                            <img src="../<?php echo $editItem['client_image']; ?>" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                        <?php endif; ?>
                                        <input type="file" name="image" class="text-[10px] text-slate-500">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Feedback Content</label>
                                <textarea name="feedback" required rows="5" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-3xl focus:border-primary focus:bg-white focus:outline-none transition-all font-medium"><?php echo $editItem['feedback'] ?? ''; ?></textarea>
                            </div>

                            <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl shadow-xl shadow-secondary/20 hover:-translate-y-1 transition-all uppercase tracking-[4px] text-sm">
                                <?php echo ($action == 'edit') ? 'Update Testimonial' : 'Publish Testimonial'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
