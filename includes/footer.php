    <!-- Footer Start -->
    <footer class="bg-dark text-gray-400 pt-20">
        <div class="max-w-7xl mx-auto px-4 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div>
                    <a href="index.php" class="block mb-8">
                        <h1 class="text-3xl font-bold text-primary"><span class="text-white">Ask</span>Me</h1>
                    </a>
                    <p class="mb-8 leading-relaxed">Discover Ethiopia and beyond with AskMe Tour and Travel, your trusted partner for unforgettable, safe, and culturally immersive travel experiences.</p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=61584212512348&mibextid=ZbWKwL" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white uppercase tracking-[5px] font-bold mb-8">Useful Links</h5>
                    <div class="flex flex-col space-y-3">
                        <a href="index.php?p=about" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> About</a>
                        <a href="index.php?p=destination" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Destination</a>
                        <a href="index.php?p=service" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Services</a>
                        <a href="index.php?p=package" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Packages</a>
                        <a href="index.php?p=guide" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Guides</a>
                        <a href="index.php?p=testimonial" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Testimonial</a>
                        <a href="index.php?p=blog" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Blog</a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white uppercase tracking-[5px] font-bold mb-8">Contact Us</h5>
                    <div class="space-y-4">
                        <p class="flex items-center"><i class="fa fa-map-marker-alt mr-3 text-primary"></i> Addis Ababa, Ethiopia</p>
                        <p class="flex items-center"><i class="fa fa-phone-alt mr-3 text-primary"></i> +251 91 112 4715</p>
                        <p class="flex items-center"><i class="fa fa-envelope mr-3 text-primary"></i> info@askmetour.org</p>
                    </div>
                    <div class="mt-8">
                        <h6 class="text-white uppercase tracking-[5px] font-bold mb-4">Newsletter</h6>
                        <form id="newsletterForm" class="flex">
                            <input name="Email" type="email" class="w-full p-4 bg-white/10 border-0 focus:ring-0 text-white placeholder-gray-500" placeholder="Your Email" required>
                            <button class="bg-primary text-white px-6 hover:bg-primary-dark transition-colors" type="submit">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-6">
            <div class="max-w-7xl mx-auto px-4 text-center md:text-left">
                <p class="m-0 text-sm">Copyright &copy; <a href="http://www.askmetour.org" class="text-white hover:text-primary">AskMe Tour and Travel</a>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white flex items-center justify-center shadow-2xl opacity-0 transition-opacity duration-300 z-[1000]">
        <i class="fa fa-angle-double-up"></i>
    </a>

    <script>
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                document.getElementById('back-to-top').classList.add('opacity-100');
            } else {
                document.getElementById('back-to-top').classList.remove('opacity-100');
            }
        };
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form.js"></script>
</body>
</html>