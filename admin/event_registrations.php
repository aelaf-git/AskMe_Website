<?php
session_start();
require_once '../includes/db.php';
require_once 'config.php';

if (!is_admin_authenticated()) { header('Location: login.php'); exit(); }

$page_title = "Event Registrations";

// Handle Delete
if (isset($_GET['delete'])) {
    $did = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM event_registrations WHERE id = ?")->execute([$did]);
    header('Location: event_registrations.php?success=deleted');
    exit();
}

// Filter by event
$event_filter = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;

// Fetch all events for filter dropdown
$all_events = $pdo->query("SELECT id, title FROM events ORDER BY event_date DESC")->fetchAll();

// Fetch registrations
if ($event_filter > 0) {
    $stmt = $pdo->prepare("SELECT er.*, e.title as event_title FROM event_registrations er JOIN events e ON er.event_id = e.id WHERE er.event_id = ? ORDER BY er.created_at DESC");
    $stmt->execute([$event_filter]);
} else {
    $stmt = $pdo->query("SELECT er.*, e.title as event_title FROM event_registrations er JOIN events e ON er.event_id = e.id ORDER BY er.created_at DESC");
}
$regs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registrations | AskMe Admin</title>
    <link href="../assets/img/askme.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#89C23D', secondary: '#1D609E', dark: '#0f172a' }, fontFamily: { sans: ['Outfit', 'sans-serif'] } } } }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active { background-color: #89C23D; color: white; box-shadow: 0 10px 20px rgba(137, 194, 61, 0.2); }
        .modal-backdrop { background: rgba(15,23,42,0.6); backdrop-filter: blur(8px); }
    </style>
</head>
<body class="flex min-h-screen text-slate-600">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-100 px-10 py-8 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="text-3xl font-black text-secondary tracking-tighter italic uppercase">Event <span class="text-primary">Applications</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[5px] mt-1">Participant registrations by event</p>
            </div>
            <div class="flex items-center space-x-4">
                <form method="GET" class="flex items-center space-x-3">
                    <select name="event_id" onchange="this.form.submit()" class="p-3 px-5 bg-slate-50 border border-slate-100 rounded-[20px] font-bold text-sm focus:outline-none focus:border-primary">
                        <option value="0">All Events</option>
                        <?php foreach ($all_events as $ev): ?>
                        <option value="<?php echo $ev['id']; ?>" <?php echo ($event_filter == $ev['id']) ? 'selected' : ''; ?>><?php echo $ev['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <div class="px-6 py-3 bg-slate-50 rounded-[20px] border border-slate-100 flex flex-col items-end">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Applications</p>
                    <p class="text-xl font-black text-secondary leading-none"><?php echo count($regs); ?></p>
                </div>
            </div>
        </header>

        <main class="p-10">
            <?php if (isset($_GET['success'])): ?>
            <div class="mb-8 p-4 bg-emerald-50 text-emerald-600 rounded-2xl font-bold border border-emerald-100"><i class="fas fa-check-circle mr-2"></i> Registration deleted successfully.</div>
            <?php endif; ?>

            <div class="bg-white rounded-[50px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-[3px]">
                                <th class="p-8 font-black">Applicant</th>
                                <th class="p-8 font-black">Event</th>
                                <th class="p-8 font-black">Occupation</th>
                                <th class="p-8 font-black">Nationality</th>
                                <th class="p-8 font-black">Applied On</th>
                                <th class="p-8 font-black text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($regs as $r): ?>
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="p-8">
                                    <div class="text-sm font-black text-secondary"><?php echo $r['full_name']; ?></div>
                                    <div class="text-xs text-primary font-bold"><?php echo $r['email']; ?></div>
                                    <div class="text-[10px] text-slate-400 font-bold"><?php echo $r['phone']; ?></div>
                                </td>
                                <td class="p-8">
                                    <span class="px-3 py-1.5 bg-secondary/10 text-secondary text-[10px] font-black rounded-lg uppercase tracking-widest"><?php echo $r['event_title']; ?></span>
                                </td>
                                <td class="p-8 text-sm font-bold text-slate-600"><?php echo $r['occupation']; ?></td>
                                <td class="p-8 text-sm font-bold text-slate-600"><?php echo $r['nationality']; ?></td>
                                <td class="p-8">
                                    <div class="text-sm font-black text-secondary"><?php echo date('M d, Y', strtotime($r['created_at'])); ?></div>
                                    <div class="text-[10px] text-slate-400 font-bold"><?php echo date('H:i A', strtotime($r['created_at'])); ?></div>
                                </td>
                                <td class="p-8 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <button onclick="openModal(<?php echo $r['id']; ?>)" class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fas fa-eye"></i></button>
                                        <a href="?delete=<?php echo $r['id']; ?>&event_id=<?php echo $event_filter; ?>" onclick="return confirm('Delete this application?')" class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div id="modal-<?php echo $r['id']; ?>" class="fixed inset-0 z-[999] hidden items-center justify-center modal-backdrop">
                                <div class="bg-white rounded-[40px] max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto shadow-2xl p-10 md:p-14 relative">
                                    <button onclick="closeModal(<?php echo $r['id']; ?>)" class="absolute top-6 right-6 w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-all"><i class="fas fa-times"></i></button>
                                    <h3 class="text-2xl font-black text-secondary mb-1"><?php echo $r['full_name']; ?></h3>
                                    <p class="text-primary font-bold text-sm mb-8"><?php echo $r['event_title']; ?></p>

                                    <div class="grid grid-cols-2 gap-x-8 gap-y-5 text-sm">
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Gender</span><span class="font-bold text-secondary"><?php echo $r['gender']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Date of Birth</span><span class="font-bold text-secondary"><?php echo date('M d, Y', strtotime($r['dob'])); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nationality</span><span class="font-bold text-secondary"><?php echo $r['nationality']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Passport #</span><span class="font-bold text-secondary"><?php echo $r['passport_number']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Passport Expiry</span><span class="font-bold text-secondary"><?php echo date('M d, Y', strtotime($r['passport_expiry'])); ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Passport Issue Date</span><span class="font-bold text-secondary"><?php echo !empty($r['passport_issue_date']) ? date('M d, Y', strtotime($r['passport_issue_date'])) : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Passport Issue Place</span><span class="font-bold text-secondary"><?php echo !empty($r['passport_issue_place']) ? $r['passport_issue_place'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Phone</span><span class="font-bold text-secondary"><?php echo $r['phone']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Email</span><span class="font-bold text-primary"><?php echo $r['email']; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Address</span><span class="font-bold text-secondary"><?php echo $r['address']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Country of Residence</span><span class="font-bold text-secondary"><?php echo !empty($r['country_of_residence']) ? $r['country_of_residence'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">City of Residence</span><span class="font-bold text-secondary"><?php echo !empty($r['city_of_residence']) ? $r['city_of_residence'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Emergency Contact</span><span class="font-bold text-secondary"><?php echo !empty($r['emergency_contact_name']) ? $r['emergency_contact_name'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Emergency Phone</span><span class="font-bold text-secondary"><?php echo !empty($r['emergency_contact_phone']) ? $r['emergency_contact_phone'] : '-'; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Emergency Relationship</span><span class="font-bold text-secondary"><?php echo !empty($r['emergency_contact_relationship']) ? $r['emergency_contact_relationship'] : '-'; ?></span></div>

                                        <div class="col-span-2 border-t border-slate-100 pt-5 mt-2"></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Occupation</span><span class="font-bold text-secondary"><?php echo $r['occupation']; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Company</span><span class="font-bold text-secondary"><?php echo $r['company'] ?: '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Industry</span><span class="font-bold text-secondary"><?php echo $r['industry'] ?: '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Experience</span><span class="font-bold text-secondary"><?php echo $r['experience_years']; ?> years</span></div>

                                        <div class="col-span-2 border-t border-slate-100 pt-5 mt-2"></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Purpose</span><span class="font-bold text-secondary"><?php echo $r['purpose']; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Areas of Interest</span><span class="font-bold text-secondary"><?php echo $r['areas_of_interest'] ?: '-'; ?></span></div>

                                        <div class="col-span-2 border-t border-slate-100 pt-5 mt-2"></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Valid Passport</span><span class="font-bold <?php echo $r['has_passport'] ? 'text-emerald-600' : 'text-rose-500'; ?>"><?php echo $r['has_passport'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Traveled Before</span><span class="font-bold text-secondary"><?php echo $r['traveled_before'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Invitation Letter</span><span class="font-bold <?php echo $r['needs_invitation'] ? 'text-amber-600' : 'text-secondary'; ?>"><?php echo $r['needs_invitation'] ? 'Yes' : 'No'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Accommodation</span><span class="font-bold text-secondary"><?php echo !empty($r['accommodation_preference']) ? $r['accommodation_preference'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Room Type</span><span class="font-bold text-secondary"><?php echo !empty($r['room_type_preference']) ? $r['room_type_preference'] : '-'; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Dietary Requirements</span><span class="font-bold text-secondary"><?php echo !empty($r['dietary_requirements']) ? $r['dietary_requirements'] : '-'; ?></span></div>
                                        <div class="col-span-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Medical Conditions</span><span class="font-bold text-secondary"><?php echo !empty($r['medical_conditions']) ? $r['medical_conditions'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Insurance Provider</span><span class="font-bold text-secondary"><?php echo !empty($r['insurance_provider']) ? $r['insurance_provider'] : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Policy Number</span><span class="font-bold text-secondary"><?php echo !empty($r['insurance_policy_number']) ? $r['insurance_policy_number'] : '-'; ?></span></div>
                                        <div class="col-span-2 border-t border-slate-100 pt-5 mt-2"></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Passport File</span><span class="font-bold text-secondary"><?php echo !empty($r['passport_scan_path']) ? '<a class="text-primary underline" target="_blank" href="../' . $r['passport_scan_path'] . '">View</a>' : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Profile Photo</span><span class="font-bold text-secondary"><?php echo !empty($r['profile_photo_path']) ? '<a class="text-primary underline" target="_blank" href="../' . $r['profile_photo_path'] . '">View</a>' : '-'; ?></span></div>
                                        <div><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Insurance Document</span><span class="font-bold text-secondary"><?php echo !empty($r['insurance_doc_path']) ? '<a class="text-primary underline" target="_blank" href="../' . $r['insurance_doc_path'] . '">View</a>' : '-'; ?></span></div>
                                        <?php if ($r['special_notes']): ?>
                                        <div class="col-span-2 border-t border-slate-100 pt-5 mt-2"><span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Special Notes</span><span class="font-bold text-secondary"><?php echo $r['special_notes']; ?></span></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php if (empty($regs)): ?>
                            <tr><td colspan="6" class="p-20 text-center">
                                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200"><i class="fas fa-clipboard-list text-4xl"></i></div>
                                <p class="text-slate-400 font-black uppercase tracking-widest text-sm">No applications yet</p>
                            </td></tr>
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
