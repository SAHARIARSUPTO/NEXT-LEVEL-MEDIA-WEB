<?php
// Load dynamic portrait client video testimonials from admin panel data
$raw_reviews = get_section_videos('reviews');
$portrait_reviews = [];

foreach ($raw_reviews as $r) {
    if (!empty($r['video_url'])) {
        $client_name = !empty($r['client_name']) ? $r['client_name'] : 'Verified Client';
        $title = !empty($r['title']) ? $r['title'] : 'Client Video Review';
        $thumb = !empty($r['thumbnail_url']) ? $r['thumbnail_url'] : 'clients/1.png';
        $link_url = !empty($r['link_url']) ? $r['link_url'] : '';
        
        // If thumbnail is empty or default, attempt to extract YouTube thumbnail if it is a YouTube URL
        if (empty($r['thumbnail_url']) && preg_match('/(?:shorts\/|v=|\/embed\/|youtu\.be\/|\/v\/|watch\?v=|\&v=)([^#\&\?\/]+)/', $r['video_url'], $m)) {
            $thumb = "https://img.youtube.com/vi/{$m[1]}/maxresdefault.jpg";
        }

        $portrait_reviews[] = [
            'id' => $r['id'] ?? 1,
            'client_name' => $client_name,
            'title' => $title,
            'video_url' => $r['video_url'],
            'thumbnail' => $thumb,
            'link_url' => $link_url
        ];
    }
}

// Fallback to the 2 local testimonial videos if empty
if (empty($portrait_reviews)) {
    $portrait_reviews = [
        [
            'id' => 25,
            'client_name' => 'Verified Client Story',
            'title' => 'Client Video Review & Growth Breakdown',
            'video_url' => 'testimonials/Testimonial 1 .mp4',
            'thumbnail' => 'testimonials/thumb1.jpg',
            'link_url' => ''
        ],
        [
            'id' => 26,
            'client_name' => 'Creator Case Study',
            'title' => 'Scale & Content Performance Breakdown',
            'video_url' => 'testimonials/Testimonial 2.mp4',
            'thumbnail' => 'testimonials/thumb2.jpg',
            'link_url' => ''
        ]
    ];
}

$total_reviews = count($portrait_reviews);
?>

<!-- Client Video Testimonials Section (1 Video at a time with Interactive Swipe) -->
<section class="relative w-full py-6 sm:py-16 px-3 sm:px-6 lg:px-8 bg-transparent overflow-hidden" id="video-testimonials">
  
  <div class="max-w-7xl mx-auto relative z-10">
    
    <!-- Section Header (Centered) -->
    <div class="text-center max-w-3xl mx-auto mb-4 sm:mb-8" data-aos="fade-up">
      <div class="inline-flex items-center gap-2 px-3.5 py-1 sm:px-5 sm:py-2 rounded-none bg-black border-2 border-white/25 backdrop-blur-xl shadow-[0_0_25px_rgba(255,255,255,0.15)] hover:border-white hover:shadow-[0_0_35px_rgba(255,255,255,0.35)] transition-all mb-3 sm:mb-4">
        <span class="w-2 h-2 rounded-none bg-red-500 animate-ping"></span>
        <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-widest text-white font-display">Client Video Testimonial</span>
      </div>
      <h2 class="text-xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight font-display">
        Client <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-[#8d96ff] to-[#535eee]">Video Proof.</span>
      </h2>
      <p class="mt-1.5 sm:mt-2 text-xs sm:text-base text-gray-300 max-w-2xl mx-auto">
        Direct client video reviews and unscripted performance breakdowns.
      </p>
    </div>

    <!-- Swipe Instructions Banner (Prominent & Stylish Cyber Aesthetic - Clean SVG Icons, No Emojis) -->
    <?php if ($total_reviews > 1): ?>
      <div class="flex items-center justify-center mb-4 sm:mb-6" data-aos="fade-up" data-aos-delay="50">
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 sm:px-6 sm:py-2 rounded-none bg-black/90 border-2 border-white/30 backdrop-blur-xl shadow-[0_0_25px_rgba(83,94,238,0.25)] select-none">
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#8d96ff] animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
          </svg>
          <span class="text-[10px] sm:text-xs font-mono font-bold tracking-widest uppercase text-white flex items-center gap-1.5">
            <span class="inline-block sm:hidden">SWIPE TO VIEW NEXT STORY</span>
            <span class="hidden sm:inline-block">SWIPE OR USE ARROWS TO VIEW NEXT STORY</span>
          </span>
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#8d96ff] animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </div>
    <?php endif; ?>

    <!-- Single Focused Video Stage with Flanking Controls -->
    <div class="relative max-w-lg mx-auto flex items-center justify-center" data-aos="fade-up" data-aos-delay="100">
      
      <!-- Desktop Left Arrow -->
      <?php if ($total_reviews > 1): ?>
        <button type="button" 
                id="testimonialPrevArrow" 
                class="hidden md:flex absolute -left-16 lg:-left-20 top-1/2 -translate-y-1/2 w-12 h-12 rounded-none bg-black/90 border-2 border-white/30 text-white items-center justify-center hover:border-white hover:bg-white hover:text-black hover:shadow-[0_0_30px_rgba(255,255,255,0.6)] transition-all z-20 cursor-pointer group"
                aria-label="Previous Review Video">
          <svg class="w-5 h-5 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
          </svg>
        </button>
      <?php endif; ?>

      <!-- 1-Card-at-a-Time Swipeable Carousel Container -->
      <div class="w-full max-w-[320px] xs:max-w-[340px] sm:max-w-[380px] overflow-hidden">
        
        <div id="singleReviewCarousel" 
             class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none select-none cursor-grab active:cursor-grabbing w-full scroll-smooth">
          
          <?php foreach ($portrait_reviews as $idx => $item): ?>
            <div class="w-full flex-shrink-0 snap-center p-1" data-index="<?= $idx; ?>">
              
              <!-- Portrait Card Frame (9:16 Aspect Ratio) -->
              <div class="group relative rounded-none bg-[#09090d]/95 border-2 border-white/25 hover:border-white hover:shadow-[0_0_45px_rgba(255,255,255,0.45)] transition-all duration-500 overflow-hidden cursor-pointer flex flex-col justify-between"
                   onclick="openPortraitVideoModal('<?= htmlspecialchars($item['video_url']); ?>', '<?= htmlspecialchars(addslashes($item['client_name'])); ?> — <?= htmlspecialchars(addslashes($item['title'])); ?>')">
                
                <div class="relative w-full aspect-[9/16] overflow-hidden bg-black">
                  
                  <!-- Thumbnail Image -->
                  <img src="<?= htmlspecialchars($item['thumbnail']); ?>" 
                       alt="<?= htmlspecialchars($item['client_name']); ?>" 
                       class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                  
                  <!-- Gradient Lighting Overlay -->
                  <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-black/20 pointer-events-none"></div>

                  <!-- Verified Badge Pill & Story Counter -->
                  <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-black/85 border border-white/35 backdrop-blur-md text-[10px] sm:text-[11px] font-bold text-white uppercase tracking-wider">
                      <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                      <span>Verified Client Story</span>
                    </div>

                    <div class="px-2.5 py-1 bg-black/85 border border-white/35 backdrop-blur-md text-[10px] sm:text-[11px] font-mono font-bold text-[#8d96ff]">
                      <?= sprintf('%02d', $idx + 1); ?> / <?= sprintf('%02d', $total_reviews); ?>
                    </div>
                  </div>

                  <!-- Center Cyber Square Play Button -->
                  <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                    <div class="w-14 h-14 sm:w-18 sm:h-18 rounded-none bg-white text-black flex items-center justify-center shadow-[0_0_35px_rgba(255,255,255,0.5)] group-hover:scale-115 group-hover:shadow-[0_0_60px_rgba(255,255,255,0.9)] transition-all duration-300">
                      <svg class="w-6 h-6 sm:w-8 sm:h-8 ml-1 fill-current" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                      </svg>
                    </div>
                  </div>

                  <!-- Bottom Card Details -->
                  <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-5 z-10 bg-gradient-to-t from-black via-black/95 to-transparent">
                    <h3 class="text-sm sm:text-base font-extrabold text-white leading-tight font-display mb-1.5 group-hover:text-blue-300 transition-colors">
                      <?= htmlspecialchars($item['title']); ?>
                    </h3>
                    <div class="flex items-center justify-between pt-2 border-t border-white/20">
                      <span class="text-xs sm:text-sm font-bold text-gray-200"><?= htmlspecialchars($item['client_name']); ?></span>
                      <span class="text-[10px] sm:text-[11px] text-[#8d96ff] font-mono font-bold uppercase tracking-wider flex items-center gap-1">
                        <span>Play Video</span> &rarr;
                      </span>
                    </div>
                  </div>

                </div>

              </div>

            </div>
          <?php endforeach; ?>

        </div>

      </div>

      <!-- Desktop Right Arrow -->
      <?php if ($total_reviews > 1): ?>
        <button type="button" 
                id="testimonialNextArrow" 
                class="hidden md:flex absolute -right-16 lg:-right-20 top-1/2 -translate-y-1/2 w-12 h-12 rounded-none bg-black/90 border-2 border-white/30 text-white items-center justify-center hover:border-white hover:bg-white hover:text-black hover:shadow-[0_0_30px_rgba(255,255,255,0.6)] transition-all z-20 cursor-pointer group"
                aria-label="Next Review Video">
          <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
          </svg>
        </button>
      <?php endif; ?>

    </div>

    <!-- Mobile & Desktop Bottom Navigation Controls (Arrows + Active Dots) -->
    <?php if ($total_reviews > 1): ?>
      <div class="flex flex-col items-center justify-center gap-3 mt-4 sm:mt-6" data-aos="fade-up" data-aos-delay="150">
        
        <!-- Mobile Left/Right Control Buttons -->
        <div class="flex md:hidden items-center justify-center gap-4">
          <button type="button" 
                  id="testimonialPrevMobile" 
                  class="px-4 py-2 rounded-none bg-black border-2 border-white/30 text-white flex items-center gap-1.5 hover:border-white transition-all text-xs font-bold uppercase tracking-wider font-mono cursor-pointer active:scale-95 shadow-md">
            <span>&larr; Prev</span>
          </button>
          
          <span class="text-xs font-mono font-bold text-gray-300" id="mobilePaginationIndicator">
            1 / <?= $total_reviews; ?>
          </span>

          <button type="button" 
                  id="testimonialNextMobile" 
                  class="px-4 py-2 rounded-none bg-black border-2 border-white/30 text-white flex items-center gap-1.5 hover:border-white transition-all text-xs font-bold uppercase tracking-wider font-mono cursor-pointer active:scale-95 shadow-md">
            <span>Next &rarr;</span>
          </button>
        </div>

        <!-- Segmented Interactive Indicator Dots -->
        <div class="flex items-center gap-2" id="testimonialDotsContainer">
          <?php for ($i = 0; $i < $total_reviews; $i++): ?>
            <button type="button" 
                    class="testimonial-dot h-2 transition-all duration-300 rounded-none cursor-pointer <?= $i === 0 ? 'w-8 bg-white shadow-[0_0_12px_rgba(255,255,255,0.8)]' : 'w-2.5 bg-white/30 hover:bg-white/60'; ?>" 
                    data-slide-to="<?= $i; ?>"
                    aria-label="Go to testimonial <?= $i + 1; ?>">
            </button>
          <?php endfor; ?>
        </div>

      </div>
    <?php endif; ?>

  </div>
</section>

<!-- Dedicated Responsive Portrait Video Modal with Full HTML5 Player & Controls -->
<div id="portraitVideoModal" class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6 bg-black/95 backdrop-blur-2xl transition-all duration-300">
  <div class="relative w-full max-w-[340px] xs:max-w-sm sm:max-w-md bg-black border-2 border-white/40 shadow-[0_0_80px_rgba(255,255,255,0.3)] rounded-none overflow-hidden flex flex-col">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between px-4 py-3 bg-[#0a0a0f] border-b border-white/20">
      <div class="flex items-center gap-2 min-w-0 pr-2">
        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping shrink-0"></span>
        <span id="portraitModalTitle" class="text-xs sm:text-sm font-bold text-white font-display truncate">Client Video</span>
      </div>
      <button type="button" id="closePortraitModal" class="px-3 py-1 rounded-none bg-white text-black hover:bg-red-600 hover:text-white font-extrabold text-xs tracking-wider uppercase transition-all shadow-[0_0_15px_rgba(255,255,255,0.4)] flex items-center gap-1 shrink-0">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span>Close</span>
      </button>
    </div>

    <!-- Video Slot (Portrait 9:16 Aspect Ratio) -->
    <div id="portraitModalSlot" class="relative w-full aspect-[9/16] max-h-[78vh] bg-black flex items-center justify-center overflow-hidden"></div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.getElementById('singleReviewCarousel');
  const prevArrow = document.getElementById('testimonialPrevArrow');
  const nextArrow = document.getElementById('testimonialNextArrow');
  const prevMobile = document.getElementById('testimonialPrevMobile');
  const nextMobile = document.getElementById('testimonialNextMobile');
  const indicator = document.getElementById('mobilePaginationIndicator');
  const dots = document.querySelectorAll('.testimonial-dot');
  const totalSlides = <?= $total_reviews; ?>;

  let activeIndex = 0;

  function scrollToSlide(index) {
    if (!carousel) return;
    activeIndex = Math.max(0, Math.min(index, totalSlides - 1));
    const slideWidth = carousel.clientWidth;
    carousel.scrollTo({
      left: activeIndex * slideWidth,
      behavior: 'smooth'
    });
    updateUI(activeIndex);
  }

  function updateUI(index) {
    if (indicator) {
      indicator.textContent = `${index + 1} / ${totalSlides}`;
    }
    dots.forEach((dot, idx) => {
      if (idx === index) {
        dot.className = "testimonial-dot h-2 transition-all duration-300 rounded-none cursor-pointer w-8 bg-white shadow-[0_0_12px_rgba(255,255,255,0.8)]";
      } else {
        dot.className = "testimonial-dot h-2 transition-all duration-300 rounded-none cursor-pointer w-2.5 bg-white/30 hover:bg-white/60";
      }
    });
  }

  if (prevArrow) prevArrow.addEventListener('click', () => scrollToSlide(activeIndex - 1));
  if (nextArrow) nextArrow.addEventListener('click', () => scrollToSlide(activeIndex + 1));
  if (prevMobile) prevMobile.addEventListener('click', () => scrollToSlide(activeIndex - 1));
  if (nextMobile) nextMobile.addEventListener('click', () => scrollToSlide(activeIndex + 1));

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      const targetIdx = parseInt(dot.getAttribute('data-slide-to'), 10);
      scrollToSlide(targetIdx);
    });
  });

  // Track manual touch swiping / scroll snap
  if (carousel) {
    let scrollTimeout;
    carousel.addEventListener('scroll', () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(() => {
        const slideWidth = carousel.clientWidth;
        if (slideWidth > 0) {
          const newIdx = Math.round(carousel.scrollLeft / slideWidth);
          if (newIdx !== activeIndex && newIdx >= 0 && newIdx < totalSlides) {
            activeIndex = newIdx;
            updateUI(activeIndex);
          }
        }
      }, 60);
    }, { passive: true });
  }

  // Modal Controls
  const modal = document.getElementById('portraitVideoModal');
  const modalSlot = document.getElementById('portraitModalSlot');
  const modalTitle = document.getElementById('portraitModalTitle');
  const closeBtn = document.getElementById('closePortraitModal');

  window.openPortraitVideoModal = function(url, title = 'Client Video') {
    if (!modal || !modalSlot) return;
    
    if (modalTitle) modalTitle.textContent = title;
    
    // Check if Vimeo URL
    if (url.includes('vimeo.com')) {
      const match = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
      const vId = match ? match[1] : '1219657057';
      modalSlot.innerHTML = `
        <iframe class="w-full h-full border-0"
          src="https://player.vimeo.com/video/${vId}?autoplay=1&title=0&byline=0&portrait=0&badge=0&autopause=0&dnt=1"
          title="Client Video"
          frameborder="0"
          allow="autoplay; fullscreen; picture-in-picture"
          allowfullscreen></iframe>
      `;
    } 
    // Check if YouTube URL
    else if (url.includes('youtube.com') || url.includes('youtu.be')) {
      const match = url.match(/(?:shorts\/|v=|\/embed\/|youtu\.be\/|\/v\/|watch\?v=|\&v=)([^#\&\?\/]+)/);
      const yId = match ? match[1] : '';
      modalSlot.innerHTML = `
        <iframe class="w-full h-full border-0"
          src="https://www.youtube.com/embed/${yId}?autoplay=1&rel=0"
          title="Client Video"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      `;
    } 
    // Local / Direct Video File (.mp4, .mov, .webm)
    else {
      modalSlot.innerHTML = `
        <video class="w-full h-full object-contain bg-black" 
               controls 
               autoplay 
               playsinline 
               preload="auto"
               controlsList="nodownload">
          <source src="${url}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      `;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  };

  function closePortraitModal() {
    if (!modal || !modalSlot) return;
    const videoEl = modalSlot.querySelector('video');
    if (videoEl) {
      videoEl.pause();
      videoEl.currentTime = 0;
    }
    modalSlot.innerHTML = '';
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
  }

  if (closeBtn) closeBtn.addEventListener('click', closePortraitModal);
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closePortraitModal();
    });
  }
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closePortraitModal();
  });
});
</script>
