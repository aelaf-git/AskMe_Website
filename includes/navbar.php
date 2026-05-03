    <!-- Navbar Start -->
    <div class="relative w-full z-50">
        <div class="max-w-7xl mx-auto lg:px-6">
            <nav class="flex flex-wrap items-center justify-between bg-white shadow-lg py-3 lg:py-0 px-4 lg:px-10">
                <a href="index.php" class="text-3xl font-bold flex items-center">
                    <span class="text-primary"><span class="text-dark">Ask</span>Me</span>
                </a>
                <button id="nav-toggle" type="button" class="lg:hidden text-gray-500 hover:text-primary focus:outline-none">
                    <span class="fa fa-bars text-2xl"></span>
                </button>
                <div id="nav-content" class="hidden lg:flex w-full lg:w-auto flex-col lg:flex-row lg:items-center lg:ml-auto">
                    <div class="flex flex-col lg:flex-row">
                        <a href="index.php" class="py-4 px-4 text-dark hover:text-primary font-medium transition-colors <?php echo (!isset($_GET['p']) || $_GET['p'] == 'home') ? 'text-primary' : ''; ?>">Home</a>
                        <a href="index.php?p=about" class="py-4 px-4 text-dark hover:text-primary font-medium transition-colors <?php echo (isset($_GET['p']) && $_GET['p'] == 'about') ? 'text-primary' : ''; ?>">About</a>
                        <a href="index.php?p=service" class="py-4 px-4 text-dark hover:text-primary font-medium transition-colors <?php echo (isset($_GET['p']) && $_GET['p'] == 'service') ? 'text-primary' : ''; ?>">Services</a>
                        <a href="index.php?p=package" class="py-4 px-4 text-dark hover:text-primary font-medium transition-colors <?php echo (isset($_GET['p']) && $_GET['p'] == 'package') ? 'text-primary' : ''; ?>">Tour Packages</a>
                        
                        <!-- Dropdown -->
                        <div class="relative group">
                            <button class="w-full lg:w-auto text-left py-4 px-4 text-dark hover:text-primary font-medium flex items-center justify-between transition-colors">
                                Pages <i class="fa fa-angle-down ml-2"></i>
                            </button>
                            <div class="lg:absolute lg:hidden group-hover:block bg-white lg:shadow-xl lg:min-w-[200px] left-0 top-full z-[100]">
                                <a href="index.php?p=blog" class="block py-3 px-6 text-dark hover:bg-gray-100 hover:text-primary transition-colors">Blog Grid</a>
                                <a href="index.php?p=single" class="block py-3 px-6 text-dark hover:bg-gray-100 hover:text-primary transition-colors">Blog Detail</a>
                                <a href="index.php?p=destination" class="block py-3 px-6 text-dark hover:bg-gray-100 hover:text-primary transition-colors">Destination</a>
                                <a href="index.php?p=guide" class="block py-3 px-6 text-dark hover:bg-gray-100 hover:text-primary transition-colors">Travel Guides</a>
                                <a href="index.php?p=testimonial" class="block py-3 px-6 text-dark hover:bg-gray-100 hover:text-primary transition-colors">Testimonial</a>
                            </div>
                        </div>

                        <a href="index.php?p=contact" class="py-4 px-4 text-dark hover:text-primary font-medium transition-colors <?php echo (isset($_GET['p']) && $_GET['p'] == 'contact') ? 'text-primary' : ''; ?>">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    
    <script>
        document.getElementById('nav-toggle').onclick = function() {
            var content = document.getElementById('nav-content');
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                content.classList.add('block');
            } else {
                content.classList.add('hidden');
                content.classList.remove('block');
            }
        }
    </script>
    <!-- Navbar End -->