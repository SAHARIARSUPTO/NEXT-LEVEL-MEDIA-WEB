<?php
$page_title = 'Website Videos & Showreel';
require_once('layout_header.php');

$msg = '';
$action = $_GET['action'] ?? 'list';
$active_section = $_GET['section'] ?? 'all';

// Handle Hero Showreel Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hero_showreel'])) {
    $hero_url = trim($_POST['hero_video_url'] ?? '');
    $hero_badge = trim($_POST['hero_badge_text'] ?? 'Agency Showreel (01:24)');

    // Convert Vimeo normal URL to player embed if needed
    if (preg_match('/vimeo\.com\/([0-9]+)/', $hero_url, $m)) {
        $hero_url = "https://player.vimeo.com/video/{$m[1]}";
    }

    save_setting('hero_video_url', $hero_url);
    save_setting('hero_badge_text', $hero_badge);
    $msg = 'Hero Showreel updated successfully!';
}

// Handle Add / Edit Section Video
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_section_video'])) {
    $video_id = intval($_POST['video_id'] ?? 0);
    $section = trim($_POST['section'] ?? 'shorts');
    $title = trim($_POST['title'] ?? '');
    $client_name = trim($_POST['client_name'] ?? 'Next Level Media');
    $video_url = trim($_POST['video_url'] ?? '');

    if (empty($title) || empty($video_url)) {
        $msg = 'Error: Please provide both a video title and link.';
    } else {
        save_video_item($section, $title, $client_name, $video_url, $video_id);
        $msg = 'Video successfully saved to ' . strtoupper($section) . ' catalog!';
        $action = 'list';
    }
}

// Handle Delete
if ($action === 'delete' && !empty($_GET['id'])) {
    delete_video_item(intval($_GET['id']));
    $msg = 'Video deleted successfully.';
    $action = 'list';
}

$all_videos = get_section_videos($active_section);
$hero_video_url = get_setting('hero_video_url', 'https://player.vimeo.com/video/824804225');
$hero_badge_text = get_setting('hero_badge_text', 'Agency Showreel (01:24)');

// Counts per section
$all_raw_videos = get_section_videos('all');
$section_counts = [
    'all' => count($all_raw_videos),
    'shorts' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'shorts')),
    'youtube' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'youtube')),
    'vsl' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'vsl')),
    'motion_3d' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'motion_3d')),
    'reviews' => count(array_filter($all_raw_videos, fn($v) => ($v['section'] ?? '') === 'reviews')),
];
?>

<!-- Page Header -->
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
  <div>
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">Videos & Showreel</span>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Website Videos & Showreel Manager</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Change the main video on your homepage or add new YouTube videos to your portfolio tabs.</p>
  </div>
  
  <div>
    <a href="../index.php#projects" target="_blank" class="adm-btn-secondary">
      <span>View Live Website Portfolio</span>
      <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
      </svg>
    </a>
  </div>
</div>

<!-- Alert Banner -->
<?php if (!empty($msg)): ?>
  <div class="mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-200 text-sm font-semibold flex items-center justify-between gap-3">
    <div class="flex items-center gap-2.5">
      <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      <span><?= htmlspecialchars($msg); ?></span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white text-base font-bold">&times;</button>
  </div>
<?php endif; ?>

<!-- 1. Hero Showreel Manager Card -->
<div class="mb-8 adm-card p-6 sm:p-8">
  <div class="flex items-start justify-between pb-4 mb-6 border-b border-white/[0.08]">
    <div>
      <div class="flex items-center gap-2 mb-1">
        <span class="px-2.5 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 font-bold text-xs">
          Homepage Main Video
        </span>
      </div>
      <h2 class="text-xl sm:text-2xl font-bold text-white font-display">1. Main Homepage Showreel Player</h2>
      <p class="text-sm text-slate-300 mt-0.5">The first video visitors see at the top of your homepage. Paste a Vimeo or YouTube URL here.</p>
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
        class="adm-input text-sm font-mono" 
        value="<?= htmlspecialchars($hero_video_url); ?>" 
        placeholder="https://player.vimeo.com/video/824804225 or https://youtube.com/watch?v=..." 
      />
      <p class="text-xs text-slate-400 mt-1">Example: <code class="text-indigo-300">https://player.vimeo.com/video/824804225</code></p>
    </div>

    <div class="sm:col-span-3">
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Badge Text (Top of Video)</label>
      <input 
        type="text" 
        name="hero_badge_text" 
        required 
        class="adm-input text-sm font-semibold" 
        value="<?= htmlspecialchars($hero_badge_text); ?>" 
        placeholder="Agency Showreel (01:24)" 
      />
    </div>

    <div class="sm:col-span-3">
      <button type="submit" class="w-full adm-btn-primary py-3">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span>Save Showreel</span>
      </button>
    </div>
  </form>
</div>

<!-- 2. Section Video Catalog Manager -->
<div class="adm-card p-6 sm:p-8">
  <div class="flex items-start justify-between pb-4 mb-6 border-b border-white/[0.08]">
    <div>
      <h2 class="text-xl sm:text-2xl font-bold text-white font-display">2. Section-Wise Portfolio Videos</h2>
      <p class="text-sm text-slate-300 mt-0.5">Add YouTube videos into specific category tabs on your website.</p>
    </div>
  </div>

  <!-- Add New Video Box -->
  <div class="p-6 rounded-2xl bg-black/30 border border-white/10 mb-8">
    <div class="text-sm font-extrabold uppercase tracking-wider text-white font-display mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      <span>Add New Video to Portfolio</span>
    </div>

    <form action="videos.php" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
      <input type="hidden" name="save_section_video" value="1" />

      <div class="sm:col-span-3">
        <label class="block text-xs font-bold text-slate-300 mb-1.5">Category / Section *</label>
        <select name="section" required class="adm-input text-sm font-semibold">
          <option value="shorts" <?= $active_section === 'shorts' ? 'selected' : ''; ?>>Viral Shorts & Reels</option>
          <option value="youtube" <?= $active_section === 'youtube' ? 'selected' : ''; ?>>YouTube Long-Form</option>
          <option value="vsl" <?= $active_section === 'vsl' ? 'selected' : ''; ?>>Paid Ads & VSLs</option>
          <option value="motion_3d" <?= $active_section === 'motion_3d' ? 'selected' : ''; ?>>3D Motion & Assets</option>
          <option value="reviews" <?= $active_section === 'reviews' ? 'selected' : ''; ?>>Client Video Reviews</option>
        </select>
      </div>

      <div class="sm:col-span-3">
        <label class="block text-xs font-bold text-slate-300 mb-1.5">Video Title *</label>
        <input type="text" name="title" required placeholder="e.g. High Paced Viral Edit" class="adm-input text-sm" />
      </div>

      <div class="sm:col-span-2">
        <label class="block text-xs font-bold text-slate-300 mb-1.5">Client Name</label>
        <input type="text" name="client_name" placeholder="e.g. Creator Channel" class="adm-input text-sm" />
      </div>

      <div class="sm:col-span-2">
        <label class="block text-xs font-bold text-slate-300 mb-1.5">YouTube / Video Link *</label>
        <input type="text" name="video_url" required placeholder="https://youtube.com/..." class="adm-input text-sm font-mono" />
      </div>

      <div class="sm:col-span-2">
        <button type="submit" class="w-full adm-btn-primary text-sm py-2.5">
          <span>+ Add Video</span>
        </button>
      </div>
    </form>
  </div>

  <!-- Section Filter Tabs -->
  <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6 text-sm">
    
    <a href="videos.php?section=all" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      All Videos (<?= $section_counts['all']; ?>)
    </a>

    <a href="videos.php?section=shorts" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'shorts' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      Shorts & Reels (<?= $section_counts['shorts']; ?>)
    </a>

    <a href="videos.php?section=youtube" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'youtube' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      YouTube Long-Form (<?= $section_counts['youtube']; ?>)
    </a>

    <a href="videos.php?section=vsl" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'vsl' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      Paid Ads / VSL (<?= $section_counts['vsl']; ?>)
    </a>

    <a href="videos.php?section=motion_3d" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'motion_3d' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      3D Motion (<?= $section_counts['motion_3d']; ?>)
    </a>

    <a href="videos.php?section=reviews" class="px-4 py-2 rounded-xl font-bold transition-all whitespace-nowrap <?= $active_section === 'reviews' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-[#121522] border border-[#23283c] text-slate-300 hover:text-white'; ?>">
      Client Reviews (<?= $section_counts['reviews']; ?>)
    </a>

  </div>

  <!-- Videos Table -->
  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-slate-200">
      <thead>
        <tr class="text-slate-400 border-b border-white/[0.08] text-xs font-bold uppercase tracking-wider">
          <th class="pb-3 pr-4">Section Category</th>
          <th class="pb-3 pr-4">Video Title</th>
          <th class="pb-3 pr-4">Client / Channel</th>
          <th class="pb-3 pr-4">Video Link</th>
          <th class="pb-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/[0.06]">
        <?php foreach ($all_videos as $v): ?>
          <tr class="hover:bg-white/[0.03] transition-colors">
            <td class="py-4 pr-4">
              <span class="px-2.5 py-1 rounded-md bg-indigo-500/15 border border-indigo-500/30 text-xs font-mono uppercase font-bold text-indigo-300">
                <?= htmlspecialchars($v['section']); ?>
              </span>
            </td>
            <td class="py-4 pr-4 font-bold text-white text-base">
              <?= htmlspecialchars($v['title']); ?>
            </td>
            <td class="py-4 pr-4 text-slate-300">
              <?= htmlspecialchars($v['client_name'] ?? 'Next Level Media'); ?>
            </td>
            <td class="py-4 pr-4 font-mono text-slate-300 truncate max-w-xs text-xs">
              <a href="<?= htmlspecialchars($v['video_url']); ?>" target="_blank" class="text-indigo-400 hover:text-white hover:underline inline-flex items-center gap-1.5 font-semibold">
                <span class="truncate"><?= htmlspecialchars($v['video_url']); ?></span>
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
              </a>
            </td>
            <td class="py-4 text-right whitespace-nowrap">
              <a href="videos.php?action=delete&id=<?= $v['id']; ?><?= $active_section !== 'all' ? '&section='.$active_section : ''; ?>" onclick="return confirm('Are you sure you want to remove the video: <?= htmlspecialchars(addslashes($v['title'])); ?>?')" class="px-3 py-1.5 rounded-lg bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-400 hover:text-white font-bold text-xs transition-all">
                Delete Video
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once('layout_footer.php'); ?>
