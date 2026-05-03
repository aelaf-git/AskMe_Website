<?php 
    $pageTitle = "Guides";
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
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">Travel Guides</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">Guides</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Guides Start -->
    <section id="team" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Guides</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Our Travel Guides</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $guides = [
                    ['Aman K.', 'Senior Guide', 'img/nobody.jpg'],
                    ['Selam T.', 'Cultural Expert', 'img/nobody.jpg'],
                    ['Dawit M.', 'Adventure Specialist', 'img/nobody.jpg'],
                    ['Aster W.', 'Wildlife Expert', 'img/nobody.jpg'],
                ];
                foreach ($guides as $guide):
                ?>
                <div class="bg-white shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden aspect-square">
                        <img src="<?php echo $guide[2]; ?>" alt="<?php echo $guide[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-6">
                        <h5 class="text-xl font-bold mb-1"><?php echo $guide[0]; ?></h5>
                        <p class="text-gray-500 m-0"><?php echo $guide[1]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Guides End -->

<?php 
    include 'includes/footer.php';
?>