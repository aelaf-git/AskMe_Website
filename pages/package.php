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

<!-- Packages Start -->
<div class="py-32 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20 -mt-20"></div>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Packages</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Perfect Tour <span class="text-primary">Packages</span></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM packages ORDER BY created_at DESC");
                $packages = $stmt->fetchAll();
                if (count($packages) > 0) {
                    foreach ($packages as $pkg):
            ?>
            <div class="bg-white rounded-[50px] shadow-sm border border-slate-100 group overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-4">
                <div class="relative overflow-hidden h-72">
                    <img src="<?php echo $pkg['image_path']; ?>" alt="<?php echo $pkg['title']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-md px-6 py-2 rounded-2xl shadow-lg">
                        <span class="text-secondary font-black text-lg">$<?php echo number_format($pkg['price'], 2); ?></span>
                    </div>
                </div>
                <div class="p-10">
                    <div class="flex items-center space-x-4 text-[10px] text-primary font-black uppercase tracking-[2px] mb-6">
                        <span class="flex items-center"><i class="fa fa-map-marker-alt mr-2"></i> <?php echo $pkg['location']; ?></span>
                        <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                        <span class="flex items-center"><i class="fa fa-calendar-alt mr-2"></i> <?php echo $pkg['duration']; ?></span>
                    </div>
                    <h4 class="text-2xl font-black text-secondary group-hover:text-primary transition-colors leading-tight mb-6"><?php echo $pkg['title']; ?></h4>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8 font-medium"><?php echo $pkg['description']; ?></p>
                    <div class="pt-8 border-t border-slate-50 flex justify-between items-center">
                        <a href="#" class="text-secondary font-black text-xs uppercase tracking-widest group-hover:translate-x-2 transition-transform inline-flex items-center">
                            Book Now <i class="fas fa-arrow-right ml-3 text-[10px]"></i>
                        </a>
                        <div class="flex text-amber-400 text-[10px]">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-3 text-center py-24 glass rounded-[60px] border border-slate-100 w-full">
                    <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-suitcase-rolling text-4xl text-primary/40"></i>
                    </div>
                    <h3 class="text-3xl font-black text-secondary tracking-tight">Luxury Packages Coming Soon</h3>
                    <p class="text-slate-400 font-medium max-w-md mx-auto">We are currently curating exclusive travel packages for your next big adventure.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading packages.</p>';
            }
            ?>
        </div>
    </div>
</div>
<!-- Packages End -->

<!-- Featured Ethiopian Destinations -->
<div class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Discovery</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Explore <span class="text-primary">Ethiopia</span></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM destinations WHERE category = 'Ethiopia' ORDER BY id ASC");
                $ethiopia = $stmt->fetchAll();
                if (count($ethiopia) > 0) {
                    foreach ($ethiopia as $dest):
            ?>
            <div class="relative group overflow-hidden h-[450px] rounded-[50px] shadow-xl hover-lift">
                <img src="<?php echo $dest['image_path']; ?>" alt="<?php echo $dest['name']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/20 to-transparent flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 px-10 text-center">
                    <h5 class="text-white text-3xl font-black mb-4 tracking-tighter"><?php echo $dest['name']; ?></h5>
                    <div class="w-12 h-1 bg-primary rounded-full mb-6"></div>
                    <p class="text-white/80 text-sm font-medium leading-relaxed">Experience the breathtaking beauty and rich heritage of <?php echo $dest['name']; ?>.</p>
                </div>
                <div class="absolute bottom-10 left-10 opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                    <h5 class="text-white text-2xl font-black tracking-tight"><?php echo $dest['name']; ?></h5>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-3 text-center py-20 glass rounded-[50px] w-full">
                    <i class="fas fa-mountain text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Discover Ethiopia Soon</h3>
                    <p class="text-slate-400 font-medium">We're adding breathtaking Ethiopian destinations to our catalog.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading destinations.</p>';
            }
            ?>
        </div>
    </div>
</div>