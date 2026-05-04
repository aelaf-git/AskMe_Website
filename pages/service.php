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
<section id="services" class="py-32 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -ml-20 -mt-20"></div>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Expertise</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Premium Travel <span class="text-primary">Services</span></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
                $services = $stmt->fetchAll();
                if (count($services) > 0) {
                    foreach ($services as $service):
            ?>
            <div class="glass p-12 rounded-[60px] text-center group hover:bg-secondary transition-all duration-500 hover:shadow-2xl hover:-translate-y-4">
                <div class="w-24 h-24 bg-primary/10 text-primary rounded-[30px] flex items-center justify-center mx-auto mb-10 group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-sm">
                    <i class="<?php echo $service['icon_class']; ?> text-4xl"></i>
                </div>
                <h5 class="text-3xl font-black mb-6 group-hover:text-white transition-colors tracking-tight text-secondary"><?php echo $service['title']; ?></h5>
                <p class="text-slate-500 group-hover:text-white/70 transition-colors text-base leading-relaxed font-medium"><?php echo $service['description']; ?></p>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-3 text-center py-20 glass rounded-[60px] border border-slate-100 w-full">
                    <i class="fas fa-tools text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">New Services Coming Soon</h3>
                    <p class="text-slate-400 font-medium">We're tailoring premium services to make your travels extraordinary.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading services.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Service End -->

<!-- Testimonial Start -->
<section id="testimonial" class="py-32 bg-slate-50 relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20 -mb-20"></div>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Testimonials</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Voice Of Our <span class="text-primary">Travelers</span></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC");
                $testimonials = $stmt->fetchAll();
                if (count($testimonials) > 0) {
                    foreach ($testimonials as $t):
            ?>
            <div class="glass p-12 rounded-[50px] relative group hover:-translate-y-2 transition-all duration-500 border border-slate-100">
                <i class="fa fa-quote-right absolute top-12 right-12 text-primary/5 text-7xl group-hover:text-primary/10 transition-colors"></i>
                <p class="text-xl text-slate-600 italic mb-10 leading-relaxed font-medium relative z-10">"<?php echo $t['feedback']; ?>"</p>
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg border-2 border-white">
                        <img src="<?php echo $t['client_image']; ?>" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h5 class="text-xl font-black text-secondary leading-tight"><?php echo $t['client_name']; ?></h5>
                        <small class="text-primary font-black uppercase tracking-widest text-[10px]"><?php echo $t['profession']; ?></small>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-2 text-center py-20 glass rounded-[50px] border border-slate-100 w-full">
                    <i class="fas fa-comment-dots text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Voices of Adventure Coming Soon</h3>
                    <p class="text-slate-400 font-medium">Wait until you hear what our first travelers have to say!</p>
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