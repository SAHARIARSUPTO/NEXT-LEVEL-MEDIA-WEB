<?php
$page_title = 'Google SEO & Website Settings';
require_once('layout_header.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    $settings_to_update = [
        'meta_title' => $_POST['meta_title'] ?? '',
        'meta_description' => $_POST['meta_description'] ?? '',
        'meta_keywords' => $_POST['meta_keywords'] ?? '',
        'og_image' => $_POST['og_image'] ?? '',
        'contact_email' => $_POST['contact_email'] ?? '',
        'contact_phone' => $_POST['contact_phone'] ?? '',
        'booking_calendly_url' => $_POST['booking_calendly_url'] ?? '',
        'hero_video_url' => $_POST['hero_video_url'] ?? '',
        'hero_badge_text' => $_POST['hero_badge_text'] ?? '',
    ];

    try {
        $update_stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        foreach ($settings_to_update as $key => $val) {
            $update_stmt->execute([$key, trim($val)]);
        }
        $msg = 'Website settings and Google SEO tags updated successfully!';
    } catch (Exception $e) {
        $msg = 'Error updating settings: ' . $e->getMessage();
    }
}

$current_title = get_setting('meta_title', 'Next Level Media | High-Performance Video Production & Creative Systems');
$current_desc = get_setting('meta_description', 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.');
$current_keywords = get_setting('meta_keywords', 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation');
$current_og_image = get_setting('og_image', 'main-logo.png');
$current_email = get_setting('contact_email', 'contact@nextlevelmediadigital.com');
$current_phone = get_setting('contact_phone', '+880 1753-506047');
$current_calendly = get_setting('booking_calendly_url', 'https://calendly.com/nextlevelmediacall/30min?month=2025-07');
?>

<div class="max-w-4xl mx-auto">
  
  <!-- Page Header -->
  <div class="mb-8">
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-1">
      <a href="index.php" class="hover:text-white transition-colors">Admin</a>
      <span>/</span>
      <span class="text-indigo-400 font-bold">SEO & Settings</span>
    </div>
    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-display">Website Settings & Google SEO</h1>
    <p class="text-sm sm:text-base text-slate-300 mt-1">Configure your search engine preview, social sharing image, contact email, and Calendly meeting link.</p>
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

  <form action="seo.php" method="POST" class="space-y-8">
    
    <!-- Section 1: Search Engine Optimization -->
    <div class="adm-card p-6 sm:p-8 space-y-6">
      <div class="border-b border-white/[0.08] pb-4">
        <div class="flex items-center gap-2 mb-1">
          <span class="px-2.5 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 font-bold text-xs">
            Google Search Appearance
          </span>
        </div>
        <h2 class="text-xl font-bold text-white font-display">1. Google Search & Social Media SEO</h2>
        <p class="text-sm text-slate-300 mt-0.5">Control how your agency looks when people search on Google or share your link on Twitter/Facebook.</p>
      </div>

      <div class="space-y-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Website Title (Appears in Google Tab & Search)</label>
          <input 
            type="text" 
            name="meta_title" 
            id="metaTitleInput" 
            class="adm-input text-sm font-semibold" 
            value="<?= htmlspecialchars($current_title); ?>" 
            oninput="updateSerpPreview()" 
          />
          <p class="text-xs text-slate-400 mt-1">Recommended length: 50–60 characters.</p>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Search Description (Google Snippet Text)</label>
          <textarea 
            name="meta_description" 
            id="metaDescInput" 
            rows="3" 
            class="adm-input text-sm leading-relaxed" 
            oninput="updateSerpPreview()"
          ><?= htmlspecialchars($current_desc); ?></textarea>
          <p class="text-xs text-slate-400 mt-1">A short summary of your agency (approx. 140–160 characters).</p>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Keywords (Comma-Separated)</label>
          <input 
            type="text" 
            name="meta_keywords" 
            class="adm-input text-sm" 
            value="<?= htmlspecialchars($current_keywords); ?>" 
          />
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Social Share & Logo Image Path</label>
          <input 
            type="text" 
            name="og_image" 
            class="adm-input text-sm font-mono" 
            value="<?= htmlspecialchars($current_og_image); ?>" 
          />
          <p class="text-xs text-slate-400 mt-1">Tip: You can upload a new logo in <a href="media.php" class="text-indigo-400 underline font-bold">Image Manager</a> and paste the link here.</p>
        </div>
      </div>

      <!-- Live Google Search Simulation Box -->
      <div class="p-5 rounded-2xl bg-black/40 border border-white/10 mt-6">
        <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 flex items-center gap-2">
          <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          <span>Live Google Search Snippet Preview:</span>
        </div>
        <div class="p-4 rounded-xl bg-[#0f111a] border border-white/[0.08] space-y-1">
          <div class="text-xs text-slate-400 font-mono flex items-center gap-1">
            <span>https://nextlevelmediadigital.com</span>
            <span>›</span>
          </div>
          <div class="text-base sm:text-lg font-semibold text-[#8ab4f8] hover:underline cursor-pointer" id="serpTitle">
            <?= htmlspecialchars($current_title); ?>
          </div>
          <div class="text-xs sm:text-sm text-[#cbd5e1] leading-relaxed line-clamp-2" id="serpDesc">
            <?= htmlspecialchars($current_desc); ?>
          </div>
        </div>
      </div>

    </div>

    <!-- Section 2: Global Contact & Discovery Links -->
    <div class="adm-card p-6 sm:p-8 space-y-6">
      <div class="border-b border-white/[0.08] pb-4">
        <div class="flex items-center gap-2 mb-1">
          <span class="px-2.5 py-0.5 rounded-md bg-emerald-500/20 text-emerald-300 font-bold text-xs">
            Client Communication
          </span>
        </div>
        <h2 class="text-xl font-bold text-white font-display">2. Contact Channels & Meeting Booking</h2>
        <p class="text-sm text-slate-300 mt-0.5">Where client emails are delivered and which Calendly link is used for booking discovery calls.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Primary Contact Email</label>
          <input 
            type="email" 
            name="contact_email" 
            class="adm-input text-sm font-semibold" 
            value="<?= htmlspecialchars($current_email); ?>" 
          />
          <p class="text-xs text-slate-400 mt-1">Clients will see this email across the footer and contact page.</p>
        </div>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Primary Phone / WhatsApp</label>
          <input 
            type="text" 
            name="contact_phone" 
            class="adm-input text-sm font-semibold" 
            value="<?= htmlspecialchars($current_phone); ?>" 
          />
        </div>

        <div class="sm:col-span-2">
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-200 mb-1.5">Calendly Discovery Call Link</label>
          <input 
            type="url" 
            name="booking_calendly_url" 
            class="adm-input text-sm font-mono" 
            value="<?= htmlspecialchars($current_calendly); ?>" 
          />
          <p class="text-xs text-slate-400 mt-1">This link opens whenever a client clicks the "Book A 30-Min Call" button on the website.</p>
        </div>
      </div>
    </div>

    <!-- Save Button Toolbar -->
    <div class="flex justify-end pt-2">
      <button type="submit" class="adm-btn-primary px-10 py-3.5 text-sm uppercase tracking-wider font-extrabold shadow-lg shadow-indigo-600/40">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span>Save All Settings</span>
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
