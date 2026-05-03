<?php 
    $pageTitle = "Blog";
    include 'includes/head.php';
    include 'includes/topbar.php';
    include 'includes/navbar.php';
?>

    <!-- Header Start -->
    <div class="relative w-full py-24 bg-dark overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="img/carousel-1.jpg" class="w-full h-full object-cover opacity-40">
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">Our Blog</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">Blog</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-8/12 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                        <?php
                        $blogs = [
                            ['Exploring the ancient mysteries of Lalibela.', 'img/blog-1.jpg', '01', 'Jan'],
                            ['Wildlife adventures in the Semien Mountains.', 'img/blog-2.jpg', '02', 'Jan'],
                            ['A journey through the historical castles of Gondar.', 'img/blog-3.jpg', '03', 'Jan'],
                        ];
                        foreach ($blogs as $blog):
                        ?>
                        <div class="bg-white shadow-lg overflow-hidden group">
                            <div class="relative overflow-hidden h-64">
                                <img src="<?php echo $blog[1]; ?>" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute bottom-0 left-0 bg-primary text-white p-3 text-center">
                                    <h6 class="font-bold leading-none mb-1"><?php echo $blog[2]; ?></h6>
                                    <small class="uppercase text-[10px]"><?php echo $blog[3]; ?></small>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center text-primary text-xs uppercase font-bold mb-4">
                                    <span>Admin</span>
                                    <span class="mx-2">|</span>
                                    <span>Tours & Travel</span>
                                </div>
                                <a href="" class="text-xl font-bold hover:text-primary transition-colors leading-tight block mb-4"><?php echo $blog[0]; ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex justify-center space-x-2">
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-colors">&laquo;</a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-primary text-white">1</a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-colors">2</a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-colors">3</a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-colors">&raquo;</a>
                    </div>
                </div>
    
                <!-- Sidebar -->
                <div class="w-full lg:w-4/12 px-4 mt-12 lg:mt-0">
                    <!-- Author -->
                    <div class="bg-white p-8 shadow-lg text-center mb-10">
                        <img src="img/nobody.jpg" class="w-24 h-24 mx-auto mb-6 rounded-full object-cover">
                        <h3 class="text-2xl font-bold text-primary mb-4">AskMe Team</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">We are a team of passionate travel experts dedicated to sharing the beauty and culture of Ethiopia with the world.</p>
                        <div class="flex justify-center space-x-3 text-primary">
                            <a href="#" class="hover:text-dark transition-colors"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="hover:text-dark transition-colors"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="hover:text-dark transition-colors"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="hover:text-dark transition-colors"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
    
                    <!-- Search -->
                    <div class="bg-white p-8 shadow-lg mb-10">
                        <div class="flex border border-gray-200">
                            <input type="text" class="w-full p-4 focus:outline-none" placeholder="Keyword">
                            <button class="bg-primary text-white px-6"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white p-8 shadow-lg mb-10">
                        <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Categories</h4>
                        <div class="space-y-4">
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary transition-colors font-medium">
                                <span><i class="fa fa-angle-right mr-2 text-primary"></i> Historic Sites</span>
                                <span class="bg-gray-100 px-3 py-1 text-xs">15</span>
                            </a>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary transition-colors font-medium">
                                <span><i class="fa fa-angle-right mr-2 text-primary"></i> Adventure</span>
                                <span class="bg-gray-100 px-3 py-1 text-xs">10</span>
                            </a>
                            <a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary transition-colors font-medium">
                                <span><i class="fa fa-angle-right mr-2 text-primary"></i> Culture</span>
                                <span class="bg-gray-100 px-3 py-1 text-xs">8</span>
                            </a>
                        </div>
                    </div>
    
                    <!-- Recent Post -->
                    <div class="bg-white p-8 shadow-lg mb-10">
                        <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Recent Posts</h4>
                        <div class="space-y-6">
                            <a href="#" class="flex items-center group">
                                <img src="img/blog-100x100.jpg" class="w-20 h-20 object-cover">
                                <div class="ml-4">
                                    <h6 class="font-bold group-hover:text-primary transition-colors leading-tight">Exploring the ancient mysteries of Lalibela.</h6>
                                    <small class="text-gray-500">Jan 01, 2026</small>
                                </div>
                            </a>
                            <a href="#" class="flex items-center group">
                                <img src="img/blog-100x100.jpg" class="w-20 h-20 object-cover">
                                <div class="ml-4">
                                    <h6 class="font-bold group-hover:text-primary transition-colors leading-tight">Wildlife adventures in the Semien Mountains.</h6>
                                    <small class="text-gray-500">Jan 01, 2026</small>
                                </div>
                            </a>
                        </div>
                    </div>
    
                    <!-- Tags -->
                    <div class="bg-white p-8 shadow-lg">
                        <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white px-4 py-2 text-sm transition-all">Travel</a>
                            <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white px-4 py-2 text-sm transition-all">Ethiopia</a>
                            <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white px-4 py-2 text-sm transition-all">History</a>
                            <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white px-4 py-2 text-sm transition-all">Nature</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

<?php 
    include 'includes/footer.php';
?>