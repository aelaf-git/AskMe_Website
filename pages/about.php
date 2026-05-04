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
            <!-- Event 1 -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden group hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                <div class="relative h-72 overflow-hidden">
                    <img src="assets/img/dallol.jpg" alt="Enkutatash" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute top-6 left-6 backdrop-blur-md bg-primary/90 text-white px-5 py-2 rounded-lg font-bold shadow-2xl border border-white/20">
                        <span class="block text-2xl leading-none">11</span>
                        <span class="text-xs uppercase tracking-widest">Sep</span>
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors leading-tight">Ethiopian New Year (Enkutatash)</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Join us in celebrating the vibrant Ethiopian New Year with traditional music, dancing, and the beautiful yellow Meskel daisies.</p>
                </div>
            </div>

            <!-- Event 2 -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden group hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                <div class="relative h-72 overflow-hidden">
                    <img src="assets/img/ertale.jpg" alt="Meskel" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute top-6 left-6 backdrop-blur-md bg-primary/90 text-white px-5 py-2 rounded-lg font-bold shadow-2xl border border-white/20">
                        <span class="block text-2xl leading-none">27</span>
                        <span class="text-xs uppercase tracking-widest">Sep</span>
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors leading-tight">Meskel Festival</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Experience the magnificent bonfire lighting ceremony (Demera) in Meskel Square, a UNESCO inscribed cultural heritage.</p>
                </div>
            </div>

            <!-- Event 3 -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden group hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                <div class="relative h-72 overflow-hidden">
                    <img src="assets/img/addisababa.jpg" alt="Great Run" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    <div class="absolute top-6 left-6 backdrop-blur-md bg-primary/90 text-white px-5 py-2 rounded-lg font-bold shadow-2xl border border-white/20">
                        <span class="block text-2xl leading-none">17</span>
                        <span class="text-xs uppercase tracking-widest">Nov</span>
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors leading-tight">Great Ethiopian Run</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Participate in Africa's biggest 10km road race through the heart of Addis Ababa with over 45,000 other runners.</p>
                </div>
            </div>
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
                    <h5 class="text-xl font-bold mb-1 text-truncate px-2"><?php echo $member[0]; ?></h5>
                    <p class="text-gray-500 m-0"><?php echo $member[1]; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
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