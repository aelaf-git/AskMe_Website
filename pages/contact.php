<!-- Header Start -->
<div class="relative w-full py-24 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="assets/img/carousel-1.jpg" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white uppercase mb-4"><?php echo $pageTitle; ?></h1>
        <div class="flex items-center justify-center text-white space-x-4 font-medium">
            <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
            <i class="fa fa-angle-double-right text-xs pt-1"></i>
            <span class="text-primary"><?php echo $pageTitle; ?></span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h6 class="text-primary uppercase tracking-[5px] font-bold mb-2">Contact</h6>
            <h1 class="text-4xl md:text-5xl font-bold text-dark">Contact For Any Query</h1>
        </div>
        <div class="flex justify-center">
            <div class="w-full lg:w-8/12">
                <div class="bg-white p-8 md:p-12 shadow-xl">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="control-group">
                                <input type="text" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" id="name" placeholder="Your Name"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-red-500 text-xs mt-1"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" id="email" placeholder="Your Email"
                                    required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-red-500 text-xs mt-1"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <input type="text" class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" id="subject" placeholder="Subject"
                                required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-red-500 text-xs mt-1"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="w-full p-4 bg-gray-50 border border-gray-200 focus:outline-none focus:border-primary transition-colors" rows="5" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-red-500 text-xs mt-1"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn-primary" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->