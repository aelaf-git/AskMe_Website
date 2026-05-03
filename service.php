<?php 
    $pageTitle = "Services";
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
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">Our Services</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">Services</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Service Start -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Services</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Tours & Travel Services</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $services = [
                    ['Travel Guide', 'fa-route', 'Expert guides to lead you through the most beautiful and historic sites.'],
                    ['Ticket Booking', 'fa-ticket-alt', 'Hassle-free booking for all your travel needs, from flights to local tours.'],
                    ['Hotel Booking', 'fa-hotel', 'Comfortable and affordable accommodations handpicked for your stay.'],
                    ['Travel Guide', 'fa-route', 'Expert guides to lead you through the most beautiful and historic sites.'],
                    ['Ticket Booking', 'fa-ticket-alt', 'Hassle-free booking for all your travel needs, from flights to local tours.'],
                    ['Hotel Booking', 'fa-hotel', 'Comfortable and affordable accommodations handpicked for your stay.'],
                ];
                foreach ($services as $svc):
                ?>
                <div class="bg-white p-10 shadow-xl text-center group hover:bg-primary transition-colors duration-300">
                    <i class="fa fa-3x <?php echo $svc[1]; ?> text-primary group-hover:text-white mb-6"></i>
                    <h5 class="text-2xl font-bold mb-4 group-hover:text-white"><?php echo $svc[0]; ?></h5>
                    <p class="text-gray-600 group-hover:text-white/90 leading-relaxed"><?php echo $svc[2]; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Service End -->

    <!-- Testimonial Start -->
    <section id="testimonial" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Testimonial</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">What Our Clients Say</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php
                $testimonials = [
                    ['Melaku Debru', 'Corporate Event Planner', '“AskMe Tour and Travel handled every detail flawlessly, turning a complex business trip into an enjoyable experience.”'],
                    ['Sara Tesfaye', 'High School Teacher', '“Their customized itinerary made my educational tour both stress free and incredibly enriching for my students.”'],
                    ['Shemsedin Ahmed', 'Software Engineer', '“AskMe Tour and Travel turned my dream vacation into reality with exceptional planning and friendly service.”'],
                    ['Rakeb Teklu', 'Photographer', '“Thanks to their expertise, I captured stunning locations I never would have found on my own.”'],
                ];
                foreach ($testimonials as $t):
                ?>
                <div class="bg-white p-8 md:p-12 shadow-xl relative group">
                    <i class="fa fa-quote-right absolute top-8 right-8 text-primary/10 text-6xl group-hover:text-primary/20 transition-colors"></i>
                    <p class="text-gray-600 italic mb-8 leading-relaxed text-lg relative z-10"><?php echo $t[2]; ?></p>
                    <div class="flex items-center">
                        <img src="img/nobody.jpg" class="w-16 h-16 rounded-full object-cover border-4 border-gray-50 mr-4">
                        <div>
                            <h5 class="text-xl font-bold text-dark leading-tight"><?php echo $t[0]; ?></h5>
                            <small class="text-primary font-bold uppercase tracking-wider text-[10px]"><?php echo $t[1]; ?></small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Testimonial End -->

<?php 
    include 'includes/footer.php';
?>