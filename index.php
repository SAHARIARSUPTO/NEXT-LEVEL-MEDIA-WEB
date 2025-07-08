<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Next Level Media</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <meta name="description" content="Next Level Media – Creative agency in Sylhet, Bangladesh specializing in strategic content, video marketing, and automation to help your business grow." />
  <meta name="keywords" content="Next Level Media, video marketing, content creation, Sylhet agency, performance marketing, branding, business automation" />
  <meta name="author" content="Next Level Media" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://nextlevelmedia.digital/" />


  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://nextlevelmedia.digital/" />
  <meta property="og:title" content="Next Level Media - Creative Agency in Sylhet, Bangladesh" />
  <meta property="og:description" content="We help brands and businesses grow with content, paid ads, and automation systems that scale." />
  <meta property="og:image" content="main-logo.png" />

  <meta name="twitter:card" content="main-logo.png" />
  <meta name="twitter:url" content="https://nextlevelmedia.digital/" />
  <meta name="twitter:title" content="Next Level Media - Creative Agency in Sylhet, Bangladesh" />
  <meta name="twitter:description" content="We help brands and businesses grow with content, paid ads, and automation systems that scale." />
  <meta name="twitter:image" content="main-logo.png" />

  <link rel="icon" href="main-logo.png" type="image/x-icon" />

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Next Level Media",
    "url": "https://nextlevelmedia.digital/",
    "logo": "https://nextlevelmedia.digital/favicon.ico",
    "sameAs": [
      "https://www.facebook.com/nextlevelmedia",
      "https://twitter.com/nextlevelmedia",
      "https://www.linkedin.com/company/nextlevelmedia"
    ]
  }
  </script>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    html { scroll-behavior: smooth; }
    body {
      background-color: #000;
      background-image: radial-gradient(circle at top left, #1a0033 1%, transparent 20%),
                        radial-gradient(circle at bottom right, #330066 1%, transparent 20%);
      background-size: 800px 800px;
      background-repeat: no-repeat;
      background-position: top left, bottom right;
      color: white;
      overflow-x: hidden; /* Prevent horizontal scroll on some mobile animations */
    }

    /* Glow Orbs */
    .orb {
      position: absolute;
      width: 150px;
      height: 150px;
      background: radial-gradient(circle at center, rgba(93, 63, 211, 0.6), transparent 70%);
      border-radius: 50%;
      filter: blur(50px);
      z-index: 0;
      animation: floatOrb 10s infinite alternate ease-in-out;
    }

    .orb:nth-child(1) { top: 10%; left: 20%; animation-delay: 0s; }
    .orb:nth-child(2) { bottom: 15%; right: 25%; animation-delay: 2s; }
    .orb:nth-child(3) { top: 50%; left: 70%; animation-delay: 4s; }

    @keyframes floatOrb {
      0% { transform: translateY(0) scale(1); }
      100% { transform: translateY(-30px) scale(1.1); }
    }

    /* Floating Card (if used elsewhere on your site, but not for the player) */
    .floating-card {
      background-color: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .floating-card:hover {
      transform: translateY(-5px) scale(1.01);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
    }

    /* YOUTUBE VIDEO PLAYER CARD STYLES */
    .youtube-player-card {
      position: relative;
      max-width: 800px; /* Adjust max-width as needed for a good 16:9 player size */
      width: 100%;
      padding-bottom: 56.25%; /* 16:9 aspect ratio (9 / 16 * 100 = 56.25%) */
      height: 0; /* Important for aspect ratio padding trick */
      margin: 2rem auto; /* Center the card horizontally */
      background-color: #000; /* Black background for YouTube player */
      border-radius: 1.5rem; /* Rounded corners */
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5); /* Stronger shadow */
      z-index: 5; /* Ensure it's above background orbs */
    }

    .youtube-player-card iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    /* Intersection Observer Animations (General for scroll) */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(20px); /* Initial state: slightly down */
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      will-change: opacity, transform; /* Optimize for animation performance */
    }

    .animate-on-scroll.is-visible {
      opacity: 1;
      transform: translateY(0); /* Final state: original position */
    }

    /* For larger text animations with smooth effect */
    .animate-heading {
      opacity: 0;
      transform: translateY(30px); /* More pronounced initial state */
      transition: opacity 1s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 1s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smooth cubic-bezier */
      will-change: opacity, transform;
    }

    .animate-heading.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .headline-word {
      opacity: 0;
      transform: translateY(30px);
      display: inline-block;
      transition: opacity 0.7s cubic-bezier(0.25,0.46,0.45,0.94), transform 0.7s cubic-bezier(0.25,0.46,0.45,0.94);
      will-change: opacity, transform;
    }

    .animate-heading.is-visible .headline-word {
      opacity: 1;
      transform: translateY(0);
    }

    /* Specific delays for initial load animations (Hero section) */
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
    .animate-fadeIn.delay-200 { animation-delay: 0.2s; }
    .animate-fadeIn.delay-400 { animation-delay: 0.4s; }
    .animate-fadeIn.delay-800 { animation-delay: 0.8s; }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .animate-scaleIn { animation: scaleIn 0.5s ease-out forwards; }
    .animate-scaleIn.delay-600 { animation-delay: 0.6s; }
    .animate-scaleIn.delay-700 { animation-delay: 0.7s; }
    .animate-scaleIn.delay-800 { animation-delay: 0.8s; }
    .animate-scaleIn.delay-900 { animation-delay: 0.9s; }

    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .animate-slideInFromLeft { animation: slideInFromLeft 0.7s ease-out forwards; }
    .animate-slideInFromLeft.delay-1000 { animation-delay: 1s; }

    @keyframes slideInFromLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .youtube-player-card {
        max-width: 90%; /* Adjust card width for smaller screens */
        margin: 1.5rem auto;
      }

      /* Adjust padding/margins for mobile to reduce extra space in sections */
      section {
        padding-top: 4rem;
        padding-bottom: 4rem;
      }
      .pt-32 { padding-top: 6rem; } /* Adjust hero top padding */
      .pb-32 { padding-bottom: 6rem; } /* Adjust hero bottom padding */
      .pb-10 { padding-bottom: 2rem; } /* If used specifically for the hero, adjust as needed */
    }

    /* Ensure no extra bottom margin/padding for main sections */
    main {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
    section:last-of-type {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
  </style>
</head>
<body class="text-white font-sans">

<?php include('components/navbar.php'); ?>

<main>
  <section class="relative min-h-screen flex flex-col items-center justify-center px-4 text-center bg-black pt-32 pb-32 overflow-hidden">
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>

    <div class="max-w-4xl mx-auto relative z-10">
      <h1 class="text-4xl md:text-6xl font-semibold leading-tight text-white animate-heading" id="mainHeadline">
        <span class="headline-word">Content</span>
        <span class="headline-word">That</span>
        <span class="headline-word">Performs</span>
        <br>
        <span class="headline-word text-white font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white">Systems</span>
        <span class="headline-word text-white font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white">That</span>
        <span class="headline-word text-white font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white">Scale</span>
      </h1>

      <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto animate-fadeIn delay-200">
        No more boring content. No more wasted ad spend.
      </p>

      <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 animate-fadeIn delay-400">
        <div class="flex -space-x-2">
          <img class="w-10 h-10 rounded-full border-2 border-white animate-scaleIn delay-600" src="CL1.jpg" alt="User 1" />
          <img class="w-10 h-10 rounded-full border-2 border-white animate-scaleIn delay-700" src="CL2.jpg" alt="User 2" />
          <img class="w-10 h-10 rounded-full border-2 border-white animate-scaleIn delay-800 " src="CL3.jpg" alt="User 3" />
          <img class="w-10 h-10 rounded-full border-2 border-white animate-scaleIn delay-900" src="CL4.jpg" alt="User 4" />
        </div>
        <div class="text-left text-sm text-white animate-slideInFromLeft delay-1000">
          <p class="font-semibold">Loved by 500+ Businesses worldwide.</p>
          <p class="text-gray-400">Our Clients Speak for Us</p>
        </div>
      </div>

      <div class="mt-10 animate-fadeIn delay-800">
        <a href="contact.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 transition text-white font-semibold text-sm rounded-full shadow-lg">
          Book A Call
          <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </a>
        <a href="#projects" target="_blank" class="ml-4 inline-flex items-center px-6 py-3 bg-white hover:bg-blue-700 transition text-black font-semibold text-sm rounded-full shadow-lg">
          View Portfolio
        </a>
      </div>
<div class="relative w-full mx-auto mt-10 rounded-3xl overflow-hidden youtube-player-card">
  <iframe
  src="https://www.youtube.com/embed/X0SIgFWWb1o"
  title="Next Level Media Showreel"
  frameborder="0"
  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
  allowfullscreen
></iframe>

</div>
      </div>
  </section>
</main>

<?php include('components/second-intro.php'); ?>
<br>

<div class="mt-12 mb-12"><?php include('components/clients-testimonials.php'); ?></div>
<?php include('components/projects.php'); ?>
<?php include('components/why-us.php'); ?>
<?php include('components/strategy.php'); ?>
<?php include('components/core-services.php'); ?>
<?php include('components/feedback.php'); ?>
<?php include('components/accordion.php'); ?>
<?php include('components/footer.php'); ?>

<script>
  // --- Intersection Observer for Scroll Animations ---
  document.addEventListener('DOMContentLoaded', () => {
    // Select both general scroll animations and specific heading animations
    const animateElements = document.querySelectorAll('.animate-on-scroll, .animate-heading');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible'); // Use 'is-visible' as defined in CSS

          // If it's a headline, stagger the animation of each word
          if (entry.target.classList.contains('animate-heading')) {
            const words = entry.target.querySelectorAll('.headline-word');
            words.forEach((word, i) => {
              word.style.transitionDelay = `${i * 0.08 + 0.1}s`;
            });
          }

          observer.unobserve(entry.target); // Stop observing once visible
        }
      });
    }, {
      threshold: 0.1 // Trigger when 10% of the element is visible
    });

    animateElements.forEach(element => {
      observer.observe(element);
    });
  });
</script>
</body>
</html>