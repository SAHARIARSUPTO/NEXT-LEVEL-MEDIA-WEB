<?php
$page_title = 'Website Links & SEO Settings';
require_once('layout_header.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings_to_update = [
        'meta_title' => $_POST['meta_title'] ?? '',
        'meta_description' => $_POST['meta_description'] ?? '',
        'meta_keywords' => $_POST['meta_keywords'] ?? '',
        'og_image' => $_POST['og_image'] ?? '',
        'contact_email' => $_POST['contact_email'] ?? '',
        'contact_phone' => $_POST['contact_phone'] ?? '',
        'booking_calendly_url' => $_POST['booking_calendly_url'] ?? '',
        'order_cta_url' => $_POST['order_cta_url'] ?? 'order.php',
        'hero_video_url' => $_POST['hero_video_url'] ?? '',
        'hero_badge_text' => $_POST['hero_badge_text'] ?? '',
        'social_twitter' => $_POST['social_twitter'] ?? '',
        'social_youtube' => $_POST['social_youtube'] ?? '',
        'social_linkedin' => $_POST['social_linkedin'] ?? '',
        'social_instagram' => $_POST['social_instagram'] ?? '',
    ];

    foreach ($settings_to_update as $key => $val) {
        save_setting($key, trim($val));
    }
    $msg = 'All website links, social profiles, and SEO settings updated successfully!';
}

$current_title = get_setting('meta_title', 'Next Level Media | High-Performance Video Production & Creative Systems');
$current_desc = get_setting('meta_description', 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.');
$current_keywords = get_setting('meta_keywords', 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation');
$current_og_image = get_setting('og_image', 'main-logo.png');
$current_email = get_setting('contact_email', 'contact@nextlevelmediadigital.com');
$current_phone = get_setting('contact_phone', '+880 1753-506047');
$current_calendly = get_setting('booking_calendly_url', 'https://calendly.com/nextlevelmediacall/30min?month=2025-07');
$current_order_cta = get_setting('order_cta_url', 'order.php');
$current_hero_url = get_setting('hero_video_url', 'https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0');
$current_hero_badge = get_setting('hero_badge_text', 'Agency Showreel');
$current_twitter = get_setting('social_twitter', 'https://x.com/neel_nafis');
$current_youtube = get_setting('social_youtube', 'https://www.youtube.com/@neelnafis');
$current_linkedin = get_setting('social_linkedin', 'https://www.linkedin.com/company/mz-media-digital/');
$current_instagram = get_setting('social_instagram', 'https://instagram.com/nextlevelmedia');
?>

<div class="max-w-5xl mx-auto space-y-8">
  
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
        <a href="index.php" class="hover:text-white transition-colors">Admin</a>
        <span>/</span>
        <span class="text-white font-bold">Homepage Links & SEO</span>
      </div>
      <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Website Links & Settings Center</h1>
      <p class="text-sm text-slate-300 mt-1">Easily control all buttons, CTA links, social accounts, and search previews across your entire website.</p>
    </div>
    
    <div>
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

  <form action="seo.php" method="POST" class="space-y-8">
    
    <!-- 1. Global CTA & Homepage Action Links -->
    <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 hover:border-white/40 backdrop-blur-xl shadow-xl space-y-6">
      <div class="border-b border-white/15 pb-4">
        <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-white/10 border border-white/20 text-white font-mono text-xs uppercase font-bold mb-2">
          <span>Action Buttons & CTAs</span>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-white font-display">1. Homepage CTA Buttons & Navigation Links</h2>
        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Control where visitors are redirected when clicking buttons on the homepage and header.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">"Book a Discovery Call" Calendly URL</label>
          <input 
            type="url" 
            name="booking_calendly_url" 
            required 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_calendly); ?>" 
          />
          <p class="text-[11px] text-gray-400 mt-1">Used for all Calendly / discovery meeting buttons on the site.</p>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">"Get your video done" / Order CTA Link</label>
          <input 
            type="text" 
            name="order_cta_url" 
            required 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_order_cta); ?>" 
          />
          <p class="text-[11px] text-gray-400 mt-1">Target for the primary project order / start video buttons.</p>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Agency Contact Email</label>
          <input 
            type="email" 
            name="contact_email" 
            required 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_email); ?>" 
          />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Agency Phone / WhatsApp</label>
          <input 
            type="text" 
            name="contact_phone" 
            required 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_phone); ?>" 
          />
        </div>
      </div>
    </div>

    <!-- 2. Social Media & External Channels -->
    <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 hover:border-white/40 backdrop-blur-xl shadow-xl space-y-6">
      <div class="border-b border-white/15 pb-4">
        <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-white/10 border border-white/20 text-white font-mono text-xs uppercase font-bold mb-2">
          <span>Social Media</span>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-white font-display">2. Social Media & Channel Links</h2>
        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Control the social icons displayed in the footer and contact sections.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">X / Twitter Profile Link</label>
          <input type="url" name="social_twitter" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" value="<?= htmlspecialchars($current_twitter); ?>" />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">YouTube Channel Link</label>
          <input type="url" name="social_youtube" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" value="<?= htmlspecialchars($current_youtube); ?>" />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">LinkedIn Company / Profile Link</label>
          <input type="url" name="social_linkedin" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" value="<?= htmlspecialchars($current_linkedin); ?>" />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Instagram Profile Link</label>
          <input type="url" name="social_instagram" class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" value="<?= htmlspecialchars($current_instagram); ?>" />
        </div>
      </div>
    </div>

    <!-- 3. Google SEO & Meta Tags -->
    <div class="p-6 sm:p-8 bg-[#09090d]/90 border-2 border-white/20 hover:border-white/40 backdrop-blur-xl shadow-xl space-y-6">
      <div class="border-b border-white/15 pb-4">
        <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-white/10 border border-white/20 text-white font-mono text-xs uppercase font-bold mb-2">
          <span>Search Engine Appearance</span>
        </div>
        <h2 class="text-xl sm:text-2xl font-bold text-white font-display">3. Google Search & Social Media SEO</h2>
        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">Control how your agency appears on Google searches and link unfurls.</p>
      </div>

      <div class="space-y-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Website Title (Google Title Tag)</label>
          <input 
            type="text" 
            name="meta_title" 
            id="metaTitleInput" 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_title); ?>" 
            oninput="updateSerpPreview()" 
          />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">Search Description (Google Snippet Text)</label>
          <textarea 
            name="meta_description" 
            id="metaDescInput" 
            rows="3" 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none leading-relaxed" 
            oninput="updateSerpPreview()"
          ><?= htmlspecialchars($current_desc); ?></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">SEO Keywords (Comma-Separated)</label>
          <input 
            type="text" 
            name="meta_keywords" 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_keywords); ?>" 
          />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-2">OG Share Image / Logo Path</label>
          <input 
            type="text" 
            name="og_image" 
            class="w-full bg-black border-2 border-white/30 px-4 py-3 text-white text-sm font-mono focus:border-white focus:outline-none" 
            value="<?= htmlspecialchars($current_og_image); ?>" 
          />
        </div>
      </div>

      <!-- Live Google Search Simulation Box -->
      <div class="p-5 bg-black border-2 border-white/20 mt-6">
        <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 flex items-center gap-2">
          <span>Live Google Search Snippet Preview:</span>
        </div>
        <div class="p-4 bg-[#0a0a0f] border border-white/10 space-y-1">
          <div class="text-xs text-slate-400 font-mono">
            https://nextlevelmediadigital.com
          </div>
          <div class="text-base sm:text-lg font-semibold text-[#8ab4f8] hover:underline cursor-pointer font-display" id="serpTitle">
            <?= htmlspecialchars($current_title); ?>
          </div>
          <div class="text-xs sm:text-sm text-[#cbd5e1] leading-relaxed line-clamp-2" id="serpDesc">
            <?= htmlspecialchars($current_desc); ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Save Button Toolbar -->
    <div class="flex justify-end pt-2">
      <button type="submit" class="bg-white text-black font-extrabold text-sm uppercase tracking-wider py-4 px-10 border-2 border-white hover:bg-black hover:text-white hover:shadow-[0_0_35px_rgba(255,255,255,0.7)] transition-all cursor-pointer">
        Save All Links & Settings
      </button>
    </div>

  </form>

</div>

<script>
function updateSerpPreview() {
  const title = document.getElementById('metaTitleInput').value || 'Next Level Media';
  const desc = document.getElementById('metaDescInput').value || 'High-performance video production and creative systems.';
  
  document.getElementById('serpTitle').innerText = title;
  document.getElementById('serpDesc').innerText = desc;
}
</script>

<?php require_once('layout_footer.php'); ?>
