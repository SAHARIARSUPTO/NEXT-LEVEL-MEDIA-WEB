<!-- Footer Component (Square Obsidian Aesthetic with Cyber Glow Border) -->
<footer class="relative w-full bg-black border-t border-white/10 pt-10 sm:pt-20 pb-8 sm:pb-12 overflow-hidden text-gray-400">
  
  <!-- Sleek Cyber Glow Border Image from MZ Style -->
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-6xl pointer-events-none z-10 opacity-80 flex justify-center">
    <img src="border-img" alt="Glow Border Accent" class="w-full max-w-[800px] h-auto object-contain select-none pointer-events-none" />
  </div>

  <!-- Ambient Bottom Glow -->
  <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[250px] bg-gradient-to-t from-[#535eee]/15 via-[#535eee]/5 to-transparent rounded-none blur-[140px] pointer-events-none"></div>

  <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 relative z-10">
    
    <!-- Big Pre-Footer CTA Card (Whitened Border & White Hover) -->
    <div class="relative p-4 sm:p-12 lg:p-16 rounded-none bg-[#09090d] border-2 border-white/25 shadow-[0_20px_70px_rgba(0,0,0,0.95)] hover:border-white hover:shadow-[0_20px_80px_rgba(255,255,255,0.25)] text-center mb-8 sm:mb-16 overflow-hidden transition-all duration-500" data-aos="fade-up">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_70%)] pointer-events-none"></div>
      
      <!-- Top Glow Border on the Card -->
      <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-white to-transparent pointer-events-none"></div>
      
      <div class="max-w-3xl mx-auto relative z-10">
        <div class="inline-flex items-center gap-1.5 sm:gap-2 px-3 py-1 sm:px-4 sm:py-1.5 rounded-none bg-white/10 border border-white/25 backdrop-blur-md mb-4 sm:mb-6">
          <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-none bg-emerald-400 animate-pulse"></span>
          <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-white">Accepting 3 New Brands This Month</span>
        </div>
        
        <h2 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] sm:leading-[1.1] font-display">
          Ready to scale your content <br class="hidden sm:inline" />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-[#8d96ff] to-[#535eee]">to the Next Level?</span>
        </h2>
        
        <p class="mt-2.5 sm:mt-4 text-xs sm:text-base text-gray-300 max-w-xl mx-auto leading-relaxed">
          Send us your email and query for an instant project review, or schedule a 15-minute creative strategy call.
        </p>

        <!-- Direct Touch Quick Form -->
        <form id="footerDirectTouchForm" class="mt-6 sm:mt-8 max-w-xl mx-auto text-left space-y-3">
          <div class="grid grid-cols-1 sm:grid-cols-12 gap-2.5 sm:gap-3">
            <div class="sm:col-span-6">
              <label for="quick_email" class="block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-300 mb-1">Your Email *</label>
              <input type="email" id="quick_email" name="email" required placeholder="name@company.com" class="w-full px-3.5 py-2.5 sm:px-4 sm:py-3 bg-white/[0.04] border-2 border-white/25 rounded-none text-white text-xs sm:text-sm focus:outline-none focus:border-white focus:bg-white/[0.08] transition-all placeholder:text-gray-500" />
            </div>
            <div class="sm:col-span-6">
              <label for="quick_name" class="block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-300 mb-1">Your Name (Optional)</label>
              <input type="text" id="quick_name" name="name" placeholder="John Doe" class="w-full px-3.5 py-2.5 sm:px-4 sm:py-3 bg-white/[0.04] border-2 border-white/25 rounded-none text-white text-xs sm:text-sm focus:outline-none focus:border-white focus:bg-white/[0.08] transition-all placeholder:text-gray-500" />
            </div>
          </div>
          <div>
            <label for="quick_message" class="block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-300 mb-1">Query Message (Optional)</label>
            <textarea id="quick_message" name="message" rows="2" placeholder="Tell us about your brand goals, video needs, or target deadline..." class="w-full px-3.5 py-2.5 sm:px-4 sm:py-3 bg-white/[0.04] border-2 border-white/25 rounded-none text-white text-xs sm:text-sm focus:outline-none focus:border-white focus:bg-white/[0.08] transition-all placeholder:text-gray-500 resize-none"></textarea>
          </div>
          
          <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4 pt-1">
            <button type="submit" id="quickSubmitBtn" class="w-full sm:w-auto px-5 py-2.5 sm:px-7 sm:py-3 rounded-none bg-white text-black font-bold text-xs sm:text-sm uppercase tracking-wider shadow-[0_0_30px_rgba(255,255,255,0.4)] hover:shadow-[0_0_50px_rgba(255,255,255,0.9)] hover:bg-white border-2 border-white transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer">
              <span>Send Direct Message</span>
              <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <span class="text-[10px] sm:text-[11px] text-gray-400 text-center sm:text-right">⚡ Direct notification sent to creative leads</span>
          </div>

          <div id="quickFormStatus" class="hidden p-3 rounded-none text-xs font-bold text-center mt-3"></div>
        </form>

        <div class="mt-8 pt-6 border-t border-white/15 flex flex-col sm:flex-row items-center justify-center gap-4">
          <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Or schedule directly:</span>
          <!-- Main Action Button -->
          <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="mz-btn bg-[#13131e] text-white border-2 border-white/30 hover:border-white hover:bg-white hover:text-black w-full sm:w-auto justify-center rounded-none transition-all duration-300">
            <span>Book A Strategy Call</span>
            <div class="mz-btn-icon bg-white/10 text-white rounded-none">
              <svg class="w-3.5 h-3.5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </div>
          </a>

          <!-- Create Order Button -->
          <a href="order.php" class="mz-btn bg-[#535eee]/20 text-[#8d96ff] border-2 border-white/30 hover:bg-[#1f1f30] hover:border-white hover:text-white w-full sm:w-auto justify-center backdrop-blur-xl rounded-none shadow-[0_0_20px_rgba(0,0,0,0.5)] hover:shadow-[0_0_40px_rgba(255,255,255,0.4)]">
            <span>Start A Project Order</span>
            <div class="mz-btn-icon bg-white/10 text-white rounded-none">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Footer Main Columns -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-white/15">
      
      <!-- Brand Summary Column -->
      <div class="md:col-span-5 space-y-5">
        <a href="index.php" class="flex items-center space-x-3 group w-fit">
          <div class="w-10 h-10 rounded-none bg-gradient-to-tr from-[#535eee]/30 to-[#3b46cf]/20 border border-white/30 flex items-center justify-center overflow-hidden shadow-[0_0_15px_rgba(255,255,255,0.2)]">
            <img src="main-logo.png" alt="Logo" class="w-7 h-7 object-contain">
          </div>
          <span class="text-white font-black text-lg tracking-wider uppercase font-display">
            NEXT LEVEL <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#535eee] to-[#8d96ff]">MEDIA</span>
          </span>
        </a>

        <p class="text-sm text-gray-300 max-w-sm leading-relaxed">
          High-performance video production, retention editing, and creative growth systems for creators, SaaS founders, and global brands.
        </p>

        <!-- Social Brand Logos Row -->
        <div class="pt-2">
          <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Official Channels & Contact</h4>
          <div class="flex items-center gap-3">
            
            <!-- WhatsApp / Phone -->
            <?php 
            $clean_phone = preg_replace('/[^0-9]/', '', get_setting('contact_phone', '8801753506047')); 
            ?>
            <a href="https://wa.me/<?= $clean_phone; ?>" target="_blank" rel="noopener noreferrer" title="WhatsApp: <?= htmlspecialchars(get_setting('contact_phone', '+880 1753-506047')); ?>" class="w-10 h-10 rounded-none bg-emerald-500/15 border border-white/20 flex items-center justify-center text-emerald-400 hover:text-white hover:bg-emerald-600 hover:border-white hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transition-all">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.693.076-1.127-.063-.264-.085-.604-.207-1.042-.396-1.849-.798-3.045-2.673-3.137-2.797-.093-.125-.758-.999-.758-1.905s.475-1.353.644-1.54c.169-.187.369-.234.492-.234.124 0 .247.001.355.006.114.006.266-.043.416.319.155.374.529 1.292.576 1.385.046.094.077.203.015.328-.061.125-.092.203-.184.312-.092.11-.194.244-.277.328-.093.094-.19.196-.082.383.108.187.479.79 1.028 1.28.707.63 1.303.824 1.49.918.187.094.296.079.406-.047.11-.125.468-.546.593-.733.125-.187.249-.156.417-.094.168.063 1.066.503 1.249.596.183.094.305.14.351.219.046.078.046.452-.098.857z"/>
              </svg>
            </a>

            <!-- YouTube -->
            <a href="<?= htmlspecialchars(get_setting('social_youtube', 'https://youtube.com/@nextlevelmedia')); ?>" target="_blank" rel="noopener noreferrer" title="YouTube" class="w-10 h-10 rounded-none bg-white/5 border border-white/20 flex items-center justify-center text-gray-300 hover:text-white hover:bg-red-600/30 hover:border-white hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transition-all">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
              </svg>
            </a>

            <!-- Instagram -->
            <a href="<?= htmlspecialchars(get_setting('social_instagram', 'https://www.instagram.com/nextlevelmedia_production/')); ?>" target="_blank" rel="noopener noreferrer" title="Instagram" class="w-10 h-10 rounded-none bg-white/5 border border-white/20 flex items-center justify-center text-gray-300 hover:text-white hover:bg-pink-600/30 hover:border-white hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transition-all">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>

            <!-- LinkedIn -->
            <a href="<?= htmlspecialchars(get_setting('social_linkedin', 'https://www.linkedin.com/company/nextlevelmedia')); ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn" class="w-10 h-10 rounded-none bg-white/5 border border-white/20 flex items-center justify-center text-gray-300 hover:text-white hover:bg-blue-600/30 hover:border-white hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transition-all">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
              </svg>
            </a>

            <!-- Direct Email -->
            <a href="mailto:<?= htmlspecialchars(get_setting('contact_email', 'contact@nextlevelmediadigital.com')); ?>" title="Send Email" class="w-10 h-10 rounded-none bg-white/5 border border-white/20 flex items-center justify-center text-gray-300 hover:text-white hover:bg-white/20 hover:border-white hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transition-all">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </a>

          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="md:col-span-3">
        <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Navigation</h4>
        <ul class="space-y-2.5 text-sm">
          <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
          <li><a href="index.php#projects" class="hover:text-white transition-colors">Featured Portfolio</a></li>
          <li><a href="index.php#strategy" class="hover:text-white transition-colors">How It Works</a></li>
          <li><a href="index.php#clients-testimonials" class="hover:text-white transition-colors">Client Reviews</a></li>
          <li><a href="index.php#core-services" class="hover:text-white transition-colors">Services & Deliverables</a></li>
          <li><a href="contact.php" class="hover:text-white transition-colors">Contact Us</a></li>
          <li><a href="order.php" class="text-white font-semibold hover:text-[#8d96ff] transition-colors">★ Create Project Order</a></li>
        </ul>
      </div>

      <!-- Services List -->
      <div class="md:col-span-4">
        <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Production Solutions</h4>
        <ul class="space-y-2.5 text-sm">
          <li class="text-gray-300">⚡ Viral Shorts, Reels & TikTok Systems</li>
          <li class="text-gray-300">🎬 High-Retention YouTube Video Editing</li>
          <li class="text-gray-300">🎯 Direct Response VSLs & Paid Ad Creatives</li>
          <li class="text-gray-300">🧊 3D Motion Graphics & Product Assets</li>
          <li class="text-gray-300">🖼️ Custom High-CTR Thumbnail Strategy</li>
        </ul>

        <div class="mt-6 pt-4 border-t border-white/10 text-xs text-gray-400 flex items-center gap-2">
          <span class="w-2 h-2 rounded-none bg-emerald-400"></span>
          <span>Average turn-around: 24 to 48 hours</span>
        </div>
      </div>

    </div>

    <!-- Bottom Copyright & Modals -->
    <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-4 border-t border-white/5 mt-8">
      <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4">
        <span>&copy; <?= date('Y'); ?> Next Level Media. All rights reserved.</span>
        <span class="hidden sm:inline text-gray-700">|</span>
        <span>Developed by <a href="https://dev-sahariarsupto.vercel.app" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 font-semibold transition-colors underline underline-offset-2">Sahariar Supto</a></span>
      </div>
      <div class="flex items-center space-x-6">
        <button id="openPrivacyModal" class="hover:text-gray-300 transition-colors focus:outline-none">Privacy Policy</button>
        <button id="openTermsModal" class="hover:text-gray-300 transition-colors focus:outline-none">Terms of Service</button>
        <a href="admin/login.php" class="text-gray-600 hover:text-gray-400 transition-colors">Admin Portal</a>
      </div>
    </div>

  </div>
</footer>

<!-- Privacy Policy Modal -->
<div id="privacyModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300">
  <div class="relative w-full max-w-2xl bg-[#12121a] border-2 border-white/30 rounded-none p-6 sm:p-8 max-h-[85vh] overflow-y-auto text-gray-300 shadow-2xl">
    <button id="closePrivacyModal" class="absolute top-5 right-5 text-gray-400 hover:text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <h3 class="text-xl font-bold text-white mb-4 font-display">Privacy Policy</h3>
    <div class="space-y-3 text-sm leading-relaxed text-gray-400">
      <p>At Next Level Media, your privacy is a paramount priority. We collect only necessary information to deliver our media production, strategy, and creative services.</p>
      <p>Any media files, videos, script drafts, and branding guidelines shared with us remain strictly confidential and will never be shared or distributed without explicit written permission.</p>
      <p>If you have any questions regarding your data or request deletion of communication logs, feel free to contact our data team at contact@nextlevelmediadigital.com.</p>
    </div>
  </div>
</div>

<!-- Terms of Service Modal -->
<div id="termsModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300">
  <div class="relative w-full max-w-2xl bg-[#12121a] border-2 border-white/30 rounded-none p-6 sm:p-8 max-h-[85vh] overflow-y-auto text-gray-300 shadow-2xl">
    <button id="closeTermsModal" class="absolute top-5 right-5 text-gray-400 hover:text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <h3 class="text-xl font-bold text-white mb-4 font-display">Terms of Service</h3>
    <div class="space-y-3 text-sm leading-relaxed text-gray-400">
      <p>By engaging with Next Level Media services or browsing our site, you agree to our standard service guidelines.</p>
      <p>All video deliverables, motion designs, and final exports transfer full copyright and ownership to the client upon receipt of final settlement.</p>
      <p>Revisions are conducted until customer satisfaction within the outlined project scope. Custom requests outside scope will be quoted transparently.</p>
    </div>
  </div>
</div>

<script>
  (function() {
    function setupModal(openBtnId, closeBtnId, modalId) {
      const openBtn = document.getElementById(openBtnId);
      const closeBtn = document.getElementById(closeBtnId);
      const modal = document.getElementById(modalId);
      if (!openBtn || !closeBtn || !modal) return;

      openBtn.addEventListener('click', () => {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        document.body.style.overflow = 'hidden';
      });

      const close = () => {
        modal.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = 'auto';
      };

      closeBtn.addEventListener('click', close);
      modal.addEventListener('click', (e) => {
        if (e.target === modal) close();
      });
    }

    setupModal('openPrivacyModal', 'closePrivacyModal', 'privacyModal');
    setupModal('openTermsModal', 'closeTermsModal', 'termsModal');

    // Quick Direct Touch Form Handler
    const quickForm = document.getElementById('footerDirectTouchForm');
    const quickStatus = document.getElementById('quickFormStatus');
    const quickBtn = document.getElementById('quickSubmitBtn');

    if (quickForm && quickStatus && quickBtn) {
      quickForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const originalText = quickBtn.innerHTML;
        quickBtn.disabled = true;
        quickBtn.innerHTML = '<span>Sending...</span><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>';
        quickStatus.className = 'hidden p-3 rounded-none text-xs font-bold text-center mt-3';

        const formData = new FormData(quickForm);

        try {
          const res = await fetch('api_quick_contact.php', {
            method: 'POST',
            body: formData
          });
          const result = await res.json();

          if (result.success) {
            quickStatus.className = 'p-3 rounded-none text-xs font-bold text-center mt-3 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 shadow-[0_0_20px_rgba(16,185,129,0.25)]';
            quickStatus.textContent = result.message || 'Thank you! Message received. We will get back to you shortly.';
            quickStatus.classList.remove('hidden');
            quickForm.reset();
          } else {
            quickStatus.className = 'p-3 rounded-none text-xs font-bold text-center mt-3 bg-red-500/15 border border-red-500/30 text-red-300';
            quickStatus.textContent = result.error || 'Failed to submit. Please try again.';
            quickStatus.classList.remove('hidden');
          }
        } catch (err) {
          quickStatus.className = 'p-3 rounded-none text-xs font-bold text-center mt-3 bg-red-500/15 border border-red-500/30 text-red-300';
          quickStatus.textContent = 'Network error. Please try again or reach out via email.';
          quickStatus.classList.remove('hidden');
        } finally {
          quickBtn.disabled = false;
          quickBtn.innerHTML = originalText;
        }
      });
    }
  })();
</script>
