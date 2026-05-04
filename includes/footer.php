    <!-- Footer Start -->
    <footer class="bg-dark pt-32 pb-12 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-30"></div>
        
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20">
                <div class="lg:col-span-2 space-y-10">
                    <a href="index.php" class="flex items-center space-x-3 group">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-md group-hover:rotate-12 transition-transform duration-300">
                            <i class="fas fa-paper-plane text-white text-xl"></i>
                        </div>
                        <span class="text-3xl font-black tracking-tighter text-white">
                            <span class="text-primary">Ask</span>Me
                        </span>
                    </a>
                    <p class="text-xl text-slate-400 max-w-xl leading-relaxed">
                        Redefining travel through innovation and authentic experiences. Discover the hidden gems of Ethiopia and the world with AskMe Tour and Travel.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=61584212512348&mibextid=ZbWKwL" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary hover:shadow-md transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary hover:shadow-md transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary hover:shadow-md transition-all duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="space-y-10">
                    <h5 class="text-white font-black uppercase tracking-[3px] text-sm">Quick Navigation</h5>
                    <div class="grid grid-cols-1 gap-4">
                        <a href="index.php?p=about" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <span class="w-2 h-0.5 bg-primary mr-3 opacity-0 group-hover:opacity-100 transition-all"></span>
                            About Our Vision
                        </a>
                        <a href="index.php?p=package" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <span class="w-2 h-0.5 bg-primary mr-3 opacity-0 group-hover:opacity-100 transition-all"></span>
                            Premium Packages
                        </a>
                        <a href="index.php?p=destination" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <span class="w-2 h-0.5 bg-primary mr-3 opacity-0 group-hover:opacity-100 transition-all"></span>
                            Top Destinations
                        </a>
                        <a href="index.php?p=contact" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <span class="w-2 h-0.5 bg-primary mr-3 opacity-0 group-hover:opacity-100 transition-all"></span>
                            Get In Touch
                        </a>
                    </div>
                </div>

                <div class="space-y-10">
                    <h5 class="text-white font-black uppercase tracking-[3px] text-sm">Newsletter</h5>
                    <p class="text-slate-400 text-sm">Stay updated with our latest offers and travel tips.</p>
                    <form id="newsletterForm" class="relative group">
                        <input name="Email" type="email" placeholder="Your email address" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-6 pr-14 text-white focus:outline-none focus:border-primary transition-all" required>
                        <button type="submit" class="absolute right-2 top-2 bottom-2 w-10 bg-primary text-white rounded-xl hover:shadow-md transition-all">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
                <p class="text-slate-500 text-sm">
                    &copy; <?php echo date('Y'); ?> <span class="text-white font-bold">AskMe Tour and Travel</span>. All rights reserved.
                </p>
                <div class="flex space-x-8 text-slate-500 text-xs font-bold tracking-widest uppercase">
                    <a href="#" class="hover:text-primary transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-primary transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" id="back-to-top" class="fixed bottom-8 right-8 w-14 h-14 glass text-white flex items-center justify-center rounded-2xl shadow-2xl opacity-0 scale-75 transition-all duration-500 z-[1000] hover:bg-primary hover:shadow-md">
        <i class="fa fa-chevron-up"></i>
    </a>

    <script>
        window.onscroll = function() {
            const btn = document.getElementById('back-to-top');
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                btn.classList.add('opacity-100', 'scale-100');
                btn.classList.remove('opacity-0', 'scale-75');
            } else {
                btn.classList.remove('opacity-100', 'scale-100');
                btn.classList.add('opacity-0', 'scale-75');
            }
        };
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form.js"></script>
</body>
</html>