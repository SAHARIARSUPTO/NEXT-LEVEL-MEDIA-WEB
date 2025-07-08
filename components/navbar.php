<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$isContactPage = $currentPage === 'contact.php';
?>

<header class="fixed top-0 left-0 w-full z-50 py-4 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#1C1C24] rounded-full shadow-lg flex justify-between items-center h-16 px-6">

            <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="flex items-center space-x-2 text-white text-xl font-bold">
                    <img src="main-logo.png" alt="" class="w-16 h-16 object-contain">
                    <span class="ms-3 text-white hidden sm:inline sm:text-xl text-sm">NEXT LEVEL MEDIA</span>
                </a>
            </div>

            <nav class="flex space-x-2 text-xs font-medium text-white md:space-x-8 md:text-sm">
                <a href="index.php" class="hover:text-blue-400 transition">Home</a>

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

            <?php if (!$isContactPage): ?>
                <div class="hidden md:flex">
                    <a href="contact.php" class="inline-block px-6 py-2 bg-[#4252CC] text-white text-sm font-semibold rounded-full hover:bg-[#3543A6] transition">
                        Book A Call
                    </a>
                </div>
            <?php endif; ?>

            </div>
    </div>
</header>