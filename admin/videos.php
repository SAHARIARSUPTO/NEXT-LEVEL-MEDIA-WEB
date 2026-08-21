<?php
$page_title = 'Website Videos & Testimonials';
require_once('layout_header.php');

$msg = '';
$action = $_GET['action'] ?? 'list';
$active_tab = $_GET['tab'] ?? 'videos';
$active_section = $_GET['section'] ?? 'all';

// 1. Handle Hero Showreel Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hero_showreel'])) {
    $hero_url = trim($_POST['hero_video_url'] ?? '');
    $hero_badge = trim($_POST['hero_badge_text'] ?? 'Agency Showreel');

    save_setting('hero_video_url', $hero_url);
    save_setting('hero_badge_text', $hero_badge);
    $msg = 'Hero Showreel updated successfully!';
}

// 2. Handle Add / Edit Video Showcase (Portfolio or Video Testimonial)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_section_video'])) {
    $video_id = intval($_POST['video_id'] ?? 0);
    $section = trim($_POST['section'] ?? 'shorts');
    $title = trim($_POST['title'] ?? '');
    $client_name = trim($_POST['client_name'] ?? 'Next Level Media');
    $video_url = trim($_POST['video_url'] ?? '');
    $thumbnail_url = trim($_POST['thumbnail_url'] ?? '');
    $link_url = trim($_POST['link_url'] ?? '');

    // Handle Image Upload
    if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            @mkdir($upload_dir, 0777, true);
        }
        $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
        $ext = strtolower(pathinfo($_FILES['thumbnail_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed_exts)) {
            $new_name = 'thumb_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['thumbnail_file']['tmp_name'], $upload_dir . $new_name)) {
                $thumbnail_url = 'uploads/' . $new_name;
            }
        }
    }

    if (empty($title) || empty($video_url)) {
        $msg = 'Error: Please provide both a title and video link.';
    } else {
        save_video_item($section, $title, $client_name, $video_url, $thumbnail_url, $link_url, $video_id);
        $msg = 'Video item successfully saved!';
        $action = 'list';
    }
}

// 3. Handle Add / Edit Written Founder Review
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_written_review'])) {
    $review_id = intval($_POST['review_id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $quote = trim($_POST['quote'] ?? '');
    $avatar = trim($_POST['avatar'] ?? 'clients/1.png');
    $brand_logo = trim($_POST['brand_logo'] ?? '');
    $link_url = trim($_POST['link_url'] ?? '');

    // Handle Avatar Upload
    if (isset($_FILES['avatar_file']) && $_FILES['avatar_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) @mkdir($upload_dir, 0777, true);
        $ext = strtolower(pathinfo($_FILES['avatar_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
            $new_name = 'client_avatar_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['avatar_file']['tmp_name'], $upload_dir . $new_name)) {
                $avatar = 'uploads/' . $new_name;
            }
        }
    }

    // Handle Brand Logo Upload
    if (isset($_FILES['brand_logo_file']) && $_FILES['brand_logo_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) @mkdir($upload_dir, 0777, true);
        $ext = strtolower(pathinfo($_FILES['brand_logo_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg', 'avif'])) {
            $new_name = 'brand_logo_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['brand_logo_file']['tmp_name'], $upload_dir . $new_name)) {
                $brand_logo = 'uploads/' . $new_name;
            }
        }
    }

    if (empty($name) || empty($quote)) {
        $msg = 'Error: Please provide client name and review quote.';
    } else {
        save_client_review($name, $role, $company, $quote, $avatar, $brand_logo, $link_url, $review_id);
        $msg = 'Review successfully saved!';
        $active_tab = 'reviews';
    }
}

// 4. Handle Delete Operations
if ($action === 'delete_video' && !empty($_GET['id'])) {
    delete_video_item(intval($_GET['id']));
    $msg = 'Video item deleted successfully.';
    $action = 'list';
}

if ($action === 'delete_review' && !empty($_GET['id'])) {
    delete_client_review(intval($_GET['id']));
    $msg = 'Review deleted successfully.';
    $active_tab = 'reviews';
    $action = 'list';
}

// Fetch lists
$all_videos = get_section_videos($active_section);
$all_written_reviews = get_client_reviews();
$hero_video_url = get_setting('hero_video_url', 'https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0');
$hero_badge_text = get_setting('hero_badge_text', 'Agency Showreel');

$all_raw_videos = get_section_videos('all');
$video_counts = [
    'all' => count($all_raw_videos),
    'shorts' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'shorts')),
    'youtube' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'youtube')),
    'vsl' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'vsl')),
    'podcast' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'podcast')),
    'motion_3d' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'motion_3d')),
    'reviews' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'reviews')),
];
?>

<div class="max-w-7xl mx-auto space-y-8">
  
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
        <a href="index.php" class="hover:text-white transition-colors">Admin</a>
        <span>/</span>
        <span class="text-white font-bold">Videos & Testimonials</span>
      </div>
      <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Videos & Client Testimonials Manager</h1>
      <p class="text-sm text-slate-300 mt-1">Manage the hero showreel, portfolio videos, portrait video proof, and written client reviews with links.</p>
    </div>
    
    <div class="flex items-center gap-3">
      <a href="../index.php" target="_blank" class="px-5 py-2.5 bg-black border-2 border-white/40 text-white font-bold text-xs uppercase tracking-wider hover:border-white hover:shadow-[0_0_25px_rgba(255,255,255,0.4)] transition-all">
        <span>View Live Website ↗</span>
      </a>
    </div>
  </div>

  <!-- Alert Banner -->
  <?php if (!empty($msg)): ?>
    <div class="p-4 rounded-none bg-emerald-500/15 border-2 border-emerald-500/40 text-emerald-200 text-sm font-semibold flex items-center justify-between gap-3 shadow-[0_0_25px_rgba(16,185,129,0.2)]">
      <div class="flex items-center gap-2.5">
        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span><?= htmlspecialchars($msg); ?></span>
      </div>
      <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white text-base font-bold">&times;</button>
    </div>
  <?php endif; ?>

  <!-- 1. Hero Showreel Manager Card (Cyber Glass Card) -->
  <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 hover:border-white/40 backdrop-blur-xl shadow-xl transition-all">
    <div class="pb-4 mb-6 border-b border-white/15 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
      <div>
        <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-white/10 border border-white/20 text-white font-mono text-xs uppercase font-bold mb-2">
          <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
          <span>Top Video Showreel</span>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-white font-display">1. Homepage Main Showreel Player</h2>
        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">The primary showreel video visitors see right below the main headline on the homepage.</p>
      </div>
    </div>

    <form action="videos.php" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-end">
      <input type="hidden" name="update_hero_showreel" value="1" />

      <div class="sm:col-span-6">
        <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Vimeo or YouTube Video Link</label>
        <input 
          type="text" 
          name="hero_video_url" 
          required 
          class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none transition-all" 
          value="<?= htmlspecialchars($hero_video_url); ?>" 
          placeholder="https://vimeo.com/1219066986" 
        />
      </div>

      <div class="sm:col-span-4">
        <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Badge Text</label>
        <input 
          type="text" 
          name="hero_badge_text" 
          class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none transition-all" 
          value="<?= htmlspecialchars($hero_badge_text); ?>" 
          placeholder="Agency Showreel" 
        />
      </div>

      <div class="sm:col-span-2">
        <button type="submit" class="w-full bg-white text-black font-extrabold text-sm uppercase tracking-wider py-3.5 px-4 border-2 border-white hover:bg-black hover:text-white hover:shadow-[0_0_25px_rgba(255,255,255,0.6)] transition-all cursor-pointer">
          Save Showreel
        </button>
      </div>
    </form>
  </div>

  <!-- Primary Tab Switcher (Videos vs Written Reviews) -->
  <div class="flex border-b-2 border-white/20 gap-3 sm:gap-4 overflow-x-auto pb-1">
    <a href="videos.php?tab=videos" class="px-6 py-3 border-2 <?= $active_tab === 'videos' ? 'border-white bg-white text-black font-extrabold shadow-[0_0_25px_rgba(255,255,255,0.4)]' : 'border-white/20 bg-black text-gray-300 hover:border-white hover:text-white'; ?> text-xs sm:text-sm uppercase tracking-wider font-display transition-all whitespace-nowrap">
      🎬 Video Catalogs & Testimonials (<?= count($all_raw_videos); ?>)
    </a>
    <a href="videos.php?tab=reviews" class="px-6 py-3 border-2 <?= $active_tab === 'reviews' ? 'border-white bg-white text-black font-extrabold shadow-[0_0_25px_rgba(255,255,255,0.4)]' : 'border-white/20 bg-black text-gray-300 hover:border-white hover:text-white'; ?> text-xs sm:text-sm uppercase tracking-wider font-display transition-all whitespace-nowrap">
      ⭐ Written Founder Reviews & Social Proof (<?= count($all_written_reviews); ?>)
    </a>
  </div>

  <?php if ($active_tab === 'reviews'): ?>
    <!-- TAB 2: WRITTEN FOUNDER REVIEWS & SOCIAL PROOF -->
    <div class="space-y-8">
      
      <!-- Add / Edit Review Form Card -->
      <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 backdrop-blur-xl shadow-xl">
        <div class="pb-4 mb-6 border-b border-white/15 flex items-center justify-between">
          <div>
            <h2 class="text-xl sm:text-2xl font-bold text-white font-display">Add or Edit Client Review Card</h2>
            <p class="text-xs sm:text-sm text-slate-300 mt-0.5">These appear in the Reviews section with matching client photos, brand tags, and external profile links.</p>
          </div>
        </div>

        <form action="videos.php?tab=reviews" method="POST" enctype="multipart/form-data" class="space-y-6">
          <input type="hidden" name="save_written_review" value="1" />
          <input type="hidden" name="review_id" id="rev_id" value="0" />

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Client Name *</label>
              <input type="text" name="name" id="rev_name" required placeholder="Alex Hormozi" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Role / Designation *</label>
              <input type="text" name="role" id="rev_role" required placeholder="Entrepreneur" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Brand / Company Name *</label>
              <input type="text" name="company" id="rev_company" required placeholder="Acquisition.com" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Review / Testimonial Quote *</label>
            <textarea name="quote" id="rev_quote" rows="3" required placeholder="These guys are the OGs. The fastest 'yes' we've ever seen from prospects..." class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none leading-relaxed"></textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Client Avatar (Upload or Path)</label>
              <input type="file" name="avatar_file" class="w-full bg-black border-2 border-white/30 px-3 py-2 text-white text-xs mb-2 file:bg-white file:text-black file:border-0 file:font-bold file:px-3 file:py-1 cursor-pointer" />
              <input type="text" name="avatar" id="rev_avatar" placeholder="clients/1.png" class="w-full bg-black border-2 border-white/20 px-3 py-2 text-gray-300 text-xs font-mono" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Brand Logo (Upload or Path)</label>
              <input type="file" name="brand_logo_file" class="w-full bg-black border-2 border-white/30 px-3 py-2 text-white text-xs mb-2 file:bg-white file:text-black file:border-0 file:font-bold file:px-3 file:py-1 cursor-pointer" />
              <input type="text" name="brand_logo" id="rev_brand_logo" placeholder="brands/logo_4.png (leave blank for text badge)" class="w-full bg-black border-2 border-white/20 px-3 py-2 text-gray-300 text-xs font-mono" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Profile / Social Link URL</label>
              <input type="text" name="link_url" id="rev_link_url" placeholder="https://linkedin.com/in/... or https://company.com" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none font-mono" />
              <p class="text-[11px] text-gray-400 mt-1">When added, card and badge become clickable!</p>
            </div>
          </div>

          <div class="flex items-center gap-4 pt-4 border-t border-white/15">
            <button type="submit" class="bg-white text-black font-extrabold text-sm uppercase tracking-wider py-3.5 px-8 border-2 border-white hover:bg-black hover:text-white hover:shadow-[0_0_30px_rgba(255,255,255,0.6)] transition-all cursor-pointer">
              Save Review
            </button>
            <button type="button" onclick="resetReviewForm()" class="bg-black text-gray-300 border-2 border-white/30 text-sm font-bold uppercase py-3.5 px-6 hover:text-white hover:border-white transition-all cursor-pointer">
              Clear Form
            </button>
          </div>
        </form>
      </div>

      <!-- Reviews Table / Card Grid -->
      <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 backdrop-blur-xl shadow-xl">
        <h3 class="text-xl font-bold text-white font-display mb-6">Current Active Reviews (<?= count($all_written_reviews); ?>)</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($all_written_reviews as $r): ?>
            <div class="p-5 bg-black border-2 border-white/25 flex flex-col justify-between hover:border-white hover:shadow-[0_0_30px_rgba(255,255,255,0.25)] transition-all">
              <div>
                <div class="flex items-center justify-between mb-3">
                  <span class="text-amber-400 text-xs">★★★★★</span>
                  <?php if (!empty($r['link_url'])): ?>
                    <a href="<?= htmlspecialchars($r['link_url']); ?>" target="_blank" class="text-indigo-300 text-xs hover:underline flex items-center gap-1 font-mono">
                      <span>Link</span> ↗
                    </a>
                  <?php endif; ?>
                </div>
                <p class="text-xs text-gray-300 italic mb-4 leading-relaxed line-clamp-3">
                  "<?= htmlspecialchars($r['quote']); ?>"
                </p>
              </div>

              <div class="pt-3 border-t border-white/15 flex items-center justify-between">
                <div class="flex items-center gap-2.5 min-w-0">
                  <img src="../<?= htmlspecialchars($r['avatar']); ?>" alt="" class="w-8 h-8 rounded-full border border-white/50 object-cover shrink-0" onerror="this.src='../clients/1.png'" />
                  <div class="min-w-0">
                    <p class="text-xs font-bold text-white truncate"><?= htmlspecialchars($r['name']); ?></p>
                    <p class="text-[10px] text-gray-400 truncate"><?= htmlspecialchars($r['company']); ?></p>
                  </div>
                </div>

                <div class="flex items-center gap-2">
                  <button type="button" onclick='editReview(<?= json_encode($r); ?>)' class="px-2.5 py-1 bg-white text-black font-bold text-[10px] uppercase tracking-wider hover:bg-gray-200">
                    Edit
                  </button>
                  <a href="videos.php?tab=reviews&action=delete_review&id=<?= $r['id']; ?>" onclick="return confirm('Delete this review?');" class="px-2.5 py-1 bg-red-600/20 text-red-400 border border-red-500/40 text-[10px] font-bold uppercase hover:bg-red-600 hover:text-white">
                    ✕
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

  <?php else: ?>
    <!-- TAB 1: VIDEO SHOWCASE & PORTFOLIOS (Including Portrait Reviews) -->
    <div class="space-y-8">
      
      <!-- Filter Badges by Category -->
      <div class="flex flex-wrap gap-2 sm:gap-3">
        <?php 
        $categories = [
            'all' => 'All Videos',
            'reviews' => 'Portrait Video Proof',
            'youtube' => 'YouTube Long-Form',
            'shorts' => 'Viral Shorts',
            'vsl' => 'Paid Ads & VSL',
            'podcast' => 'Podcasts',
            'motion_3d' => '3D Motion'
        ];
        foreach ($categories as $k => $label): 
            $isActive = $active_section === $k;
            $count = $video_counts[$k] ?? 0;
        ?>
          <a href="videos.php?tab=videos&section=<?= $k; ?>" 
             class="px-4 py-2 border-2 <?= $isActive ? 'border-white bg-white text-black font-extrabold shadow-[0_0_20px_rgba(255,255,255,0.4)]' : 'border-white/25 bg-black text-gray-300 hover:border-white hover:text-white'; ?> text-xs uppercase tracking-wider font-display transition-all">
            <?= $label; ?> (<?= $count; ?>)
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Add / Edit Video Item Form Card -->
      <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 backdrop-blur-xl shadow-xl">
        <div class="pb-4 mb-6 border-b border-white/15">
          <h2 class="text-xl sm:text-2xl font-bold text-white font-display">Add or Edit Video Catalog Item</h2>
          <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Select category (e.g. Portrait Video Proof, YouTube, Shorts, VSL) and paste the video link.</p>
        </div>

        <form action="videos.php?tab=videos&section=<?= htmlspecialchars($active_section); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
          <input type="hidden" name="save_section_video" value="1" />
          <input type="hidden" name="video_id" id="vid_id" value="0" />

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Category Section *</label>
              <select name="section" id="vid_section" required class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none">
                <option value="reviews" <?= $active_section === 'reviews' ? 'selected' : ''; ?>>Portrait Video Testimonial (9:16)</option>
                <option value="youtube" <?= $active_section === 'youtube' ? 'selected' : ''; ?>>YouTube Long-Form (16:9)</option>
                <option value="shorts" <?= $active_section === 'shorts' ? 'selected' : ''; ?>>Viral Shorts (9:16)</option>
                <option value="vsl" <?= $active_section === 'vsl' ? 'selected' : ''; ?>>Paid Ads & VSL</option>
                <option value="podcast" <?= $active_section === 'podcast' ? 'selected' : ''; ?>>Podcasts</option>
                <option value="motion_3d" <?= $active_section === 'motion_3d' ? 'selected' : ''; ?>>3D Motion Graphics</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Video Title / Hook *</label>
              <input type="text" name="title" id="vid_title" required placeholder="e.g. High-Retention Masterclass" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Client / Creator Name</label>
              <input type="text" name="client_name" id="vid_client" placeholder="e.g. YouTube Creator or Brand Name" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Video URL (Vimeo / YouTube / MP4) *</label>
              <input type="text" name="video_url" id="vid_url" required placeholder="https://vimeo.com/1219657057" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">External Link / Case Study URL</label>
              <input type="text" name="link_url" id="vid_link" placeholder="https://..." class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Upload Custom Thumbnail / Client Photo</label>
              <input type="file" name="thumbnail_file" class="w-full bg-black border-2 border-white/30 px-3 py-2 text-white text-xs file:bg-white file:text-black file:border-0 file:font-bold file:px-3 file:py-1 cursor-pointer" />
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Or Thumbnail Image Path</label>
              <input type="text" name="thumbnail_url" id="vid_thumb" placeholder="CL1.jpg or clients/1.png" class="w-full bg-black border-2 border-white/30 px-4 py-2.5 text-gray-300 text-xs font-mono focus:border-white focus:outline-none" />
            </div>
          </div>

          <div class="flex items-center gap-4 pt-4 border-t border-white/15">
            <button type="submit" class="bg-white text-black font-extrabold text-sm uppercase tracking-wider py-3.5 px-8 border-2 border-white hover:bg-black hover:text-white hover:shadow-[0_0_30px_rgba(255,255,255,0.6)] transition-all cursor-pointer">
              Save Video Item
            </button>
            <button type="button" onclick="resetVideoForm()" class="bg-black text-gray-300 border-2 border-white/30 text-sm font-bold uppercase py-3.5 px-6 hover:text-white hover:border-white transition-all cursor-pointer">
              Clear Form
            </button>
          </div>
        </form>
      </div>

      <!-- Videos Table List -->
      <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 backdrop-blur-xl shadow-xl">
        <h3 class="text-xl font-bold text-white font-display mb-6">Catalog Items (<?= count($all_videos); ?>)</h3>
        
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs sm:text-sm border-collapse">
            <thead>
              <tr class="border-b-2 border-white/20 text-gray-400 font-mono uppercase text-[11px]">
                <th class="py-3 px-3">Thumb</th>
                <th class="py-3 px-3">Title & Client</th>
                <th class="py-3 px-3">Category</th>
                <th class="py-3 px-3">Video Link</th>
                <th class="py-3 px-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
              <?php foreach ($all_videos as $v): ?>
                <tr class="hover:bg-white/[0.03] transition-colors">
                  <td class="py-3 px-3 w-16">
                    <?php if (!empty($v['thumbnail_url'])): ?>
                      <img src="../<?= htmlspecialchars($v['thumbnail_url']); ?>" alt="" class="w-12 h-12 object-cover border border-white/30" onerror="this.src='../CL1.jpg'" />
                    <?php else: ?>
                      <div class="w-12 h-12 bg-black border border-white/20 flex items-center justify-center text-gray-500 font-mono text-[10px]">▶</div>
                    <?php endif; ?>
                  </td>
                  <td class="py-3 px-3">
                    <p class="font-bold text-white text-sm"><?= htmlspecialchars($v['title']); ?></p>
                    <p class="text-xs text-gray-400"><?= htmlspecialchars($v['client_name'] ?? 'Next Level Media'); ?></p>
                    <?php if (!empty($v['link_url'])): ?>
                      <a href="<?= htmlspecialchars($v['link_url']); ?>" target="_blank" class="text-indigo-400 text-[11px] hover:underline font-mono">External Link ↗</a>
                    <?php endif; ?>
                  </td>
                  <td class="py-3 px-3">
                    <span class="px-2.5 py-1 bg-white/10 border border-white/20 text-[10px] font-bold text-white uppercase font-mono">
                      <?= htmlspecialchars($v['section']); ?>
                    </span>
                  </td>
                  <td class="py-3 px-3 font-mono text-xs text-gray-300 max-w-[200px] truncate">
                    <a href="<?= htmlspecialchars($v['video_url']); ?>" target="_blank" class="hover:text-white hover:underline truncate block">
                      <?= htmlspecialchars($v['video_url']); ?>
                    </a>
                  </td>
                  <td class="py-3 px-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                      <button type="button" onclick='editVideo(<?= json_encode($v); ?>)' class="px-3 py-1.5 bg-white text-black font-bold text-xs uppercase hover:bg-gray-200">
                        Edit
                      </button>
                      <a href="videos.php?tab=videos&action=delete_video&id=<?= $v['id']; ?>&section=<?= htmlspecialchars($active_section); ?>" onclick="return confirm('Delete this video item?');" class="px-3 py-1.5 bg-red-600/20 text-red-400 border border-red-500/40 text-xs font-bold uppercase hover:bg-red-600 hover:text-white">
                        ✕
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  <?php endif; ?>

</div>

<script>
function editVideo(item) {
  document.getElementById('vid_id').value = item.id || 0;
  document.getElementById('vid_section').value = item.section || 'shorts';
  document.getElementById('vid_title').value = item.title || '';
  document.getElementById('vid_client').value = item.client_name || '';
  document.getElementById('vid_url').value = item.video_url || '';
  document.getElementById('vid_thumb').value = item.thumbnail_url || '';
  if (document.getElementById('vid_link')) {
    document.getElementById('vid_link').value = item.link_url || '';
  }
  window.scrollTo({ top: 350, behavior: 'smooth' });
}

function resetVideoForm() {
  document.getElementById('vid_id').value = '0';
  document.getElementById('vid_title').value = '';
  document.getElementById('vid_client').value = '';
  document.getElementById('vid_url').value = '';
  document.getElementById('vid_thumb').value = '';
  if (document.getElementById('vid_link')) document.getElementById('vid_link').value = '';
}

function editReview(item) {
  document.getElementById('rev_id').value = item.id || 0;
  document.getElementById('rev_name').value = item.name || '';
  document.getElementById('rev_role').value = item.role || '';
  document.getElementById('rev_company').value = item.company || '';
  document.getElementById('rev_quote').value = item.quote || '';
  document.getElementById('rev_avatar').value = item.avatar || '';
  document.getElementById('rev_brand_logo').value = item.brand_logo || '';
  if (document.getElementById('rev_link_url')) {
    document.getElementById('rev_link_url').value = item.link_url || '';
  }
  window.scrollTo({ top: 350, behavior: 'smooth' });
}

function resetReviewForm() {
  document.getElementById('rev_id').value = '0';
  document.getElementById('rev_name').value = '';
  document.getElementById('rev_role').value = '';
  document.getElementById('rev_company').value = '';
  document.getElementById('rev_quote').value = '';
  document.getElementById('rev_avatar').value = '';
  document.getElementById('rev_brand_logo').value = '';
  if (document.getElementById('rev_link_url')) document.getElementById('rev_link_url').value = '';
}
</script>

<?php require_once('layout_footer.php'); ?>
