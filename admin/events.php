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
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        header('Location: events.php?msg=Event Deleted');
        exit;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = $_POST['title'];
    $short = $_POST['short_description'];
    $long = $_POST['long_description'];
    $date = $_POST['event_date'];
    
    $image_path = handle_image_upload($_FILES['image'], $_POST['current_image'] ?: 'assets/img/carousel-1.jpg');

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE events SET title=?, short_description=?, long_description=?, event_date=?, image_path=? WHERE id=?");
            $stmt->execute([$title, $short, $long, $date, $image_path, $id]);
            $message = "Event updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO events (title, short_description, long_description, event_date, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $short, $long, $date, $image_path]);
            $message = "Event added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

$editEvent = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editEvent = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - AskMe Admin</title>
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
                <h2 class="text-2xl font-black text-secondary tracking-tighter">Upcoming Events</h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Content Management</p>
            </div>
            <?php if ($action == 'list'): ?>
                <a href="events.php?action=add" class="bg-primary text-white px-8 py-3 rounded-2xl font-black shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all text-sm uppercase tracking-widest">Add New Event</a>
            <?php else: ?>
                <a href="events.php" class="text-slate-400 font-black hover:text-secondary transition-colors text-sm uppercase tracking-widest"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
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
                                    <th class="pb-6 font-black">Event Title</th>
                                    <th class="pb-6 font-black">Date</th>
                                    <th class="pb-6 font-black">Description</th>
                                    <th class="pb-6 text-right font-black">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
                                while ($row = $stmt->fetch()):
                                ?>
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm border-2 border-white">
                                                <img src="../<?php echo $row['image_path']; ?>" class="w-full h-full object-cover">
                                            </div>
                                            <p class="font-black text-secondary text-base"><?php echo $row['title']; ?></p>
                                        </div>
                                    </td>
                                    <td class="py-6 text-sm font-bold text-slate-500"><?php echo date('M d, Y', strtotime($row['event_date'])); ?></td>
                                    <td class="py-6 text-sm text-slate-400 w-1/3"><p class="line-clamp-2"><?php echo $row['short_description']; ?></p></td>
                                    <td class="py-6 text-right space-x-4">
                                        <a href="events.php?action=edit&id=<?php echo $row['id']; ?>" class="text-secondary hover:text-primary font-black text-xs uppercase tracking-widest transition-colors">Edit</a>
                                        <a href="events.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this event?')" class="text-rose-400 hover:text-rose-600 font-black text-xs uppercase tracking-widest transition-colors">Delete</a>
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
                        <form action="events.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                            <input type="hidden" name="id" value="<?php echo $editEvent['id'] ?? ''; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $editEvent['image_path'] ?? ''; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Event Title</label>
                                    <input type="text" name="title" required value="<?php echo $editEvent['title'] ?? ''; ?>" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Event Date</label>
                                    <input type="date" name="event_date" required value="<?php echo $editEvent['event_date'] ?? ''; ?>" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl focus:border-primary focus:bg-white focus:outline-none transition-all font-bold">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Event Banner Image</label>
                                <div class="flex items-center space-x-8 p-6 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                    <?php if (isset($editEvent['image_path'])): ?>
                                        <img src="../<?php echo $editEvent['image_path']; ?>" class="w-40 h-24 rounded-2xl object-cover shadow-md">
                                    <?php endif; ?>
                                    <input type="file" name="image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary file:text-white hover:file:bg-primary/80 transition-all">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Short Summary (For Cards)</label>
                                <textarea name="short_description" required rows="3" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-3xl focus:border-primary focus:bg-white focus:outline-none transition-all font-medium"><?php echo $editEvent['short_description'] ?? ''; ?></textarea>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] uppercase tracking-[3px] font-black text-slate-400">Full Event Content</label>
                                <textarea name="long_description" required rows="10" class="w-full p-5 bg-slate-50 border border-slate-100 rounded-3xl focus:border-primary focus:bg-white focus:outline-none transition-all font-medium"><?php echo $editEvent['long_description'] ?? ''; ?></textarea>
                            </div>

                            <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl shadow-xl shadow-secondary/20 hover:-translate-y-1 transition-all uppercase tracking-[4px] text-sm">
                                <?php echo ($action == 'edit') ? 'Update Event' : 'Publish Event'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
