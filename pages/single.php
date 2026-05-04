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

<!-- Blog Detail Start -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-8/12 px-4">
                <div class="bg-white shadow-lg overflow-hidden mb-12">
                    <img src="assets/img/blog-1.jpg" alt="" class="w-full h-auto">
                    <div class="p-8 md:p-12">
                        <div class="flex items-center text-primary text-xs uppercase font-bold mb-6">
                            <span>Admin</span>
                            <span class="mx-2">|</span>
                            <span>Tours & Travel</span>
                            <span class="mx-2">|</span>
                            <span>Jan 01, 2026</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold mb-8">Exploring the ancient mysteries of Lalibela</h2>
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed space-y-6">
                            <p>AskMe Tour and Travel invites you to explore the breathtaking rock-hewn churches of Lalibela. This UNESCO World Heritage site is a testament to the rich history and spiritual heritage of Ethiopia.</p>
                            <p>Our guided tours provide deep insights into the architecture and legends of these monolithic structures, carved out of solid rock in the 12th century.</p>
                            <h4 class="text-2xl font-bold text-secondary mt-10 mb-4">A Spiritual Journey</h4>
                            <div class="flex flex-wrap md:flex-nowrap gap-6 my-8">
                                <img src="assets/img/blog-2.jpg" class="w-full md:w-1/2 object-cover rounded shadow-md">
                                <p>Lalibela is not just a destination; it's a spiritual experience. Walk through the narrow passages and tunnels connecting the churches, and feel the ancient atmosphere that has drawn pilgrims for centuries.</p>
                            </div>
                            <h4 class="text-2xl font-bold text-secondary mt-10 mb-4">Unforgettable Memories</h4>
                            <div class="flex flex-wrap md:flex-nowrap gap-6 my-8">
                                <p>From the iconic St. George's Church (Bete Giyorgis) to the grand Bete Medhane Alem, every corner of Lalibela tells a story. Join us for a journey that will stay with you forever.</p>
                                <img src="assets/img/blog-3.jpg" class="w-full md:w-1/2 object-cover rounded shadow-md order-first md:order-last">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Comments -->
                <div class="bg-white p-8 md:p-12 shadow-lg mb-12">
                    <h4 class="text-xl font-bold uppercase tracking-widest mb-8 border-b pb-4">Comments</h4>
                    <div class="flex space-x-4">
                        <img src="assets/img/nobody.jpg" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h6 class="font-bold">Samuel G. <small class="text-gray-400 font-normal ml-2 italic">01 Jan 2026</small></h6>
                            <p class="text-gray-600 mt-2">An incredible experience! The guides were so knowledgeable and the sites were beyond anything I could have imagined.</p>
                            <button class="text-primary font-bold text-xs uppercase mt-2 hover:underline">Reply</button>
                        </div>
                    </div>
                </div>

                <!-- Comment Form -->
                <div class="bg-white p-8 md:p-12 shadow-lg">
                    <h4 class="text-xl font-bold uppercase tracking-widest mb-8 border-b pb-4">Leave a Comment</h4>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Name *</label>
                                <input type="text" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email *</label>
                                <input type="email" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Message *</label>
                            <textarea rows="5" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors"></textarea>
                        </div>
                        <button class="btn-primary" type="submit">Post Comment</button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-4/12 px-4 mt-12 lg:mt-0">
                <!-- Author -->
                <div class="bg-white p-8 shadow-lg text-center mb-10">
                    <img src="assets/img/nobody.jpg" class="w-24 h-24 mx-auto mb-6 rounded-full object-cover">
                    <h3 class="text-2xl font-bold text-primary mb-4">AskMe Team</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Our team is dedicated to providing you with the best travel insights and experiences in Ethiopia.</p>
                    <div class="flex justify-center space-x-3 text-primary">
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="hover:text-secondary transition-colors"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Recent Post -->
                <div class="bg-white p-8 shadow-lg">
                    <h4 class="text-xl font-bold uppercase tracking-widest mb-6 border-b pb-4">Recent Posts</h4>
                    <div class="space-y-6">
                        <a href="#" class="flex items-center group">
                            <img src="assets/img/blog-100x100.jpg" class="w-20 h-20 object-cover">
                            <div class="ml-4">
                                <h6 class="font-bold group-hover:text-primary transition-colors leading-tight">Exploring the ancient mysteries of Lalibela.</h6>
                                <small class="text-gray-500">Jan 01, 2026</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->