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

<!-- About Start -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-4 items-center">
            <div class="w-full lg:w-1/2 px-4 mb-12 lg:mb-0 h-[500px]">
                <img class="w-full h-full object-cover shadow-2xl" src="assets/img/ertale.jpg" alt="About">
            </div>
            <div class="w-full lg:w-1/2 px-4 lg:pl-12">
                <div class="bg-white p-8 md:p-12 shadow-xl border-l-4 border-primary">
                    <h6 class="text-primary uppercase tracking-[5px] font-bold mb-4">About Us</h6>
                    <h1 class="text-3xl md:text-4xl font-bold mb-6">We Provide Best Tour Packages In Your Budget</h1>
                    <p class="text-gray-600 mb-8 leading-relaxed text-lg">Discover Ethiopia and beyond with AskMe Tour and Travel, your trusted partner for unforgettable, safe, and culturally immersive travel experiences. With professional service, modern travel solutions, and customized tour packages, we turn every journey into a memorable adventure.</p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <img class="w-full h-40 object-cover" src="assets/img/gorgora.jpg" alt="">
                        <img class="w-full h-40 object-cover" src="assets/img/moscow.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- About End -->

<!-- Upcoming Events Start -->
<div class="w-full py-24 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20 relative">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-3">Events</h6>
            <h1 class="text-4xl md:text-6xl font-black text-secondary leading-tight">Upcoming Events</h1>
            <div class="w-24 h-1.5 bg-primary mx-auto mt-6 rounded-full"></div>
            <div class="absolute -top-10 left-1/2 -translate-x-1/2 text-gray-200 text-8xl font-black -z-10 opacity-20 uppercase">Festivals</div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC LIMIT 3");
                $events = $stmt->fetchAll();
                if (count($events) > 0) {
                    foreach ($events as $event) {
                        $date = new DateTime($event['event_date']);
            ?>
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden group hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                <div class="relative h-72 overflow-hidden">
                    <img src="<?php echo $event['image_path']; ?>" alt="<?php echo $event['title']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute top-6 left-6 backdrop-blur-md bg-primary/90 text-white px-5 py-2 rounded-lg font-bold shadow-2xl border border-white/20 text-center">
                        <span class="block text-2xl leading-none"><?php echo $date->format('d'); ?></span>
                        <span class="text-xs uppercase tracking-widest"><?php echo $date->format('M'); ?></span>
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors leading-tight"><?php echo $event['title']; ?></h3>
                    <p class="text-gray-500 mb-8 leading-relaxed line-clamp-3"><?php echo $event['short_description']; ?></p>
                </div>
            </div>
            <?php
                    }
                } else {
            ?>
                <div class="lg:col-span-3 text-center py-20 glass rounded-3xl border border-slate-100 w-full">
                    <i class="fas fa-calendar-star text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Cultural Festivals Coming Soon</h3>
                    <p class="text-slate-400 font-medium">We're updating our event calendar with the latest festivals and tours.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading events.</p>';
            }
            ?>
        </div>
    </div>
</div>
<!-- Upcoming Events End -->

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
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6"><span class="text-secondary">Register Now!</span> and Experience the World with Us.</h1>
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
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">Our Team</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM team ORDER BY id ASC");
                $team = $stmt->fetchAll();
                if (count($team) > 0) {
                    foreach ($team as $member):
            ?>
            <div class="bg-white shadow-lg overflow-hidden group rounded-2xl border border-gray-100">
                <div class="relative overflow-hidden aspect-square">
                    <img src="<?php echo $member['image_path']; ?>" alt="<?php echo $member['name']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <?php if($member['facebook_url']): ?>
                            <a href="<?php echo $member['facebook_url']; ?>" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if($member['instagram_url']): ?>
                            <a href="<?php echo $member['instagram_url']; ?>" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if($member['linkedin_url']): ?>
                            <a href="<?php echo $member['linkedin_url']; ?>" class="w-10 h-10 bg-white/20 hover:bg-primary text-white flex items-center justify-center transition-colors border border-white/30"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-center p-6">
                    <h5 class="text-xl font-bold mb-1 px-2"><?php echo $member['name']; ?></h5>
                    <p class="text-gray-500 m-0 text-sm"><?php echo $member['designation']; ?></p>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-4 text-center py-16 glass rounded-3xl border border-slate-100 w-full">
                    <i class="fas fa-user-friends text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Our Team is Growing</h3>
                    <p class="text-slate-400 font-medium">We'll introduce our expert guides and leadership very soon.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading team.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Team End -->

<!-- Testimonial Start -->
<section id="testimonial" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Testimonial</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-secondary">What Our Clients Say</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 4");
                $testimonials = $stmt->fetchAll();
                if (count($testimonials) > 0) {
                    foreach ($testimonials as $t):
            ?>
            <div class="bg-white p-8 md:p-12 shadow-xl relative group rounded-3xl border border-gray-100">
                <i class="fa fa-quote-right absolute top-8 right-8 text-primary/10 text-6xl group-hover:text-primary/20 transition-colors"></i>
                <p class="text-gray-600 italic mb-8 leading-relaxed text-lg relative z-10">"<?php echo $t['feedback']; ?>"</p>
                <div class="flex items-center">
                    <img src="<?php echo $t['client_image']; ?>" class="w-16 h-16 rounded-full object-cover border-4 border-gray-50 mr-4">
                    <div>
                        <h5 class="text-xl font-bold text-secondary leading-tight"><?php echo $t['client_name']; ?></h5>
                        <small class="text-primary font-bold uppercase tracking-wider text-[10px]"><?php echo $t['profession']; ?></small>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-2 text-center py-16 glass rounded-3xl border border-slate-100 w-full">
                    <i class="fas fa-quote-left text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Hear from our Travelers Soon</h3>
                    <p class="text-slate-400 font-medium">Real stories from real adventurers are being curated for you.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading testimonials.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Testimonial End -->