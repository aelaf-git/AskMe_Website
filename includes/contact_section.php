<!-- Contact Start -->
<div id="contact" class="py-32 relative overflow-hidden bg-dark">
    <!-- Animated background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex flex-wrap items-center -mx-4">
            <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0">
                <div class="space-y-8">
                    <div class="inline-block px-4 py-2 bg-primary/10 border border-primary/20 text-primary rounded-xl text-xs font-black uppercase tracking-[3px]">Reach Out</div>
                    <h1 class="text-5xl md:text-7xl font-black text-white leading-tight tracking-tighter">
                        Let's Talk About Your <span class="text-primary text-glow">Next Adventure</span>
                    </h1>
                    <p class="text-xl text-slate-400 max-w-md font-medium leading-relaxed">
                        Ready to start your journey? Our team of experts is here to help you craft the perfect itinerary.
                    </p>
                    
                    <div class="space-y-6 pt-4">
                        <div class="flex items-center space-x-6 group">
                            <div class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Our Location</h4>
                                <p class="text-slate-400">Addis Ababa, Ethiopia</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6 group text-white">
                            <div class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <i class="fas fa-phone-alt text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold">Call Us</h4>
                                <p class="text-slate-400">+251 911 124 715</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 px-4">
                <div class="glass-dark p-10 md:p-12 rounded-[50px] shadow-2xl border border-white/5 relative overflow-hidden">
                    <form id="contactForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-widest text-primary/70 ml-1">Full Name</label>
                                <input type="text" name="name" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:outline-none focus:border-primary transition-all placeholder:text-white/20" placeholder="John Doe" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-widest text-primary/70 ml-1">Email Address</label>
                                <input type="email" name="email" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:outline-none focus:border-primary transition-all placeholder:text-white/20" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-primary/70 ml-1">Subject</label>
                            <input type="text" name="subject" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:outline-none focus:border-primary transition-all placeholder:text-white/20" placeholder="Trip Inquiry" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-primary/70 ml-1">Message</label>
                            <textarea name="message" rows="4" class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:outline-none focus:border-primary transition-all placeholder:text-white/20" placeholder="Tell us about your plans..." required></textarea>
                        </div>
                        <button type="submit" id="sendMessageButton" class="w-full py-5 bg-primary text-white font-black rounded-2xl shadow-glow hover:shadow-glow-heavy hover:scale-[1.02] active:scale-95 transition-all duration-300 uppercase tracking-[2px]">
                            Dispatch Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
