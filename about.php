<?php 
    $pageTitle = "About";
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
            <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4">About Us</h1>
            <div class="flex items-center justify-center text-white space-x-4 font-medium">
                <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
                <i class="fa fa-angle-double-right text-xs pt-1"></i>
                <span class="text-primary">About</span>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4 items-center">
                <div class="w-full lg:w-1/2 px-4 mb-12 lg:mb-0 h-[500px]">
                    <img class="w-full h-full object-cover shadow-2xl" src="img/about.jpg" alt="About">
                </div>
                <div class="w-full lg:w-1/2 px-4 lg:pl-12">
                    <div class="bg-white p-8 md:p-12 shadow-xl border-l-4 border-primary">
                        <h6 class="text-primary uppercase tracking-[5px] font-bold mb-4">About Us</h6>
                        <h1 class="text-3xl md:text-4xl font-bold mb-6">We Provide Best Tour Packages In Your Budget</h1>
                        <p class="text-gray-600 mb-8 leading-relaxed text-lg">AskMe Tour and Travel is a premier travel agency dedicated to providing exceptional travel experiences. We specialize in curating unique itineraries that cater to the diverse interests of our clients, ensuring every journey is memorable and stress-free.</p>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <img class="w-full h-40 object-cover" src="img/about-1.jpg" alt="">
                            <img class="w-full h-40 object-cover" src="img/about-2.jpg" alt="">
                        </div>
                        <a href="index.php#Registration" class="btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <!-- About End -->

    <?php include 'includes/upcoming_events.php'; ?>

    <!-- Feature Start -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-20 h-20 bg-primary flex items-center justify-center text-white mr-4">
                            <i class="fa fa-2x fa-money-check-alt"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold mb-2">Competitive Pricing</h5>
                            <p class="text-gray-600 m-0">We offer high quality travel experiences at prices that fit your budget.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-20 h-20 bg-primary flex items-center justify-center text-white mr-4">
                            <i class="fa fa-2x fa-award"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold mb-2">Best Services</h5>
                            <p class="text-gray-600 m-0">Our dedicated team is committed to providing top-notch service throughout your trip.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-20 h-20 bg-primary flex items-center justify-center text-white mr-4">
                            <i class="fa fa-2x fa-globe"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold mb-2">Worldwide Coverage</h5>
                            <p class="text-gray-600 m-0">Explore breathtaking destinations in Ethiopia and across the globe with our extensive network.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- Team Start -->
    <section id="team" class="py-20 bg-white">
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
    <!-- Team End -->

<?php 
    include 'includes/footer.php';
?>