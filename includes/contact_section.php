<!-- Contact Us Section -->
<section id="contact-us" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex flex-wrap -mx-4 items-center">
            <div class="w-full lg:w-5/12 px-4 mb-16 lg:mb-0">
                <div class="pr-0 lg:pr-12">
                    <h6 class="text-primary uppercase tracking-[5px] font-bold mb-4">Contact Us</h6>
                    <h1 class="text-4xl md:text-5xl font-black text-dark mb-8 leading-tight">Have Questions? <span class="text-primary">Get In Touch</span> With Us</h1>
                    <p class="text-gray-500 text-lg mb-10 leading-relaxed">Whether you're planning your next adventure or just want to say hi, our team is here to help you 24/7. Drop us a message and we'll get back to you within 24 hours.</p>
                    
                    <div class="space-y-8">
                        <div class="flex items-center space-x-6 group">
                            <div class="w-16 h-16 bg-secondary text-primary rounded-2xl flex items-center justify-center text-2xl group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-lg shadow-primary/5">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Our Office</p>
                                <p class="text-dark font-bold text-lg">Addis Ababa, Ethiopia</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6 group">
                            <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-blue-500 group-hover:text-white transition-all duration-300 shadow-lg shadow-blue-500/5">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Call Us</p>
                                <p class="text-dark font-bold text-lg">+251 91 112 4715</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6 group">
                            <div class="w-16 h-16 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-purple-500 group-hover:text-white transition-all duration-300 shadow-lg shadow-purple-500/5">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email Us</p>
                                <p class="text-dark font-bold text-lg">info@askmetour.org</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-7/12 px-4">
                <div class="bg-white p-8 md:p-12 rounded-[2rem] shadow-2xl border border-gray-50">
                    <form id="contactForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 ml-1">Full Name</label>
                                <input type="text" name="name" required class="w-full p-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:outline-none transition-all duration-300 placeholder-gray-300" placeholder="John Doe">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 ml-1">Email Address</label>
                                <input type="email" name="email" required class="w-full p-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:outline-none transition-all duration-300 placeholder-gray-300" placeholder="john@example.com">
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 ml-1">Subject</label>
                            <input type="text" name="subject" required class="w-full p-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:outline-none transition-all duration-300 placeholder-gray-300" placeholder="How can we help?">
                        </div>
                        
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest font-bold text-gray-400 ml-1">Your Message</label>
                            <textarea name="message" required rows="5" class="w-full p-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:outline-none transition-all duration-300 placeholder-gray-300" placeholder="Tell us more about your travel plans..."></textarea>
                        </div>
                        
                        <button type="submit" id="sendMessageButton" class="w-full py-5 bg-primary text-white font-bold rounded-2xl shadow-xl shadow-primary/20 hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-3">
                            <span>Send Message</span>
                            <i class="fas fa-paper-plane text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
