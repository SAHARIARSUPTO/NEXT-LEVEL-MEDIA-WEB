<?php
require_once('config/db.php');
require_once('components/tracker.php');

$inquiry_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Inquiry');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Please provide your name, email, and message.';
    } else {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message, status) VALUES (?, ?, ?, ?, ?, 'Unread')");
                $stmt->execute([$name, $email, $phone, $subject, $message]);
                $inquiry_sent = true;

                // Associate email with visitor session
                track_visitor('Contact Form Sent', $email);
            } catch (Exception $e) {
                $error_message = 'Failed to submit message to database. Please email us directly.';
            }
        } else {
            $inquiry_sent = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <title>Contact Us | Next Level Media Production</title>
  <meta name="description" content="Get in touch with Next Level Media. Schedule a strategy meeting, send a message, or explore production partnerships." />
  <meta name="keywords" content="contact Next Level Media, video agency discovery call, video editing inquiry, creative partnership" />
  <meta name="author" content="Sahariar Supto" />
  <meta name="developer" content="Sahariar Supto" />
  <meta name="designer" content="Sahariar Supto" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://nextlevelmediadigital.com/contact.php" />

  <!-- Open Graph -->
  <meta property="og:site_name" content="Next Level Media" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://nextlevelmediadigital.com/contact.php" />
  <meta property="og:title" content="Contact Us | Next Level Media" />
  <meta property="og:description" content="Get in touch with Next Level Media. Schedule a strategy meeting or explore partnerships." />
  <meta property="og:image" content="https://nextlevelmediadigital.com/main-logo.png" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Contact Us | Next Level Media" />
  <meta name="twitter:description" content="Get in touch with Next Level Media. Schedule a strategy meeting or explore partnerships." />
  <meta name="twitter:image" content="https://nextlevelmediadigital.com/main-logo.png" />
  
  <link rel="icon" type="image/png" href="main-logo.png" />
  <link rel="apple-touch-icon" href="main-logo.png" />
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
    button, .btn, a.btn, input[type="submit"], input[type="button"] {
      border-radius: 0px !important;
    }
    .immersive-card {
      background: rgba(9, 9, 13, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(28px);
      border-radius: 0px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.95);
    }
    .input-field {
      width: 100%;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 0px;
      padding: 0.875rem 1.25rem;
      color: #fff;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s ease;
    }
    .input-field:focus {
      background: rgba(255, 255, 255, 0.07);
      border-color: #535eee;
      box-shadow: 0 0 20px rgba(83, 94, 238, 0.3);
    }
    select.input-field {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23535eee' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
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
  </style>
</head>
<body class="relative bg-black text-slate-100 antialiased selection:bg-[#535eee] selection:text-white">

  <!-- Dual-Sided Background Color Gradients (MZ Media Cyber Aura Style) -->
  <div class="fixed top-0 left-0 bottom-0 w-[300px] sm:w-[480px] lg:w-[650px] bg-[radial-gradient(ellipse_at_left,_rgba(83,94,238,0.22)_0%,_rgba(59,130,246,0.12)_45%,_transparent_75%)] pointer-events-none z-0"></div>
  <div class="fixed top-1/3 left-0 w-[250px] sm:w-[400px] h-[600px] bg-gradient-to-r from-blue-600/15 via-[#535eee]/10 to-transparent blur-[120px] pointer-events-none z-0"></div>

  <div class="fixed top-0 right-0 bottom-0 w-[300px] sm:w-[480px] lg:w-[650px] bg-[radial-gradient(ellipse_at_right,_rgba(141,150,255,0.20)_0%,_rgba(83,94,238,0.12)_45%,_transparent_75%)] pointer-events-none z-0"></div>
  <div class="fixed top-2/3 right-0 w-[250px] sm:w-[400px] h-[600px] bg-gradient-to-l from-[#8d96ff]/15 via-[#535eee]/10 to-transparent blur-[120px] pointer-events-none z-0"></div>

  <!-- Left & Right Atmospheric Fog -->
  <div class="fixed top-0 left-0 bottom-0 w-[260px] sm:w-[420px] lg:w-[540px] pointer-events-none z-0 select-none opacity-35 sm:opacity-45 mix-blend-screen overflow-hidden">
    <img src="fog-side.svg" alt="Left Ambient Fog" class="w-full h-full object-cover object-left select-none pointer-events-none" />
  </div>
  <div class="fixed top-0 right-0 bottom-0 w-[260px] sm:w-[420px] lg:w-[540px] pointer-events-none z-0 select-none opacity-35 sm:opacity-45 mix-blend-screen overflow-hidden scale-x-[-1]">
    <img src="fog-side.svg" alt="Right Ambient Fog" class="w-full h-full object-cover object-left select-none pointer-events-none" />
  </div>

  <?php include('components/navbar.php'); ?>

  <main class="relative z-10 pt-36 pb-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
      
      <!-- Page Header -->
      <div class="text-center max-w-2xl mx-auto mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-[#535eee]/10 border border-[#535eee]/30 text-[#8d96ff] text-xs font-bold uppercase tracking-wider mb-4 shadow-[0_0_20px_rgba(83,94,238,0.25)]">
          ★ Direct Communication
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight font-display mb-4">
          Let's Talk <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-[#8d96ff] to-[#535eee]">Content Growth</span>
        </h1>
        <p class="text-sm sm:text-base text-gray-300 leading-relaxed">
          We’re not an average agency. We build viral video machines and retention systems that scale your pipeline. Reach out anytime!
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Direct Channels & Studio Info -->
        <div class="lg:col-span-5 space-y-6">
          
          <!-- Fast Book Card -->
          <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="block immersive-card p-6 sm:p-7 hover:border-[#535eee]/60 hover:shadow-[0_0_35px_rgba(83,94,238,0.3)] transition-all group rounded-none">
            <div class="flex items-center justify-between mb-3">
              <div class="w-12 h-12 rounded-none bg-[#535eee]/20 border border-[#535eee]/40 flex items-center justify-center text-[#8d96ff]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              </div>
              <span class="text-xs font-bold uppercase text-[#8d96ff] group-hover:translate-x-1 transition-transform">Book Now ➔</span>
            </div>
            <h3 class="text-lg font-bold text-white mb-1 font-display">Schedule 1-on-1 Strategy Call</h3>
            <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
              Grab 15-30 minutes on Calendly with our creative director to audit your current retention.
            </p>
          </a>

          <!-- Direct WhatsApp / Email Card -->
          <div class="immersive-card p-6 sm:p-7 space-y-4 rounded-none">
            <h3 class="text-base font-bold text-white pb-3 border-b border-white/10 flex items-center gap-2 font-display">
              <span class="w-2 h-2 rounded-none bg-emerald-400 animate-pulse"></span> Fast Contact Channels
            </h3>
            
            <div class="flex items-center justify-between text-sm">
              <span class="text-gray-400">Phone / WhatsApp:</span>
              <a href="https://wa.me/8801753506047" target="_blank" class="text-emerald-400 hover:text-white font-bold font-mono">+880 1753-506047</a>
            </div>

            <div class="flex items-center justify-between text-sm">
              <span class="text-gray-400">Direct Email:</span>
              <a href="mailto:contact@nextlevelmediadigital.com" class="text-[#8d96ff] hover:text-white font-medium">contact@nextlevelmediadigital.com</a>
            </div>

            <div class="flex items-center justify-between text-sm">
              <span class="text-gray-400">Founder Email:</span>
              <a href="mailto:workforsiambruh@gmail.com" class="text-blue-300 hover:text-white font-medium">workforsiambruh@gmail.com</a>
            </div>

            <div class="flex items-center justify-between text-sm">
              <span class="text-gray-400">Response Speed:</span>
              <span class="text-emerald-400 font-bold">Under 2 Hours</span>
            </div>
          </div>

          <!-- Studio Location Card -->
          <div class="immersive-card p-6 sm:p-7 space-y-3 rounded-none">
            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 font-display">Studio & HQ</h4>
            <p class="text-sm font-semibold text-white">Sylhet, Bangladesh & Global Remote Team</p>
            <p class="text-xs text-gray-400 leading-relaxed">
              Available 24/7 for clients across US, UK, Europe, Australia, and Asia-Pacific time zones.
            </p>
          </div>

        </div>

        <!-- Right Column: Interactive Contact Form -->
        <div class="lg:col-span-7">
          <div class="immersive-card p-6 sm:p-10 rounded-none">
            
            <?php if ($inquiry_sent): ?>
              <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto rounded-none bg-emerald-500/20 border border-emerald-500/50 flex items-center justify-center text-emerald-400 text-2xl mb-4 shadow-[0_0_25px_rgba(16,185,129,0.3)]">
                  ✓
                </div>
                <h3 class="text-2xl font-bold text-white mb-2 font-display">Message Dispatched!</h3>
                <p class="text-sm text-gray-300 max-w-md mx-auto mb-6">
                  Thank you, <span class="text-white font-bold"><?= htmlspecialchars($name); ?></span>. We’ve received your inquiry and our team will get back to you shortly.
                </p>
                <a href="index.php" class="px-6 py-2.5 rounded-none bg-white text-black font-bold text-xs uppercase tracking-wider hover:bg-gray-100 transition-all border border-white">
                  Back to Homepage
                </a>
              </div>
            <?php else: ?>
              <h2 class="text-xl sm:text-2xl font-black text-white mb-2 font-display">Send A Direct Message</h2>
              <p class="text-xs sm:text-sm text-gray-300 mb-6">Have questions or a custom inquiry? Leave a message below.</p>

              <?php if (!empty($error_message)): ?>
                <div class="mb-6 p-3.5 rounded-none bg-red-500/15 border border-red-500/40 text-red-300 text-xs">
                  <?= htmlspecialchars($error_message); ?>
                </div>
              <?php endif; ?>

              <form action="contact.php" method="POST" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Your Name *</label>
                    <input type="text" name="name" required placeholder="Alex Morgan" class="input-field" value="<?= htmlspecialchars($_POST['name'] ?? ''); ?>" />
                  </div>
                  <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Your Email *</label>
                    <input type="email" name="email" required placeholder="alex@company.com" class="input-field" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" />
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Phone / WhatsApp</label>
                    <input type="text" name="phone" placeholder="+1 (555) 000-0000" class="input-field" value="<?= htmlspecialchars($_POST['phone'] ?? ''); ?>" />
                  </div>
                  <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Subject</label>
                    <input type="text" name="subject" placeholder="e.g. Monthly Retainer Question" class="input-field" value="<?= htmlspecialchars($_POST['subject'] ?? ''); ?>" />
                  </div>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Your Message *</label>
                  <textarea name="message" required rows="5" placeholder="Tell us how we can help you..." class="input-field"><?= htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="w-full py-4 rounded-none bg-white text-black font-extrabold text-sm uppercase tracking-wider hover:bg-[#f1f3ff] transition-all shadow-[0_0_35px_rgba(255,255,255,0.35)] hover:shadow-[0_0_45px_rgba(83,94,238,0.6)] cursor-pointer border border-white hover:border-[#535eee]">
                  Send Message ➔
                </button>
              </form>
            <?php endif; ?>

          </div>
        </div>

      </div>

    </div>
  </main>

  <?php include('components/footer.php'); ?>

</body>
</html>