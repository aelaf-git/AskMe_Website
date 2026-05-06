<!-- Header Start -->
<div class="relative w-full pt-32 md:pt-48 pb-24 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="assets/img/carousel-2.jpg" class="w-full h-full object-cover opacity-20 scale-110">
        <div class="absolute inset-0 bg-gradient-to-b from-dark via-transparent to-dark"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <div class="inline-block px-4 py-2 glass rounded-xl text-xs font-black uppercase tracking-[3px] text-primary mb-6 animate-fade-in">AskMe Calendar</div>
        <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter mb-8 animate-slide-up"><?php echo $pageTitle; ?></h1>
        <div class="flex items-center justify-center space-x-4">
            <a href="index.php" class="text-white/50 hover:text-primary font-bold transition-colors">Home</a>
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            <span class="text-primary font-bold uppercase tracking-widest text-xs"><?php echo $pageTitle; ?></span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Events Start -->
<div class="py-32 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
                $events = $stmt->fetchAll();
                if (count($events) > 0) {
                    foreach ($events as $event) {
                        $date = new DateTime($event['event_date']);
            ?>
            <div class="group relative hover-lift">
                <div class="relative h-[500px] overflow-hidden rounded-[40px] shadow-2xl">
                    <img src="<?php echo $event['image_path']; ?>" alt="<?php echo $event['title']; ?>" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    
                    <div class="absolute top-6 left-6 bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-2xl p-3 text-center min-w-[80px]">
                        <span class="block text-2xl font-black leading-none"><?php echo $date->format('d'); ?></span>
                        <span class="block text-[10px] font-bold uppercase tracking-[2px] mt-1"><?php echo $date->format('M'); ?></span>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-primary text-white text-[10px] font-black uppercase tracking-[2px] rounded-lg">Featured</span>
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold rounded-lg"><?php echo $date->format('Y'); ?></span>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-3 line-clamp-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p class="text-slate-200 text-sm font-medium line-clamp-2 mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            <?php echo htmlspecialchars($event['short_description']); ?>
                        </p>
                        <a href="index.php?p=event_detail&id=<?php echo $event['id']; ?>" class="inline-flex items-center space-x-2 text-white font-bold group/btn">
                            <span class="text-sm uppercase tracking-widest relative">
                                Learn More
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/btn:w-full"></span>
                            </span>
                            <i class="fas fa-arrow-right text-primary transform group-hover/btn:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "<div class='col-span-full text-center py-20'>
                            <div class='w-24 h-24 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400'>
                                <i class='fas fa-calendar-times text-4xl'></i>
                            </div>
                            <h3 class='text-2xl font-black text-secondary'>No Upcoming Events</h3>
                            <p class='text-slate-500 mt-2'>Check back later for new events.</p>
                          </div>";
                }
            } catch (PDOException $e) {
                echo "<p class='text-red-500 text-center col-span-full'>Error loading events.</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Events End -->
