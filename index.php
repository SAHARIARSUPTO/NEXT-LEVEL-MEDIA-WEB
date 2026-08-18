<?php
require_once('config/db.php');
require_once('components/tracker.php');

$meta_title = get_setting('meta_title', 'Next Level Media | High-Performance Video Production & Creative Systems');
$meta_desc = get_setting('meta_description', 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.');
$meta_keys = get_setting('meta_keywords', 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation');
$og_image = get_setting('og_image', 'main-logo.png');
$hero_video_url = get_setting('hero_video_url', 'https://www.youtube.com/embed/X0SIgFWWb1o');
$hero_badge_text = get_setting('hero_badge_text', 'Agency Showreel (01:24)');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <title><?= htmlspecialchars($meta_title); ?></title>
  
  <meta name="description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($meta_keys); ?>" />
  <meta name="author" content="Next Level Media" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://nextlevelmediadigital.com/" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://nextlevelmediadigital.com/" />
  <meta property="og:title" content="<?= htmlspecialchars($meta_title); ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta property="og:image" content="<?= htmlspecialchars($og_image); ?>" />

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:url" content="https://nextlevelmediadigital.com/" />
  <meta name="twitter:title" content="<?= htmlspecialchars($meta_title); ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars($og_image); ?>" />

  <link rel="icon" href="main-logo.png" type="image/png" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700;800&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            display: ['"Space Grotesk"', '"Syne"', 'sans-serif'],
          },
          colors: {
            brand: {
              purple: '#8b5cf6',
              indigo: '#6366f1',
              blue: '#3b82f6',
              cyan: '#06b6d4',
              pink: '#ec4899',
            },
            dark: {
              950: '#040407',
              900: '#07070b',
              850: '#0c0c14',
              800: '#11111b',
              700: '#181826'
            }
          },
          animation: {
            'marquee-fast': 'marquee 22s linear infinite',
            'marquee-reverse': 'marqueeRev 24s linear infinite',
            'glow-pulse': 'glowPulse 8s ease-in-out infinite alternate',
            'beam-flow': 'beamFlow 12s ease-in-out infinite alternate',
          },
          keyframes: {
            marquee: {
              '0%': { transform: 'translateX(0%)' },
              '100%': { transform: 'translateX(-50%)' }
            },
            marqueeRev: {
              '0%': { transform: 'translateX(-50%)' },
              '100%': { transform: 'translateX(0%)' }
            },
            glowPulse: {
              '0%': { opacity: 0.35, transform: 'scale(1)' },
              '100%': { opacity: 0.7, transform: 'scale(1.15)' }
            },
            beamFlow: {
              '0%': { opacity: 0.4, transform: 'translateY(-5%) scaleY(1)' },
              '50%': { opacity: 0.8, transform: 'translateY(5%) scaleY(1.1)' },
              '100%': { opacity: 0.4, transform: 'translateY(-5%) scaleY(1)' }
            }
          }
        }
      }
    }
  </script>

  <!-- Three.js CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <!-- Lenis Butter-Smooth Scrolling Engine -->
  <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

  <!-- Structured Schema Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Next Level Media",
    "url": "https://nextlevelmediadigital.com/",
    "logo": "https://nextlevelmediadigital.com/main-logo.png",
    "description": "Next Level Media is a video production agency creating high-performing video content and visual systems.",
    "sameAs": [
      "https://www.facebook.com/nextlevelmedia",
      "https://twitter.com/nextlevelmedia",
      "https://www.linkedin.com/company/nextlevelmedia"
    ]
  }
  </script>

  <style>
    :root {
      --bg-dark: #000000;
      --card-bg: #09090d;
      --border-subtle: rgba(255, 255, 255, 0.08);
      --accent-glow: rgba(139, 92, 246, 0.15);
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      background-color: #000000 !important;
      background: #000000 !important;
      color: #f8fafc;
      font-family: 'Plus Jakarta Sans', sans-serif;
      overflow-x: hidden;
    }

    html.lenis, html.lenis body {
      height: auto;
    }
    .lenis.lenis-smooth {
      scroll-behavior: auto !important;
    }
    .lenis.lenis-smooth [data-lenis-prevent] {
      overscroll-behavior: contain;
    }
    .lenis.lenis-stopped {
      overflow: hidden;
    }
    .lenis.lenis-scrolling iframe {
      pointer-events: none;
    }

    /* Hero Video Container Scroll-Driven Transform Transition */
    #heroVideoContainer {
      transform-origin: center center;
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease, border-color 0.3s ease;
      will-change: transform;
    }

    /* Ultra-Immersive Pure Black Studio Card Style */
    .immersive-card {
      position: relative;
      background: #09090d;
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(28px);
      -webkit-backdrop-filter: blur(28px);
      border-radius: 1.75rem;
      overflow: hidden;
      transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.15s ease-out;
      transform-style: preserve-3d;
      box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.95);
    }

    .immersive-card::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: inherit;
      background: radial-gradient(500px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 255, 255, 0.04), transparent 80%);
      opacity: 0;
      transition: opacity 0.4s ease;
      pointer-events: none;
      z-index: 1;
    }

    .immersive-card:hover::before {
      opacity: 1;
    }

    .immersive-card:hover {
      border-color: rgba(139, 92, 246, 0.4);
      box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.98), 0 0 30px rgba(139, 92, 246, 0.15);
    }

    /* Corner HUD Cyber Bracket Accents */
    .hud-corner-tl, .hud-corner-br {
      position: absolute;
      width: 8px;
      height: 8px;
      pointer-events: none;
      opacity: 0.25;
      transition: opacity 0.3s ease, border-color 0.3s ease;
    }
    .hud-corner-tl {
      top: 10px;
      left: 10px;
      border-top: 1.5px solid rgba(255, 255, 255, 0.4);
      border-left: 1.5px solid rgba(255, 255, 255, 0.4);
    }
    .hud-corner-br {
      bottom: 10px;
      right: 10px;
      border-bottom: 1.5px solid rgba(255, 255, 255, 0.4);
      border-right: 1.5px solid rgba(255, 255, 255, 0.4);
    }
    .immersive-card:hover .hud-corner-tl,
    .immersive-card:hover .hud-corner-br {
      opacity: 0.8;
      border-color: #8b5cf6;
    }

    /* MZ Media Button Styling */
    .mz-btn {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.875rem 1.85rem;
      border-radius: 9999px;
      font-weight: 700;
      font-size: 0.875rem;
      letter-spacing: 0.025em;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mz-btn-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 1.85rem;
      height: 1.85rem;
      border-radius: 9999px;
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .mz-btn:hover .mz-btn-icon {
      transform: translate(3px, -3px) scale(1.08);
    }

    .fade-in-up {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .fade-in-up.is-visible {
      opacity: 1;
      transform: translateY(0);
    }
    /* Global Three.js 3D Objects Canvas (Pure Black Background & Soft Ambient Opacity) */
    #global-three-canvas {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 0;
      opacity: 0.38;
      transition: opacity 0.5s ease;
    }
  </style>
</head>

<body class="relative bg-black text-slate-100 antialiased selection:bg-indigo-600 selection:text-white">

  <!-- Fullscreen Interactive 3D Objects Canvas -->
  <canvas id="global-three-canvas"></canvas>

  <!-- Header / Navbar Component -->
  <?php include('components/navbar.php'); ?>

  <!-- Main Hero Section -->
  <main class="relative z-10">
    <section id="heroSection" class="relative min-h-[95vh] flex flex-col items-center justify-center pt-36 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
      
      <div class="max-w-5xl mx-auto text-center relative z-10">
        
        <!-- Trust Pills Row -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 mb-8 fade-in-up">
          
          <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-[#10101a]/80 border border-white/15 backdrop-blur-xl shadow-lg hover:border-violet-500/50 transition-colors">
            <div class="flex -space-x-2">
              <img src="CL1.jpg" alt="Client 1" class="w-6 h-6 rounded-full border-2 border-white/40 object-cover" />
              <img src="CL2.jpg" alt="Client 2" class="w-6 h-6 rounded-full border-2 border-white/40 object-cover" />
              <img src="CL3.jpg" alt="Client 3" class="w-6 h-6 rounded-full border-2 border-white/40 object-cover" />
              <img src="CL4.jpg" alt="Client 4" class="w-6 h-6 rounded-full border-2 border-white/40 object-cover" />
            </div>
            <span class="text-xs sm:text-sm font-semibold text-gray-200">Trusted by <span class="text-white font-extrabold">500+ Businesses</span></span>
          </div>

          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#10101a]/80 border border-white/15 backdrop-blur-xl shadow-lg hover:border-violet-500/50 transition-colors">
            <span class="text-amber-400 text-xs sm:text-sm font-bold">★★★★★</span>
            <span class="text-xs sm:text-sm font-semibold text-gray-200"><span class="text-white font-extrabold">4.9</span> (50+ Reviews)</span>
          </div>

          <div class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#10101a]/80 border border-white/15 backdrop-blur-xl shadow-lg hover:border-violet-500/50 transition-colors">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-xs sm:text-sm font-semibold text-gray-200">24–48h First Cuts</span>
          </div>

        </div>

        <!-- Hero Headline -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.08] mb-6 fade-in-up font-display">
          Content that <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-violet-400">Performs.</span><br />
          Systems that <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 via-purple-300 to-fuchsia-400">Scale.</span>
        </h1>

        <!-- Subheadline -->
        <p class="text-base sm:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed mb-10 fade-in-up font-normal">
          No more boring content. No more wasted ad spend. We create high-retention video content, viral shorts, VSLs, and 3D motion assets engineered to convert viewers into high-ticket clients.
        </p>

        <!-- CTA Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 mb-16 fade-in-up">
          
          <!-- Primary CTA -->
          <a href="https://calendly.com/nextlevelmediacall/30min?month=2025-07" target="_blank" class="mz-btn bg-white text-black shadow-[0_0_40px_rgba(255,255,255,0.3)] hover:shadow-[0_0_45px_rgba(99,102,241,0.6)] hover:bg-gray-100 w-full sm:w-auto justify-center">
            <span>Book A Discovery Call</span>
            <div class="mz-btn-icon bg-black text-white">
              <svg class="w-3.5 h-3.5 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </div>
          </a>

          <!-- Secondary CTA -->
          <a href="#projects" class="mz-btn bg-[#13131e]/90 text-gray-200 border border-white/15 hover:border-white/40 hover:text-white hover:bg-[#1a1a28] w-full sm:w-auto justify-center backdrop-blur-xl">
            <span>Explore Portfolio</span>
            <div class="mz-btn-icon bg-white/10 text-gray-300">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
          </a>

        </div>

        <!-- Featured Showreel Video Card -->
        <div class="relative w-full max-w-4xl mx-auto rounded-3xl overflow-hidden bg-[#0c0c14] border-2 border-white/20 shadow-[0_25px_80px_rgba(0,0,0,0.85)] group fade-in-up hover:border-violet-500/60 transition-all duration-500" id="heroVideoContainer">
          
          <div class="relative aspect-video w-full cursor-pointer" id="heroVideoTrigger">
            <img src="https://img.youtube.com/vi/X0SIgFWWb1o/maxresdefault.jpg" alt="Next Level Media Showreel" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" id="heroThumbnail" />
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>

            <!-- Custom Play Button -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
              <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-white/95 text-black flex items-center justify-center shadow-[0_0_50px_rgba(255,255,255,0.45)] group-hover:scale-110 group-hover:bg-white transition-all duration-300">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 ml-1.5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z"/>
                </svg>
              </div>
            </div>

            <!-- Bottom Video Badge -->
            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between pointer-events-none">
              <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-black/70 border border-white/25 text-white text-xs font-semibold backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                <span><?= htmlspecialchars($hero_badge_text); ?></span>
              </div>
              <div class="text-xs text-gray-300 font-medium hidden sm:block">
                Click to play with sound
              </div>
            </div>

          </div>

          <!-- Video Embed Slot -->
          <div id="heroEmbedSlot" class="hidden aspect-video w-full bg-black"></div>
        </div>

        <!-- Trusted Client Logos Marquee -->
        <div class="mt-16 pt-8 border-t border-white/10 overflow-hidden fade-in-up">
          <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">Trusted by High-Performing Creators & Brands</p>
          
          <div class="relative w-full overflow-hidden">
            <div class="flex gap-12 items-center animate-marquee-fast w-max opacity-70 hover:opacity-100 transition-opacity">
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span> CLICKUP
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-violet-500 shadow-[0_0_10px_#8b5cf6]"></span> LUMANA
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-purple-500 shadow-[0_0_10px_#a855f7]"></span> ATRIA MEDIA
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-pink-500 shadow-[0_0_10px_#ec4899]"></span> PHONELY AI
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-indigo-500 shadow-[0_0_10px_#6366f1]"></span> HELONIC
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></span> REACHLY
              </div>
              
              <!-- Repeat for infinite marquee loop -->
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span> CLICKUP
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-violet-500 shadow-[0_0_10px_#8b5cf6]"></span> LUMANA
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-purple-500 shadow-[0_0_10px_#a855f7]"></span> ATRIA MEDIA
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-pink-500 shadow-[0_0_10px_#ec4899]"></span> PHONELY AI
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-indigo-500 shadow-[0_0_10px_#6366f1]"></span> HELONIC
              </div>
              <div class="flex items-center gap-2 font-bold text-gray-200 text-lg tracking-wider">
                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></span> REACHLY
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

  <!-- Modular Sections -->
  <div class="relative z-10 space-y-4">
    <?php include('components/second-intro.php'); ?>
    <?php include('components/clients-testimonials.php'); ?>
    <?php include('components/projects.php'); ?>
    <?php include('components/why-us.php'); ?>
    <?php include('components/strategy.php'); ?>
    <?php include('components/core-services.php'); ?>
    <?php include('components/feedback.php'); ?>
    <?php include('components/accordion.php'); ?>
    <?php include('components/footer.php'); ?>
  </div>

  <!-- Scripts -->
  <script>
    // --------------------------------------------------------------------------
    // High-Performance Scroll-Driven WebGL 3D Section-Morphing Engine
    // (Bruno Simon / Award-Winning WebGL Interactive Experience on Pure Black)
    // --------------------------------------------------------------------------
    (function initScrollDrivenThreeEngine() {
      const canvas = document.getElementById('global-three-canvas');
      if (!canvas || typeof THREE === 'undefined') return;

      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
      camera.position.z = 28;

      const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        alpha: true,
        antialias: true,
        powerPreference: "high-performance"
      });
      renderer.setClearColor(0x000000, 0); // 100% pure transparent on pure obsidian black
      renderer.setSize(window.innerWidth, window.innerHeight);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      // Global Root Group
      const worldGroup = new THREE.Group();
      scene.add(worldGroup);

      // ========================================================================
      // AMBIENT COSMIC STARDUST (Soft 3D Depth Across Pure Black Canvas)
      // ========================================================================
      const dustCount = 140;
      const dustGeo = new THREE.BufferGeometry();
      const dustPos = new Float32Array(dustCount * 3);
      const dustVels = [];
      for (let i = 0; i < dustCount; i++) {
        dustPos[i * 3] = (Math.random() - 0.5) * 60;
        dustPos[i * 3 + 1] = (Math.random() - 0.5) * 60;
        dustPos[i * 3 + 2] = (Math.random() - 0.5) * 30;
        dustVels.push({
          x: (Math.random() - 0.5) * 0.015,
          y: (Math.random() - 0.5) * 0.015,
          z: (Math.random() - 0.5) * 0.01
        });
      }
      dustGeo.setAttribute('position', new THREE.BufferAttribute(dustPos, 3));
      const dustMat = new THREE.PointsMaterial({
        color: 0xc4b5fd,
        size: 0.35,
        transparent: true,
        opacity: 0.4,
        blending: THREE.AdditiveBlending
      });
      const dustSystem = new THREE.Points(dustGeo, dustMat);
      worldGroup.add(dustSystem);

      // ========================================================================
      // SCENE 1: HERO (Camera Viewfinders, Lens Reticles & Glowing Play Crystals)
      // ========================================================================
      const heroGroup = new THREE.Group();
      worldGroup.add(heroGroup);

      function createViewfinder(size = 4.5, color = 0x8b5cf6) {
        const grp = new THREE.Group();
        const pts = [];
        const h = size / 2, b = size * 0.25;
        pts.push(new THREE.Vector3(-h, h - b, 0), new THREE.Vector3(-h, h, 0), new THREE.Vector3(-h, h, 0), new THREE.Vector3(-h + b, h, 0));
        pts.push(new THREE.Vector3(h - b, h, 0), new THREE.Vector3(h, h, 0), new THREE.Vector3(h, h, 0), new THREE.Vector3(h, h - b, 0));
        pts.push(new THREE.Vector3(-h, -h + b, 0), new THREE.Vector3(-h, -h, 0), new THREE.Vector3(-h, -h, 0), new THREE.Vector3(-h + b, -h, 0));
        pts.push(new THREE.Vector3(h - b, -h, 0), new THREE.Vector3(h, -h, 0), new THREE.Vector3(h, -h, 0), new THREE.Vector3(h, -h + b, 0));
        const c = size * 0.1;
        pts.push(new THREE.Vector3(-c, 0, 0), new THREE.Vector3(c, 0, 0), new THREE.Vector3(0, -c, 0), new THREE.Vector3(0, c, 0));
        
        const geo = new THREE.BufferGeometry().setFromPoints(pts);
        const mat = new THREE.LineBasicMaterial({ color: color, transparent: true, opacity: 0.65 });
        grp.add(new THREE.LineSegments(geo, mat));

        const rGeo = new THREE.RingGeometry(size * 0.35, size * 0.37, 32);
        const rMat = new THREE.MeshBasicMaterial({ color: color, side: THREE.DoubleSide, transparent: true, opacity: 0.45 });
        grp.add(new THREE.Mesh(rGeo, rMat));
        return { group: grp, mat: mat, rMat: rMat };
      }

      const vf1 = createViewfinder(5.0, 0x8b5cf6);
      vf1.group.position.set(13, 4, -2);
      heroGroup.add(vf1.group);

      const vf2 = createViewfinder(4.0, 0xa78bfa);
      vf2.group.position.set(-13, 3, -4);
      heroGroup.add(vf2.group);

      const triShape = new THREE.Shape();
      triShape.moveTo(-1.2, -1.5);
      triShape.lineTo(1.8, 0);
      triShape.lineTo(-1.2, 1.5);
      triShape.closePath();
      const playGeo = new THREE.ExtrudeGeometry(triShape, { depth: 0.5, bevelEnabled: true, bevelSegments: 2, steps: 1, bevelSize: 0.1 });
      const playMat = new THREE.MeshBasicMaterial({ color: 0xc4b5fd, wireframe: true, transparent: true, opacity: 0.6 });
      const heroPlayMesh = new THREE.Mesh(playGeo, playMat);
      heroPlayMesh.position.set(11, -6, -3);
      heroGroup.add(heroPlayMesh);

      // ========================================================================
      // SCENE 2: ABOUT / INTRO (3D Curving Film Strips with Timecodes)
      // ========================================================================
      const introGroup = new THREE.Group();
      worldGroup.add(introGroup);

      function createFilmTex() {
        const c = document.createElement('canvas');
        c.width = 512;
        c.height = 128;
        const ctx = c.getContext('2d');
        ctx.fillStyle = '#0a0a0f';
        ctx.fillRect(0, 0, 512, 128);
        ctx.strokeStyle = 'rgba(139, 92, 246, 0.9)';
        ctx.lineWidth = 2;
        ctx.strokeRect(0, 0, 512, 128);
        ctx.fillStyle = 'rgba(255, 255, 255, 0.95)';
        for (let x = 8; x < 512; x += 24) {
          ctx.fillRect(x, 6, 12, 12);
          ctx.fillRect(x, 110, 12, 12);
        }
        for (let f = 0; f < 4; f++) {
          const fx = f * 128 + 8;
          ctx.strokeStyle = 'rgba(167, 139, 250, 0.8)';
          ctx.strokeRect(fx, 24, 112, 80);
          ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
          ctx.font = 'bold 10px monospace';
          ctx.fillText(`00:0${f}:24:00`, fx + 10, 40);
        }
        const tex = new THREE.CanvasTexture(c);
        tex.wrapS = THREE.RepeatWrapping;
        tex.wrapT = THREE.RepeatWrapping;
        tex.repeat.set(4, 1);
        return tex;
      }

      const filmTex = createFilmTex();
      const filmMat = new THREE.MeshBasicMaterial({ map: filmTex, side: THREE.DoubleSide, transparent: true, opacity: 0.65, blending: THREE.AdditiveBlending });
      
      class FilmCurve extends THREE.Curve {
        getPoint(t) {
          const a = t * Math.PI * 2.8;
          return new THREE.Vector3(Math.sin(a) * 16, (t - 0.5) * 32, Math.cos(a) * 10);
        }
      }
      const filmGeo = new THREE.TubeGeometry(new FilmCurve(), 80, 2.2, 4, false);
      const filmMesh = new THREE.Mesh(filmGeo, filmMat);
      filmMesh.position.set(0, 0, -4);
      introGroup.add(filmMesh);

      // ========================================================================
      // SCENE 3: REVIEWS / TESTIMONIALS (3D Holographic Stars & Orbital Rings)
      // ========================================================================
      const reviewsGroup = new THREE.Group();
      worldGroup.add(reviewsGroup);

      function createStarMesh(size = 1.3) {
        const starShape = new THREE.Shape();
        const points = 5;
        const outerRadius = size;
        const innerRadius = size * 0.45;
        for (let i = 0; i < points * 2; i++) {
          const r = i % 2 === 0 ? outerRadius : innerRadius;
          const angle = (i * Math.PI) / points - Math.PI / 2;
          const x = Math.cos(angle) * r;
          const y = Math.sin(angle) * r;
          if (i === 0) starShape.moveTo(x, y);
          else starShape.lineTo(x, y);
        }
        starShape.closePath();
        const geo = new THREE.ExtrudeGeometry(starShape, { depth: 0.35, bevelEnabled: true, bevelSegments: 2, steps: 1, bevelSize: 0.08 });
        const mat = new THREE.MeshBasicMaterial({ color: 0xf59e0b, wireframe: true, transparent: true, opacity: 0.7 });
        return new THREE.Mesh(geo, mat);
      }

      const reviewStars = [];
      for (let s = 0; s < 5; s++) {
        const sm = createStarMesh(1.4);
        sm.position.set((s - 2) * 4.2, Math.sin(s * 0.8) * 1.5, -3);
        reviewsGroup.add(sm);
        reviewStars.push(sm);
      }

      const starRingGeo = new THREE.TorusGeometry(12, 0.06, 16, 80);
      const starRingMat = new THREE.MeshBasicMaterial({ color: 0xf59e0b, transparent: true, opacity: 0.4, wireframe: true });
      const starRing = new THREE.Mesh(starRingGeo, starRingMat);
      starRing.rotation.x = Math.PI / 3;
      reviewsGroup.add(starRing);

      // ========================================================================
      // SCENE 4: PROJECTS / PORTFOLIO (3D Floating Aspect-Ratio Display Frames)
      // ========================================================================
      const projectsGroup = new THREE.Group();
      worldGroup.add(projectsGroup);

      const frameGeo = new THREE.PlaneGeometry(7, 4);
      const frameMat = new THREE.MeshBasicMaterial({ color: 0x8b5cf6, wireframe: true, transparent: true, opacity: 0.5 });
      const pFrames = [];
      const framePositions = [
        { x: -12, y: 3, z: -6, rotY: 0.25 },
        { x: 12, y: -2, z: -5, rotY: -0.25 },
        { x: -10, y: -5, z: -7, rotY: 0.3 },
        { x: 11, y: 5, z: -6, rotY: -0.2 }
      ];

      framePositions.forEach(pos => {
        const fMesh = new THREE.Mesh(frameGeo, frameMat);
        fMesh.position.set(pos.x, pos.y, pos.z);
        fMesh.rotation.y = pos.rotY;
        projectsGroup.add(fMesh);
        pFrames.push(fMesh);
      });

      // ========================================================================
      // SCENE 5: WHY US (3D Kinetic Cyber Hexagonal Shield & Polyhedra)
      // ========================================================================
      const whyUsGroup = new THREE.Group();
      worldGroup.add(whyUsGroup);

      const shieldGrp = new THREE.Group();
      for (let r = 2; r <= 7; r += 1.8) {
        const ringGeo = new THREE.RingGeometry(r - 0.05, r, 6);
        const ringMat = new THREE.MeshBasicMaterial({ color: 0xa78bfa, side: THREE.DoubleSide, transparent: true, opacity: 0.5 });
        shieldGrp.add(new THREE.Mesh(ringGeo, ringMat));
      }
      shieldGrp.position.set(-11, 1, -4);
      whyUsGroup.add(shieldGrp);

      const cubeGeo = new THREE.BoxGeometry(2.2, 2.2, 2.2);
      const cubeMat = new THREE.MeshBasicMaterial({ color: 0x8b5cf6, wireframe: true, transparent: true, opacity: 0.55 });
      const whyCube = new THREE.Mesh(cubeGeo, cubeMat);
      whyCube.position.set(12, 2, -3);
      whyUsGroup.add(whyCube);

      // ========================================================================
      // SCENE 6: STRATEGY (3D Ascending Stairway Track & Waveform Equalizer)
      // ========================================================================
      const strategyGroup = new THREE.Group();
      worldGroup.add(strategyGroup);

      const waveBarCount = 28;
      const waveBars = [];
      const barGeo = new THREE.BoxGeometry(0.35, 1, 0.35);

      for (let i = 0; i < waveBarCount; i++) {
        const bMat = new THREE.MeshBasicMaterial({ color: i % 2 === 0 ? 0x8b5cf6 : 0xa78bfa, transparent: true, opacity: 0.55 });
        const bMesh = new THREE.Mesh(barGeo, bMat);
        bMesh.position.x = (i - waveBarCount / 2) * 0.9;
        bMesh.position.y = -4;
        bMesh.position.z = -3;
        strategyGroup.add(bMesh);
        waveBars.push({ mesh: bMesh, speed: 2 + (i % 4) * 0.8, offset: i * 0.25 });
      }

      const nodePts = [
        new THREE.Vector3(-11, -5, -3),
        new THREE.Vector3(-4, -1, -2),
        new THREE.Vector3(4, 3, -2),
        new THREE.Vector3(11, 7, -3)
      ];
      const curve = new THREE.CatmullRomCurve3(nodePts);
      const tubeGeo = new THREE.TubeGeometry(curve, 48, 0.1, 8, false);
      const tubeMat = new THREE.MeshBasicMaterial({ color: 0x8b5cf6, transparent: true, opacity: 0.65 });
      strategyGroup.add(new THREE.Mesh(tubeGeo, tubeMat));

      nodePts.forEach((pt, idx) => {
        const sGeo = new THREE.SphereGeometry(0.6, 16, 16);
        const sMat = new THREE.MeshBasicMaterial({ color: idx === 3 ? 0x10b981 : 0xa78bfa, wireframe: true });
        const sMesh = new THREE.Mesh(sGeo, sMat);
        sMesh.position.copy(pt);
        strategyGroup.add(sMesh);
      });

      // ========================================================================
      // SCENE 7: SERVICES (3D Floating Multi-Layer Prisms & Orbiting Dodecahedrons)
      // ========================================================================
      const servicesGroup = new THREE.Group();
      worldGroup.add(servicesGroup);

      const dodecGeo = new THREE.DodecahedronGeometry(3.2, 0);
      const dodecMat = new THREE.MeshBasicMaterial({ color: 0x8b5cf6, wireframe: true, transparent: true, opacity: 0.55 });
      const dodecMesh = new THREE.Mesh(dodecGeo, dodecMat);
      dodecMesh.position.set(12, 0, -3);
      servicesGroup.add(dodecMesh);

      const octaGeo = new THREE.OctahedronGeometry(2.6, 0);
      const octaMat = new THREE.MeshBasicMaterial({ color: 0xa78bfa, wireframe: true, transparent: true, opacity: 0.5 });
      const octaMesh = new THREE.Mesh(octaGeo, octaMat);
      octaMesh.position.set(-12, -2, -4);
      servicesGroup.add(octaMesh);

      // ========================================================================
      // SCENE 8: FAQ & CLOSING (3D Holographic Question Pulse Rings)
      // ========================================================================
      const faqGroup = new THREE.Group();
      worldGroup.add(faqGroup);

      const faqTorusGeo = new THREE.TorusGeometry(4.0, 0.07, 16, 80);
      const faqTorusMat = new THREE.MeshBasicMaterial({ color: 0x8b5cf6, transparent: true, opacity: 0.5 });
      const faqTorus1 = new THREE.Mesh(faqTorusGeo, faqTorusMat);
      faqTorus1.position.set(-12, 0, -3);
      faqGroup.add(faqTorus1);

      const faqTorus2 = new THREE.Mesh(faqTorusGeo, faqTorusMat);
      faqTorus2.position.set(12, 0, -3);
      faqGroup.add(faqTorus2);

      // ========================================================================
      // SECTION REGISTRATION & DYNAMIC SMOOTH MORPH CONTROLLER
      // ========================================================================
      const sections = [
        { id: 'heroSection', group: heroGroup },
        { id: 'about', group: introGroup },
        { id: 'clients-testimonials', group: reviewsGroup },
        { id: 'projects', group: projectsGroup },
        { id: 'why-us', group: whyUsGroup },
        { id: 'strategy', group: strategyGroup },
        { id: 'core-services', group: servicesGroup },
        { id: 'faq', group: faqGroup }
      ];

      // Smooth Mouse Parallax Tracking
      let mouseX = 0, mouseY = 0;
      let targetMouseX = 0, targetMouseY = 0;
      window.addEventListener('mousemove', (e) => {
        targetMouseX = (e.clientX / window.innerWidth - 0.5) * 2;
        targetMouseY = -(e.clientY / window.innerHeight - 0.5) * 2;
      }, { passive: true });

      // Window Resize Listener
      window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      }, { passive: true });

      // Dynamic Section Proximity Calculator (Bruno Mars Style Scroll Bell-Curve)
      function computeProximity(elem) {
        if (!elem) return 0;
        const rect = elem.getBoundingClientRect();
        const vh = window.innerHeight;
        const centerOffset = (rect.top + rect.height / 2) - (vh / 2);
        const maxRange = (rect.height + vh) / 2;
        const normalized = 1 - Math.min(Math.abs(centerOffset) / maxRange, 1);
        // Smooth sine power curve for seamless morphing
        return Math.pow(Math.sin(normalized * Math.PI / 2), 2);
      }

      // 60FPS Continuous Animation & Morphing Render Loop
      const clock = new THREE.Clock();
      function animateThreeScenes() {
        requestAnimationFrame(animateThreeScenes);
        const elapsed = clock.getElapsedTime();

        // Smooth mouse damping
        mouseX += (targetMouseX - mouseX) * 0.05;
        mouseY += (targetMouseY - mouseY) * 0.05;

        // Ambient Stardust Motion
        const dPos = dustGeo.attributes.position;
        for (let i = 0; i < dustCount; i++) {
          const i3 = i * 3;
          dPos.array[i3] += dustVels[i].x;
          dPos.array[i3 + 1] += dustVels[i].y;
          dPos.array[i3 + 2] += dustVels[i].z;
          if (Math.abs(dPos.array[i3]) > 30) dustVels[i].x *= -1;
          if (Math.abs(dPos.array[i3 + 1]) > 30) dustVels[i].y *= -1;
        }
        dPos.needsUpdate = true;

        // Animate Individual Scene Meshes in Real-Time
        heroPlayMesh.rotation.y = elapsed * 0.8;
        heroPlayMesh.rotation.z = Math.sin(elapsed * 0.5) * 0.2;
        vf1.group.rotation.z = elapsed * 0.15;
        vf2.group.rotation.z = -elapsed * 0.2;

        filmMesh.rotation.y = elapsed * 0.25;
        filmMesh.position.y = Math.sin(elapsed * 0.6) * 1.2;
        filmTex.offset.x = (elapsed * 0.04) % 1;

        reviewStars.forEach((star, i) => {
          star.rotation.y = elapsed * 0.6 + i * 0.3;
          star.position.y = Math.sin(elapsed * 0.8 + i) * 0.8;
        });
        starRing.rotation.z = elapsed * 0.12;

        pFrames.forEach((frame, i) => {
          frame.rotation.z = Math.sin(elapsed * 0.4 + i) * 0.08;
          frame.position.y = framePositions[i].y + Math.sin(elapsed * 0.6 + i) * 0.5;
        });

        shieldGrp.rotation.z = elapsed * 0.2;
        whyCube.rotation.x = elapsed * 0.4;
        whyCube.rotation.y = elapsed * 0.5;

        waveBars.forEach(item => {
          const h = Math.abs(Math.sin(elapsed * item.speed + item.offset)) * 3.2 + 0.4;
          item.mesh.scale.y = h;
          item.mesh.position.y = h / 2 - 4;
        });
        strategyGroup.rotation.y = Math.sin(elapsed * 0.3) * 0.15;

        dodecMesh.rotation.x = elapsed * 0.3;
        dodecMesh.rotation.y = elapsed * 0.4;
        octaMesh.rotation.x = -elapsed * 0.35;
        octaMesh.rotation.y = elapsedTime = elapsed * 0.45;

        faqTorus1.rotation.x = elapsed * 0.3;
        faqTorus1.rotation.y = elapsed * 0.4;
        faqTorus2.rotation.x = -elapsed * 0.3;
        faqTorus2.rotation.y = -elapsed * 0.4;

        // Dynamic Section-by-Section Morphing
        sections.forEach(({ id, group }) => {
          const elem = document.getElementById(id);
          const progress = computeProximity(elem);

          if (progress > 0.02) {
            group.visible = true;
            // Smoothly scale in and slide into view
            const targetScale = 0.35 + progress * 0.65;
            group.scale.lerp(new THREE.Vector3(targetScale, targetScale, targetScale), 0.1);
            
            // Vertical floating drift transition
            const targetY = (1 - progress) * 8;
            group.position.y = THREE.MathUtils.lerp(group.position.y, targetY, 0.1);
          } else {
            group.visible = false;
          }
        });

        // Interactive World Parallax Tilt
        worldGroup.rotation.y = mouseX * 0.04;
        worldGroup.rotation.x = -mouseY * 0.03;

        renderer.render(scene, camera);
      }
      animateThreeScenes();
    })();

    // --------------------------------------------------------------------------
    // Lenis Butter-Smooth Inertia Scrolling Engine
    // --------------------------------------------------------------------------
    let lenis;
    if (typeof Lenis !== 'undefined') {
      lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        smoothTouch: false,
        touchMultiplier: 1.8,
      });

      function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
      }
      requestAnimationFrame(raf);
    }

    // --------------------------------------------------------------------------
    // Hero Video Card Scroll-Driven 3D Zoom / Enlarge Animation
    // As the user scrolls down, the Showreel video card smoothly expands & illuminates!
    // --------------------------------------------------------------------------
    (function initHeroVideoScrollZoom() {
      const container = document.getElementById('heroVideoContainer');
      if (!container) return;

      function updateHeroZoom() {
        const scrollY = window.scrollY || window.pageYOffset;
        // Progress from 0 (at top) to 1 (scrolled 450px)
        const progress = Math.min(Math.max(scrollY / 450, 0), 1);
        
        // Scale from 0.88 -> 1.05 and float up
        const scale = 0.88 + progress * 0.17;
        const translateY = (1 - progress) * 20;

        container.style.transform = `perspective(1200px) scale(${scale}) translateY(${translateY}px)`;

        if (progress > 0.3) {
          const glowAlpha = (0.25 + progress * 0.35).toFixed(2);
          container.style.borderColor = 'rgba(139, 92, 246, 0.75)';
          container.style.boxShadow = `0 30px 100px rgba(139, 92, 246, ${glowAlpha}), 0 0 45px rgba(99, 102, 241, 0.35)`;
        } else {
          container.style.borderColor = 'rgba(255, 255, 255, 0.2)';
          container.style.boxShadow = '0 25px 80px rgba(0, 0, 0, 0.85)';
        }
      }

      window.addEventListener('scroll', updateHeroZoom, { passive: true });
      if (lenis) lenis.on('scroll', updateHeroZoom);
      updateHeroZoom();
    })();

    // --------------------------------------------------------------------------
    // Ultra-Modern 3D Card Tilt & Mouse Spotlight Engine
    // --------------------------------------------------------------------------
    (function initCardTiltSpotlight() {
      const cards = document.querySelectorAll('.immersive-card');

      cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;

          card.style.setProperty('--mouse-x', `${x}px`);
          card.style.setProperty('--mouse-y', `${y}px`);

          const centerX = rect.width / 2;
          const centerY = rect.height / 2;
          const rotateX = ((y - centerY) / centerY) * -7;
          const rotateY = ((x - centerX) / centerX) * 7;

          card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });

        card.addEventListener('mouseleave', () => {
          card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
      });
    })();

    // --------------------------------------------------------------------------
    // Hero Video Embed Replacement
    // --------------------------------------------------------------------------
    (function setupHeroVideo() {
      const trigger = document.getElementById('heroVideoTrigger');
      const slot = document.getElementById('heroEmbedSlot');
      const heroUrl = <?= json_encode($hero_video_url); ?>;
      if (trigger && slot) {
        trigger.addEventListener('click', () => {
          let embedSrc = heroUrl;
          if (embedSrc.indexOf('autoplay=1') === -1) {
            embedSrc += (embedSrc.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1&rel=0&modestbranding=1';
          }
          slot.innerHTML = `
            <iframe class="w-full h-full"
              src="${embedSrc}"
              title="Next Level Media Showreel"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          `;
          trigger.classList.add('hidden');
          slot.classList.remove('hidden');
        });
      }
    })();

    // --------------------------------------------------------------------------
    // Scroll Reveal & Metric Counter Animations
    // --------------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', () => {
      const revealElements = document.querySelectorAll('.fade-in-up');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.08 });
      revealElements.forEach(el => observer.observe(el));

      const counters = document.querySelectorAll('.count-up');
      function animateCountUp(el, target, duration = 1600) {
        let start = 0;
        let startTime = null;
        target = +target;
        function step(timestamp) {
          if (!startTime) startTime = timestamp;
          const progress = Math.min((timestamp - startTime) / duration, 1);
          const easeProgress = 1 - Math.pow(1 - progress, 3);
          const current = Math.floor(easeProgress * (target - start) + start);
          el.textContent = current;
          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            el.textContent = target;
          }
        }
        requestAnimationFrame(step);
      }

      const counterObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const el = entry.target;
            animateCountUp(el, el.getAttribute('data-target'));
            obs.unobserve(el);
          }
        });
      }, { threshold: 0.4 });
      counters.forEach(c => counterObserver.observe(c));
    });
  </script>

</body>
</html>
