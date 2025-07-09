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

  <!-- Open Graph -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://nextlevelmedia.digital/" />
  <meta property="og:title" content="Next Level Media - Creative Agency in Sylhet, Bangladesh" />
  <meta property="og:description" content="We help brands and businesses grow with content, paid ads, and automation systems that scale." />
  <meta property="og:image" content="main-logo.png" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:url" content="https://nextlevelmedia.digital/" />
  <meta name="twitter:title" content="Next Level Media - Creative Agency in Sylhet, Bangladesh" />
  <meta name="twitter:description" content="We help brands and businesses grow with content, paid ads, and automation systems that scale." />
  <meta name="twitter:image" content="main-logo.png" />

  <link rel="icon" href="main-logo.png" type="image/x-icon" />

  <!-- Fonts + Tailwind + Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

  <!-- Structured Data -->
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
      overflow-x: hidden;
      font-family: 'Space Grotesk', sans-serif;
    }

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

    .youtube-player-card {
      position: relative;
      max-width: 800px;
      width: 100%;
      padding-bottom: 56.25%;
      height: 0;
      margin: 2rem auto;
      background-color: #000;
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
      z-index: 5;
    }

    .youtube-player-card iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    .animate-on-scroll {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .animate-on-scroll.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .animate-heading {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .animate-heading.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .headline-word {
      display: inline-block;
    }

    @media (max-width: 768px) {
      .youtube-player-card { max-width: 90%; margin: 1.5rem auto; }
      section { padding-top: 4rem; padding-bottom: 2rem; }
      .pt-32 { padding-top: 6rem; }
      .pb-32 { padding-bottom: 2rem !important; }
    }

    main, section:last-of-type {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
  </style>
</head>

<body class="text-white">

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
        <span class="headline-word bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white font-bold">Systems</span>
        <span class="headline-word bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white font-bold">That</span>
        <span class="headline-word bg-clip-text text-transparent bg-gradient-to-r from-gray-300 to-white font-bold">Scale</span>
      </h1>

      <p class="mt-6 text-lg text-gray-400 max-w-2xl mx-auto animate-on-scroll">
        No more boring content. No more wasted ad spend.
      </p>

      <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 animate-on-scroll">
        <div class="flex -space-x-2">
          <img loading="lazy" class="w-10 h-10 rounded-full border-2 border-white" src="CL1.jpg" alt="User 1" />
          <img loading="lazy" class="w-10 h-10 rounded-full border-2 border-white" src="CL2.jpg" alt="User 2" />
          <img loading="lazy" class="w-10 h-10 rounded-full border-2 border-white" src="CL3.jpg" alt="User 3" />
          <img loading="lazy" class="w-10 h-10 rounded-full border-2 border-white" src="CL4.jpg" alt="User 4" />
        </div>
        <div class="text-left text-sm text-white">
          <p class="font-semibold">Loved by 500+ Businesses worldwide.</p>
          <p class="text-gray-400">Our Clients Speak for Us</p>
        </div>
      </div>

      <div class="mt-10 animate-on-scroll">
        <a href="contact.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 transition text-white font-semibold text-sm rounded-full shadow-lg">
          Book A Call
          
        </a>
        <a href="#projects" class="ml-4 inline-flex items-center px-6 py-3 bg-white hover:bg-blue-700 transition text-black font-semibold text-sm rounded-full shadow-lg">
          View Portfolio
        </a>
      </div>

      <!-- YouTube Thumbnail w/ Play Button -->
      <div class="relative w-full mx-auto mt-10 rounded-3xl overflow-hidden youtube-player-card animate-on-scroll group" id="videoWrapper">
        <img 
        loading="lazy"
          src="https://img.youtube.com/vi/X0SIgFWWb1o/maxresdefault.jpg" 
          alt="Showreel Thumbnail" 
          class="absolute top-0 left-0 w-full h-full object-cover cursor-pointer group-hover:opacity-80 transition" 
          id="videoThumbnail"
        />
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
          <div class="bg-white text-black rounded-full p-4 shadow-xl pointer-events-auto group-hover:scale-110 transition" id="customPlayButton">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
              <path d="M6.5 5.5v9l7-4.5-7-4.5z" />
            </svg>
          </div>
        </div>
      </div>

    </div>
  </section>
</main>

<?php include('components/second-intro.php'); ?>
<div class="mt-12"><?php include('components/clients-testimonials.php'); ?></div>
<?php include('components/projects.php'); ?>
<?php include('components/why-us.php'); ?>
<?php include('components/strategy.php'); ?>
<?php include('components/core-services.php'); ?>
<?php include('components/feedback.php'); ?>
<?php include('components/accordion.php'); ?>
<?php include('components/footer.php'); ?>

<script>
  // Animate on scroll
  document.addEventListener('DOMContentLoaded', () => {
    const animateElements = document.querySelectorAll('.animate-on-scroll, .animate-heading');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    animateElements.forEach(el => observer.observe(el));
  });

  // YouTube player swap
  document.getElementById('customPlayButton').addEventListener('click', () => {
    const wrapper = document.getElementById('videoWrapper');
    wrapper.innerHTML = `
      <iframe
        class="absolute top-0 left-0 w-full h-full"
        src="https://www.youtube.com/embed/X0SIgFWWb1o?autoplay=1&modestbranding=1&rel=0&showinfo=0&controls=1"
        title="Next Level Media Showreel"
        frameborder="0"
        allow="autoplay; encrypted-media; picture-in-picture"
        allowfullscreen
      ></iframe>
    `;
  });

  document.getElementById('videoThumbnail').addEventListener('click', () => {
    document.getElementById('customPlayButton').click();
  });
</script>

</body>
</html>
