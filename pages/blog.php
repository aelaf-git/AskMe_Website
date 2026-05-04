<!-- Header Start -->
<div class="relative w-full pt-32 md:pt-48 pb-24 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="assets/img/carousel-1.jpg" class="w-full h-full object-cover opacity-20 scale-110">
        <div class="absolute inset-0 bg-gradient-to-b from-dark via-transparent to-dark"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <div class="inline-block px-4 py-2 glass rounded-xl text-xs font-black uppercase tracking-[3px] text-primary mb-6 animate-fade-in">AskMe Experience</div>
        <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter mb-8 animate-slide-up"><?php echo $pageTitle; ?></h1>
        <div class="flex items-center justify-center space-x-4">
            <a href="index.php" class="text-white/50 hover:text-primary font-bold transition-colors">Home</a>
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            <span class="text-primary font-bold uppercase tracking-widest text-xs"><?php echo $pageTitle; ?></span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Blog Start -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-8/12 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php
                    $posts = [
                        ['Exploring the ancient mysteries of Lalibela.', 'assets/img/blog-1.jpg', '01', 'Jan'],
                        ['Wildlife adventures in the Semien Mountains.', 'assets/img/blog-2.jpg', '02', 'Jan'],
                        ['A journey through the historical castles of Gondar.', 'assets/img/blog-3.jpg', '03', 'Jan'],
                        ['The colorful cultures of the Omo Valley tribes.', 'assets/img/blog-1.jpg', '04', 'Jan'],
                    ];
                    foreach ($posts as $post):
                    ?>
                    <div class="bg-white shadow-lg overflow-hidden group">
                        <div class="relative overflow-hidden h-64">
                            <img src="<?php echo $post[1]; ?>" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4 bg-primary text-white px-4 py-2 font-bold shadow-lg text-center">
                                <h6 class="font-bold text-white mb-0"><?php echo $post[2]; ?></h6>
                                <small class="uppercase text-[10px]"><?php echo $post[3]; ?></small>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center text-primary text-xs uppercase font-bold mb-4">
                                <span>Admin</span>
                                <span class="mx-2">|</span>
                                <span>Tours & Travel</span>
                            </div>
                            <a href="index.php?p=single" class="text-xl font-bold hover:text-primary transition-colors leading-tight block mb-4"><?php echo $post[0]; ?></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-12 space-x-2">
                    <a href="#" class="w-10 h-10 border border-gray-200 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fa fa-angle-double-left"></i></a>
                    <a href="#" class="w-10 h-10 bg-primary text-white flex items-center justify-center">1</a>
                    <a href="#" class="w-10 h-10 border border-gray-200 flex items-center justify-center hover:bg-primary hover:text-white transition-all">2</a>
                    <a href="#" class="w-10 h-10 border border-gray-200 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-4/12 px-4 mt-12 lg:mt-0">
                <div class="bg-white p-8 shadow-lg text-center mb-10">
                    <img src="assets/img/nobody.jpg" class="w-24 h-24 mx-auto mb-6 rounded-full object-cover">
                    <h3 class="text-2xl font-bold text-primary mb-4">AskMe Team</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Our team is dedicated to providing you with the best travel insights and experiences in Ethiopia.</p>
                    <div class="flex justify-center space-x-3 text-primary">
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="bg-white p-8 shadow-lg mb-10">
                    <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Categories</h4>
                    <ul class="space-y-4 text-gray-600 font-medium">
                        <li><a href="#" class="hover:text-primary transition-colors flex justify-between">Travel Guides <span>(12)</span></a></li>
                        <li><a href="#" class="hover:text-primary transition-colors flex justify-between">Destinations <span>(8)</span></a></li>
                        <li><a href="#" class="hover:text-primary transition-colors flex justify-between">Culture <span>(5)</span></a></li>
                    </ul>
                </div>

                <div class="bg-white p-8 shadow-lg">
                    <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Recent Posts</h4>
                    <div class="space-y-6">
                        <a href="#" class="flex items-center group">
                            <img src="assets/img/blog-100x100.jpg" class="w-20 h-20 object-cover">
                            <div class="ml-4">
                                <h6 class="font-bold group-hover:text-primary transition-colors leading-tight">Exploring the ancient mysteries of Lalibela.</h6>
                                <small class="text-gray-500">Jan 01, 2026</small>
                            </div>
                        </a>
                        <a href="#" class="flex items-center group">
                            <img src="assets/img/blog-100x100.jpg" class="w-20 h-20 object-cover">
                            <div class="ml-4">
                                <h6 class="font-bold group-hover:text-primary transition-colors leading-tight">Wildlife adventures in the Semien Mountains.</h6>
                                <small class="text-gray-500">Jan 01, 2026</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->