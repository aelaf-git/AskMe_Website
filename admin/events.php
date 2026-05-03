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
    $image = $_POST['image_path'] ?: 'assets/img/carousel-1.jpg';

    try {
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE events SET title=?, short_description=?, long_description=?, event_date=?, image_path=? WHERE id=?");
            $stmt->execute([$title, $short, $long, $date, $image, $id]);
            $message = "Event updated successfully!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO events (title, short_description, long_description, event_date, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $short, $long, $date, $image]);
            $message = "Event added successfully!";
        }
        $action = 'list';
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Fetch single event for editing
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
    <title>Manage Events - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#7AB730', dark: '#527a20' },
                        dark: '#212121',
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
</head>
<body class="flex min-h-screen bg-gray-50">
    <!-- Sidebar (Same as Dashboard) -->
    <div class="w-72 bg-dark text-white flex flex-col p-6 shadow-2xl z-20">
        <div class="mb-12 px-2">
            <h1 class="text-3xl font-bold text-primary"><span class="text-white">Ask</span>Me</h1>
            <p class="text-gray-500 text-[10px] uppercase tracking-[3px] mt-2 font-bold">Admin Portal</p>
        </div>
        <nav class="flex-1 space-y-3">
            <a href="dashboard.php" class="flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
                <i class="fas fa-th-large"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="events.php" class="bg-primary text-white flex items-center space-x-4 p-4 rounded-xl shadow-lg shadow-primary/30 transition-all duration-300">
                <i class="fas fa-calendar-alt"></i>
                <span class="font-semibold">Events</span>
            </a>
            <a href="logout.php" class="flex items-center space-x-4 p-4 text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all duration-300 font-bold mt-auto">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b border-gray-100 px-10 py-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-dark">Manage Upcoming Events</h2>
            <?php if ($action == 'list'): ?>
                <a href="events.php?action=add" class="bg-primary text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-primary/20 hover:-translate-y-1 transition-all">Add New Event</a>
            <?php else: ?>
                <a href="events.php" class="text-gray-400 font-bold hover:text-dark transition-colors"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
            <?php endif; ?>
        </header>

        <main class="p-10 flex-1 overflow-y-auto">
            <?php if (isset($_GET['msg'])): ?>
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-8 font-bold border border-emerald-100"><?php echo $_GET['msg']; ?></div>
            <?php endif; ?>
            <?php if ($message): ?>
                <div class="bg-blue-50 text-blue-600 p-4 rounded-xl mb-8 font-bold border border-blue-100"><?php echo $message; ?></div>
            <?php endif; ?>

            <?php if ($action == 'list'): ?>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-[10px] uppercase tracking-[3px] border-b border-gray-50">
                                    <th class="pb-6">Event</th>
                                    <th class="pb-6">Date</th>
                                    <th class="pb-6">Description</th>
                                    <th class="pb-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
                                while ($row = $stmt->fetch()):
                                ?>
                                <tr class="group hover:bg-gray-50 transition-colors">
                                    <td class="py-6">
                                        <div class="flex items-center space-x-4">
                                            <img src="../<?php echo $row['image_path']; ?>" class="w-12 h-12 rounded-xl object-cover">
                                            <p class="font-bold text-dark"><?php echo $row['title']; ?></p>
                                        </div>
                                    </td>
                                    <td class="py-6 text-sm font-medium text-gray-500"><?php echo $row['event_date']; ?></td>
                                    <td class="py-6 text-sm text-gray-400 w-1/3"><?php echo substr($row['short_description'], 0, 80); ?>...</td>
                                    <td class="py-6 text-right space-x-4">
                                        <a href="events.php?action=edit&id=<?php echo $row['id']; ?>" class="text-blue-500 hover:underline font-bold">Edit</a>
                                        <a href="events.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="text-rose-500 hover:underline font-bold">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white p-12 rounded-3xl shadow-xl border border-gray-100">
                        <form action="events.php" method="POST" class="space-y-8">
                            <input type="hidden" name="id" value="<?php echo $editEvent['id'] ?? ''; ?>">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Event Title</label>
                                    <input type="text" name="title" required value="<?php echo $editEvent['title'] ?? ''; ?>" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Event Date</label>
                                    <input type="date" name="event_date" required value="<?php echo $editEvent['event_date'] ?? ''; ?>" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Image Path (e.g. assets/img/event.jpg)</label>
                                <input type="text" name="image_path" value="<?php echo $editEvent['image_path'] ?? ''; ?>" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Short Description (Cards)</label>
                                <textarea name="short_description" required rows="3" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all"><?php echo $editEvent['short_description'] ?? ''; ?></textarea>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400">Full Content (HTML allowed)</label>
                                <textarea name="long_description" required rows="10" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-primary focus:outline-none transition-all"><?php echo $editEvent['long_description'] ?? ''; ?></textarea>
                            </div>
                            <button type="submit" class="w-full py-5 bg-primary text-white font-bold rounded-2xl shadow-xl shadow-primary/20 hover:-translate-y-1 transition-all">
                                <?php echo ($action == 'edit') ? 'Update Event' : 'Create Event'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
