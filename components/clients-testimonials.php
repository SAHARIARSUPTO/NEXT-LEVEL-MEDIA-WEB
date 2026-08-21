<?php
// Dynamic client testimonial reviews loaded from DB/JSON with links and details
$testimonials_list = get_client_reviews();
?>

<!-- Social Proof & Reviews Section (Exact MZ Media Architecture) -->
<section class="relative w-full py-5 sm:py-16 px-3 sm:px-6 lg:px-8 bg-transparent overflow-hidden" id="clients-testimonials">

  <div class="max-w-7xl mx-auto relative z-10">
    
    <!-- Section Title Block (MZ Media Exact Header) -->
    <div class="text-center max-w-3xl mx-auto mb-4 sm:mb-8" data-aos="fade-up">
      <h2 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight font-display">
        Reviews
      </h2>
      <p class="mt-1.5 text-xs sm:text-base md:text-lg text-gray-300">
        Don't take our word for it.
      </p>
    </div>

    <!-- Review Highlight Pill (MZ Media Style Trusted By Box) -->
    <div class="flex items-center justify-center mb-4 sm:mb-10 px-1" data-aos="fade-up" data-aos-delay="50">
      <div class="group relative py-2 px-3 sm:h-14 sm:min-h-[56px] sm:px-8 bg-black border-2 border-white/30 shadow-[0_0_25px_rgba(255,255,255,0.15)] hover:border-white hover:shadow-[0_0_40px_rgba(255,255,255,0.5)] transition-all duration-300 backdrop-blur-xl rounded-none flex flex-wrap sm:flex-nowrap items-center justify-center gap-2.5 sm:gap-5 cursor-pointer max-w-full">
        
        <!-- Circled Brand Avatars First -->
        <div class="flex -space-x-2 sm:-space-x-3 items-center py-0.5">
          <img src="brands/1.jpeg" alt="Brand 1" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-110 hover:!scale-135 hover:!z-30 shrink-0" />
          <img src="brands/2.webp" alt="Brand 2" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-110 hover:!scale-135 hover:!z-30 shrink-0" />
          <img src="brands/3.webp" alt="Brand 3" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-110 hover:!scale-135 hover:!z-30 shrink-0" />
          <img src="brands/4.jpg" alt="Brand 4" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-110 hover:!scale-135 hover:!z-30 shrink-0" />
          <img src="brands/5.png" alt="Brand 5" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-110 hover:!scale-135 hover:!z-30 shrink-0" />
        </div>

        <!-- Vertical Divider -->
        <div class="hidden sm:block h-6 w-[1px] bg-white/20"></div>

        <!-- 50+ Founder Reviews with Star Animation -->
        <div class="flex items-center gap-1.5 sm:gap-2">
          <div class="flex text-amber-400 text-[10px] sm:text-sm tracking-wider animate-pulse">★★★★★</div>
          <span class="text-[10px] sm:text-sm font-extrabold uppercase tracking-wider text-white font-display whitespace-nowrap">50+ Founder Reviews</span>
        </div>

      </div>
    </div>

    <!-- Review Cards Grid (MZ Media review-card-block with Cyber Polish) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-7" data-aos="fade-up" data-aos-delay="100">
      
      <?php foreach ($testimonials_list as $t): ?>
        <?php $has_link = !empty($t['link_url']); ?>
        <div class="group relative p-3.5 sm:p-7 rounded-none bg-[#09090d]/90 border-2 border-white/20 backdrop-blur-xl shadow-xl flex flex-col justify-between hover:border-white hover:shadow-[0_0_35px_rgba(255,255,255,0.35)] transition-all duration-300">
          
          <!-- Top Quote Text -->
          <p class="text-xs sm:text-base text-gray-200 font-medium leading-relaxed mb-4 sm:mb-6">
            "<?= htmlspecialchars($t['quote']); ?>"
          </p>
          
          <!-- Bottom Client & Brand Info (Flexible Multi-line Wrap for Long Names) -->
          <div class="flex flex-wrap items-center justify-between gap-2.5 sm:gap-3 pt-3 sm:pt-4 border-t border-white/15">
            
            <div class="flex items-center gap-2.5 sm:gap-3 min-w-0 flex-1">
              <img src="<?= htmlspecialchars($t['avatar']); ?>" 
                   alt="<?= htmlspecialchars($t['name']); ?>" 
                   class="w-9 h-9 sm:w-11 sm:h-11 rounded-full object-cover border-2 border-white/70 shadow-md shrink-0" />
              <div class="min-w-0 flex-1">
                <h4 class="text-xs sm:text-sm font-extrabold text-white leading-snug font-display flex flex-wrap items-center gap-1">
                  <span class="break-words"><?= htmlspecialchars($t['name']); ?></span>
                  <?php if ($has_link): ?>
                    <a href="<?= htmlspecialchars($t['link_url']); ?>" target="_blank" class="text-gray-400 hover:text-white transition-colors inline-block shrink-0" title="Verified Profile">
                      <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                      </svg>
                    </a>
                  <?php endif; ?>
                </h4>
                <p class="text-[10px] sm:text-xs text-gray-400 leading-tight mt-0.5 break-words"><?= htmlspecialchars($t['role']); ?></p>
              </div>
            </div>

            <!-- Brand Image or Stylized Brand Tag -->
            <div class="shrink-0 ml-auto">
              <?php if (!empty($t['brand_logo'])): ?>
                <?php if ($has_link): ?>
                  <a href="<?= htmlspecialchars($t['link_url']); ?>" target="_blank" class="block hover:opacity-80 transition-opacity">
                    <img src="<?= htmlspecialchars($t['brand_logo']); ?>" 
                         alt="<?= htmlspecialchars($t['company']); ?>" 
                         class="h-5 sm:h-6 max-w-[80px] sm:max-w-[90px] object-contain filter brightness-100 invert-0" />
                  </a>
                <?php else: ?>
                  <img src="<?= htmlspecialchars($t['brand_logo']); ?>" 
                       alt="<?= htmlspecialchars($t['company']); ?>" 
                       class="h-5 sm:h-6 max-w-[80px] sm:max-w-[90px] object-contain filter brightness-100 invert-0" />
                <?php endif; ?>
              <?php else: ?>
                <?php if ($has_link): ?>
                  <a href="<?= htmlspecialchars($t['link_url']); ?>" target="_blank" class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-none bg-white/10 border border-white/25 text-[9px] sm:text-[11px] font-bold text-white uppercase tracking-wider font-mono whitespace-nowrap hover:bg-white/20 transition-all inline-block">
                    <?= htmlspecialchars($t['company']); ?> ↗
                  </a>
                <?php else: ?>
                  <span class="px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-none bg-white/10 border border-white/25 text-[9px] sm:text-[11px] font-bold text-white uppercase tracking-wider font-mono whitespace-nowrap">
                    <?= htmlspecialchars($t['company']); ?>
                  </span>
                <?php endif; ?>
              <?php endif; ?>
            </div>

          </div>

        </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>