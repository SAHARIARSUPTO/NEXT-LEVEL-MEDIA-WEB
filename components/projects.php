<?php
// Load all section videos from fast data layer
$raw_videos = get_section_videos('all');
$videos = [];

foreach ($raw_videos as $row) {
    $sec = $row['section'] ?? 'shorts';
    $category_mapped = ($sec === 'motion_3d') ? '3d' : (($sec === 'vsl' || $sec === 'ads') ? 'ad' : $sec);
    
    $tag_label = 'Production Asset';
    if ($sec === 'shorts') $tag_label = 'Short Form';
    elseif ($sec === 'youtube') $tag_label = 'YouTube Long-form';
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
?>

<!-- Featured Projects & Portfolio Section (Immersive MZ Media Style) -->
<section class="relative w-full py-24 px-4 sm:px-6 lg:px-8 bg-transparent" id="projects">
  
  <div class="max-w-7xl mx-auto relative z-10">
    
    <!-- Section Title -->
    <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#09090d]/90 border border-white/15 backdrop-blur-xl mb-6 shadow-[0_0_20px_rgba(99,102,241,0.2)]">
        <span class="w-2 h-2 rounded-full bg-violet-400 animate-ping"></span>
        <span class="text-xs font-bold uppercase tracking-widest text-violet-300">Selected Case Studies</span>
      </div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight font-display">
        Work that builds <br class="hidden sm:inline" />
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-violet-400">authority and drives revenue</span>
      </h2>
      <p class="mt-4 text-base sm:text-lg text-gray-300">
        Explore our recent high-retention video edits, viral shorts, ads, 3D assets, and high-CTR creatives.
      </p>
    </div>

    <!-- Category Filter Tabs (MZ Media Pill Tabs) -->
    <div class="flex items-center justify-center flex-wrap gap-2.5 sm:gap-3 mb-14" data-aos="fade-up" data-aos-delay="100">
      <button data-filter="all" class="project-filter-btn active px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-white text-black shadow-[0_0_25px_rgba(255,255,255,0.3)]">
        All Works
      </button>
      <button data-filter="shorts" class="project-filter-btn px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#09090d]/90 text-gray-300 border border-white/10 hover:text-white hover:border-violet-500/50 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]">
        Shorts & Reels
      </button>
      <button data-filter="youtube" class="project-filter-btn px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#09090d]/90 text-gray-300 border border-white/10 hover:text-white hover:border-violet-500/50 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]">
        YouTube Long-form
      </button>
      <button data-filter="ad" class="project-filter-btn px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#09090d]/90 text-gray-300 border border-white/10 hover:text-white hover:border-violet-500/50 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]">
        Paid Ads & VSL
      </button>
      <button data-filter="3d" class="project-filter-btn px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#09090d]/90 text-gray-300 border border-white/10 hover:text-white hover:border-violet-500/50 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]">
        3D & Motion
      </button>
      <button data-filter="thumbnails" class="project-filter-btn px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#09090d]/90 text-gray-300 border border-white/10 hover:text-white hover:border-violet-500/50 hover:shadow-[0_0_15px_rgba(139,92,246,0.2)]">
        Thumbnails
      </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="projectsGrid">
      <?php foreach ($videos as $item): 
        $ytId = getYoutubeIdFromUrl($item['videoUrl']);
        $isShort = $item['category'] === 'shorts';
        $isThumbnail = $item['category'] === 'thumbnails';
        $is3D = $item['category'] === '3d';
        
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
        <div class="project-card-item immersive-card group cursor-pointer" data-category="<?= $item['category']; ?>" data-video-url="<?= htmlspecialchars($item['videoUrl']); ?>" data-title="<?= htmlspecialchars($item['title']); ?>" data-tag="<?= htmlspecialchars($item['tag']); ?>">
          <div class="hud-corner-tl"></div>
          <div class="hud-corner-br"></div>

          <!-- Video Thumbnail Frame -->
          <div class="relative w-full <?= $isShort ? 'aspect-[9/16]' : ($isThumbnail ? 'aspect-[16/9]' : 'aspect-video'); ?> overflow-hidden bg-black/40">
            <img src="<?= $thumbUrl; ?>" alt="<?= htmlspecialchars($item['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
            
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a10] via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity"></div>

            <!-- Play Icon Badge -->
            <?php if (!$isThumbnail): ?>
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white/90 text-black flex items-center justify-center shadow-[0_0_30px_rgba(255,255,255,0.4)] group-hover:scale-110 group-hover:bg-white transition-all duration-300">
                  <svg class="w-6 h-6 sm:w-7 sm:h-7 ml-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                  </svg>
                </div>
              </div>
            <?php endif; ?>

            <!-- Tag Badge -->
            <div class="absolute top-4 left-4">
              <span class="px-3 py-1 rounded-full bg-[#0e0e18]/80 border border-white/20 text-white text-[11px] font-bold backdrop-blur-md">
                <?= htmlspecialchars($item['tag']); ?>
              </span>
            </div>
          </div>

          <!-- Card Content Info -->
          <div class="p-6">
            <div class="flex items-center justify-between gap-2 mb-2">
              <span class="text-xs font-semibold text-gray-400"><?= htmlspecialchars($item['client'] ?? 'Next Level Media'); ?></span>
              <span class="text-xs text-violet-400 font-bold group-hover:translate-x-1 transition-transform">Watch ➔</span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-violet-300 transition-colors line-clamp-1 font-display">
              <?= htmlspecialchars($item['title']); ?>
            </h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- Global Responsive Video Modal Player -->
<div id="videoModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/90 backdrop-blur-xl opacity-0 pointer-events-none transition-opacity duration-300">
  <div class="relative w-full max-w-4xl bg-[#09090e] border border-white/20 rounded-3xl overflow-hidden shadow-[0_25px_80px_rgba(0,0,0,0.95)]" id="videoModalContent">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between p-4 sm:p-5 border-b border-white/10 bg-[#0c0c12]">
      <div>
        <span id="modalVideoTag" class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-violet-400"></span>
        <h3 id="modalVideoTitle" class="text-sm sm:text-lg font-bold text-white truncate max-w-xs sm:max-w-lg"></h3>
      </div>
      <button id="closeVideoModal" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-gray-300 hover:text-white flex items-center justify-center transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Modal Player Container -->
    <div class="relative w-full aspect-video bg-black" id="modalPlayerSlot">
      <!-- Injected iframe or video element -->
    </div>
  </div>
</div>

<script>
  (function initProjectsSection() {
    // 1. Filter Tabs Logic
    const filterBtns = document.querySelectorAll('.project-filter-btn');
    const projectCards = document.querySelectorAll('.project-card-item');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => {
          b.classList.remove('active', 'bg-white', 'text-black', 'shadow-[0_0_25px_rgba(255,255,255,0.3)]');
          b.classList.add('bg-[#09090d]/90', 'text-gray-300', 'border', 'border-white/10');
        });

        btn.classList.add('active', 'bg-white', 'text-black', 'shadow-[0_0_25px_rgba(255,255,255,0.3)]');
        btn.classList.remove('bg-[#09090d]/90', 'text-gray-300', 'border', 'border-white/10');

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

    // 2. Video Modal Logic
    const modal = document.getElementById('videoModal');
    const modalSlot = document.getElementById('modalPlayerSlot');
    const modalTitle = document.getElementById('modalVideoTitle');
    const modalTag = document.getElementById('modalVideoTag');
    const closeBtn = document.getElementById('closeVideoModal');

    function openModal(videoUrl, title, tag, isThumbnail = false) {
      modalTitle.textContent = title;
      modalTag.textContent = tag;

      if (isThumbnail) {
        modalSlot.innerHTML = `<img src="${videoUrl}" class="w-full h-full object-contain bg-black" alt="${title}" />`;
      } else if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
        let ytId = '';
        const match = videoUrl.match(/(?:shorts\/|v=|\/embed\/|youtu\.be\/|\/v\/|watch\?v=|\&v=)([^#\&\?\/]+)/);
        if (match) ytId = match[1];
        modalSlot.innerHTML = `
          <iframe class="w-full h-full"
            src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0&modestbranding=1"
            title="${title}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        `;
      } else if (videoUrl.includes('vimeo.com')) {
        const vimeoId = videoUrl.split('/').pop();
        modalSlot.innerHTML = `
          <iframe class="w-full h-full"
            src="https://player.vimeo.com/video/${vimeoId}?autoplay=1"
            title="${title}"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            allowfullscreen></iframe>
        `;
      } else {
        modalSlot.innerHTML = `
          <video class="w-full h-full object-contain" controls autoplay>
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
        const title = card.getAttribute('data-title');
        const tag = card.getAttribute('data-tag');
        const category = card.getAttribute('data-category');
        openModal(videoUrl, title, tag, category === 'thumbnails');
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