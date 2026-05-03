<!-- Header Start -->
<div class="relative w-full py-24 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="assets/img/carousel-1.jpg" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4"><?php echo $pageTitle; ?></h1>
        <div class="flex items-center justify-center text-white space-x-4 font-medium">
            <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
            <i class="fa fa-angle-double-right text-xs pt-1"></i>
            <span class="text-primary"><?php echo $pageTitle; ?></span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Destination Start -->
<section id="destination" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Destinations</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-dark">Explore Top Destinations</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $destinations = [
                ['South Korea', '3 Cities', 'assets/img/southkorea.jpg'],
                ['United Arab Emirates', '3 Cities', 'assets/img/uae.jpeg'],
                ['Europe', '12 Cities', 'assets/img/europe.jpg'],
                ['India', '5 Cities', 'assets/img/india.jpeg'],
                ['South Africa', '4 Cities', 'assets/img/southafrica.jpg'],
                ['Indonesia', '2 Cities', 'assets/img/Indonesia.jpg'],
                ['Ethiopia', '11 Cities', 'assets/img/ethiopia.jpg'],
                ['Tanzania', '3 Cities', 'assets/img/tanzania.jpg'],
                ['Brazil', '6 Cities', 'assets/img/brazil.jpg'],
                ['Kenya', '3 Cities', 'assets/img/kenya.jpg'],
                ['Singapore', '1 City', 'assets/img/singapore.jpg'],
                ['Japan', '4 Cities', 'assets/img/japan.jpg'],
                ['United States', '11 Cities', 'assets/img/usa.jpg'],
                ['China', '7 Cities', 'assets/img/china.jpg'],
                ['Botswana', '3 Cities', 'assets/img/botswana.jpg'],
            ];
            foreach ($destinations as $dest):
            ?>
            <div class="relative group overflow-hidden h-64 shadow-lg">
                <img src="<?php echo $dest[2]; ?>" alt="<?php echo $dest[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <a href="" class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 no-underline text-center px-4">
                    <h5 class="text-white text-xl font-bold mb-1 leading-tight"><?php echo $dest[0]; ?></h5>
                    <span class="text-white/80"><?php echo $dest[1]; ?></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Destination End -->

<!-- Featured Ethiopian Destinations -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Featured</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-dark">Explore Ethiopia</h1>
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