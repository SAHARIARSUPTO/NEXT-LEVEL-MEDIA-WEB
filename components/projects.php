<?php
// Load all section videos from fast data layer
$raw_videos = get_section_videos('all');
$videos = [];

foreach ($raw_videos as $row) {
    $sec = $row['section'] ?? 'shorts';
    $category_mapped = ($sec === 'motion_3d') ? '3d' : (($sec === 'vsl' || $sec === 'ads') ? 'vsl' : $sec);
    
    $tag_label = 'Production Asset';
    if ($sec === 'shorts') $tag_label = 'Short Form';
    elseif ($sec === 'youtube') $tag_label = 'YouTube Long-form';
    elseif ($sec === 'podcast') $tag_label = 'Podcast Cut';
    elseif ($sec === '3d' || $sec === 'motion_3d') $tag_label = '3D & VFX';
    elseif ($sec === 'vsl' || $sec === 'ads') $tag_label = 'Paid Ads & VSL';
    elseif ($sec === 'reviews') $tag_label = 'Client Review';

    $videos[] = [
        'id' => $row['id'] ?? 1,
        'category' => $category_mapped,
        'videoUrl' => $row['video_url'] ?? '',
        'title' => $row['title'] ?? 'Video Production Asset',
        'tag' => $tag_label,
        'client' => $row['client_name'] ?? 'Next Level Media',
        'thumbnail_url' => $row['thumbnail_url'] ?? '',
    ];
}

// Add thumbnail showcase samples
$thumbnails_sample = [
    ["id" => 201, "category" => "thumbnails", "videoUrl" => "CL1.jpg", "title" => "High CTR Visual 01", "tag" => "Graphic Design", "client" => "YouTube Creator"],
    ["id" => 202, "category" => "thumbnails", "videoUrl" => "CL2.jpg", "title" => "High CTR Visual 02", "tag" => "Graphic Design", "client" => "Creator Channel"],
    ["id" => 203, "category" => "thumbnails", "videoUrl" => "CL3.jpg", "title" => "High CTR Visual 03", "tag" => "Graphic Design", "client" => "Podcast"],
    ["id" => 204, "category" => "thumbnails", "videoUrl" => "CL4.jpg", "title" => "High CTR Visual 04", "tag" => "Graphic Design", "client" => "Documentary"],
    ["id" => 205, "category" => "thumbnails", "videoUrl" => "CL5.jpg", "title" => "High CTR Visual 05", "tag" => "Graphic Design", "client" => "SaaS Brand"],
    ["id" => 206, "category" => "thumbnails", "videoUrl" => "CL6.jpg", "title" => "High CTR Visual 06", "tag" => "Graphic Design", "client" => "Growth Channel"],
];
$videos = array_merge($videos, $thumbnails_sample);

function getYoutubeIdFromUrl($url) {
    if (preg_match('/(?:shorts\/|v=|\/embed\/|youtu\.be\/|\/v\/|watch\?v=|\&v=)([^#\&\?\/]+)/', $url, $matches)) {
        return $matches[1];
    }
    return '';
}

function getVimeoIdFromUrl($url) {
    if (preg_match('/vimeo\.com\/(?:.*\/)?(\d+)/', $url, $matches)) {
        return $matches[1];
    }
    return '';
}
?>

<!-- Featured Projects & Portfolio Section (MZ Media Style) -->
<section class="relative w-full py-6 sm:py-16 px-3 sm:px-6 lg:px-8 bg-transparent" id="projects">

  <div class="max-w-7xl mx-auto relative z-10">
    
    <!-- Section Title (MZ Media Headline & Subhead) -->
    <div class="text-center max-w-4xl mx-auto mb-5 sm:mb-10" data-aos="fade-up">
      <div class="inline-flex items-center gap-2 px-3.5 py-1 sm:px-4 sm:py-1.5 rounded-none bg-black border-2 border-white/25 backdrop-blur-xl mb-3 sm:mb-4 shadow-[0_0_25px_rgba(255,255,255,0.15)]">
        <span class="w-2 h-2 rounded-none bg-white animate-ping"></span>
        <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-widest text-white font-display">Selected Case Studies</span>
      </div>
      <h2 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight font-display">
        The videos we ship.
      </h2>
      <p class="mt-1.5 sm:mt-3 text-xs sm:text-base md:text-lg text-gray-300 max-w-2xl mx-auto">
        What are you launching?
      </p>
    </div>

    <!-- Category Filter Tabs (Scrollable on Mobile, Centered on Desktop) -->
    <div class="flex items-center justify-start sm:justify-center overflow-x-auto gap-1.5 sm:gap-3.5 mb-4 sm:mb-10 pb-2 scrollbar-none px-0.5" data-aos="fade-up" data-aos-delay="100">
      
      <!-- Tab 1: YouTube Long-Form -->
      <button data-filter="youtube" class="project-tab-btn active group relative inline-flex items-center gap-1.5 sm:gap-3 px-2.5 py-1.5 sm:px-5 sm:py-3 rounded-none bg-white/[0.08] border-2 border-white text-white shadow-[0_0_20px_rgba(255,255,255,0.25)] transition-all duration-300 shrink-0">
        <div class="tab-icon-wrap w-5 h-5 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-gradient-to-b from-[#e4dede] via-[#d5d7ff] to-[#3755fd]/80 text-black shadow-[0_0_10px_rgba(255,255,255,0.6)] transition-all shrink-0">
          <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
          </svg>
        </div>
        <span class="tab-label text-[10px] sm:text-sm font-extrabold uppercase tracking-wider font-display text-white whitespace-nowrap">YouTube Long-Form</span>
      </button>

      <!-- Tab 2: Viral Shorts & Reels -->
      <button data-filter="shorts" class="project-tab-btn group relative inline-flex items-center gap-1.5 sm:gap-3 px-2.5 py-1.5 sm:px-5 sm:py-3 rounded-none bg-black/60 border border-white/15 text-gray-300 hover:text-white hover:border-white/50 hover:bg-white/[0.04] transition-all duration-300 shrink-0">
        <div class="tab-icon-wrap w-5 h-5 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-white/[0.05] border border-white/20 text-gray-300 group-hover:text-white transition-all shrink-0">
          <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
            <path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/>
          </svg>
        </div>
        <span class="tab-label text-[10px] sm:text-sm font-bold uppercase tracking-wider font-display text-gray-300 group-hover:text-white whitespace-nowrap">Viral Shorts</span>
      </button>

      <!-- Tab 3: Paid Ads & VSL -->
      <button data-filter="vsl" class="project-tab-btn group relative inline-flex items-center gap-1.5 sm:gap-3 px-2.5 py-1.5 sm:px-5 sm:py-3 rounded-none bg-black/60 border border-white/15 text-gray-300 hover:text-white hover:border-white/50 hover:bg-white/[0.04] transition-all duration-300 shrink-0">
        <div class="tab-icon-wrap w-5 h-5 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-white/[0.05] border border-white/20 text-gray-300 group-hover:text-white transition-all shrink-0">
          <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
          </svg>
        </div>
        <span class="tab-label text-[10px] sm:text-sm font-bold uppercase tracking-wider font-display text-gray-300 group-hover:text-white whitespace-nowrap">Paid Ads & VSL</span>
      </button>

      <!-- Tab 4: Podcasts -->
      <button data-filter="podcast" class="project-tab-btn group relative inline-flex items-center gap-1.5 sm:gap-3 px-2.5 py-1.5 sm:px-5 sm:py-3 rounded-none bg-black/60 border border-white/15 text-gray-300 hover:text-white hover:border-white/50 hover:bg-white/[0.04] transition-all duration-300 shrink-0">
        <div class="tab-icon-wrap w-5 h-5 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-white/[0.05] border border-white/20 text-gray-300 group-hover:text-white transition-all shrink-0">
          <svg class="w-2.5 h-2.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
            <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.91-3c-.49 0-.9.36-.98.85C16.52 14.2 14.47 16 12 16s-4.52-1.8-4.93-4.15c-.08-.49-.49-.85-.98-.85-.61 0-1.09.54-1 1.14.49 3 2.89 5.35 5.91 5.78V20c0 .55.45 1 1 1s1-.45 1-1v-2.08c3.02-.43 5.42-2.78 5.91-5.78.1-.6-.39-1.14-1-1.14z"/>
          </svg>
        </div>
        <span class="tab-label text-[10px] sm:text-sm font-bold uppercase tracking-wider font-display text-gray-300 group-hover:text-white whitespace-nowrap">Podcasts</span>
      </button>

      <!-- Tab 5: All Works -->
      <button data-filter="all" class="project-tab-btn group relative inline-flex items-center gap-1.5 sm:gap-3 px-2.5 py-1.5 sm:px-5 sm:py-3 rounded-none bg-black/60 border border-white/15 text-gray-300 hover:text-white hover:border-white/50 hover:bg-white/[0.04] transition-all duration-300 shrink-0">
        <div class="tab-icon-wrap w-5 h-5 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-white/[0.05] border border-white/20 text-gray-300 group-hover:text-white transition-all shrink-0">
          <svg class="w-3 h-3 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24">
            <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
          </svg>
        </div>
        <span class="tab-label text-[10px] sm:text-sm font-bold uppercase tracking-wider font-display text-gray-300 group-hover:text-white whitespace-nowrap">All Works</span>
      </button>

    </div>

    <!-- Giant Outer Border Box (Holds All Video Cards in Single White Box like MZ Media) -->
    <div class="relative w-full rounded-none bg-black border-2 border-white p-2 sm:p-7 lg:p-8 shadow-[0_0_35px_rgba(255,255,255,0.2)] sm:shadow-[0_0_50px_rgba(255,255,255,0.25)] hover:shadow-[0_0_70px_rgba(255,255,255,0.4)] transition-all duration-500 overflow-hidden" data-aos="fade-up" data-aos-delay="150">
      
      <!-- Top Subtle Glow Line on the Giant Box -->
      <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-white to-transparent pointer-events-none"></div>

      <!-- Projects Grid (2 Columns on Mobile & Tablet, 3 Columns on Desktop) -->
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6" id="projectsGrid">
        <?php foreach ($videos as $item): 
          $ytId = getYoutubeIdFromUrl($item['videoUrl']);
          $vimeoId = getVimeoIdFromUrl($item['videoUrl']);
          $isShort = $item['category'] === 'shorts';
          $isThumbnail = $item['category'] === 'thumbnails';
          $is3D = $item['category'] === '3d';
          $isDefaultVisible = ($item['category'] === 'youtube');
          
          $thumbUrl = !empty($item['thumbnail_url']) ? $item['thumbnail_url'] : '';
          if (empty($thumbUrl)) {
              if (!empty($ytId)) {
                  $thumbUrl = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
              } elseif ($isThumbnail) {
                  $thumbUrl = $item['videoUrl'];
              } else {
                  $thumbUrl = 'review-thumb.png';
              }
          }
        ?>
          <div class="project-card-item group cursor-pointer rounded-none bg-black overflow-hidden relative" 
               data-category="<?= $item['category']; ?>" 
               data-video-url="<?= htmlspecialchars($item['videoUrl']); ?>" 
               style="<?= $isDefaultVisible ? '' : 'display: none;'; ?>">

            <!-- Card Media Frame (Pure Clean Visual, No UI / No Controls / No Type Text / No Individual Border) -->
            <div class="relative w-full <?= $isShort ? 'aspect-[9/16]' : ($isThumbnail ? 'aspect-[16/9]' : 'aspect-video'); ?> overflow-hidden bg-black flex items-center justify-center">
              
              <?php if (!empty($vimeoId)): ?>
                <!-- Vimeo Clean Background Embed -->
                <iframe 
                  src="https://player.vimeo.com/video/<?= $vimeoId; ?>?title=0&byline=0&portrait=0&badge=0&controls=0&autopause=0&player_id=0&app_id=58479" 
                  class="w-full h-full pointer-events-none scale-[1.02]" 
                  frameborder="0" 
                  allow="autoplay; fullscreen; picture-in-picture" 
                  title=""
                  loading="lazy">
                </iframe>
              <?php elseif (!empty($ytId)): ?>
                <!-- YouTube Thumbnail / Clean Preview -->
                <img src="<?= $thumbUrl; ?>" alt="Showcase" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 pointer-events-none" loading="lazy" />
              <?php elseif ($isThumbnail): ?>
                <!-- Graphic Design Thumbnail -->
                <img src="<?= htmlspecialchars($item['videoUrl']); ?>" alt="Graphic Asset" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 pointer-events-none" loading="lazy" />
              <?php else: ?>
                <!-- Direct Video / MP4 Preview -->
                <video class="w-full h-full object-cover pointer-events-none" preload="metadata" muted playsinline>
                  <source src="<?= htmlspecialchars($item['videoUrl']); ?>" type="video/mp4">
                </video>
              <?php endif; ?>

              <!-- Center Square Play Button Overlay (Proportionately scaled for 2-column mobile & desktop) -->
              <?php if (!$isThumbnail): ?>
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center pointer-events-none">
                  <div class="w-8 h-8 sm:w-16 sm:h-16 rounded-none bg-white text-black flex items-center justify-center shadow-[0_0_20px_rgba(255,255,255,0.7)] sm:shadow-[0_0_35px_rgba(255,255,255,0.7)] group-hover:scale-110 group-hover:shadow-[0_0_60px_rgba(255,255,255,0.95)] transition-all duration-300">
                    <svg class="w-3.5 h-3.5 sm:w-7 sm:h-7 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M8 5v14l11-7z"/>
                    </svg>
                  </div>
                </div>
              <?php endif; ?>

            </div>

          </div>
        <?php endforeach; ?>
      </div>

    </div>

  </div>
</section>

<!-- Fullscreen Responsive Video Modal Player with Cancel Button -->
<div id="videoModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-black/95 backdrop-blur-2xl opacity-0 pointer-events-none transition-opacity duration-300">
  
  <div class="relative w-full max-w-5xl bg-black border-2 border-white/40 rounded-none overflow-hidden shadow-[0_0_80px_rgba(255,255,255,0.3)] transition-all duration-300" id="videoModalContent">
    
    <!-- Modal Control Header -->
    <div class="flex items-center justify-between px-5 py-3.5 border-b border-white/20 bg-[#0a0a0f]">
      <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-none bg-[#535eee] animate-pulse"></span>
        <span class="text-xs font-bold uppercase tracking-widest text-white">Now Playing</span>
      </div>
      
      <!-- Prominent Cancel / Close Button -->
      <button id="closeVideoModal" class="px-4 py-1.5 rounded-none bg-white text-black hover:bg-red-600 hover:text-white hover:border-red-600 font-extrabold text-xs tracking-wider uppercase transition-all shadow-[0_0_20px_rgba(255,255,255,0.4)] flex items-center gap-1.5 border-2 border-white">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span>Cancel</span>
      </button>
    </div>

    <!-- Modal Fullscreen Player Container -->
    <div class="relative w-full aspect-video bg-black flex items-center justify-center" id="modalPlayerSlot">
      <!-- Injected autoplaying iframe or video element -->
    </div>
  </div>
</div>

<script>
  (function initProjectsSection() {
    // 1. MZ Media Style Filter Tabs Logic
    const filterBtns = document.querySelectorAll('.project-tab-btn');
    const projectCards = document.querySelectorAll('.project-card-item');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Reset all buttons to inactive state
        filterBtns.forEach(b => {
          b.classList.remove('active', 'bg-white/[0.08]', 'border-2', 'border-white', 'text-white', 'shadow-[0_0_30px_rgba(255,255,255,0.25)]');
          b.classList.add('bg-black/60', 'border', 'border-white/15', 'text-gray-300');
          
          const icon = b.querySelector('.tab-icon-wrap');
          if (icon) {
            icon.className = "tab-icon-wrap w-7 h-7 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-white/[0.05] border border-white/20 text-gray-300 group-hover:text-white transition-all shrink-0";
          }
          
          const label = b.querySelector('.tab-label');
          if (label) {
            label.className = "tab-label text-xs sm:text-sm font-bold uppercase tracking-wider font-display text-gray-300 group-hover:text-white";
          }
        });

        // Activate clicked button
        btn.classList.remove('bg-black/60', 'border-white/15', 'text-gray-300');
        btn.classList.add('active', 'bg-white/[0.08]', 'border-2', 'border-white', 'text-white', 'shadow-[0_0_30px_rgba(255,255,255,0.25)]');

        const activeIcon = btn.querySelector('.tab-icon-wrap');
        if (activeIcon) {
          activeIcon.className = "tab-icon-wrap w-7 h-7 sm:w-8 sm:h-8 rounded-none flex items-center justify-center bg-gradient-to-b from-[#e4dede] via-[#d5d7ff] to-[#3755fd]/80 text-black shadow-[0_0_15px_rgba(255,255,255,0.6)] transition-all shrink-0";
        }

        const activeLabel = btn.querySelector('.tab-label');
        if (activeLabel) {
          activeLabel.className = "tab-label text-xs sm:text-sm font-extrabold uppercase tracking-wider font-display text-white";
        }

        const filter = btn.getAttribute('data-filter');

        projectCards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // 2. Fullscreen Video Modal Logic with Auto-Play & Cancel Button
    const modal = document.getElementById('videoModal');
    const modalContent = document.getElementById('videoModalContent');
    const modalSlot = document.getElementById('modalPlayerSlot');
    const closeBtn = document.getElementById('closeVideoModal');

    function openModal(videoUrl, isThumbnail = false, isShort = false) {
      if (modalContent && modalSlot) {
        if (isShort) {
          modalContent.className = "relative w-full max-w-md bg-black border-2 border-white/40 rounded-none overflow-hidden shadow-[0_0_80px_rgba(255,255,255,0.3)] transition-all duration-300";
          modalSlot.className = "relative w-full aspect-[9/16] bg-black flex items-center justify-center max-h-[78vh]";
        } else {
          modalContent.className = "relative w-full max-w-5xl bg-black border-2 border-white/40 rounded-none overflow-hidden shadow-[0_0_80px_rgba(255,255,255,0.3)] transition-all duration-300";
          modalSlot.className = "relative w-full aspect-video bg-black flex items-center justify-center";
        }
      }

      if (isThumbnail) {
        modalSlot.innerHTML = `<img src="${videoUrl}" class="w-full h-full object-contain bg-black" alt="Creative Graphic" />`;
      } else if (videoUrl.includes('vimeo.com')) {
        const match = videoUrl.match(/vimeo\.com\/(?:.*\/)?(\d+)/);
        const vimeoId = match ? match[1] : videoUrl.split('/').filter(Boolean).pop();
        modalSlot.innerHTML = `
          <iframe class="w-full h-full"
            src="https://player.vimeo.com/video/${vimeoId}?autoplay=1&title=0&byline=0&portrait=0&badge=0&color=535eee"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            allowfullscreen></iframe>
        `;
      } else if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
        let ytId = '';
        const match = videoUrl.match(/(?:shorts\/|v=|\/embed\/|youtu\.be\/|\/v\/|watch\?v=|\&v=)([^#\&\?\/]+)/);
        if (match) ytId = match[1];
        modalSlot.innerHTML = `
          <iframe class="w-full h-full"
            src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0&modestbranding=1"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        `;
      } else {
        modalSlot.innerHTML = `
          <video class="w-full h-full object-contain" controls autoplay playsinline>
            <source src="${videoUrl}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        `;
      }

      modal.classList.remove('opacity-0', 'pointer-events-none');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.add('opacity-0', 'pointer-events-none');
      modalSlot.innerHTML = '';
      document.body.style.overflow = 'auto';
    }

    projectCards.forEach(card => {
      card.addEventListener('click', () => {
        const videoUrl = card.getAttribute('data-video-url');
        const category = card.getAttribute('data-category');
        openModal(videoUrl, category === 'thumbnails', category === 'shorts');
      });
    });

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
  })();
</script>