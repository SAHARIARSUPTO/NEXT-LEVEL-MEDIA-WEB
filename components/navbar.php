<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$isContactPage = $currentPage === 'contact.php';
?>
 <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
<style>
     body {
            
            font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
         
            
        }
</style>
<header class="fixed top-0 left-0 w-full z-50 bg-transparent py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#1C1C24] rounded-full shadow-lg flex justify-between items-center h-16 px-6">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="flex items-center space-x-2 text-white text-xl font-bold">
                    <img src="main-logo.png" alt="Logo" class="w-12 h-12 object-contain">
                    <span class="ms-2  sm:inline text-white text-sm sm:text-xl">NEXT LEVEL MEDIA</span>
                </a>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex space-x-4 lg:space-x-8 text-xs font-medium text-white lg:text-sm">
                <a href="/" class="hover:text-blue-400 transition">Home</a>
                <?php if (!$isContactPage): ?>
                    <a href="#clients-testimonials" class="hover:text-blue-400 transition">Reviews</a>
                    <a href="#projects" class="hover:text-blue-400 transition">Works</a>
                    <a href="#core-services" class="hover:text-blue-400 transition">Services</a>
                    <a href="contact.php" class="hover:text-blue-400 transition">Contact</a>
                <?php else: ?>
                    <span class="opacity-40 cursor-not-allowed">Reviews</span>
                    <span class="opacity-40 cursor-not-allowed">Works</span>
                    <span class="opacity-40 cursor-not-allowed">Services</span>
                    <span class="opacity-40 cursor-not-allowed">Contact</span>
                <?php endif; ?>
            </nav>

            <!-- CTA Button (Desktop Only) -->
            <?php if (!$isContactPage): ?>
                <div class="hidden md:flex">
                    <a href="contact.php" class="inline-block px-6 py-2 bg-[#4252CC] text-white text-sm font-semibold rounded-full hover:bg-[#3543A6] transition">
                        Book A Call
                    </a>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobileMenuBtn" class="text-white focus:outline-none">
                    <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div id="mobileMenu" class="md:hidden mt-2 hidden bg-[#1C1C24] rounded-lg shadow-lg p-4 space-y-3 text-white">
            <a href="/" class="block hover:text-blue-400 transition">Home</a>
            <?php if (!$isContactPage): ?>
                <a href="#clients-testimonials" class="block hover:text-blue-400 transition">Reviews</a>
                <a href="#projects" class="block hover:text-blue-400 transition">Works</a>
                <a href="#core-services" class="block hover:text-blue-400 transition">Services</a>
                <a href="contact.php" class="block hover:text-blue-400 transition">Contact</a>
                <a href="https://calendly.com/siamahmedshanto3954/30min" class="block mt-2 px-4 py-2 bg-[#4252CC] rounded-full text-center text-sm hover:bg-[#3543A6] transition">Book A Call</a>
            <?php else: ?>
                <span class="block opacity-40 cursor-not-allowed">Reviews</span>
                <span class="block opacity-40 cursor-not-allowed">Works</span>
                <span class="block opacity-40 cursor-not-allowed">Services</span>
                <span class="block opacity-40 cursor-not-allowed">Contact</span>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Toggle Script -->
<script>
    const menuBtn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>
