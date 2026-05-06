<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside id="adminSidebar" class="w-80 bg-white border-r border-slate-100 flex flex-col fixed lg:sticky top-0 h-screen overflow-y-auto custom-scrollbar z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="p-10">
        <div class="flex items-center space-x-3 mb-10">
            <div class="w-10 h-10 bg-secondary rounded-xl flex items-center justify-center shadow-lg shadow-secondary/20">
                <img src="../assets/img/askme.png" class="w-6 h-6 invert brightness-0">
            </div>
            <div>
                <h1 class="text-xl font-black text-secondary tracking-tighter">AskMe.</h1>
                <p class="text-[9px] font-black text-primary uppercase tracking-[3px]">Admin Control</p>
            </div>
        </div>

        <nav class="space-y-2">
            <div class="pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Core</div>
            <a href="dashboard.php" class="sidebar-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-chart-pie w-5 text-lg"></i>
                <span class="font-bold text-sm">Dashboard</span>
            </a>
            <a href="traffic.php" class="sidebar-link <?php echo ($current_page == 'traffic.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-tower-broadcast w-5 text-lg"></i>
                <span class="font-bold text-sm">Traffic Analysis</span>
            </a>

            <div class="pt-8 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Inventory</div>
            <a href="packages.php" class="sidebar-link <?php echo ($current_page == 'packages.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-suitcase-rolling w-5 text-lg"></i>
                <span class="font-bold text-sm">Tours</span>
            </a>
            <a href="destinations.php" class="sidebar-link <?php echo ($current_page == 'destinations.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-map-location-dot w-5 text-lg"></i>
                <span class="font-bold text-sm">Destinations</span>
            </a>
            <a href="events.php" class="sidebar-link <?php echo ($current_page == 'events.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-calendar-star w-5 text-lg"></i>
                <span class="font-bold text-sm">Events</span>
            </a>

            <div class="pt-8 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-slate-400">Engagement</div>
            <a href="messages.php" class="sidebar-link <?php echo ($current_page == 'messages.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-envelope-open-text w-5 text-lg"></i>
                <span class="font-bold text-sm">Messages</span>
            </a>
            <a href="registrations.php" class="sidebar-link <?php echo ($current_page == 'registrations.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-id-card w-5 text-lg"></i>
                <span class="font-bold text-sm">Tour Bookings</span>
            </a>
            <a href="custom_trip_requests.php" class="sidebar-link <?php echo ($current_page == 'custom_trip_requests.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-plane-departure w-5 text-lg"></i>
                <span class="font-bold text-sm">Custom Trips</span>
            </a>
            <a href="event_registrations.php" class="sidebar-link <?php echo ($current_page == 'event_registrations.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-clipboard-list w-5 text-lg"></i>
                <span class="font-bold text-sm">Event Bookings</span>
            </a>
            <a href="newsletter.php" class="sidebar-link <?php echo ($current_page == 'newsletter.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-paper-plane w-5 text-lg"></i>
                <span class="font-bold text-sm">Newsletter</span>
            </a>

            <div class="pt-8 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-slate-400">People</div>
            <a href="change_password.php" class="sidebar-link <?php echo ($current_page == 'change_password.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-key w-5 text-lg"></i>
                <span class="font-bold text-sm">Change Password</span>
            </a>
            <a href="team.php" class="sidebar-link <?php echo ($current_page == 'team.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-users-gear w-5 text-lg"></i>
                <span class="font-bold text-sm">Our Team</span>
            </a>
            <a href="testimonials.php" class="sidebar-link <?php echo ($current_page == 'testimonials.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-slate-400 hover:text-secondary hover:bg-slate-50 rounded-2xl transition-all duration-300">
                <i class="fas fa-comment-dots w-5 text-lg"></i>
                <span class="font-bold text-sm">Reviews</span>
            </a>
        </nav>
    </div>

    <div class="mt-auto p-10">
        <a href="logout.php" class="flex items-center space-x-4 p-5 bg-rose-50 text-rose-500 rounded-[24px] hover:bg-rose-500 hover:text-white transition-all duration-500 group shadow-sm hover:shadow-lg hover:shadow-rose-500/20">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm group-hover:bg-rose-400 transition-colors">
                <i class="fas fa-power-off"></i>
            </div>
            <span class="font-black text-[10px] uppercase tracking-[2px]">Logout System</span>
        </a>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden opacity-0 transition-opacity duration-300"></div>

<!-- Cropper.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const isClosed = sidebar.classList.contains('-translate-x-full');
    
    if (isClosed) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
    } else {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
    }
}

document.addEventListener('DOMContentLoaded', initTinyMCE);

// Universal Image Cropping System
let cropper = null;
let currentCropInput = null;
let currentCropPreview = null;

function openCropModal(input, preview, ratio = 16/9) {
    currentCropInput = input;
    currentCropPreview = preview;
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const modal = document.getElementById('cropperModal');
        const image = document.getElementById('cropperImage');
        image.src = e.target.result;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        if (cropper) cropper.destroy();
        cropper = new Cropper(image, {
            aspectRatio: ratio,
            viewMode: 2,
            dragMode: 'move',
            background: false
        });
    };
    reader.readAsDataURL(file);
}

function applyCrop() {
    if (!cropper) return;
    const canvas = cropper.getCroppedCanvas({
        width: 1200,
        height: 675,
    });
    
    canvas.toBlob((blob) => {
        const file = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });
        const container = new DataTransfer();
        container.items.add(file);
        currentCropInput.files = container.files;
        
        if (currentCropPreview) {
            currentCropPreview.src = URL.createObjectURL(blob);
        }
        
        closeCropModal();
    }, 'image/jpeg', 0.9);
}

function closeCropModal() {
    document.getElementById('cropperModal').classList.add('hidden');
    document.getElementById('cropperModal').classList.remove('flex');
    if (cropper) cropper.destroy();
}
</script>

<!-- Cropper Modal -->
<div id="cropperModal" class="fixed inset-0 bg-slate-900/90 z-[200] hidden items-center justify-center p-4">
    <div class="bg-white rounded-[40px] w-full max-w-4xl overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-white">
            <h3 class="text-xl font-black text-secondary uppercase tracking-tighter">Adjust <span class="text-primary">Image</span></h3>
            <button onclick="closeCropModal()" class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-500 transition-all"><i class="fas fa-times"></i></button>
        </div>
        <div class="flex-1 overflow-hidden bg-slate-900 flex items-center justify-center">
            <img id="cropperImage" class="max-w-full">
        </div>
        <div class="p-8 border-t border-slate-100 bg-white flex justify-end space-x-4">
            <button onclick="closeCropModal()" class="px-8 py-4 bg-slate-100 text-slate-400 font-black rounded-2xl uppercase tracking-widest text-xs">Cancel</button>
            <button onclick="applyCrop()" class="px-10 py-4 bg-primary text-white font-black rounded-2xl shadow-xl shadow-primary/20 hover:-translate-y-1 transition-all uppercase tracking-widest text-xs">Apply Crop</button>
        </div>
    </div>
</div>

