<?php 
    $pageTitle = "Tour Packages";
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
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">Tour Packages</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">Packages</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Packages Start -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Packages</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Perfect Tour Packages</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $packages = [
                    ['Lalibela', '3 days', '2 Person', 'Explore the ancient rock-hewn churches of Lalibela.', '4.5', '250', '$350', 'img/package-1.jpg'],
                    ['Semien Mountains', '5 days', '2 Person', 'Experience the stunning wildlife and scenery of the Semien Mountains.', '4.8', '320', '$500', 'img/package-2.jpg'],
                    ['Axum', '4 days', '2 Person', 'Discover the rich history and ancient stelae of Axum.', '4.6', '180', '$400', 'img/package-3.jpg'],
                    ['Danakil', '4 days', '2 Person', 'Embark on a unique adventure to the surreal landscapes of Danakil.', '4.9', '150', '$650', 'img/package-4.jpg'],
                    ['Gondar', '3 days', '2 Person', 'Explore the majestic castles and history of Gondar.', '4.7', '220', '$380', 'img/package-5.jpg'],
                    ['Omo Valley', '6 days', '2 Person', 'A cultural immersion into the diverse tribes of the Omo Valley.', '4.8', '190', '$750', 'img/package-6.jpg'],
                ];
                foreach ($packages as $pkg):
                ?>
                <div class="bg-white shadow-lg group overflow-hidden">
                    <div class="relative overflow-hidden h-64">
                        <img src="<?php echo $pkg[7]; ?>" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-center text-xs text-primary font-bold uppercase mb-4">
                            <span><i class="fa fa-map-marker-alt mr-1"></i> <?php echo $pkg[0]; ?></span>
                            <span><i class="fa fa-calendar-alt mr-1"></i> <?php echo $pkg[1]; ?></span>
                            <span><i class="fa fa-user mr-1"></i> <?php echo $pkg[2]; ?></span>
                        </div>
                        <a href="" class="text-xl font-bold hover:text-primary transition-colors leading-tight block mb-6"><?php echo $pkg[3]; ?></a>
                        <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                            <div class="flex items-center text-sm font-bold">
                                <i class="fa fa-star text-primary mr-1"></i>
                                <span><?php echo $pkg[4]; ?> <span class="text-gray-400 font-normal">(<?php echo $pkg[5]; ?>)</span></span>
                            </div>
                            <h5 class="text-2xl font-bold text-primary"><?php echo $pkg[6]; ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Packages End -->

<?php 
    include 'includes/footer.php';
?>