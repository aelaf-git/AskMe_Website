<?php
require_once 'includes/db.php';

$form_message = '';
$form_success = false;

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
    $form_message = 'Database setup issue detected. Please contact admin.';
}

if (isset($_GET['submitted']) && $_GET['submitted'] === '1') {
    $form_success = true;
    $form_message = 'Application submitted successfully.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['custom_trip_submit'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO custom_trip_requests (
            full_name, email, phone, nationality, residence_country, travelers_count, destination_country, destination_cities,
            departure_date, return_date, date_flexibility, budget_range, trip_purpose, accommodation_preference, transport_preference,
            has_valid_passport, needs_visa_assistance, previous_international_travel, previous_countries, emergency_contact_name,
            emergency_contact_phone, special_requirements, additional_notes
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->execute([
            trim($_POST['full_name'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['phone'] ?? ''),
            trim($_POST['nationality'] ?? ''),
            trim($_POST['residence_country'] ?? ''),
            (int)($_POST['travelers_count'] ?? 1),
            trim($_POST['destination_country'] ?? ''),
            trim($_POST['destination_cities'] ?? ''),
            $_POST['departure_date'] ?? null,
            $_POST['return_date'] ?? null,
            trim($_POST['date_flexibility'] ?? 'Fixed dates'),
            trim($_POST['budget_range'] ?? ''),
            trim($_POST['trip_purpose'] ?? ''),
            trim($_POST['accommodation_preference'] ?? ''),
            trim($_POST['transport_preference'] ?? ''),
            isset($_POST['has_valid_passport']) ? 1 : 0,
            isset($_POST['needs_visa_assistance']) ? 1 : 0,
            isset($_POST['previous_international_travel']) ? 1 : 0,
            trim($_POST['previous_countries'] ?? ''),
            trim($_POST['emergency_contact_name'] ?? ''),
            trim($_POST['emergency_contact_phone'] ?? ''),
            trim($_POST['special_requirements'] ?? ''),
            trim($_POST['additional_notes'] ?? '')
        ]);

        header('Location: index.php?p=custom_trip&submitted=1');
        exit();
    } catch (PDOException $e) {
        $form_message = 'Unable to submit your application right now. Please try again.';
    }
}
?>

<div class="relative w-full pt-32 md:pt-44 pb-20 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="assets/img/africa.jpg" class="w-full h-full object-cover opacity-25">
        <div class="absolute inset-0 bg-gradient-to-b from-dark/90 to-dark"></div>
    </div>
    <div class="max-w-6xl mx-auto px-4 relative z-10 text-center">
        <div class="inline-block px-4 py-2 glass rounded-xl text-xs font-black uppercase tracking-[3px] text-primary mb-5">AskMe Private Travel</div>
        <h1 class="text-4xl md:text-7xl font-black text-white tracking-tight mb-6">Book a Custom Trip</h1>
        <p class="text-slate-300 max-w-2xl mx-auto">Planning a trip outside AskMe events? Submit your preferences and we will build your itinerary.</p>
    </div>
</div>

<div class="py-20 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4">
        <?php if ($form_message): ?>
        <div class="mb-8 p-5 rounded-2xl font-bold text-center <?php echo $form_success ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200'; ?>">
            <?php echo $form_message; ?>
        </div>
        <?php endif; ?>

        <?php if (!$form_success): ?>
        <form method="POST" class="bg-white rounded-[32px] border border-slate-100 overflow-hidden">
            <input type="hidden" name="custom_trip_submit" value="1">

            <div class="p-8 md:p-12 border-b border-slate-100">
                <h3 class="text-2xl font-black text-secondary mb-2">1. Traveler Information</h3>
                <p class="text-sm text-slate-500 mb-6">Basic traveler and contact details.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div><label class="block text-xs font-bold mb-2">Full Name *</label><input type="text" name="full_name" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Email *</label><input type="email" name="email" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Phone *</label><input type="tel" name="phone" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Number of Travelers *</label><input type="number" name="travelers_count" min="1" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Nationality *</label><input type="text" name="nationality" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Country of Residence *</label><input type="text" name="residence_country" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                </div>
            </div>

            <div class="p-8 md:p-12 border-b border-slate-100">
                <h3 class="text-2xl font-black text-secondary mb-2">2. Trip Plan</h3>
                <p class="text-sm text-slate-500 mb-6">Tell us where and when you want to travel.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div><label class="block text-xs font-bold mb-2">Destination Country *</label><input type="text" name="destination_country" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">City / Cities *</label><input type="text" name="destination_cities" required placeholder="e.g. Paris, Nice" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Departure Date *</label><input type="date" name="departure_date" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Return Date *</label><input type="date" name="return_date" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Date Flexibility *</label><select name="date_flexibility" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"><option>Fixed dates</option><option>Flexible +/- 3 days</option><option>Flexible +/- 7 days</option></select></div>
                    <div><label class="block text-xs font-bold mb-2">Estimated Budget (USD) *</label><input type="text" name="budget_range" required placeholder="e.g. 1500 - 2500 per traveler" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Trip Purpose *</label><select name="trip_purpose" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"><option value="">Select</option><option>Leisure</option><option>Business</option><option>Family Visit</option><option>Honeymoon</option><option>Education</option></select></div>
                    <div><label class="block text-xs font-bold mb-2">Accommodation Preference *</label><select name="accommodation_preference" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"><option value="">Select</option><option>3 Star Hotel</option><option>4 Star Hotel</option><option>5 Star Hotel</option><option>Apartment</option><option>No Preference</option></select></div>
                </div>
            </div>

            <div class="p-8 md:p-12 border-b border-slate-100">
                <h3 class="text-2xl font-black text-secondary mb-2">3. Travel Documents & Safety</h3>
                <p class="text-sm text-slate-500 mb-6">Visa/passport and emergency details.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 bg-slate-50"><span class="text-sm font-bold">I have a valid passport</span><input type="checkbox" name="has_valid_passport" value="1" class="w-5 h-5 accent-primary"></label>
                    <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 bg-slate-50"><span class="text-sm font-bold">I need visa assistance</span><input type="checkbox" name="needs_visa_assistance" value="1" class="w-5 h-5 accent-primary"></label>
                    <label class="flex items-center justify-between p-4 rounded-xl border border-slate-200 bg-slate-50"><span class="text-sm font-bold">I have traveled internationally before</span><input type="checkbox" name="previous_international_travel" value="1" class="w-5 h-5 accent-primary"></label>
                    <div><label class="block text-xs font-bold mb-2">Preferred Transport *</label><select name="transport_preference" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"><option value="">Select</option><option>Economy Flight</option><option>Business Class Flight</option><option>No Preference</option></select></div>
                    <div class="md:col-span-2"><label class="block text-xs font-bold mb-2">Countries Visited Before</label><textarea name="previous_countries" rows="2" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></textarea></div>
                    <div><label class="block text-xs font-bold mb-2">Emergency Contact Name *</label><input type="text" name="emergency_contact_name" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div><label class="block text-xs font-bold mb-2">Emergency Contact Phone *</label><input type="tel" name="emergency_contact_phone" required class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></div>
                    <div class="md:col-span-2"><label class="block text-xs font-bold mb-2">Special Requirements</label><textarea name="special_requirements" rows="2" placeholder="Dietary, accessibility, medical, kids/seniors, etc." class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></textarea></div>
                    <div class="md:col-span-2"><label class="block text-xs font-bold mb-2">Additional Notes</label><textarea name="additional_notes" rows="3" class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-primary"></textarea></div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <button type="submit" class="w-full py-4 bg-secondary text-white font-black rounded-2xl uppercase tracking-wider">Submit Custom Trip Request</button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>
