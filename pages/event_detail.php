<?php
require_once 'includes/db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch();

    if (!$event) {
        echo '<div class="py-40 text-center text-4xl font-bold">Event Not Found</div>';
        return;
    }
    
    $date = new DateTime($event['event_date']);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!-- Header Start -->
<div class="relative w-full py-32 bg-dark overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo $event['image_path']; ?>" class="w-full h-full object-cover opacity-40">
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-7xl font-black text-white uppercase mb-6"><?php echo $event['title']; ?></h1>
        <div class="flex items-center justify-center text-white space-x-4 font-bold tracking-widest uppercase text-sm">
            <a href="index.php" class="text-white hover:text-primary transition-colors">Home</a>
            <i class="fa fa-angle-double-right text-primary"></i>
            <span class="text-primary">Event Detail</span>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Event Detail Start -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-8">
            <!-- Content -->
            <div class="w-full lg:w-8/12 px-8">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                    <div class="relative h-[450px]">
                        <img src="<?php echo $event['image_path']; ?>" class="w-full h-full object-cover">
                        <div class="absolute bottom-10 left-10 bg-primary text-white p-6 rounded-2xl shadow-2xl">
                            <h4 class="text-4xl font-black"><?php echo $date->format('d'); ?></h4>
                            <p class="uppercase font-bold tracking-widest text-sm"><?php echo $date->format('M Y'); ?></p>
                        </div>
                    </div>
                    <div class="p-10 md:p-16">
                        <div class="flex items-center space-x-4 text-primary font-bold uppercase tracking-[3px] text-xs mb-8">
                            <span><i class="far fa-calendar-alt mr-2"></i> <?php echo $date->format('F d, Y'); ?></span>
                            <span class="text-gray-200">|</span>
                            <span><i class="far fa-clock mr-2"></i> Annual Festival</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black text-dark mb-10 leading-tight"><?php echo $event['title']; ?></h2>
                        <div class="prose prose-xl max-w-none text-gray-600 leading-relaxed space-y-8">
                            <p class="font-semibold text-xl text-dark leading-relaxed italic border-l-4 border-primary pl-6 py-2 bg-gray-50 rounded-r-xl">
                                <?php echo $event['short_description']; ?>
                            </p>
                            <div class="text-lg whitespace-pre-line">
                                <?php echo $event['long_description']; ?>
                            </div>
                        </div>
                        
                        <!-- Share -->
                        <div class="mt-16 pt-10 border-t border-gray-100 flex items-center justify-between flex-wrap gap-6">
                            <div class="flex items-center space-x-4">
                                <span class="font-bold text-dark uppercase tracking-widest text-xs">Share this event:</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-dark flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-dark flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="w-10 h-10 bg-gray-100 text-dark flex items-center justify-center rounded-full hover:bg-primary hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <a href="index.php?p=contact" class="btn-primary">Inquire About This Event</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-4/12 px-8 mt-16 lg:mt-0">
                <div class="bg-dark rounded-3xl p-10 text-white shadow-2xl sticky top-10">
                    <h4 class="text-2xl font-bold mb-8 flex items-center">
                        <span class="w-8 h-1 bg-primary mr-4 rounded-full"></span>
                        Recent Events
                    </h4>
                    <div class="space-y-8">
                        <?php
                        $stmtRecent = $pdo->prepare("SELECT * FROM events WHERE id != ? ORDER BY event_date DESC LIMIT 3");
                        $stmtRecent->execute([$id]);
                        while ($recent = $stmtRecent->fetch()) {
                            $rDate = new DateTime($recent['event_date']);
                        ?>
                        <a href="index.php?p=event_detail&id=<?php echo $recent['id']; ?>" class="group flex items-center space-x-4">
                            <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden shadow-lg border border-white/10">
                                <img src="<?php echo $recent['image_path']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <h5 class="font-bold text-white group-hover:text-primary transition-colors leading-tight mb-2"><?php echo $recent['title']; ?></h5>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold"><?php echo $rDate->format('M d, Y'); ?></p>
                            </div>
                        </a>
                        <?php } ?>
                    </div>

                    <div class="mt-12 p-8 bg-white/5 rounded-2xl border border-white/10">
                        <h5 class="text-xl font-bold mb-4">Book a Customized Tour</h5>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed">Let us plan your perfect journey to experience these events in person.</p>
                        <a href="index.php?p=package" class="block text-center py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all">View Packages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Event Detail End -->
