<?php
require_once('config/db.php');
require_once('components/tracker.php');

$meta_title = get_setting('meta_title', 'Next Level Media | High-Performance Video Production & Creative Systems');
$meta_desc = get_setting('meta_description', 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.');
$meta_keys = get_setting('meta_keywords', 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation');
$og_image = get_setting('og_image', 'main-logo.png');
$hero_video_url = get_setting('hero_video_url', 'https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0');
$hero_badge_text = get_setting('hero_badge_text', 'Agency Showreel');
$booking_calendly_url = get_setting('booking_calendly_url', 'https://calendly.com/nextlevelmediacall/30min?month=2025-07');
?>
<!DOCTYPE html>
<html lang="en" class="overflow-x-clip w-full max-w-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <title><?= htmlspecialchars($meta_title); ?></title>
  
  <meta name="description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($meta_keys); ?>" />
  <meta name="author" content="Sahariar Supto" />
  <meta name="developer" content="Sahariar Supto" />
  <meta name="designer" content="Sahariar Supto" />
  <meta name="publisher" content="Next Level Media" />
  <meta name="theme-color" content="#000000" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="apple-mobile-web-app-title" content="Next Level Media" />
  <meta name="application-name" content="Next Level Media" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  <link rel="canonical" href="https://nextlevelmediadigital.com/" />

  <!-- Open Graph / Facebook Social Sharing -->
  <meta property="og:site_name" content="Next Level Media" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:url" content="https://nextlevelmediadigital.com/" />
  <meta property="og:title" content="<?= htmlspecialchars($meta_title); ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta property="og:image" content="https://nextlevelmediadigital.com/main-logo.png" />
  <meta property="og:image:secure_url" content="https://nextlevelmediadigital.com/main-logo.png" />
  <meta property="og:image:type" content="image/png" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:image:alt" content="Next Level Media - High-Performance Video Production" />

  <!-- Twitter / X Cards Social Sharing -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:url" content="https://nextlevelmediadigital.com/" />
  <meta name="twitter:title" content="<?= htmlspecialchars($meta_title); ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($meta_desc); ?>" />
  <meta name="twitter:image" content="https://nextlevelmediadigital.com/main-logo.png" />
  <meta name="twitter:image:alt" content="Next Level Media Logo" />
  <meta name="twitter:creator" content="@SahariarSupto" />

  <!-- Favicons & App Icons -->
  <link rel="icon" type="image/png" href="main-logo.png" />
  <link rel="shortcut icon" type="image/png" href="main-logo.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="main-logo.png" />

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
              primary: '#535eee',
              purple: '#535eee',
              indigo: '#4650d4',
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

  <!-- Lenis Butter-Smooth Scrolling Engine -->
  <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

  <!-- Structured Schema Data (JSON-LD) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": "https://nextlevelmediadigital.com/#organization",
        "name": "Next Level Media",
        "url": "https://nextlevelmediadigital.com/",
        "logo": {
          "@type": "ImageObject",
          "url": "https://nextlevelmediadigital.com/main-logo.png",
          "caption": "Next Level Media Logo"
        },
        "description": "High-Performance Video Production & Creative Systems",
        "founder": {
          "@type": "Person",
          "name": "Sahariar Supto"
        },
        "developer": {
          "@type": "Person",
          "name": "Sahariar Supto"
        }
      },
      {
        "@type": "WebSite",
        "@id": "https://nextlevelmediadigital.com/#website",
        "url": "https://nextlevelmediadigital.com/",
        "name": "Next Level Media",
        "publisher": {
          "@id": "https://nextlevelmediadigital.com/#organization"
        }
      }
    ]
  }
  </script>

  <style>
    html {
      scroll-behavior: auto !important;
    }

    html, body {
      max-width: 100% !important;
      overflow-x: clip !important;
      position: relative;
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
      pointer-events: none !important;
    }

    /* Noise Texture Overlay */
    .bg-noise {
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.035'/%3E%3C/svg%3E");
    }

    /* Cyber Grid lines */
    .bg-cyber-grid {
      background-size: 50px 50px;
      background-image: 
        linear-gradient(to right, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
    }

    /* Immersive 3D Spotlight Cards */
    .immersive-card {
      position: relative;
      background: rgba(8, 8, 12, 0.85);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 0px !important;
      overflow: hidden;
      transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.2s ease-out;
      transform-style: preserve-3d;
      box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.95);
    }

    .immersive-card::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: inherit;
      background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 255, 255, 0.12), transparent 75%);
      opacity: 0;
      transition: opacity 0.4s ease;
      pointer-events: none;
      z-index: 1;
    }

    .immersive-card:hover::before {
      opacity: 1;
    }

    .immersive-card:hover {
      border-color: rgba(255, 255, 255, 0.9) !important;
      box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.98), 0 0 35px rgba(255, 255, 255, 0.3), 0 0 60px rgba(255, 255, 255, 0.12);
    }

    /* Corner HUD Cyber Bracket Accents */
    .hud-corner-tl, .hud-corner-br {
      position: absolute;
      width: 8px;
      height: 8px;
      pointer-events: none;
      opacity: 0.35;
      transition: opacity 0.3s ease, border-color 0.3s ease, filter 0.3s ease;
    }
    .hud-corner-tl {
      top: 10px;
      left: 10px;
      border-top: 1.5px solid rgba(255, 255, 255, 0.6);
      border-left: 1.5px solid rgba(255, 255, 255, 0.6);
    }
    .hud-corner-br {
      bottom: 10px;
      right: 10px;
      border-bottom: 1.5px solid rgba(255, 255, 255, 0.6);
      border-right: 1.5px solid rgba(255, 255, 255, 0.6);
    }
    .immersive-card:hover .hud-corner-tl,
    .immersive-card:hover .hud-corner-br {
      opacity: 1;
      border-color: #ffffff;
      filter: drop-shadow(0 0 6px rgba(255, 255, 255, 0.8));
    }

    /* Button Styling - Square Borders with White Hover Animations */
    .mz-btn {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.875rem 1.85rem;
      border-radius: 0px !important;
      font-weight: 700;
      font-size: 0.875rem;
      letter-spacing: 0.025em;
      transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mz-btn:hover {
      border-color: #ffffff !important;
      box-shadow: 0 0 35px rgba(255, 255, 255, 0.5), 0 0 65px rgba(255, 255, 255, 0.25) !important;
      transform: translateY(-2px);
    }

    .mz-btn-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 1.85rem;
      height: 1.85rem;
      border-radius: 0px !important;
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .mz-btn:hover .mz-btn-icon {
      transform: translate(3px, -3px) scale(1.08);
    }

    .fade-in-up {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body class="relative bg-black text-slate-100 antialiased selection:bg-[#535eee] selection:text-white overflow-x-hidden w-full max-w-full">

  <!-- Dual-Sided Background Color Gradients (MZ Media Cyber Aura Style) -->
  <!-- Left Side Background Color Gradient Aura -->
  <div class="fixed top-0 left-0 bottom-0 w-[300px] sm:w-[480px] lg:w-[650px] bg-[radial-gradient(ellipse_at_left,_rgba(83,94,238,0.22)_0%,_rgba(59,130,246,0.12)_45%,_transparent_75%)] pointer-events-none z-0"></div>
  <div class="fixed top-1/3 left-0 w-[250px] sm:w-[400px] h-[600px] bg-gradient-to-r from-blue-600/15 via-[#535eee]/10 to-transparent blur-[120px] pointer-events-none z-0"></div>

  <!-- Right Side Background Color Gradient Aura -->
  <div class="fixed top-0 right-0 bottom-0 w-[300px] sm:w-[480px] lg:w-[650px] bg-[radial-gradient(ellipse_at_right,_rgba(141,150,255,0.20)_0%,_rgba(83,94,238,0.12)_45%,_transparent_75%)] pointer-events-none z-0"></div>
  <div class="fixed top-2/3 right-0 w-[250px] sm:w-[400px] h-[600px] bg-gradient-to-l from-[#8d96ff]/15 via-[#535eee]/10 to-transparent blur-[120px] pointer-events-none z-0"></div>

  <!-- Left Atmospheric Fog (MZ Media Mystical Mist Style) -->
  <div class="fixed top-0 left-0 bottom-0 w-[260px] sm:w-[420px] lg:w-[540px] pointer-events-none z-0 select-none opacity-35 sm:opacity-45 mix-blend-screen overflow-hidden">
    <img src="fog-side.svg" alt="Left Ambient Fog" class="w-full h-full object-cover object-left select-none pointer-events-none" />
  </div>

  <!-- Right Atmospheric Fog (MZ Media Mystical Mist Style) -->
  <div class="fixed top-0 right-0 bottom-0 w-[260px] sm:w-[420px] lg:w-[540px] pointer-events-none z-0 select-none opacity-35 sm:opacity-45 mix-blend-screen overflow-hidden scale-x-[-1]">
    <img src="fog-side.svg" alt="Right Ambient Fog" class="w-full h-full object-cover object-left select-none pointer-events-none" />
  </div>

  <!-- Header / Navbar Component -->
  <?php include('components/navbar.php'); ?>

  <!-- Main Hero Section -->
  <main class="relative z-10 w-full max-w-full overflow-hidden">
    <section id="heroSection" class="relative flex flex-col items-center justify-center pt-24 sm:pt-36 pb-3 sm:pb-6 px-2.5 sm:px-6 lg:px-8 overflow-hidden w-full max-w-full">
      
      <div class="max-w-6xl w-full mx-auto text-center relative z-10 pt-1 sm:pt-2 flex flex-col items-center justify-center">
        
        <!-- Live Rotating Trust Ticker Pill (MZ Media Exact Architecture) -->
        <div class="inline-flex items-center justify-center mb-3.5 sm:mb-7" id="heroBadgeWrapper">
          <div class="group relative h-10 sm:h-13 px-3 sm:px-6 bg-black border-2 border-white/30 shadow-[0_0_25px_rgba(255,255,255,0.18)] hover:border-white hover:shadow-[0_0_40px_rgba(255,255,255,0.5)] transition-all duration-300 backdrop-blur-xl rounded-none overflow-hidden max-w-[95vw] cursor-pointer">
            
            <div id="verticalSwipeTicker" class="w-full flex flex-col transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]">
              
              <!-- Slide 1: Brands Circle + "Trusted by 500+ Creators & Brands" -->
              <div class="h-10 sm:h-13 flex-shrink-0 flex items-center justify-center gap-2 sm:gap-3.5 px-1 sm:px-2">
                <span class="text-[9px] sm:text-xs font-bold uppercase tracking-wider text-gray-400 font-display whitespace-nowrap">Trusted by</span>
                <div class="flex -space-x-1.5 sm:-space-x-2.5 items-center py-0.5 shrink-0">
                  <img src="brands/1.jpeg" alt="Brand 1" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="brands/2.webp" alt="Brand 2" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="brands/3.webp" alt="Brand 3" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="brands/4.jpg" alt="Brand 4" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="brands/5.png" alt="Brand 5" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                </div>
                <div class="h-4 sm:h-6 w-[1px] bg-white/20 shrink-0"></div>
                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider text-white font-display whitespace-nowrap">500+ Creators &bull; 100M+ Views</span>
              </div>

              <!-- Slide 2: Clients Photos Circle + "★★★★★ 4.9 (50+ Reviews)" -->
              <div class="h-10 sm:h-13 flex-shrink-0 flex items-center justify-center gap-2 sm:gap-3.5 px-1 sm:px-2">
                <div class="flex -space-x-1.5 sm:-space-x-2.5 items-center py-0.5 shrink-0">
                  <img src="clients/1.png" alt="Client 1" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="clients/2.jpg" alt="Client 2" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="clients/3.webp" alt="Client 3" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="clients/4.jpg" alt="Client 4" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                  <img src="clients/6.jpg" alt="Client 5" class="w-5 h-5 sm:w-7 sm:h-7 rounded-full border-2 border-white object-cover shadow-lg ring-1 ring-black/60 saturate-125 transition-all duration-300 group-hover:scale-105 hover:!scale-140 hover:!z-30 shrink-0" />
                </div>
                <div class="h-4 sm:h-6 w-[1px] bg-white/20 shrink-0"></div>
                <div class="flex items-center gap-1 sm:gap-1.5 whitespace-nowrap">
                  <div class="flex text-amber-400 text-[9px] sm:text-xs tracking-wider animate-pulse">★★★★★</div>
                  <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider text-white font-display"><span class="text-white font-extrabold">4.9</span> (50+ Reviews)</span>
                </div>
              </div>

              <!-- Slide 3: Speed Delivery & Fast Cuts -->
              <div class="h-10 sm:h-13 flex-shrink-0 flex items-center justify-center gap-2 sm:gap-3.5 px-1 sm:px-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_10px_#10b981] animate-pulse"></span>
                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider text-white font-display whitespace-nowrap"><span class="text-white font-extrabold">24–48h</span> First Cuts &bull; Rapid Scaling</span>
              </div>

              <!-- Slide 4: 100% Satisfaction Guarantee -->
              <div class="h-10 sm:h-13 flex-shrink-0 flex items-center justify-center gap-2 sm:gap-3.5 px-1 sm:px-2">
                <span class="w-2 h-2 rounded-full bg-[#535eee] shadow-[0_0_10px_#535eee] animate-pulse"></span>
                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider text-white font-display whitespace-nowrap">100% Satisfaction Guarantee &bull; Unlimited Revisions</span>
              </div>

            </div>

          </div>
        </div>

        <!-- Hero Headline (Fluid Responsive Typography 320px -> 1920px) -->
        <h1 class="text-2xl xs:text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.15] sm:leading-[1.08] mb-4 sm:mb-8 font-display px-1">
          Content that <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-[#8d96ff] to-[#535eee]">Performs.</span><br />
          Systems that <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#535eee] via-[#a5adff] to-fuchsia-400">Scale.</span>
        </h1>

        <!-- Featured Showreel Video Card (Enlarged Responsive Preview with Center Cyber Play Button) -->
        <div class="relative w-full max-w-[350px] xs:max-w-[420px] sm:max-w-3xl md:max-w-4xl lg:max-w-5xl mx-auto rounded-none overflow-hidden bg-black border-2 border-white/35 shadow-[0_10px_35px_rgba(0,0,0,0.9)] sm:shadow-[0_25px_80px_rgba(0,0,0,0.85)] group hover:border-white hover:shadow-[0_0_45px_rgba(255,255,255,0.35)] transition-all duration-500 mb-4 sm:mb-8 cursor-pointer" id="heroVideoContainer" onclick="playHeroShowreel()">
          
          <div class="relative aspect-video w-full bg-black overflow-hidden" id="heroShowreelFrame">
            
            <!-- Clean Preview Iframe (No Vimeo bottom controls shown by default) -->
            <iframe
              id="heroShowreelIframe"
              src="https://player.vimeo.com/video/1219066986?title=0&byline=0&portrait=0&badge=0&controls=0&autopause=0&player_id=0&app_id=58479"
              class="w-full h-full absolute inset-0 pointer-events-none scale-[1.01]"
              frameborder="0"
              allow="autoplay; fullscreen; picture-in-picture; encrypted-media"
              webkitallowfullscreen
              mozallowfullscreen
              allowfullscreen></iframe>

            <!-- Center Square Cyber Play Button Overlay (Exact style from 'The videos we ship' section) -->
            <div id="heroPlayOverlay" class="absolute inset-0 bg-black/25 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center z-10">
              <div class="w-12 h-12 sm:w-20 sm:h-20 rounded-none bg-white text-black flex items-center justify-center shadow-[0_0_25px_rgba(255,255,255,0.7)] sm:shadow-[0_0_45px_rgba(255,255,255,0.85)] group-hover:scale-110 group-hover:shadow-[0_0_65px_rgba(255,255,255,1)] transition-all duration-300">
                <svg class="w-5 h-5 sm:w-9 sm:h-9 ml-1 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z"/>
                </svg>
              </div>
            </div>

          </div>

        </div>

        <!-- CTA Action Buttons (Compact on Mobile, Fluid Row on Desktop) -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-5 mb-5 sm:mb-10 w-full mx-auto px-2">
          
          <!-- Primary CTA: Book A Discovery Call -->
          <a href="<?= htmlspecialchars($booking_calendly_url); ?>" target="_blank" class="mz-btn bg-white text-black shadow-[0_0_20px_rgba(255,255,255,0.3)] sm:shadow-[0_0_35px_rgba(255,255,255,0.35)] hover:shadow-[0_0_55px_rgba(255,255,255,0.8)] hover:bg-white hover:border-white px-3.5 py-2 sm:px-7 sm:py-3.5 w-auto min-w-[210px] sm:min-w-0 justify-center rounded-none border-2 border-white text-xs sm:text-base font-extrabold tracking-wide">
            <span>Book a Discovery Call</span>
            <div class="mz-btn-icon bg-black text-white rounded-none">
              <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </div>
          </a>

          <!-- Secondary CTA: Get your video done -->
          <a href="<?= htmlspecialchars(get_setting('order_cta_url', 'order.php')); ?>" class="mz-btn bg-[#13131e]/90 text-gray-100 border-2 border-white/40 hover:border-white hover:text-white hover:bg-[#1e1e30] px-3.5 py-2 sm:px-7 sm:py-3.5 w-auto min-w-[210px] sm:min-w-0 justify-center backdrop-blur-xl rounded-none shadow-[0_0_20px_rgba(0,0,0,0.5)] hover:shadow-[0_0_40px_rgba(255,255,255,0.4)] text-xs sm:text-base font-extrabold tracking-wide">
            <span>Get your video done</span>
            <div class="mz-btn-icon bg-white/15 text-white rounded-none">
              <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </div>
          </a>

        </div>

        <!-- Trusted Client Logos Marquee (Positioned after CTA buttons) -->
        <div class="mb-3 sm:mb-8 pt-2 pb-2 sm:pt-4 sm:pb-4 border-y border-white/15 overflow-hidden bg-white/[0.02] w-full max-w-full">
          <p class="text-[9px] sm:text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 sm:mb-3">Trusted by High-Performing Creators & Brands</p>
          
          <div class="relative w-full overflow-hidden">
            <!-- Fade Edges -->
            <div class="absolute left-0 top-0 bottom-0 w-6 sm:w-12 bg-gradient-to-r from-black to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-6 sm:w-12 bg-gradient-to-l from-black to-transparent z-10 pointer-events-none"></div>

            <div class="flex gap-6 sm:gap-14 lg:gap-16 items-center animate-marquee-fast w-max opacity-80 hover:opacity-100 transition-opacity py-1 sm:py-2">
              <!-- Set 1 -->
              <img src="brands/logo_1.png" alt="SSRG" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_2.png" alt="Walmart" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_3.png" alt="Shopify" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_4.png" alt="Acquisition" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_5.png" alt="7-Eleven" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_6.png" alt="T-Nation" class="h-3.5 sm:h-6 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_7.png" alt="Adobe" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_8.png" alt="Insta Appoint AI" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_9.png" alt="Revive Systems" class="h-6 sm:h-10 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_10.png" alt="Nerdspin" class="h-3.5 sm:h-6 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />

              <!-- Set 2 (for seamless loop) -->
              <img src="brands/logo_1.png" alt="SSRG" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_2.png" alt="Walmart" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_3.png" alt="Shopify" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_4.png" alt="Acquisition" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_5.png" alt="7-Eleven" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_6.png" alt="T-Nation" class="h-3.5 sm:h-6 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_7.png" alt="Adobe" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_8.png" alt="Insta Appoint AI" class="h-4 sm:h-7 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_9.png" alt="Revive Systems" class="h-6 sm:h-10 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
              <img src="brands/logo_10.png" alt="Nerdspin" class="h-3.5 sm:h-6 w-auto max-w-[75px] sm:max-w-[130px] object-contain opacity-80 hover:opacity-100 transition-opacity" />
            </div>
          </div>
        </div>

      </div>

      <!-- Fullscreen Wide Horizontal Divider Line with border-img in the Middle -->
      <div class="relative w-full left-0 right-0 mt-6 sm:mt-8 mb-0 flex items-center justify-center pointer-events-none fade-in-up overflow-hidden">
        <div class="absolute inset-0 flex items-center w-full">
          <div class="w-full border-t border-white/20"></div>
        </div>
        <div class="relative z-10 flex justify-center max-w-full">
          <img src="border-img" alt="Glow Border Accent" class="w-[500px] sm:w-[750px] max-w-full max-h-14 sm:max-h-16 object-contain select-none pointer-events-none" />
        </div>
      </div>

    </section>
  </main>

  <!-- Modular Sections (Reviews positioned directly after 'Why Us') -->
  <div class="relative z-10 space-y-4">
    <?php include('components/video-testimonials.php'); ?>
    <?php include('components/projects.php'); ?>
    <?php include('components/second-intro.php'); ?>
    <?php include('components/why-us.php'); ?>
    <?php include('components/clients-testimonials.php'); ?>
    <?php include('components/strategy.php'); ?>
    <?php include('components/feedback.php'); ?>
    <?php include('components/accordion.php'); ?>
    <?php include('components/footer.php'); ?>
  </div>

  <!-- Scripts -->
  <script>
    // --------------------------------------------------------------------------
    // Vertical Swiping Trust Ticker (Percentage-based Smooth Auto-Swipe)
    // --------------------------------------------------------------------------
    (function initVerticalTrustSwipe() {
      const ticker = document.getElementById('verticalSwipeTicker');
      if (!ticker) return;
      let currentIdx = 0;
      const totalSlides = ticker.children.length;
      if (totalSlides <= 1) return;
      setInterval(() => {
        currentIdx = (currentIdx + 1) % totalSlides;
        const percentage = (currentIdx * 100) / totalSlides;
        ticker.style.transform = `translateY(-${percentage}%)`;
      }, 3000);
    })();

    // --------------------------------------------------------------------------
    // Lenis Butter-Smooth Inertia Scrolling Engine
    // --------------------------------------------------------------------------
    let lenis;
    if (typeof Lenis !== 'undefined') {
      lenis = new Lenis({
        duration: 1.1,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 1.0,
        touchMultiplier: 1.0,
        infinite: false
      });

      function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
      }
      requestAnimationFrame(raf);

      // Smooth scroll for internal hash anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const targetId = this.getAttribute('href');
          if (targetId && targetId !== '#' && targetId.length > 1) {
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
              e.preventDefault();
              lenis.scrollTo(targetEl, { offset: -70 });
            }
          }
        });
      });
    }

    // --------------------------------------------------------------------------
    // Hero Video Card Scroll-Driven Responsive Enlarge
    // --------------------------------------------------------------------------
    (function initHeroVideoScrollZoom() {
      const container = document.getElementById('heroVideoContainer');
      if (!container) return;

      function updateHeroZoom() {
        if (window.innerWidth < 768) {
          container.style.transform = 'none';
          return;
        }
        const scrollY = window.scrollY || window.pageYOffset;
        const progress = Math.min(Math.max(scrollY / 400, 0), 1);
        const scale = 0.98 + progress * 0.04;
        container.style.transform = `scale(${scale})`;

        if (progress > 0.3) {
          container.style.borderColor = 'rgba(255, 255, 255, 0.7)';
          container.style.boxShadow = '0 25px 80px rgba(0, 0, 0, 0.9), 0 0 45px rgba(255, 255, 255, 0.2)';
        } else {
          container.style.borderColor = 'rgba(255, 255, 255, 0.3)';
          container.style.boxShadow = '0 15px 50px rgba(0, 0, 0, 0.85)';
        }
      }

      window.addEventListener('scroll', updateHeroZoom, { passive: true });
      window.addEventListener('resize', updateHeroZoom, { passive: true });
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
    // Hero Video Embed (Play Showreel on Center Button Click)
    // --------------------------------------------------------------------------
    window.playHeroShowreel = function() {
      const iframe = document.getElementById('heroShowreelIframe');
      const overlay = document.getElementById('heroPlayOverlay');
      if (iframe) {
        iframe.src = "https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0&autopause=0&color=535eee&playsinline=1";
        iframe.classList.remove('pointer-events-none');
      }
      if (overlay) {
        overlay.classList.add('opacity-0', 'pointer-events-none');
        setTimeout(() => overlay.remove(), 400);
      }
    };

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
