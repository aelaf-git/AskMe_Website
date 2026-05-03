<?php 
    $pageTitle = "Home";
    include 'includes/head.php'; 
?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/navbar.php'; ?>

    <!-- Carousel Start -->
    <div class="relative w-full h-[500px] lg:h-[800px] overflow-hidden">
        <div id="carousel-inner" class="flex transition-transform duration-700 ease-in-out h-full">
            <div class="min-w-full h-full relative">
                <img class="w-full h-full object-cover" src="img/addisababa.jpg" alt="Image">
                <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center p-4">
                    <div class="max-w-[900px]">
                        <h4 class="text-white uppercase tracking-[5px] mb-4">AskMe Tour & Travel</h4>
                        <h1 class="text-4xl md:text-7xl font-bold text-white mb-8">Let's Discover The World Together</h1>
                        <a href="#Registration" class="btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="min-w-full h-full relative">
                <img class="w-full h-full object-cover" src="img/fasiledes.jpg" alt="Image">
                <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center p-4">
                    <div class="max-w-[900px]">
                        <h4 class="text-white uppercase tracking-[5px] mb-4">AskMe Tour & Travel</h4>
                        <h1 class="text-4xl md:text-7xl font-bold text-white mb-8">Discover Amazing Places With Us</h1>
                        <a href="#Registration" class="btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button id="prev" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-primary w-12 h-12 flex items-center justify-center text-white transition-all rounded-none">
            <i class="fa fa-chevron-left"></i>
        </button>
        <button id="next" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-primary w-12 h-12 flex items-center justify-center text-white transition-all rounded-none">
            <i class="fa fa-chevron-right"></i>
        </button>
    </div>
    <script>
        const inner = document.getElementById('carousel-inner');
        let carouselIndex = 0;
        function showCarouselSlide(n) {
            carouselIndex = (n + 2) % 2;
            inner.style.transform = `translateX(-${carouselIndex * 100}%)`;
        }
        document.getElementById('prev').onclick = () => showCarouselSlide(carouselIndex - 1);
        document.getElementById('next').onclick = () => showCarouselSlide(carouselIndex + 1);
        setInterval(() => showCarouselSlide(carouselIndex + 1), 5000);
    </script>
    <!-- Carousel End -->

    <!-- About Start -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4 items-center">
                <div class="w-full lg:w-1/2 px-4 mb-12 lg:mb-0 h-[500px]">
                    <img class="w-full h-full object-cover shadow-2xl" src="img/ertale.jpg" alt="About">
                </div>
                <div class="w-full lg:w-1/2 px-4 lg:pl-12">
                    <div class="bg-white p-8 md:p-12 shadow-xl border-l-4 border-primary">
                        <h6 class="text-primary uppercase tracking-[5px] font-bold mb-4">About Us</h6>
                        <h1 class="text-3xl md:text-4xl font-bold mb-6">We Provide Best Tour Packages In Your Budget</h1>
                        <p class="text-gray-600 mb-8 leading-relaxed text-lg">Discover Ethiopia and beyond with AskMe Tour and Travel, your trusted partner for unforgettable, safe, and culturally immersive travel experiences. With professional service, modern travel solutions, and customized tour packages, we turn every journey into a memorable adventure.</p>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <img class="w-full h-40 object-cover" src="img/gorgora.jpg" alt="">
                            <img class="w-full h-40 object-cover" src="img/moscow.jpg" alt="">
                        </div>
                        <a href="#Registration" class="btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <!-- About End -->

    <?php include "includes/upcoming_events.php"; ?>

    <!-- Feature Start -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4 mb-8 md:mb-0">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-20 h-20 bg-primary flex items-center justify-center text-white mr-4">
                            <i class="fa fa-2x fa-money-check-alt"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold mb-2">Competitive Pricing</h5>
                            <p class="text-gray-600 m-0">Enjoy exceptional travel experiences at the best possible rates, giving you maximum value for every journey.</p>
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
                            <p class="text-gray-600 m-0">We provide reliable, customer-focused services designed to make your travel smooth, comfortable, and worry-free.</p>
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
                            <p class="text-gray-600 m-0">Explore destinations across the globe with our extensive network and expertly curated travel options.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

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
                    ['South Korea', '3 Cities', 'img/southkorea.jpg'],
                    ['United Arab Emirates', '3 Cities', 'img/uae.jpeg'],
                    ['Europe', '12 Cities', 'img/europe.jpg'],
                    ['India', '5 Cities', 'img/india.jpeg'],
                    ['South Africa', '4 Cities', 'img/southafrica.jpg'],
                    ['Indonesia', '2 Cities', 'img/Indonesia.jpg'],
                    ['Ethiopia', '11 Cities', 'img/ethiopia.jpg'],
                    ['Tanzania', '3 Cities', 'img/tanzania.jpg'],
                ];
                foreach ($destinations as $dest):
                ?>
                <div class="relative group overflow-hidden h-64 shadow-lg">
                    <img src="<?php echo $dest[2]; ?>" alt="<?php echo $dest[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <a href="" class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 no-underline">
                        <h5 class="text-white text-xl font-bold mb-1"><?php echo $dest[0]; ?></h5>
                        <span class="text-white/80"><?php echo $dest[1]; ?></span>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Destination End -->

    <!-- Service Start -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Services</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Tours & Travel Services</h1>
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

    <!-- Registration Start -->
    <section id="Registration" class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="img/africa.jpg" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-primary/80"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 py-10">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full lg:w-7/12 px-4 mb-12 lg:mb-0">
                    <h6 class="text-white uppercase tracking-[5px] font-bold mb-4">AskMe Tour and Travel</h6>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6"><span class="text-dark">Register Now!</span> and Experience the World with Us.</h1>
                </div>
                <div class="w-full lg:w-5/12 px-4">
                    <div class="bg-white shadow-2xl overflow-hidden">
                        <div class="bg-dark text-center py-6">
                            <h2 class="text-white text-3xl font-bold m-0">Sign Up Now</h2>
                        </div>
                        <div class="p-8 md:p-10">
                            <form id="registrationform" class="space-y-4">
                                <input name="Name" type="text" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" placeholder="Your name" required>
                                <input name="Email" type="email" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" placeholder="Your email" required>
                                <input name="Phone" type="number" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" placeholder="Your phone number" required>
                                <input name="Destination" type="text" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" placeholder="Where do you want to go?" required>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 ml-1">Departure Date</label>
                                        <input name="Departuredate" type="date" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" required>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 ml-1">Return Date</label>
                                        <input name="Returndate" type="date" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" required>
                                    </div>
                                </div>
                                <select name="Purpose" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" required>
                                    <option selected disabled value="">Purpose</option>
                                    <option value="Tourism">Tourism</option>
                                    <option value="Business">Business</option>
                                    <option value="Family Visit">Family Visit</option>
                                    <option value="Study">Study</option>
                                    <option value="Conferences and Meetings">Conferences and Meetings</option>
                                </select>
                                <button class="w-full bg-primary text-white font-bold py-4 hover:bg-primary-dark transition-all duration-300" type="submit" id="submitButton">Sign Up Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Registration End -->

    <!-- Team Start -->
    <section id="team" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Team</h6>
                <h1 class="text-4xl md:text-5xl font-bold text-dark">Our Team</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $team = [
                    ['Ketema Bahiru', 'Founder and Director', 'img/ketema.jpg'],
                    ['Dereje Shiferaw', 'Board Chairman', 'img/dereje.jpg'],
                    ['Dawit Zegeye', 'Board Vise Chairman', 'img/dawit.jpg'],
                    ['Aelaf Eskindir', 'ICT Officer', 'img/aelaf.jpg'],
                ];
                foreach ($team as $member):
                ?>
                <div class="bg-white shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden aspect-square">
                        <img src="<?php echo $member[2]; ?>" alt="<?php echo $member[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-6">
                        <h5 class="text-xl font-bold mb-1"><?php echo $member[0]; ?></h5>
                        <p class="text-gray-500 m-0"><?php echo $member[1]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Team End -->

    <!-- Footer Start -->
    <footer class="bg-dark text-gray-400 pt-20">
        <div class="max-w-7xl mx-auto px-4 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div>
                    <a href="" class="block mb-8">
                        <h1 class="text-3xl font-bold text-primary"><span class="text-white">Ask</span>Me</h1>
                    </a>
                    <p class="mb-8 leading-relaxed">Discover Ethiopia and beyond with AskMe Tour and Travel, your trusted partner for unforgettable, safe, and culturally immersive travel experiences.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="w-12 h-12 border border-white/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white uppercase tracking-[5px] font-bold mb-8">Useful Links</h5>
                    <div class="flex flex-col space-y-3">
                        <a href="#about" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> About</a>
                        <a href="#destination" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Destination</a>
                        <a href="#services" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Services</a>
                        <a href="#team" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Our Team</a>
                        <a href="#testimonial" class="hover:text-primary transition-colors flex items-center"><i class="fa fa-angle-right mr-2"></i> Testimonial</a>
                    </div>
                </div>
                <div>
                    <h5 class="text-white uppercase tracking-[5px] font-bold mb-8">Contact Us</h5>
                    <div class="space-y-4">
                        <p class="flex items-center"><i class="fa fa-map-marker-alt mr-3 text-primary"></i> Addis Ababa, Ethiopia</p>
                        <p class="flex items-center"><i class="fa fa-phone-alt mr-3 text-primary"></i> +251 91 112 4715</p>
                        <p class="flex items-center"><i class="fa fa-envelope mr-3 text-primary"></i> info@askmetour.org</p>
                    </div>
                    <div class="mt-8">
                        <h6 class="text-white uppercase tracking-[5px] font-bold mb-4">Newsletter</h6>
                        <form id="newsletterForm" class="flex">
                            <input name="Email" type="email" class="w-full p-4 bg-white/10 border-0 focus:ring-0 text-white placeholder-gray-500" placeholder="Your Email" required>
                            <button class="bg-primary text-white px-6 hover:bg-primary-dark transition-colors" type="submit">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-6">
            <div class="max-w-7xl mx-auto px-4 text-center md:text-left">
                <p class="m-0 text-sm">Copyright &copy; <a href="www.askmetour.org" class="text-white hover:text-primary">AskMe Tour and Travel</a>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white flex items-center justify-center shadow-2xl opacity-0 transition-opacity duration-300 z-[1000]">
        <i class="fa fa-angle-double-up"></i>
    </a>

    <script>
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                document.getElementById('back-to-top').classList.add('opacity-100');
            } else {
                document.getElementById('back-to-top').classList.remove('opacity-100');
            }
        };
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Removed Bootstrap Bundle -->
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="form.js"></script>
</body>
</html>