<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="w-72 bg-dark text-white flex flex-col p-6 shadow-2xl z-20 sticky top-0 h-screen">
    <div class="mb-10 px-2 flex items-center space-x-3">
        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center p-1.5">
            <img src="../assets/img/askme.png" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-2xl font-black tracking-tighter"><span class="text-primary">Ask</span>Me</h1>
            <p class="text-gray-500 text-[8px] uppercase tracking-[3px] font-bold">Admin Portal</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto pr-2 custom-scrollbar">
        <a href="dashboard.php" class="sidebar-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 rounded-xl transition-all duration-300">
            <i class="fas fa-chart-line w-5"></i>
            <span class="font-bold text-sm">Dashboard</span>
        </a>
        <div class="pt-4 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">Management</div>
        <a href="packages.php" class="sidebar-link <?php echo $current_page == 'packages.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-suitcase-rolling w-5"></i>
            <span class="font-bold text-sm">Tour Packages</span>
        </a>
        <a href="destinations.php" class="sidebar-link <?php echo $current_page == 'destinations.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-map-marked-alt w-5"></i>
            <span class="font-bold text-sm">Destinations</span>
        </a>
        <a href="events.php" class="sidebar-link <?php echo $current_page == 'events.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-calendar-star w-5"></i>
            <span class="font-bold text-sm">Upcoming Events</span>
        </a>
        <a href="services.php" class="sidebar-link <?php echo $current_page == 'services.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-concierge-bell w-5"></i>
            <span class="font-bold text-sm">Services</span>
        </a>
        <a href="team.php" class="sidebar-link <?php echo $current_page == 'team.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-users-gear w-5"></i>
            <span class="font-bold text-sm">Team Members</span>
        </a>
        <a href="testimonials.php" class="sidebar-link <?php echo $current_page == 'testimonials.php' ? 'active' : ''; ?> flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-comment-dots w-5"></i>
            <span class="font-bold text-sm">Testimonials</span>
        </a>

        <div class="pt-4 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">Inquiries</div>
        <a href="dashboard.php#messages" class="sidebar-link flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-envelope-open-text w-5"></i>
            <span class="font-bold text-sm">Messages</span>
        </a>
        <a href="dashboard.php#newsletter" class="sidebar-link flex items-center space-x-4 p-3.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-300">
            <i class="fas fa-at w-5"></i>
            <span class="font-bold text-sm">Subscribers</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-white/10 mt-4">
        <a href="logout.php" class="flex items-center space-x-4 p-4 text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all duration-300 font-black text-sm">
            <i class="fas fa-power-off"></i>
            <span>Logout System</span>
        </a>
    </div>
</div>
