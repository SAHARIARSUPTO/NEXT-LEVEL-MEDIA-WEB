<?php
require_once('config/db.php');
require_once('components/tracker.php');

$order_submitted = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = trim($_POST['client_name'] ?? '');
    $client_email = trim($_POST['client_email'] ?? '');
    $contact_number = trim($_POST['contact_number'] ?? '');
    $company_name = trim($_POST['company_name'] ?? '');
    $budget_range = trim($_POST['budget_range'] ?? '');
    $deadline = trim($_POST['deadline'] ?? '');
    $project_description = trim($_POST['project_description'] ?? '');
    $reference_links = trim($_POST['reference_links'] ?? '');
    
    // Services selected (array)
    $services_arr = isset($_POST['services']) && is_array($_POST['services']) ? $_POST['services'] : [];
    $service_types = !empty($services_arr) ? implode(', ', array_map('htmlspecialchars', $services_arr)) : 'General Video Production';

    if (empty($client_name) || empty($client_email) || empty($contact_number) || empty($project_description)) {
        $error_message = 'Please fill out all required fields (Name, Email, Contact Number, and Project Details).';
    } else {
        $order_id = save_new_order([
            'client_name' => $client_name,
            'client_email' => $client_email,
            'contact_number' => $contact_number,
            'company_name' => $company_name,
            'service_types' => $service_types,
            'budget_range' => $budget_range,
            'deadline' => $deadline,
            'project_description' => $project_description,
            'reference_links' => $reference_links
        ]);

        track_visitor('Order Placed', $client_email);
        $order_submitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Start A Project Order | Next Level Media</title>
  <meta name="description" content="Submit your video production brief, select service options, and start your order with Next Level Media." />
  
  <link rel="icon" href="main-logo.png" type="image/png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000000;
      color: #f8fafc;
      font-family: 'Plus Jakarta Sans', sans-serif;
      overflow-x: hidden;
    }
    .font-display {
      font-family: 'Space Grotesk', sans-serif;
    }
    .side-fog-left {
      position: fixed;
      top: 0; left: -10vw; width: 45vw; max-width: 600px; height: 100vh;
      pointer-events: none; z-index: 1;
      background: radial-gradient(ellipse at 15% 50%, rgba(99, 102, 241, 0.18), transparent 70%);
      filter: blur(80px);
    }
    .side-fog-right {
      position: fixed;
      top: 0; right: -10vw; width: 45vw; max-width: 600px; height: 100vh;
      pointer-events: none; z-index: 1;
      background: radial-gradient(ellipse at 85% 50%, rgba(168, 85, 247, 0.18), transparent 70%);
      filter: blur(80px);
    }
    .immersive-card {
      background: rgba(9, 9, 13, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(28px);
      border-radius: 1.75rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.95);
    }
    .input-field {
      width: 100%;
      background: #0d0d14;
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 1rem;
      padding: 0.875rem 1.25rem;
      color: #fff;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s ease;
    }
    .input-field:focus {
      background: #12121c;
      border-color: #8b5cf6;
      box-shadow: 0 0 20px rgba(139, 92, 246, 0.25);
    }
    select.input-field {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23a78bfa' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1.25rem center;
      background-size: 1.1em;
      padding-right: 2.75rem;
      cursor: pointer;
    }
    select.input-field option {
      background-color: #0b0b10;
      color: #ffffff;
      padding: 12px 16px;
      font-size: 0.9375rem;
    }
    .service-pill input:checked + label {
      background: rgba(139, 92, 246, 0.25);
      border-color: #a78bfa;
      color: #fff;
      box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
    }
  </style>
</head>
<body class="relative bg-black text-slate-100 antialiased">

  <div class="side-fog-left"></div>
  <div class="side-fog-right"></div>

  <?php include('components/navbar.php'); ?>

  <main class="relative z-10 pt-36 pb-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
      
      <?php if ($order_submitted): ?>
        <!-- Success Confirmation View -->
        <div class="immersive-card p-8 sm:p-14 text-center">
          <div class="w-20 h-20 mx-auto rounded-full bg-emerald-500/20 border border-emerald-500/50 flex items-center justify-center text-emerald-400 text-3xl mb-6 shadow-[0_0_30px_rgba(16,185,129,0.4)]">
            ✓
          </div>
          <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 font-display">Project Order Received!</h1>
          <p class="text-base sm:text-lg text-gray-300 max-w-xl mx-auto mb-8 leading-relaxed">
            Thank you, <span class="text-white font-bold"><?= htmlspecialchars($client_name); ?></span>! Your production brief has been successfully logged into our system. Our team will review your requirements and contact you via WhatsApp / Email (<span class="text-violet-300"><?= htmlspecialchars($client_email); ?></span>) within 24 hours with an actionable roadmap.
          </p>

          <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="index.php" class="px-8 py-3.5 rounded-full bg-white text-black font-bold text-sm uppercase tracking-wider hover:bg-gray-100 transition-all shadow-[0_0_30px_rgba(255,255,255,0.3)]">
              Back to Homepage
            </a>
            <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="px-8 py-3.5 rounded-full bg-violet-600/30 text-violet-300 border border-violet-500/50 font-bold text-sm hover:bg-violet-600/40 transition-all">
              Book Fast-Track Call
            </a>
          </div>
        </div>

      <?php else: ?>
        <!-- Order Creation Form -->
        <div class="text-center max-w-2xl mx-auto mb-12">
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-violet-500/10 border border-violet-500/30 text-violet-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-[0_0_20px_rgba(139,92,246,0.25)]">
            ★ Instant Project Briefing
          </div>
          <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight font-display mb-4">
            Start Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-violet-400">Project Order</span>
          </h1>
          <p class="text-sm sm:text-base text-gray-300 leading-relaxed">
            Fill out your project specifications below. Our production team will review your creative goals and start immediately.
          </p>
        </div>

        <?php if (!empty($error_message)): ?>
          <div class="mb-8 p-4 rounded-2xl bg-red-500/15 border border-red-500/40 text-red-300 text-sm flex items-center gap-3">
            <span>⚠️</span>
            <span><?= htmlspecialchars($error_message); ?></span>
          </div>
        <?php endif; ?>

        <form action="order.php" method="POST" class="immersive-card p-6 sm:p-10 space-y-8">
          
          <!-- Section 1: Client Information -->
          <div>
            <h3 class="text-lg font-bold text-white mb-4 pb-2 border-b border-white/10 flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-violet-400"></span> 1. Contact & Brand Information
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Your Full Name *</label>
                <input type="text" name="client_name" required placeholder="e.g. Alex Morgan" class="input-field" value="<?= htmlspecialchars($_POST['client_name'] ?? ''); ?>" />
              </div>

              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Business Email *</label>
                <input type="email" name="client_email" required placeholder="alex@company.com" class="input-field" value="<?= htmlspecialchars($_POST['client_email'] ?? ''); ?>" />
              </div>

              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">WhatsApp / Phone Number *</label>
                <input type="text" name="contact_number" required placeholder="+1 (555) 000-0000" class="input-field" value="<?= htmlspecialchars($_POST['contact_number'] ?? ''); ?>" />
              </div>

              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Company / Channel Name</label>
                <input type="text" name="company_name" placeholder="e.g. FitPro Media / YouTube Channel" class="input-field" value="<?= htmlspecialchars($_POST['company_name'] ?? ''); ?>" />
              </div>
            </div>
          </div>

          <!-- Section 2: Service Selection -->
          <div>
            <h3 class="text-lg font-bold text-white mb-4 pb-2 border-b border-white/10 flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-blue-400"></span> 2. Select Services Needed
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
              
              <div class="service-pill">
                <input type="checkbox" name="services[]" value="Viral Shorts / Reels" id="srv_shorts" class="hidden" />
                <label for="srv_shorts" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>⚡</span> Viral Shorts / TikTok / Reels
                </label>
              </div>

              <div class="service-pill">
                <input type="checkbox" name="services[]" value="YouTube Long-Form" id="srv_yt" class="hidden" />
                <label for="srv_yt" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>🎬</span> YouTube Long-Form Video
                </label>
              </div>

              <div class="service-pill">
                <input type="checkbox" name="services[]" value="Direct Response VSL" id="srv_vsl" class="hidden" />
                <label for="srv_vsl" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>🎯</span> Direct Response VSL & Ads
                </label>
              </div>

              <div class="service-pill">
                <input type="checkbox" name="services[]" value="3D Motion & VFX" id="srv_3d" class="hidden" />
                <label for="srv_3d" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>🧊</span> 3D Motion Graphics & Assets
                </label>
              </div>

              <div class="service-pill">
                <input type="checkbox" name="services[]" value="Custom Thumbnails" id="srv_thumb" class="hidden" />
                <label for="srv_thumb" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>🖼️</span> High-CTR Custom Thumbnails
                </label>
              </div>

              <div class="service-pill">
                <input type="checkbox" name="services[]" value="Complete Monthly Retainer" id="srv_retainer" class="hidden" />
                <label for="srv_retainer" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/5 border border-white/10 text-gray-300 text-xs sm:text-sm font-semibold cursor-pointer hover:border-white/30 transition-all select-none">
                  <span>👑</span> Complete Monthly Retainer
                </label>
              </div>

            </div>
          </div>

          <!-- Section 3: Budget & Timeline -->
          <div>
            <h3 class="text-lg font-bold text-white mb-4 pb-2 border-b border-white/10 flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-cyan-400"></span> 3. Budget & Timeline
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Estimated Budget</label>
                <select name="budget_range" class="input-field">
                  <option value="$500 - $1,500">$500 – $1,500 (Starter Project / Test)</option>
                  <option value="$1,500 - $3,500" selected>$1,500 – $3,500 (Growth Production)</option>
                  <option value="$3,500 - $7,000">$3,500 – $7,000 (Multi-Video Retainer)</option>
                  <option value="$7,000+">$7,000+ (Full Studio Enterprise)</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Desired Turnaround</label>
                <select name="deadline" class="input-field">
                  <option value="ASAP / 24-48 Hours">Fast-Track (24–48 Hours)</option>
                  <option value="Within 1 Week" selected>Standard (Within 1 Week)</option>
                  <option value="Within 2-3 Weeks">Flexible (2–3 Weeks)</option>
                  <option value="Monthly Ongoing">Monthly Ongoing Retainer</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Section 4: Project Scope & Reference Links -->
          <div>
            <h3 class="text-lg font-bold text-white mb-4 pb-2 border-b border-white/10 flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-emerald-400"></span> 4. Project Scope & References
            </h3>

            <div class="space-y-4">
              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Project Description / Raw Footage Details *</label>
                <textarea name="project_description" required rows="4" placeholder="Tell us about the video concept, length, goals, and who your target audience is..." class="input-field"><?= htmlspecialchars($_POST['project_description'] ?? ''); ?></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold text-gray-300 mb-2 uppercase tracking-wider">Reference Links (Drive, Dropbox, Inspiration URLs)</label>
                <input type="text" name="reference_links" placeholder="https://drive.google.com/... or https://youtube.com/..." class="input-field" value="<?= htmlspecialchars($_POST['reference_links'] ?? ''); ?>" />
              </div>
            </div>
          </div>

          <!-- Submit Action -->
          <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-400">
              🔒 Your creative files and project ideas are 100% confidential.
            </p>

            <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-full bg-white text-black font-extrabold text-sm uppercase tracking-wider hover:bg-gray-100 transition-all shadow-[0_0_40px_rgba(255,255,255,0.4)] hover:shadow-[0_0_50px_rgba(139,92,246,0.6)] cursor-pointer">
              Submit Project Order ➔
            </button>
          </div>

        </form>
      <?php endif; ?>

    </div>
  </main>

  <?php include('components/footer.php'); ?>

</body>
</html>
