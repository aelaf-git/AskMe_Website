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

<!-- Packages Start -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Packages</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">Perfect Tour Packages</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            <?php
            $packages = [
                ['Lalibela', '3 days', '2 Person', 'Explore the ancient rock-hewn churches of Lalibela.', '4.5', '250', '$350', 'assets/img/package-1.jpg'],
                ['Semien Mountains', '5 days', '2 Person', 'Experience the stunning wildlife and scenery of the Semien Mountains.', '4.8', '320', '$500', 'assets/img/package-2.jpg'],
                ['Axum', '4 days', '2 Person', 'Discover the rich history and ancient stelae of Axum.', '4.6', '180', '$400', 'assets/img/package-3.jpg'],
                ['Danakil', '4 days', '2 Person', 'Embark on a unique adventure to the surreal landscapes of Danakil.', '4.9', '150', '$650', 'assets/img/package-4.jpg'],
                ['Gondar', '3 days', '2 Person', 'Explore the majestic castles and history of Gondar.', '4.7', '220', '$380', 'assets/img/package-5.jpg'],
                ['Omo Valley', '6 days', '2 Person', 'A cultural immersion into the diverse tribes of the Omo Valley.', '4.8', '190', '$750', 'assets/img/package-6.jpg'],
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

<!-- Featured Ethiopian Destinations -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Featured</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">Explore Ethiopia</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $ethiopia = [
                ['Lalibela', 'Historic rock-hewn churches', 'assets/img/destination-1.jpg'],
                ['Semien Mountains', 'Breathtaking landscapes and wildlife', 'assets/img/destination-2.jpg'],
                ['Axum', 'Ancient obelisks and heritage', 'assets/img/destination-3.jpg'],
                ['Danakil Depression', 'One of the hottest and lowest places on Earth', 'assets/img/destination-4.jpg'],
                ['Gondar', 'The "Camelot of Africa" with its historic castles', 'assets/img/destination-5.jpg'],
                ['Omo Valley', 'Diverse cultures and ancient traditions', 'assets/img/destination-6.jpg'],
            ];
            foreach ($ethiopia as $dest):
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