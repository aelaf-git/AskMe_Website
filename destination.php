<?php 
    $pageTitle = "Destination";
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
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">Destinations</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">Destination</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Destination Start -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Destinations</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Explore Top Destinations</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $destinations = [
                    ['Lalibela', 'Historic rock-hewn churches', 'img/destination-1.jpg'],
                    ['Semien Mountains', 'Breathtaking landscapes and wildlife', 'img/destination-2.jpg'],
                    ['Axum', 'Ancient obelisks and heritage', 'img/destination-3.jpg'],
                    ['Danakil Depression', 'One of the hottest and lowest places on Earth', 'img/destination-4.jpg'],
                    ['Gondar', 'The "Camelot of Africa" with its historic castles', 'img/destination-5.jpg'],
                    ['Omo Valley', 'Diverse cultures and ancient traditions', 'img/destination-6.jpg'],
                ];
                foreach ($destinations as $dest):
                ?>
                <div class="relative group overflow-hidden h-80 shadow-lg">
                    <img src="<?php echo $dest[2]; ?>" alt="<?php echo $dest[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-6 text-center">
                        <h5 class="text-white text-2xl font-bold mb-2"><?php echo $dest[0]; ?></h5>
                        <p class="text-white/90 text-sm"><?php echo $dest[1]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Destination End -->

<?php 
    include 'includes/footer.php';
?>