    <!-- Footer Start -->
    <footer class="bg-dark pt-32 pb-12 relative overflow-hidden">
        <!-- Creative Logo Background -->
        <div class="absolute -right-20 -bottom-20 opacity-[0.03] rotate-12 pointer-events-none">
            <img src="assets/img/askme.png" alt="" class="w-[600px] h-[600px] object-contain">
        </div>
        
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-30"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20">
                <div class="lg:col-span-2 space-y-10">
                    <a href="index.php" class="flex items-center space-x-4 group">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center p-2 shadow-premium group-hover:rotate-6 transition-transform duration-300">
                            <img src="assets/img/askme.png" alt="AskMe Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="text-3xl md:text-4xl font-black tracking-tighter text-white">
                            <span class="text-primary">Ask</span><span class="text-secondary">Me</span>
                        </span>
                    </a>
                    <p class="text-xl text-slate-400 max-w-xl leading-relaxed">
                        Redefining travel through innovation and authentic experiences. Discover the hidden gems of Ethiopia and the world with AskMe Tour and Travel.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=61584212512348&mibextid=ZbWKwL" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="w-14 h-14 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <div class="space-y-10">
                    <h5 class="text-white font-black uppercase tracking-[3px] text-sm flex items-center">
                        <span class="w-8 h-1 bg-primary mr-4 rounded-full"></span>
                        Quick Navigation
                    </h5>
                    <div class="grid grid-cols-1 gap-4">
                        <a href="index.php?p=about" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-[10px] mr-3 text-primary opacity-0 group-hover:opacity-100 transition-all"></i>
                            About Our Vision
                        </a>
                        <a href="index.php?p=package" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-[10px] mr-3 text-primary opacity-0 group-hover:opacity-100 transition-all"></i>
                            Premium Packages
                        </a>
                        <a href="index.php?p=destination" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-[10px] mr-3 text-primary opacity-0 group-hover:opacity-100 transition-all"></i>
                            Top Destinations
                        </a>
                        <a href="index.php?p=contact" class="text-slate-400 hover:text-primary transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-[10px] mr-3 text-primary opacity-0 group-hover:opacity-100 transition-all"></i>
                            Get In Touch
                        </a>
                    </div>
                </div>

                <div class="space-y-10">
                    <h5 class="text-white font-black uppercase tracking-[3px] text-sm flex items-center">
                        <span class="w-8 h-1 bg-secondary mr-4 rounded-full"></span>
                        Newsletter
                    </h5>
                    <p class="text-slate-400 text-sm leading-relaxed">Stay updated with our latest offers and travel tips. Subscribe to our journey.</p>
                    <form id="newsletterForm" class="relative group">
                        <input name="Email" type="email" placeholder="Your email address" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-6 pr-14 text-white focus:outline-none focus:border-primary transition-all" required>
                        <button type="submit" class="absolute right-2 top-2 bottom-2 w-10 bg-primary text-white rounded-xl hover:scale-105 transition-all">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
                <p class="text-slate-500 text-sm">
                    &copy; <?php echo date('Y'); ?> <span class="text-white font-bold">AskMe Tour and Travel</span>. Crafted for adventure.
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