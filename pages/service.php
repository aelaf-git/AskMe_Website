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

<!-- Service Start -->
<section id="services" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Services</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">Tours & Travel Services</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-10 shadow-xl text-center group hover:bg-primary transition-colors duration-300">
                <i class="fa fa-3x fa-route text-primary group-hover:text-white mb-6"></i>
                <h5 class="text-2xl font-bold mb-4 group-hover:text-white">Travel Guide</h5>
            </div>
            <div class="bg-white p-10 shadow-xl text-center group hover:bg-primary transition-colors duration-300">
                <i class="fa fa-3x fa-ticket-alt text-primary group-hover:text-white mb-6"></i>
                <h5 class="text-2xl font-bold mb-4 group-hover:text-white">Ticket Booking</h5>
            </div>
            <div class="bg-white p-10 shadow-xl text-center group hover:bg-primary transition-colors duration-300">
                <i class="fa fa-3x fa-hotel text-primary group-hover:text-white mb-6"></i>
                <h5 class="text-2xl font-bold mb-4 group-hover:text-white">Hotel Booking</h5>
            </div>
        </div>
    </div>
</section>
<!-- Service End -->

<!-- Testimonial Start -->
<section id="testimonial" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Testimonial</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">What Our Clients Say</h1>
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
                    <img src="assets/img/nobody.jpg" class="w-16 h-16 rounded-full object-cover border-4 border-gray-50 mr-4">
                    <div>
                        <h5 class="text-xl font-bold text-secondary leading-tight"><?php echo $t[0]; ?></h5>
                        <small class="text-primary font-bold uppercase tracking-wider text-[10px]"><?php echo $t[1]; ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Testimonial End -->