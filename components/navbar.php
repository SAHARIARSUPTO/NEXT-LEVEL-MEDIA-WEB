<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$isContactPage = $currentPage === 'contact.php';
?>
<!-- Navigation Bar -->
<header class="fixed top-0 left-0 w-full z-50 transition-all duration-300 py-4 px-4 sm:px-6 lg:px-8" id="mainHeader">
  <div class="max-w-7xl mx-auto">
    <div class="relative flex items-center justify-between h-16 px-5 sm:px-7 rounded-full bg-[#0d0d12]/80 border border-white/10 backdrop-blur-xl shadow-[0_8px_32px_rgba(0,0,0,0.6)]">
      
      <!-- Brand Logo -->
      <a href="index.php" class="flex items-center space-x-3 group">
        <div class="relative flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600/30 to-violet-500/20 border border-white/10 overflow-hidden group-hover:scale-105 transition-transform duration-300">
          <img src="main-logo.png" alt="Next Level Media Logo" class="w-7 h-7 object-contain">
        </div>
        <span class="text-white font-bold text-sm sm:text-base tracking-wider uppercase font-['Plus_Jakarta_Sans',sans-serif]">
          NEXT LEVEL <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-violet-400">MEDIA</span>
        </span>
      </a>

      <!-- Desktop Navigation Links -->
      <nav class="hidden md:flex items-center space-x-1 lg:space-x-2 text-sm font-medium text-gray-300">
        <a href="index.php#" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Home</a>
        <?php if (!$isContactPage): ?>
          <a href="#projects" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Work</a>
          <a href="#clients-testimonials" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Reviews</a>
          <a href="#why-us" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Why Us</a>
          <a href="#core-services" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Services</a>
          <a href="#faq" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">FAQ</a>
        <?php else: ?>
          <a href="index.php#projects" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Work</a>
          <a href="index.php#clients-testimonials" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Reviews</a>
          <a href="index.php#core-services" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Services</a>
        <?php endif; ?>
        <a href="contact.php" class="px-3.5 py-1.5 rounded-full hover:text-white hover:bg-white/5 transition-colors">Contact</a>
        <a href="order.php" class="px-3.5 py-1.5 rounded-full text-violet-400 font-bold hover:text-violet-300 hover:bg-violet-600/15 transition-all">Order ➔</a>
      </nav>

      <!-- CTA Button (Desktop) - MZ Media Style -->
      <div class="hidden md:flex items-center">
        <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="group relative inline-flex items-center gap-2.5 px-5 py-2 rounded-full bg-white text-black font-semibold text-xs uppercase tracking-wider overflow-hidden hover:bg-white/95 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.25)] hover:shadow-[0_0_25px_rgba(99,102,241,0.5)]">
          <span>Let's Talk</span>
          <div class="flex items-center justify-center w-6 h-6 rounded-full bg-black text-white group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300">
            <svg class="w-3 h-3 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </div>
        </a>
      </div>

      <!-- Mobile Menu Toggle Button -->
      <div class="flex md:hidden">
        <button id="mobileMenuBtn" aria-label="Toggle navigation menu" class="p-2 rounded-full text-gray-300 hover:text-white hover:bg-white/10 focus:outline-none transition">
          <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobileMenu" class="md:hidden hidden mt-3 p-5 rounded-3xl bg-[#0e0e14]/95 border border-white/10 backdrop-blur-2xl shadow-2xl space-y-3 text-center transition-all duration-300">
      <a href="index.php#" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Home</a>
      <?php if (!$isContactPage): ?>
        <a href="#projects" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Work</a>
        <a href="#clients-testimonials" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Reviews</a>
        <a href="#why-us" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Why Us</a>
        <a href="#core-services" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Services</a>
        <a href="#faq" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">FAQ</a>
      <?php else: ?>
        <a href="index.php#projects" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Work</a>
        <a href="index.php#clients-testimonials" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Reviews</a>
      <?php endif; ?>
      <a href="contact.php" class="block py-2 text-gray-200 hover:text-white text-sm font-medium">Contact</a>
      <a href="order.php" class="block py-2 text-violet-400 font-bold text-sm">★ Create Project Order</a>
      <div class="pt-2">
        <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="w-full flex items-center justify-center gap-2 py-3 rounded-full bg-gradient-to-r from-blue-600 to-violet-600 text-white font-semibold text-sm shadow-lg">
          <span>Book A Discovery Call</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</header>

<script>
  (function() {
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');
    if (btn && menu) {
      btn.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden', !isOpen);
        closeIcon.classList.toggle('hidden', isOpen);
      });
      // Close menu on link click
      menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          menu.classList.add('hidden');
          menuIcon.classList.remove('hidden');
          closeIcon.classList.add('hidden');
        });
      });
    }
  })();
</script>
