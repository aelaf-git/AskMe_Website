<?php
require_once 'includes/db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$form_message = '';
$form_success = false;



function save_registration_upload($fileKey, $required = false) {
    $hiddenKey = $fileKey . '_path';
    if (isset($_POST[$hiddenKey]) && !empty($_POST[$hiddenKey])) {
        return ['ok' => true, 'path' => $_POST[$hiddenKey], 'error' => null];
    }

    if (!isset($_FILES[$fileKey]) || !is_array($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => !$required, 'path' => null, 'error' => $required ? 'Missing required upload.' : null];
    }
    
    $file = $_FILES[$fileKey];
    if ($file['error'] !== UPLOAD_ERR_OK) return ['ok' => false, 'path' => null, 'error' => 'Upload failed.'];
    if ($file['size'] > 5 * 1024 * 1024) return ['ok' => false, 'path' => null, 'error' => 'File too large (max 5MB).'];
    
    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) return ['ok' => false, 'path' => null, 'error' => 'Invalid file type.'];

    $uploadDir = __DIR__ . '/../uploads/event_registrations/' . date('Y/m');
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) return ['ok' => false, 'path' => null, 'error' => 'Upload error.'];

    $targetName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($file['name']));
    $targetPath = $uploadDir . '/' . $targetName;
    
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) return ['ok' => false, 'path' => null, 'error' => 'Save failed.'];
    return ['ok' => true, 'path' => 'uploads/event_registrations/' . date('Y/m') . '/' . $targetName, 'error' => null];
}

// Handle form submission
if (isset($_GET['submitted']) && $_GET['submitted'] === '1') {
    $form_success = true;
    $form_message = 'Application submitted successfully.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_register'])) {
    $eid = (int)$_POST['event_id'];
    $chk = $pdo->prepare("SELECT registration_deadline FROM events WHERE id = ?");
    $chk->execute([$eid]);
    $ev = $chk->fetch();
    
    if ($ev && $ev['registration_deadline'] && date('Y-m-d') > $ev['registration_deadline']) {
        $form_message = 'Registration for this event has closed.';
    } else {

        $passportUpload = save_registration_upload('passport_scan', true);
        $photoUpload = save_registration_upload('profile_photo', true);
        $insuranceUpload = save_registration_upload('insurance_doc', false);

        $uploadErrors = [];
        if (!$passportUpload['ok']) $uploadErrors[] = $passportUpload['error'];
        if (!$photoUpload['ok']) $uploadErrors[] = $photoUpload['error'];
        if (!$insuranceUpload['ok']) $uploadErrors[] = $insuranceUpload['error'];

        if (!empty($uploadErrors)) {
            $form_message = implode(' ', array_unique($uploadErrors));
            $id = $eid;
            goto end_submission;
        }

        try {
            $insertValues = [
                $eid, $_POST['full_name'], $_POST['gender'], $_POST['dob'], $_POST['nationality'],
                $_POST['passport_number'], $_POST['passport_issue_date'], $_POST['passport_expiry'], $_POST['passport_issuing_country'],
                $passportUpload['path'], $photoUpload['path'], $insuranceUpload['path'],
                $_POST['phone'], $_POST['whatsapp'] ?? '', $_POST['email'], $_POST['address'], $_POST['city'], $_POST['country'],
                $_POST['emergency_name'], $_POST['emergency_phone'], $_POST['emergency_relation'],
                $_POST['purpose'],
                isset($_POST['has_valid_passport']) ? 1 : 0, 
                isset($_POST['traveled_before']) ? 1 : 0,
                isset($_POST['has_trip_visa']) ? 1 : 0,
                $_POST['previous_international_destinations'] ?? '',
                isset($_POST['requires_visa']) ? 1 : 0, 
                isset($_POST['needs_invitation']) ? 1 : 0,
                $_POST['dietary_requirements'] ?? '', $_POST['medical_conditions'] ?? '', $_POST['room_preference'] ?? '',
                $_POST['special_notes'] ?? ''
            ];
            $placeholders = implode(',', array_fill(0, count($insertValues), '?'));

            $stmt = $pdo->prepare("INSERT INTO event_registrations (
                event_id, full_name, gender, dob, nationality,
                passport_number, passport_issue_date, passport_expiry, passport_issuing_country,
                passport_scan, profile_photo, insurance_doc_path,
                phone, whatsapp, email, address, city, country,
                emergency_name, emergency_phone, emergency_relation,
                purpose,
                has_valid_passport, traveled_before, has_trip_visa, previous_international_destinations, 
                requires_visa, needs_invitation,
                dietary_requirements, medical_conditions, room_preference, special_notes
            ) VALUES ({$placeholders})");
            $stmt->execute($insertValues);
            
            header('Location: index.php?p=event_detail&id=' . $eid . '&submitted=1#registration-form');
            exit();
        } catch (PDOException $e) {
            $form_message = 'Error submitting form: ' . $e->getMessage();
        }
    }
    $id = $eid;
}
end_submission:

try {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch();
    if (!$event) { echo '<div class="py-40 text-center text-4xl font-bold">Event Not Found</div>'; return; }
    $date = new DateTime($event['event_date']);
    $deadline = $event['registration_deadline'] ? $event['registration_deadline'] : null;
    $is_open = !$deadline || date('Y-m-d') <= $deadline;
    $reg_count = $pdo->prepare("SELECT COUNT(*) FROM event_registrations WHERE event_id = ?");
    $reg_count->execute([$id]);
    $total_registered = $reg_count->fetchColumn();
} catch (PDOException $e) { die("Error: " . $e->getMessage()); }
?>

<!-- Header Start -->
<div class="relative w-full pt-32 md:pt-48 pb-24 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo $event['image_path']; ?>" class="w-full h-full object-cover opacity-20 scale-110">
        <div class="absolute inset-0 bg-gradient-to-b from-dark via-transparent to-dark"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <div class="inline-block px-4 py-2 glass rounded-xl text-xs font-black uppercase tracking-[3px] text-primary mb-6">AskMe Experience</div>
        <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter mb-8"><?php echo $event['title']; ?></h1>
        <div class="flex items-center justify-center space-x-4">
            <a href="index.php" class="text-white/50 hover:text-primary font-bold transition-colors">Home</a>
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            <a href="index.php?p=events" class="text-white/50 hover:text-primary font-bold transition-colors">Events</a>
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            <span class="text-primary font-bold uppercase tracking-widest text-xs">Event Detail</span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Event Detail Start -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-8">
            <!-- Content -->
            <div class="w-full lg:w-8/12 px-8">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                    <div class="relative h-[450px]">
                        <img src="<?php echo $event['image_path']; ?>" class="w-full h-full object-cover">
                        <div class="absolute bottom-10 left-10 bg-primary text-white p-6 rounded-2xl shadow-2xl">
                            <h4 class="text-4xl font-black"><?php echo $date->format('d'); ?></h4>
                            <p class="uppercase font-bold tracking-widest text-sm"><?php echo $date->format('M Y'); ?></p>
                        </div>
                    </div>
                    <div class="p-10 md:p-16">
                        <div class="flex items-center space-x-4 text-primary font-bold uppercase tracking-[3px] text-xs mb-8">
                            <span><i class="far fa-calendar-alt mr-2"></i> <?php echo $date->format('F d, Y'); ?></span>
                            <span class="text-gray-200">|</span>
                            <span><i class="fas fa-users mr-2"></i> <?php echo $total_registered; ?> Registered</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black text-secondary mb-10 leading-tight"><?php echo $event['title']; ?></h2>
                        <div class="prose prose-xl max-w-none text-gray-600 leading-relaxed space-y-8">
                            <p class="font-semibold text-xl text-secondary leading-relaxed italic border-l-4 border-primary pl-6 py-2 bg-gray-50 rounded-r-xl"><?php echo $event['short_description']; ?></p>
                            <div class="text-lg whitespace-pre-line"><?php echo $event['long_description']; ?></div>
                        </div>
                        <div class="mt-16 pt-10 border-t border-gray-100 flex items-center justify-between flex-wrap gap-6">
                            <div class="flex items-center space-x-4">
                                <span class="font-bold text-secondary uppercase tracking-widest text-xs">Share this event:</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-secondary flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-secondary flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-secondary flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <?php if ($is_open): ?>
                            <a href="#registration-form" class="btn-primary">Register Now <i class="fas fa-arrow-down ml-2"></i></a>
                            <?php else: ?>
                            <span class="px-6 py-3 bg-rose-100 text-rose-600 font-bold rounded-xl text-sm">Registration Closed</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-4/12 px-8 mt-16 lg:mt-0">
                <div class="bg-dark rounded-3xl p-10 text-white shadow-2xl sticky top-10">
                    <h4 class="text-2xl font-bold mb-8 flex items-center"><span class="w-8 h-1 bg-primary mr-4 rounded-full"></span>Recent Events</h4>
                    <div class="space-y-8">
                        <?php
                        $stmtRecent = $pdo->prepare("SELECT * FROM events WHERE id != ? ORDER BY event_date DESC LIMIT 3");
                        $stmtRecent->execute([$id]);
                        while ($recent = $stmtRecent->fetch()) { $rDate = new DateTime($recent['event_date']); ?>
                        <a href="index.php?p=event_detail&id=<?php echo $recent['id']; ?>" class="group flex items-center space-x-4">
                            <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden shadow-lg border border-white/10">
                                <img src="<?php echo $recent['image_path']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <h5 class="font-bold text-white group-hover:text-primary transition-colors leading-tight mb-2"><?php echo $recent['title']; ?></h5>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold"><?php echo $rDate->format('M d, Y'); ?></p>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="mt-12 p-8 bg-white/5 rounded-2xl border border-white/10">
                        <h5 class="text-xl font-bold mb-4">Book a Customized Tour</h5>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed">Let us plan your perfect journey to experience these events in person.</p>
                        <a href="index.php?p=package" class="block text-center py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all">View Packages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Event Detail End -->

<!-- Registration Form Start -->
<?php if ($is_open): ?>
<div id="registration-form" class="py-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4">
        <?php if ($form_success): ?>
        <div class="mb-10 p-10 bg-emerald-50 rounded-[40px] border border-emerald-200 text-center shadow-lg">
            <div class="w-20 h-20 bg-emerald-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="text-3xl font-black text-emerald-700 mb-4">Registration Successful!</h3>
            <p class="text-emerald-600 font-medium mb-2"><?php echo $form_message; ?></p>
            <p class="text-sm text-emerald-500">We've received your application and will contact you soon.</p>
        </div>
        <?php elseif ($form_message): ?>
        <div class="mb-10 p-6 rounded-2xl font-bold text-lg text-center bg-rose-50 text-rose-700 border border-rose-200">
            <i class="fas fa-exclamation-circle mr-2"></i> <?php echo $form_message; ?>
        </div>
        <?php endif; ?>

        <?php if (!$form_success): ?>
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-4">Application</div>
            <h2 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Registration <span class="text-primary">Form</span></h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Complete the form below to register for <strong><?php echo $event['title']; ?></strong>.</p>
            <?php if ($deadline): ?>
            <p class="text-rose-500 font-bold mt-2 text-sm uppercase tracking-widest"><i class="fas fa-clock mr-1"></i> Deadline: <?php echo date('F d, Y', strtotime($deadline)); ?></p>
            <?php endif; ?>
        </div>

        <form action="index.php?p=event_detail&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden">
            <input type="hidden" name="event_id" value="<?php echo $id; ?>">
            <input type="hidden" name="event_register" value="1">
            <input type="hidden" name="passport_scan_path" id="passport_scan_path">
            <input type="hidden" name="profile_photo_path" id="profile_photo_path">
            <input type="hidden" name="insurance_doc_path" id="insurance_doc_path">

            <!-- Section 1: Personal -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">1. Personal Information</h3>
                <p class="text-gray-400 text-sm mb-8">Your basic identity details.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Full Name *</label><input type="text" name="full_name" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Gender *</label><select name="gender" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Date of Birth *</label><input type="date" name="dob" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Nationality *</label><input type="text" name="nationality" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Passport Number *</label><input type="text" name="passport_number" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Passport Expiry Date *</label><input type="date" name="passport_expiry" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Passport Issue Date *</label><input type="date" name="passport_issue_date" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Issuing Country *</label><input type="text" name="passport_issuing_country" required placeholder="Country that issued passport" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Country of Residence *</label><input type="text" name="country" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">City of Residence *</label><input type="text" name="city" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                </div>
            </div>

            <!-- Section 2: Contact -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">2. Contact Information</h3>
                <p class="text-gray-400 text-sm mb-8">How we can reach you.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Phone Number *</label><input type="tel" name="phone" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">WhatsApp Number</label><input type="tel" name="whatsapp" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Email Address *</label><input type="email" name="email" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div class="md:col-span-1"><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Emergency Contact Name *</label><input type="text" name="emergency_name" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Emergency Contact Phone *</label><input type="tel" name="emergency_phone" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Emergency Contact Relationship *</label><input type="text" name="emergency_relation" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                </div>
                <div class="mt-6"><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Address *</label><textarea name="address" required rows="2" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></textarea></div>
            </div>

            <!-- Section 3: Travel Purpose -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">3. Travel Purpose</h3>
                <p class="text-gray-400 text-sm mb-8">Tell us why you are joining this event.</p>
                <textarea name="purpose" required rows="5" placeholder="Briefly describe your reason for attending, what you hope to gain, and how this event aligns with your goals..." class="w-full p-5 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium text-gray-700 leading-relaxed"></textarea>
            </div>

            <!-- Section 4: International Travel & Visa History -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">4. International Travel & Visa History</h3>
                <p class="text-gray-400 text-sm mb-8">Help us understand your travel background for smoother coordination.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <label class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer"><span class="font-bold text-sm text-gray-600">Have you traveled internationally before?</span><input type="checkbox" name="traveled_before" value="1" class="w-5 h-5 accent-primary"></label>
                    <label class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer"><span class="font-bold text-sm text-gray-600">Do you already have a visa for this trip?</span><input type="checkbox" name="has_trip_visa" value="1" class="w-5 h-5 accent-primary"></label>
                    <label class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer md:col-span-2"><span class="font-bold text-sm text-gray-600">Do you need visa processing support for this event?</span><input type="checkbox" name="requires_visa" value="1" class="w-5 h-5 accent-primary"></label>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Countries You Have Previously Traveled To</label>
                    <textarea name="previous_international_destinations" rows="3" placeholder="List country names separated by commas" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></textarea>
                </div>
            </div>

            <!-- Section 5: Additional -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">5. Additional Information</h3>
                <p class="text-gray-400 text-sm mb-8">Any extra requirements.</p>
                <label class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer mb-6 max-w-md"><span class="font-bold text-sm text-gray-600">Need invitation letter?</span><input type="checkbox" name="needs_invitation" value="1" class="w-5 h-5 accent-primary"></label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Room Preference *</label><select name="room_preference" required class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"><option value="">Select</option><option value="Single Hotel">Single Hotel Room</option><option value="Twin Hotel">Twin Hotel Room</option><option value="Double Hotel">Double Hotel Room</option><option value="Serviced Apartment">Serviced Apartment</option><option value="Guest House">Guest House</option></select></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Dietary Requirements</label><input type="text" name="dietary_requirements" placeholder="Vegetarian, halal, allergies..." class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Medical Conditions / Accessibility Needs</label><input type="text" name="medical_conditions" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></div>
                    <div class="md:col-span-1"></div>
                </div>
                <div><label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Special Requests or Notes</label><textarea name="special_notes" rows="3" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium"></textarea></div>
            </div>

            <!-- Section 6: Required Uploads -->
            <div class="p-10 md:p-16 border-b border-gray-100">
                <h3 class="text-2xl font-black text-secondary mb-2">6. Document Uploads</h3>
                <p class="text-gray-400 text-sm mb-8">Upload clear files (PDF/JPG/PNG, max 5MB each).</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="upload-field" data-name="passport_scan">
                        <label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Passport Scan (Required) *</label>
                        <input type="file" name="passport_scan" accept=".pdf,.jpg,.jpeg,.png" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        <div class="progress-container hidden mt-3 h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-primary w-0 transition-all duration-300"></div>
                        </div>
                        <div class="status-msg text-[10px] font-bold mt-1 uppercase tracking-wider"></div>
                    </div>
                    <div class="upload-field" data-name="profile_photo">
                        <label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Recent Photo (Required) *</label>
                        <input type="file" name="profile_photo" accept=".jpg,.jpeg,.png,.pdf" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        <div class="progress-container hidden mt-3 h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-primary w-0 transition-all duration-300"></div>
                        </div>
                        <div class="status-msg text-[10px] font-bold mt-1 uppercase tracking-wider"></div>
                    </div>
                    <div class="upload-field" data-name="insurance_doc">
                        <label class="block text-[10px] font-black uppercase tracking-[2px] text-gray-400 mb-2">Travel Insurance Document</label>
                        <input type="file" name="insurance_doc" accept=".pdf,.jpg,.jpeg,.png" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-2xl focus:border-primary focus:outline-none transition font-medium">
                        <div class="progress-container hidden mt-3 h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-primary w-0 transition-all duration-300"></div>
                        </div>
                        <div class="status-msg text-[10px] font-bold mt-1 uppercase tracking-wider"></div>
                    </div>
                </div>
            </div>

            <!-- Section 7: Declaration & Submit -->
            <div class="p-10 md:p-16">
                <label class="flex items-start space-x-4 mb-10 cursor-pointer">
                    <input type="checkbox" required class="w-5 h-5 accent-primary mt-1">
                    <span class="text-gray-600 font-medium leading-relaxed">I confirm that all details and uploaded documents are accurate, valid, and ready for official travel/event processing.</span>
                </label>
                <button type="submit" class="w-full py-6 bg-secondary text-white font-black rounded-3xl transition-all uppercase tracking-[4px] text-sm">
                    <i class="fas fa-paper-plane mr-3"></i> Submit Application
                </button>

                <!-- Status Messages after Submit Button -->
                <?php if ($form_success): ?>
                <div class="mt-6 p-6 bg-emerald-50 rounded-2xl border border-emerald-200 text-center">
                    <p class="text-emerald-700 font-bold"><i class="fas fa-check-circle mr-2"></i> Registration Successful!</p>
                </div>
                <?php elseif ($form_message): ?>
                <div class="mt-6 p-6 bg-rose-50 rounded-2xl border border-rose-200 text-center">
                    <p class="text-rose-700 font-bold"><i class="fas fa-exclamation-circle mr-2"></i> <?php echo $form_message; ?></p>
                </div>
                <?php endif; ?>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<div class="py-20 bg-slate-50">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <div class="bg-white p-16 rounded-[40px] shadow-lg border border-gray-100">
            <div class="w-20 h-20 bg-rose-100 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl"><i class="fas fa-lock"></i></div>
            <h3 class="text-3xl font-black text-secondary mb-4">Registration Closed</h3>
            <p class="text-gray-500">The registration deadline for this event was <strong><?php echo date('F d, Y', strtotime($deadline)); ?></strong>.</p>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- Registration Form End -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadFields = document.querySelectorAll('.upload-field');
    const submitBtn = document.querySelector('button[type="submit"]');
    let activeUploads = 0;

    uploadFields.forEach(field => {
        const input = field.querySelector('input[type="file"]');
        const progressContainer = field.querySelector('.progress-container');
        const progressBar = field.querySelector('.progress-bar');
        const statusMsg = field.querySelector('.status-msg');
        const fieldName = field.getAttribute('data-name');
        const pathInput = document.getElementById(fieldName + '_path');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            // Size validation (5MB)
            if (file.size > 5 * 1024 * 1024) {
                statusMsg.textContent = 'Error: File too large (Max 5MB)';
                statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-rose-500';
                this.value = '';
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/upload_document.php', true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                }
            };

            xhr.onloadstart = function() {
                activeUploads++;
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                progressContainer.classList.remove('hidden');
                progressBar.style.width = '0%';
                statusMsg.textContent = 'Uploading...';
                statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-primary';
            };

            xhr.onload = function() {
                activeUploads--;
                if (activeUploads === 0) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }

                if (xhr.status === 200) {
                    const res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        pathInput.value = res.path;
                        statusMsg.textContent = 'Uploaded: ' + res.filename;
                        statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-emerald-500';
                        // Remove required attribute from the file input since it's already uploaded
                        input.required = false;
                    } else {
                        statusMsg.textContent = 'Error: ' + res.message;
                        statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-rose-500';
                    }
                } else {
                    statusMsg.textContent = 'Error: Upload failed';
                    statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-rose-500';
                }
            };

            xhr.onerror = function() {
                activeUploads--;
                if (activeUploads === 0) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
                statusMsg.textContent = 'Error: Connection error';
                statusMsg.className = 'status-msg text-[10px] font-bold mt-1 uppercase tracking-wider text-rose-500';
            };

            xhr.send(formData);
        });
    });
});
</script>
