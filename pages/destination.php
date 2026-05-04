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

<!-- Destination Start -->
<section id="destination" class="py-32 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20 -mt-20"></div>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">World Explorer</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Top Global <span class="text-primary">Destinations</span></h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM destinations ORDER BY name ASC");
                $destinations = $stmt->fetchAll();
                if (count($destinations) > 0) {
                    foreach ($destinations as $dest):
            ?>
            <div class="relative group overflow-hidden h-[400px] rounded-[50px] shadow-xl hover-lift">
                <img src="<?php echo $dest['image_path']; ?>" alt="<?php echo $dest['name']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent flex flex-col items-center justify-end p-10">
                    <h5 class="text-white text-2xl font-black mb-1"><?php echo $dest['name']; ?></h5>
                    <span class="text-primary font-black text-xs tracking-widest uppercase"><?php echo $dest['category']; ?></span>
                    <?php if ($dest['discount_tag']): ?>
                        <div class="mt-4 px-4 py-2 bg-rose-500 text-white text-[10px] font-black rounded-xl shadow-lg"><?php echo $dest['discount_tag']; ?></div>
                    <?php endif; ?>
                    <div class="h-1 w-0 bg-primary mt-6 group-hover:w-full transition-all duration-500 rounded-full"></div>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-4 text-center py-20 glass rounded-[50px] border border-slate-100 w-full">
                    <i class="fas fa-globe-americas text-5xl text-primary/20 mb-6"></i>
                    <h3 class="text-2xl font-black text-secondary tracking-tight">World Destinations Coming Soon</h3>
                    <p class="text-slate-400 font-medium">We're mapping out the most incredible destinations for your bucket list.</p>
                </div>
            <?php
                }
            } catch (PDOException $e) {
                echo '<p>Error loading destinations.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Destination End -->

<!-- Featured Ethiopian Destinations -->
<div class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">National Pride</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Discover <span class="text-primary">Ethiopia</span></h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM destinations WHERE category = 'Ethiopia' ORDER BY name ASC");
                $ethiopia = $stmt->fetchAll();
                if (count($ethiopia) > 0) {
                    foreach ($ethiopia as $dest):
            ?>
            <div class="relative group overflow-hidden h-[500px] rounded-[60px] shadow-2xl hover-lift">
                <img src="<?php echo $dest['image_path']; ?>" alt="<?php echo $dest['name']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-dark/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 px-10 text-center backdrop-blur-sm">
                    <h5 class="text-white text-4xl font-black mb-4 tracking-tighter"><?php echo $dest['name']; ?></h5>
                    <div class="w-16 h-1 bg-primary rounded-full mb-6"></div>
                    <p class="text-white/90 text-sm font-medium leading-relaxed">Uncover the hidden gems and ancient secrets of <?php echo $dest['name']; ?> with AskMe.</p>
                </div>
            </div>
            <?php 
                    endforeach;
                } else {
            ?>
                <div class="lg:col-span-3 text-center py-20 glass rounded-[60px] border border-slate-100 w-full">
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