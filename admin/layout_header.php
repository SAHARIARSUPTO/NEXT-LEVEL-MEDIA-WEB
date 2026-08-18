<?php
require_once('auth_check.php');
require_once('../config/db.php');

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-black">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($page_title ?? 'Admin Workspace'); ?> | Next Level Media</title>
  <link rel="icon" href="../main-logo.png" type="image/png" />
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            display: ['"Space Grotesk"', 'sans-serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          }
        }
      }
    }
  </script>

  <style>
    :root {
      color-scheme: dark;
    }
    body {
      background-color: #000000;
      color: #ffffff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 15px;
      line-height: 1.6;
    }
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    /* High-End Pure Black Studio Cards */
    .adm-card {
      background: #0b0b0f;
      border: 1px solid #1e1e28;
      border-radius: 1.125rem;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.8);
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .adm-card:hover {
      border-color: #313142;
    }

    /* Form Inputs */
    .adm-input {
      width: 100%;
      background: #050508;
      border: 1px solid #282836;
      border-radius: 0.75rem;
      padding: 0.8125rem 1.125rem;
      color: #ffffff;
      font-size: 0.9375rem;
      font-weight: 500;
      outline: none;
      transition: all 0.15s ease-in-out;
    }
    .adm-input:focus {
      border-color: #6366f1;
      background: #08080d;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.35);
    }
    .adm-input::placeholder {
      color: #64748b;
    }
    select.adm-input option {
      background: #0b0b0f;
      color: #ffffff;
      padding: 10px;
    }

    /* High-Contrast Buttons */
    .adm-btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: #6366f1;
      color: #ffffff;
      font-weight: 700;
      font-size: 0.875rem;
      padding: 0.75rem 1.375rem;
      border-radius: 0.75rem;
      transition: all 0.15s ease;
      box-shadow: 0 2px 10px rgba(99, 102, 241, 0.45);
      cursor: pointer;
      white-space: nowrap;
    }
    .adm-btn-primary:hover {
      background: #4f46e5;
      box-shadow: 0 4px 18px rgba(99, 102, 241, 0.65);
    }

    .adm-btn-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: #14141c;
      border: 1px solid #2a2a3a;
      color: #ffffff;
      font-weight: 700;
      font-size: 0.875rem;
      padding: 0.75rem 1.375rem;
      border-radius: 0.75rem;
      transition: all 0.15s ease;
      cursor: pointer;
      white-space: nowrap;
    }
    .adm-btn-secondary:hover {
      background: #1f1f2b;
      border-color: #44445c;
      color: #ffffff;
    }

    /* Distinct Status Badges */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      padding: 0.35rem 0.875rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.025em;
      white-space: nowrap;
    }
    .status-badge-pending {
      background: #3d2b09;
      color: #fcd34d;
      border: 1px solid #92630d;
    }
    .status-badge-review {
      background: #0f2c4a;
      color: #93c5fd;
      border: 1px solid #1e40af;
    }
    .status-badge-progress {
      background: #2f1c54;
      color: #d8b4fe;
      border: 1px solid #7e22ce;
    }
    .status-badge-completed {
      background: #06402b;
      color: #6ee7b7;
      border: 1px solid #059669;
    }
    .status-badge-cancelled {
      background: #451313;
      color: #fca5a5;
      border: 1px solid #b91c1c;
    }

    /* Scrollbars */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #000000;
    }
    ::-webkit-scrollbar-thumb {
      background: #252533;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #3d3d52;
    }
  </style>
</head>
<body class="h-full flex flex-col antialiased bg-black selection:bg-indigo-500 selection:text-white">

  <!-- Top Navigation Header (Strict Single Justified Row) -->
  <header class="sticky top-0 z-50 w-full bg-black/95 border-b border-[#1c1c26] backdrop-blur-md">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-10">
      <div class="h-20 flex items-center justify-between gap-4 overflow-x-auto">
        
        <!-- Left: Brand Identity -->
        <a href="index.php" class="flex items-center gap-3 shrink-0 group">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 p-2 flex items-center justify-center shadow-lg shadow-indigo-500/25 shrink-0">
            <img src="../main-logo.png" alt="Next Level Media" class="w-full h-full object-contain">
          </div>
          <div class="hidden sm:block">
            <span class="text-white font-extrabold text-base tracking-tight font-display flex items-center gap-1.5 whitespace-nowrap">
              Next Level <span class="text-indigo-300 font-bold text-[11px] px-2 py-0.5 rounded-full bg-indigo-500/20 border border-indigo-500/40">Studio Admin</span>
            </span>
          </div>
        </a>

        <!-- Center: Primary Navigation Links (Desktop) -->
        <nav class="flex items-center gap-1 lg:gap-1.5 shrink-0">
          
          <!-- Dashboard Overview -->
          <a href="index.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'index.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Dashboard</span>
          </a>

          <!-- Orders & Briefs -->
          <a href="orders.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'orders.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <span>Orders</span>
          </a>

          <!-- Income & Expenses (Finances) -->
          <a href="finances.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'finances.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Finances</span>
          </a>

          <!-- Video CMS -->
          <a href="videos.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'videos.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            <span>Videos</span>
          </a>

          <!-- Media & Files Manager -->
          <a href="media.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'media.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>Uploads</span>
          </a>

          <!-- SEO & Config -->
          <a href="seo.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'seo.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>SEO & Site</span>
          </a>

          <!-- Analytics -->
          <a href="analytics.php" class="flex items-center gap-2 px-3 lg:px-3.5 py-2 rounded-xl text-xs lg:text-sm font-bold whitespace-nowrap transition-all <?= $current_page === 'analytics.php' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:text-white hover:bg-white/[0.06]'; ?>">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <span>Visitors</span>
          </a>

        </nav>

        <!-- Right: Actions & User Menu (Single Row) -->
        <div class="flex items-center gap-2.5 shrink-0">
          
          <!-- Live Site Shortcut -->
          <a href="../index.php" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white/[0.06] border border-white/10 text-xs font-bold text-white hover:bg-white/[0.12] transition-all whitespace-nowrap">
            <span>Live Site</span>
            <svg class="w-3.5 h-3.5 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>

          <!-- Active Admin User -->
          <div class="hidden xl:flex items-center gap-2 pl-2 border-l border-white/10 shrink-0">
            <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white font-extrabold text-xs flex items-center justify-center shadow-md shrink-0">
              <?= strtoupper(substr($_SESSION['admin_username'] ?? 'A', 0, 1)); ?>
            </div>
            <span class="text-xs font-bold text-white whitespace-nowrap">
              <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>
            </span>
          </div>

          <!-- Sign Out Button -->
          <a href="logout.php" title="Sign Out" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-red-500/10 border border-red-500/30 text-red-300 hover:bg-red-500 hover:text-white text-xs font-bold transition-all whitespace-nowrap shrink-0">
            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span>Logout</span>
          </a>

        </div>

      </div>

    </div>
  </header>

  <!-- Main Workspace Content (Spacious & Justified for Big Displays) -->
  <main class="flex-1 max-w-[1600px] w-full mx-auto px-4 sm:px-6 lg:px-10 py-8">
