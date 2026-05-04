<?php 
    $page = isset($_GET['p']) ? $_GET['p'] : 'home';
    
    $pageTitles = [
        'home' => 'Home',
        'about' => 'About Us',
        'blog' => 'Our Blog',
        'contact' => 'Contact Us',
        'destination' => 'Destinations',
        'guide' => 'Our Guides',
        'package' => 'Tour Packages',
        'service' => 'Our Services',
        'single' => 'Blog Detail',
        'event_detail' => 'Event Detail',
        'testimonial' => 'Testimonials'
    ];

    $pageTitle = isset($pageTitles[$page]) ? $pageTitles[$page] : 'Home';
    
    include 'includes/head.php'; 
?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <?php 
        if ($page == 'home') {
    ?>
            <!-- Hero Start -->
            <div class="relative w-full h-screen overflow-hidden">
                <div id="carousel-inner" class="flex transition-transform duration-1000 ease-[cubic-bezier(0.87,0,0.13,1)] h-full">
                    <div class="min-w-full h-full relative">
                        <img class="w-full h-full object-cover scale-110" src="assets/img/addisababa.jpg" alt="Image">
                        <div class="absolute inset-0 bg-gradient-to-r from-dark/90 via-dark/40 to-transparent flex items-center p-8 lg:p-24 pt-32 lg:pt-40">
                            <div class="max-w-[800px] space-y-8 animate-fade-in-left">
                                <div class="inline-flex items-center space-x-3 px-4 py-2 glass rounded-full border-primary/30">
                                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                    <span class="text-xs font-black uppercase tracking-[3px] text-primary">Discover Ethiopia</span>
                                </div>
                                <h1 class="text-5xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter">
                                    Let's Explore The <span class="text-primary text-glow">Future</span> Together
                                </h1>
                                <p class="text-lg text-white/70 max-w-xl font-medium leading-relaxed">
                                    Embark on a journey where tradition meets innovation. AskMe Tour & Travel brings you the most immersive experiences across the globe.
                                </p>
                                <div class="flex flex-wrap gap-4 pt-4">
                                    <a href="index.php?p=package" class="px-8 py-4 bg-primary text-white font-bold rounded-2xl shadow-glow hover:shadow-glow-heavy hover:scale-105 transition-all duration-300">Start Your Journey</a>
                                    <a href="#about" class="px-8 py-4 glass text-white font-bold rounded-2xl hover:bg-white/20 transition-all duration-300">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="min-w-full h-full relative">
                        <img class="w-full h-full object-cover scale-110" src="assets/img/fasiledes.jpg" alt="Image">
                        <div class="absolute inset-0 bg-gradient-to-r from-dark/90 via-dark/40 to-transparent flex items-center p-8 lg:p-24 pt-32 lg:pt-40">
                            <div class="max-w-[800px] space-y-8">
                                <div class="inline-flex items-center space-x-3 px-4 py-2 glass rounded-full border-primary/30">
                                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                    <span class="text-xs font-black uppercase tracking-[3px] text-primary">Unique Adventures</span>
                                </div>
                                <h1 class="text-5xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter">
                                    Unforgettable <span class="text-primary text-glow">Memories</span> Await
                                </h1>
                                <p class="text-lg text-white/70 max-w-xl font-medium leading-relaxed">
                                    From ancient wonders to modern marvels, we curate every step of your adventure to perfection.
                                </p>
                                <div class="flex flex-wrap gap-4 pt-4">
                                    <a href="index.php?p=package" class="px-8 py-4 bg-primary text-white font-bold rounded-2xl shadow-glow hover:shadow-glow-heavy hover:scale-105 transition-all duration-300">View Packages</a>
                                    <a href="#about" class="px-8 py-4 glass text-white font-bold rounded-2xl hover:bg-white/20 transition-all duration-300">Our Story</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Controls -->
                <div class="absolute bottom-12 right-12 flex space-x-4 z-50">
                    <button id="prev" class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button id="next" class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
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
                setInterval(() => showCarouselSlide(carouselIndex + 1), 8000);
            </script>
            <!-- Hero End -->

            <!-- About Start -->
            <section id="about" class="py-32 bg-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20 -mt-20"></div>
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex flex-wrap -mx-4 items-center">
                        <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0 relative">
                            <div class="relative h-[600px] group">
                                <img class="w-full h-full object-cover rounded-[40px] shadow-2xl transition-transform duration-700 group-hover:scale-[1.02]" src="assets/img/ertale.jpg" alt="About">
                                <div class="absolute -bottom-10 -right-10 w-64 h-64 glass p-4 rounded-[30px] shadow-2xl hidden md:block animate-bounce-slow">
                                    <div class="w-full h-full rounded-[20px] bg-primary/10 flex flex-col items-center justify-center text-center p-6">
                                        <span class="text-5xl font-black text-primary mb-2">15+</span>
                                        <span class="text-sm font-bold text-dark uppercase tracking-widest">Years Experience</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 px-4 lg:pl-20">
                            <div class="space-y-8">
                                <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px]">Our Philosophy</div>
                                <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter leading-none">
                                    Redefining the way you <span class="text-primary italic">Explore</span> the world.
                                </h1>
                                <p class="text-lg text-slate-500 leading-relaxed font-medium">
                                    AskMe Tour and Travel isn't just a travel agency; we are architects of memories. We believe travel should be seamless, immersive, and transformative.
                                </p>
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:border-primary/30 transition-colors">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-4 text-primary">
                                            <i class="fas fa-shield-alt text-xl"></i>
                                        </div>
                                        <h4 class="font-bold text-dark mb-2">Safe Travels</h4>
                                        <p class="text-sm text-slate-500">Your safety is our top priority at every destination.</p>
                                    </div>
                                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:border-primary/30 transition-colors">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-4 text-primary">
                                            <i class="fas fa-globe-africa text-xl"></i>
                                        </div>
                                        <h4 class="font-bold text-dark mb-2">Global Network</h4>
                                        <p class="text-sm text-slate-500">Access to exclusive locations and experiences.</p>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <a href="index.php?p=about" class="inline-flex items-center space-x-3 text-dark font-black group">
                                        <span class="text-lg font-bold">Read Our Story</span>
                                        <span class="w-12 h-12 rounded-full border-2 border-slate-100 flex items-center justify-center group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all duration-300">
                                            <i class="fas fa-arrow-right text-sm"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
            <!-- About End -->

            <!-- Events Start -->
            <section class="py-32 bg-slate-50 overflow-hidden relative">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 space-y-6 md:space-y-0">
                        <div class="space-y-4">
                            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px]">Calendar</div>
                            <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter">Upcoming <span class="text-primary">Events</span></h1>
                        </div>
                        <a href="index.php?p=blog" class="px-8 py-4 glass text-dark font-bold rounded-2xl hover:bg-primary hover:text-white transition-all duration-300 border border-slate-200">View All Events</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        <?php
                        require_once 'includes/db.php';
                        try {
                            $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC LIMIT 3");
                            while ($event = $stmt->fetch()) {
                                $date = new DateTime($event['event_date']);
                        ?>
                        <div class="group relative hover-lift">
                            <div class="relative h-[500px] overflow-hidden rounded-[40px] shadow-2xl">
                                <img src="<?php echo $event['image_path']; ?>" alt="<?php echo $event['title']; ?>" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/20 to-transparent p-10 flex flex-col justify-end">
                                    <div class="backdrop-blur-md bg-white/10 p-2 rounded-2xl border border-white/20 inline-block w-fit mb-6">
                                        <div class="bg-primary px-4 py-2 rounded-xl text-white font-black text-center">
                                            <span class="block text-2xl leading-none"><?php echo $date->format('d'); ?></span>
                                            <span class="text-[10px] uppercase tracking-widest"><?php echo $date->format('M'); ?></span>
                                        </div>
                                    </div>
                                    <h3 class="text-3xl font-black text-white mb-4 leading-tight group-hover:text-primary transition-colors"><?php echo $event['title']; ?></h3>
                                    <p class="text-white/70 line-clamp-2 font-medium mb-8"><?php echo $event['short_description']; ?></p>
                                    <a href="index.php?p=event_detail&id=<?php echo $event['id']; ?>" class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-300">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } catch (PDOException $e) {
                            echo '<p class="text-rose-500">Error loading events.</p>';
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- Events End -->

            <!-- Feature Start -->
            <section class="py-32 bg-white relative">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="flex flex-col items-start p-10 rounded-[40px] bg-slate-50 border border-slate-100 group hover:border-primary/30 transition-all duration-500">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-primary shadow-sm mb-8 group-hover:bg-primary group-hover:text-white group-hover:shadow-glow transition-all duration-500">
                                <i class="fa fa-money-check-alt text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black text-dark mb-4">Competitive Pricing</h5>
                            <p class="text-slate-500 leading-relaxed font-medium">Enjoy exceptional travel experiences at the best possible rates, giving you maximum value for every journey.</p>
                        </div>
                        <div class="flex flex-col items-start p-10 rounded-[40px] bg-slate-50 border border-slate-100 group hover:border-primary/30 transition-all duration-500">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-primary shadow-sm mb-8 group-hover:bg-primary group-hover:text-white group-hover:shadow-glow transition-all duration-500">
                                <i class="fa fa-award text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black text-dark mb-4">Best Services</h5>
                            <p class="text-slate-500 leading-relaxed font-medium">We provide reliable, customer-focused services designed to make your travel smooth, comfortable, and worry-free.</p>
                        </div>
                        <div class="flex flex-col items-start p-10 rounded-[40px] bg-slate-50 border border-slate-100 group hover:border-primary/30 transition-all duration-500">
                            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-primary shadow-sm mb-8 group-hover:bg-primary group-hover:text-white group-hover:shadow-glow transition-all duration-500">
                                <i class="fa fa-globe text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black text-dark mb-4">Worldwide Coverage</h5>
                            <p class="text-slate-500 leading-relaxed font-medium">Explore destinations across the globe with our extensive network and expertly curated travel options.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Feature End -->

            <!-- Destination Start -->
            <section id="destination" class="py-32 bg-white">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Explore</div>
                    <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter mb-20">Top <span class="text-primary">Destinations</span></h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
                        ];
                        foreach ($destinations as $dest):
                        ?>
                        <div class="relative group overflow-hidden h-[400px] rounded-[40px] shadow-xl hover-lift">
                            <img src="<?php echo $dest[2]; ?>" alt="<?php echo $dest[0]; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent flex flex-col items-center justify-end p-8">
                                <h5 class="text-white text-2xl font-black mb-1"><?php echo $dest[0]; ?></h5>
                                <span class="text-primary font-bold text-sm tracking-widest uppercase"><?php echo $dest[1]; ?></span>
                                <div class="h-0.5 w-0 bg-primary mt-4 group-hover:w-full transition-all duration-500 rounded-full"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- Destination End -->

            <!-- Service Start -->
            <section id="services" class="py-32 bg-slate-50 relative overflow-hidden">
                <div class="absolute bottom-0 left-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -ml-20 -mb-20"></div>
                <div class="max-w-7xl mx-auto px-4">
                    <div class="text-center mb-20">
                        <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Expertise</div>
                        <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter">Our Premium <span class="text-primary">Services</span></h1>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="glass p-12 rounded-[50px] text-center group hover:bg-primary transition-all duration-500 hover:shadow-glow-heavy hover:-translate-y-4">
                            <div class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mx-auto mb-8 group-hover:bg-white group-hover:text-primary transition-colors">
                                <i class="fa fa-route text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black mb-4 group-hover:text-white transition-colors">Travel Guide</h5>
                            <p class="text-slate-500 group-hover:text-white/80 transition-colors">Expert guides to lead your journey with deep local knowledge.</p>
                        </div>
                        <div class="glass p-12 rounded-[50px] text-center group hover:bg-primary transition-all duration-500 hover:shadow-glow-heavy hover:-translate-y-4">
                            <div class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mx-auto mb-8 group-hover:bg-white group-hover:text-primary transition-colors">
                                <i class="fa fa-ticket-alt text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black mb-4 group-hover:text-white transition-colors">Ticket Booking</h5>
                            <p class="text-slate-500 group-hover:text-white/80 transition-colors">Seamless flight and transport arrangements at the best prices.</p>
                        </div>
                        <div class="glass p-12 rounded-[50px] text-center group hover:bg-primary transition-all duration-500 hover:shadow-glow-heavy hover:-translate-y-4">
                            <div class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mx-auto mb-8 group-hover:bg-white group-hover:text-primary transition-colors">
                                <i class="fa fa-hotel text-3xl"></i>
                            </div>
                            <h5 class="text-2xl font-black mb-4 group-hover:text-white transition-colors">Hotel Booking</h5>
                            <p class="text-slate-500 group-hover:text-white/80 transition-colors">Hand-picked luxury stays tailored to your specific comfort.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Service End -->

            <!-- Registration Start -->
            <section id="Registration" class="py-20 relative overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <img src="assets/img/africa.jpg" class="w-full h-full object-cover">
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
            <section id="team" class="py-32 bg-white relative overflow-hidden">
                <div class="absolute top-1/2 left-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -ml-20"></div>
                <div class="max-w-7xl mx-auto px-4">
                    <div class="text-center mb-20">
                        <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Our Experts</div>
                        <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter">Meet The <span class="text-primary text-glow">Visionaries</span></h1>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php
                        $team = [
                            ['Ketema Bahiru', 'Founder and Director', 'assets/img/ketema.jpg'],
                            ['Dereje Shiferaw', 'Board Chairman', 'assets/img/dereje.jpg'],
                            ['Dawit Zegeye', 'Board Vise Chairman', 'assets/img/dawit.jpg'],
                            ['Aelaf Eskindir', 'ICT Officer', 'assets/img/aelaf.jpg'],
                            ['Hareg Belachew', 'Marketing', 'assets/img/hareg.jpg'],
                            ['Yihunegn Mohammed', 'Advisor', 'assets/img/yihunegn.jpg'],
                            ['Redwan Tesfaye', 'Tour Coordinator', 'assets/img/redwan.jpg'],
                            ['Fetelewirk Mitiku', 'Marketing Officer', 'assets/img/Fetelewirk.jpg'],
                        ];
                        foreach ($team as $member):
                        ?>
                        <div class="group relative hover-lift">
                            <div class="relative overflow-hidden aspect-[4/5] rounded-[40px] shadow-2xl">
                                <img src="<?php echo $member[2]; ?>" alt="<?php echo $member[0]; ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/20 to-transparent flex flex-col justify-end p-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    <div class="flex flex-col space-y-1 mb-4">
                                        <h5 class="text-xl font-black text-white"><?php echo $member[0]; ?></h5>
                                        <p class="text-primary text-xs font-bold uppercase tracking-widest"><?php echo $member[1]; ?></p>
                                    </div>
                                    <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                        <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-facebook-f text-sm"></i></a>
                                        <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-instagram text-sm"></i></a>
                                        <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-white hover:bg-primary transition-all"><i class="fab fa-linkedin-in text-sm"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- Team End -->

            <!-- Testimonial Start -->
            <section id="testimonial" class="py-32 bg-slate-50 relative overflow-hidden">
                <div class="absolute bottom-0 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20 -mb-20"></div>
                <div class="max-w-7xl mx-auto px-4">
                    <div class="text-center mb-20">
                        <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Testimonials</div>
                        <h1 class="text-4xl md:text-6xl font-black text-dark tracking-tighter">What Our <span class="text-primary text-glow">Clients</span> Say</h1>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <?php
                        $testimonials = [
                            ['Melaku Debru', 'Corporate Event Planner', '“AskMe Tour and Travel handled every detail flawlessly, turning a complex business trip into an enjoyable experience.”'],
                            ['Sara Tesfaye', 'High School Teacher', '“Their customized itinerary made my educational tour both stress free and incredibly enriching for my students.”'],
                            ['Shemsedin Ahmed', 'Software Engineer', '“AskMe Tour and Travel turned my dream vacation into reality with exceptional planning and friendly service.”'],
                            ['Rakeb Teklu', 'Photographer', '“Thanks to their expertise, I captured stunning locations I never would have found on my own.”'],
                        ];
                        foreach ($testimonials as $t):
                        ?>
                        <div class="glass p-10 md:p-14 rounded-[50px] relative group hover:-translate-y-2 transition-all duration-500">
                            <div class="absolute top-10 right-10 text-primary/10 group-hover:text-primary/20 transition-colors">
                                <i class="fa fa-quote-right text-6xl"></i>
                            </div>
                            <p class="text-xl text-slate-600 italic mb-10 leading-relaxed font-medium relative z-10">
                                <?php echo $t[2]; ?>
                            </p>
                            <div class="flex items-center space-x-5">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg">
                                    <img src="assets/img/nobody.jpg" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="text-xl font-black text-dark leading-tight"><?php echo $t[0]; ?></h5>
                                    <small class="text-primary font-bold uppercase tracking-widest text-[10px]"><?php echo $t[1]; ?></small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- Testimonial End -->
    <?php 
        } else {
            $pageFile = "pages/{$page}.php";
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                echo '<div class="py-20 text-center text-4xl font-bold">404 - Page Not Found</div>';
            }
        }
    ?>

    <?php include 'includes/contact_section.php'; ?>
    <?php include 'includes/footer.php'; ?>
</body>
</html>