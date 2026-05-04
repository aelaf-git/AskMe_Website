<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-80 bg-white border-r border-slate-100 flex flex-col sticky top-0 h-screen overflow-y-auto custom-scrollbar">
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
