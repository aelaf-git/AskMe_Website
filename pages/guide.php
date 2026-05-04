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

<!-- Team Start -->
<section id="team" class="py-32 bg-white relative overflow-hidden">
    <div class="absolute top-1/2 right-0 w-1/3 h-1/3 bg-primary/5 rounded-full blur-[120px] -mr-20"></div>
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <div class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-xl text-xs font-black uppercase tracking-[3px] mb-6">Visionaries</div>
            <h1 class="text-4xl md:text-6xl font-black text-secondary tracking-tighter">Meet Our <span class="text-primary">Experts</span></h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM team ORDER BY id ASC");
                while ($member = $stmt->fetch()):
            ?>
            <div class="group relative hover-lift">
                <div class="relative overflow-hidden aspect-[4/5] rounded-[50px] shadow-2xl bg-slate-50 border-4 border-white">
                    <img src="<?php echo $member['image_path']; ?>" alt="<?php echo $member['name']; ?>" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/20 to-transparent flex flex-col justify-end p-8 translate-y-8 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px]">
                        <div class="flex flex-col space-y-2 mb-6">
                            <h5 class="text-2xl font-black text-white tracking-tight"><?php echo $member['name']; ?></h5>
                            <p class="text-primary text-[10px] font-black uppercase tracking-[3px]"><?php echo $member['designation']; ?></p>
                        </div>
                        <div class="flex space-x-4">
                            <?php if ($member['facebook_url']): ?>
                                <a href="<?php echo $member['facebook_url']; ?>" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300 shadow-lg"><i class="fab fa-facebook-f text-sm"></i></a>
                            <?php endif; ?>
                            <?php if ($member['instagram_url']): ?>
                                <a href="<?php echo $member['instagram_url']; ?>" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300 shadow-lg"><i class="fab fa-instagram text-sm"></i></a>
                            <?php endif; ?>
                            <?php if ($member['linkedin_url']): ?>
                                <a href="<?php echo $member['linkedin_url']; ?>" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-white hover:bg-primary transition-all duration-300 shadow-lg"><i class="fab fa-linkedin-in text-sm"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center group-hover:-translate-y-2 transition-transform duration-500">
                    <h5 class="text-xl font-black text-secondary tracking-tight mb-1"><?php echo $member['name']; ?></h5>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest"><?php echo $member['designation']; ?></p>
                </div>
            </div>
            <?php 
                endwhile;
            } catch (PDOException $e) {
                echo '<p>Error loading team members.</p>';
            }
            ?>
        </div>
    </div>
</section>
<!-- Team End -->