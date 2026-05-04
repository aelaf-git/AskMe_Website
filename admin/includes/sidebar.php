<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-80 bg-dark min-h-screen flex flex-col sticky top-0 h-screen">
    <div class="p-10 flex items-center space-x-4 border-b border-white/5">
        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-primary/20 p-2">
            <img src="../assets/img/askme.png" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-white text-2xl font-black tracking-tighter">AskMe<span class="text-primary italic">.</span></h1>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Admin Control</p>
        </div>
    </div>
    
    <nav class="flex-1 px-6 py-10 space-y-2 overflow-y-auto custom-scrollbar">
        <div class="pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">Core</div>
        <a href="dashboard.php" class="sidebar-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-chart-line w-5 text-lg"></i>
            <span class="font-bold text-sm">Dashboard</span>
        </a>
        <a href="traffic.php" class="sidebar-link <?php echo ($current_page == 'traffic.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-tower-broadcast w-5 text-lg"></i>
            <span class="font-bold text-sm">Traffic Analysis</span>
        </a>

        <div class="pt-6 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">Inventory</div>
        <a href="packages.php" class="sidebar-link <?php echo ($current_page == 'packages.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-suitcase-rolling w-5 text-lg"></i>
            <span class="font-bold text-sm">Tours</span>
        </a>
        <a href="destinations.php" class="sidebar-link <?php echo ($current_page == 'destinations.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-map-location-dot w-5 text-lg"></i>
            <span class="font-bold text-sm">Destinations</span>
        </a>
        <a href="events.php" class="sidebar-link <?php echo ($current_page == 'events.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-calendar-star w-5 text-lg"></i>
            <span class="font-bold text-sm">Events</span>
        </a>

        <div class="pt-6 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">People</div>
        <a href="team.php" class="sidebar-link <?php echo ($current_page == 'team.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-user-group w-5 text-lg"></i>
            <span class="font-bold text-sm">Our Team</span>
        </a>
        <a href="testimonials.php" class="sidebar-link <?php echo ($current_page == 'testimonials.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-comment-dots w-5 text-lg"></i>
            <span class="font-bold text-sm">Reviews</span>
        </a>

        <div class="pt-6 pb-2 px-4 text-[10px] font-black uppercase tracking-[2px] text-gray-500">Engagement</div>
        <a href="messages.php" class="sidebar-link <?php echo ($current_page == 'messages.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-envelope-open-text w-5 text-lg"></i>
            <span class="font-bold text-sm">Messages</span>
        </a>
        <a href="newsletter.php" class="sidebar-link <?php echo ($current_page == 'newsletter.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-at w-5 text-lg"></i>
            <span class="font-bold text-sm">Newsletter</span>
        </a>
        <a href="registrations.php" class="sidebar-link <?php echo ($current_page == 'registrations.php') ? 'active' : ''; ?> flex items-center space-x-4 p-4 text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300">
            <i class="fas fa-ticket-alt w-5 text-lg"></i>
            <span class="font-bold text-sm">Bookings</span>
        </a>
    </nav>

    <div class="p-8 mt-auto">
        <a href="logout.php" class="flex items-center space-x-4 p-4 bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white rounded-2xl transition-all duration-300 group">
            <i class="fas fa-power-off text-lg group-hover:rotate-90 transition-transform duration-500"></i>
            <span class="font-black text-xs uppercase tracking-widest">Logout System</span>
        </a>
    </div>
</aside>
