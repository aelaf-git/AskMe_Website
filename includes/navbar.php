<!-- Navbar Start -->
    <div class="fixed top-0 left-0 right-0 z-[100] px-4 py-6 pointer-events-none">
        <div class="max-w-7xl mx-auto pointer-events-auto">
            <nav class="glass px-4 md:px-8 py-3 md:py-4 rounded-[20px] md:rounded-3xl shadow-2xl flex items-center justify-between transition-all duration-500 hover:shadow-primary/20">
                <a href="index.php" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-1 shadow-md group-hover:rotate-6 transition-transform duration-300">
                        <img src="assets/img/askme.png" alt="AskMe Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-dark">
                        <span class="text-primary">Ask</span>Me
                    </span>
                </a>

                <!-- Desktop Nav -->
                <div id="nav-content" class="hidden lg:flex items-center space-x-1">
                    <a href="index.php" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 <?php echo (!isset($_GET['p']) || $_GET['p'] == 'home') ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:bg-primary/10 hover:text-primary'; ?>">Home</a>
                    <a href="index.php?p=about" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 <?php echo (isset($_GET['p']) && $_GET['p'] == 'about') ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:bg-primary/10 hover:text-primary'; ?>">About</a>
                    <a href="index.php?p=service" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 <?php echo (isset($_GET['p']) && $_GET['p'] == 'service') ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:bg-primary/10 hover:text-primary'; ?>">Services</a>
                    <a href="index.php?p=package" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 <?php echo (isset($_GET['p']) && $_GET['p'] == 'package') ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:bg-primary/10 hover:text-primary'; ?>">Packages</a>
                    
                    <div class="relative group mx-2 h-full py-2">
                        <button class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-primary/10 hover:text-primary flex items-center transition-all duration-300">
                            Explore <i class="fa fa-angle-down ml-2 group-hover:rotate-180 transition-transform"></i>
                        </button>
                        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-56 glass rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 p-2 border border-white/50">
                            <a href="index.php?p=blog" class="block py-3 px-4 rounded-xl text-sm font-bold text-slate-600 hover:bg-primary hover:text-white transition-all">Latest Stories</a>
                            <a href="index.php?p=destination" class="block py-3 px-4 rounded-xl text-sm font-bold text-slate-600 hover:bg-primary hover:text-white transition-all">Top Destinations</a>
                            <a href="index.php?p=guide" class="block py-3 px-4 rounded-xl text-sm font-bold text-slate-600 hover:bg-primary hover:text-white transition-all">Travel Guides</a>
                            <a href="index.php?p=testimonial" class="block py-3 px-4 rounded-xl text-sm font-bold text-slate-600 hover:bg-primary hover:text-white transition-all">Client Stories</a>
                        </div>
                    </div>

                    <a href="index.php?p=contact" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 <?php echo (isset($_GET['p']) && $_GET['p'] == 'contact') ? 'bg-primary text-white shadow-md' : 'text-slate-600 hover:bg-primary/10 hover:text-primary'; ?>">Contact</a>
                </div>

                <!-- Mobile Toggle -->
                <button id="nav-toggle" class="lg:hidden w-11 h-11 flex items-center justify-center rounded-xl bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all">
                    <i class="fa fa-bars text-lg"></i>
                </button>
            </nav>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 z-[99] glass-dark opacity-0 invisible transition-all duration-300 flex flex-col items-center justify-center">
        <button id="nav-close" class="absolute top-8 right-8 w-12 h-12 flex items-center justify-center text-white/50 hover:text-white text-2xl">
            <i class="fas fa-times"></i>
        </button>
        <div class="space-y-6 text-center">
            <a href="index.php" class="block text-4xl font-black text-white hover:text-primary transition-colors">Home</a>
            <a href="index.php?p=about" class="block text-4xl font-black text-white hover:text-primary transition-colors">About</a>
            <a href="index.php?p=service" class="block text-4xl font-black text-white hover:text-primary transition-colors">Services</a>
            <a href="index.php?p=package" class="block text-4xl font-black text-white hover:text-primary transition-colors">Packages</a>
            <a href="index.php?p=contact" class="block text-4xl font-black text-white hover:text-primary transition-colors">Contact</a>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('nav-toggle');
        const close = document.getElementById('nav-close');
        const menu = document.getElementById('mobile-menu');

        toggle.onclick = () => {
            menu.classList.remove('invisible', 'opacity-0');
            menu.classList.add('visible', 'opacity-100');
        };

        close.onclick = () => {
            menu.classList.remove('visible', 'opacity-100');
            menu.classList.add('invisible', 'opacity-0');
        };

        // Scroll effect
        window.onscroll = function() {
            const nav = document.querySelector('nav');
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                nav.classList.add('py-2', 'px-4', 'scale-95');
                nav.classList.remove('py-3', 'md:py-4', 'px-4', 'md:px-8');
            } else {
                nav.classList.remove('py-2', 'px-4', 'scale-95');
                nav.classList.add('py-3', 'md:py-4', 'px-4', 'md:px-8');
            }
        };
    </script>
    <!-- Navbar End -->