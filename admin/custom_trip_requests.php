<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) {
    header('Location: login.php');
    exit();
}

$page_title = "Custom Trip Requests";
$load_error = '';

function ensure_custom_trip_requests_table($pdo) {
    $pdo->exec("CREATE TABLE IF NOT EXISTS custom_trip_requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        nationality VARCHAR(100) NOT NULL,
        residence_country VARCHAR(100) NOT NULL,
        travelers_count INT NOT NULL DEFAULT 1,
        destination_country VARCHAR(150) NOT NULL,
        destination_cities VARCHAR(255) NOT NULL,
        departure_date DATE NOT NULL,
        return_date DATE NOT NULL,
        date_flexibility VARCHAR(100) NOT NULL,
        budget_range VARCHAR(100) NOT NULL,
        trip_purpose VARCHAR(100) NOT NULL,
        accommodation_preference VARCHAR(100) NOT NULL,
        transport_preference VARCHAR(100) NOT NULL,
        has_valid_passport TINYINT(1) DEFAULT 0,
        needs_visa_assistance TINYINT(1) DEFAULT 0,
        previous_international_travel TINYINT(1) DEFAULT 0,
        previous_countries TEXT,
        emergency_contact_name VARCHAR(255) NOT NULL,
        emergency_contact_phone VARCHAR(50) NOT NULL,
        special_requirements TEXT,
        additional_notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
}

try {
    ensure_custom_trip_requests_table($pdo);
} catch (PDOException $e) {
    $load_error = 'Could not prepare custom trip requests table.';
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM custom_trip_requests WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: custom_trip_requests.php?success=deleted');
    exit();
}

$requests = [];
if (!$load_error) {
    try {
        $stmt = $pdo->query("SELECT * FROM custom_trip_requests ORDER BY created_at DESC");
        $requests = $stmt->fetchAll();
    } catch (PDOException $e) {
        $load_error = 'Could not load custom trip requests.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Trips | AskMe Admin</title>
    <link href="../assets/img/askme.png" rel="icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active { background-color: #89C23D; color: white; box-shadow: 0 10px 20px rgba(137, 194, 61, 0.2); }
        .modal-backdrop { background: rgba(15,23,42,0.65); backdrop-filter: blur(6px); }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50 text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-6 py-6 lg:px-10 lg:py-8 flex flex-wrap items-center justify-between sticky top-0 z-40 gap-4">
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <button onclick="toggleSidebar()" type="button" class="lg:hidden w-10 h-10 bg-slate-50 text-slate-400 rounded-xl border border-slate-100 flex items-center justify-center hover:text-secondary focus:outline-none shrink-0">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Custom <span class="text-primary">Trip Requests</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Bookings outside AskMe events</p>
            </div>
            <div class="px-6 py-3 bg-slate-50 rounded-[20px] border border-slate-100 flex flex-col items-end">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Requests</p>
                <p class="text-xl font-black text-secondary leading-none"><?php echo count($requests); ?></p>
            </div>
        </header>

        <main class="p-8">
            <?php if (isset($_GET['success'])): ?>
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold border border-emerald-200">
                    Request deleted successfully.
                </div>
            <?php endif; ?>
            <?php if ($load_error): ?>
                <div class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-2xl font-bold border border-rose-200">
                    <?php echo $load_error; ?>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Traveler</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Destination</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Travel Dates</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Purpose</th>
                                <th class="p-6 text-[10px] font-black uppercase tracking-[2px] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($requests as $r): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="p-6">
                                    <div class="text-sm font-black text-secondary"><?php echo htmlspecialchars($r['full_name']); ?></div>
                                    <div class="text-xs text-primary font-bold"><?php echo htmlspecialchars($r['email']); ?></div>
                                    <div class="text-[10px] text-slate-400 font-bold"><?php echo htmlspecialchars($r['phone']); ?></div>
                                </td>
                                <td class="p-6 text-sm font-bold text-secondary"><?php echo htmlspecialchars($r['destination_country']); ?></td>
                                <td class="p-6 text-xs font-bold text-slate-500">
                                    <div><?php echo date('M d, Y', strtotime($r['departure_date'])); ?> - <?php echo date('M d, Y', strtotime($r['return_date'])); ?></div>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg uppercase tracking-widest"><?php echo htmlspecialchars($r['trip_purpose']); ?></span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button onclick="openModal(<?php echo $r['id']; ?>)" class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fas fa-eye"></i></button>
                                        <a href="?delete=<?php echo $r['id']; ?>" onclick="return confirm('Delete this request?')" class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <div id="modal-<?php echo $r['id']; ?>" class="fixed inset-0 z-[999] hidden items-center justify-center modal-backdrop">
                                <div class="bg-white rounded-[28px] max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto p-8 relative">
                                    <button onclick="closeModal(<?php echo $r['id']; ?>)" class="absolute top-4 right-4 w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 hover:text-rose-500"><i class="fas fa-times"></i></button>
                                    <h3 class="text-2xl font-black text-secondary mb-6"><?php echo htmlspecialchars($r['full_name']); ?></h3>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Email</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['email']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Phone</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['phone']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nationality</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['nationality']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Residence</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['residence_country']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Travelers</span><span class="font-bold text-secondary"><?php echo (int)$r['travelers_count']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Budget</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['budget_range']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Destination Country</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['destination_country']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Destination Cities</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['destination_cities']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Departure</span><span class="font-bold text-secondary"><?php echo date('M d, Y', strtotime($r['departure_date'])); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Return</span><span class="font-bold text-secondary"><?php echo date('M d, Y', strtotime($r['return_date'])); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Date Flexibility</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['date_flexibility']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Purpose</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['trip_purpose']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Accommodation</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['accommodation_preference']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Transport</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['transport_preference']); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Has Passport</span><span class="font-bold text-secondary"><?php echo $r['has_valid_passport'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Needs Visa Help</span><span class="font-bold text-secondary"><?php echo $r['needs_visa_assistance'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">International Travel Before</span><span class="font-bold text-secondary"><?php echo $r['previous_international_travel'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Emergency Contact</span><span class="font-bold text-secondary"><?php echo htmlspecialchars($r['emergency_contact_name']); ?> (<?php echo htmlspecialchars($r['emergency_contact_phone']); ?>)</span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Previously Visited Countries</span><span class="font-bold text-secondary"><?php echo !empty($r['previous_countries']) ? htmlspecialchars($r['previous_countries']) : '-'; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Special Requirements</span><span class="font-bold text-secondary"><?php echo !empty($r['special_requirements']) ? htmlspecialchars($r['special_requirements']) : '-'; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Additional Notes</span><span class="font-bold text-secondary"><?php echo !empty($r['additional_notes']) ? htmlspecialchars($r['additional_notes']) : '-'; ?></span></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php if (empty($requests)): ?>
                            <tr><td colspan="5" class="p-20 text-center text-slate-400 font-bold">No custom trip requests yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        function openModal(id) { document.getElementById('modal-' + id).classList.remove('hidden'); document.getElementById('modal-' + id).classList.add('flex'); }
        function closeModal(id) { document.getElementById('modal-' + id).classList.add('hidden'); document.getElementById('modal-' + id).classList.remove('flex'); }
    </script>
</body>
</html>
