<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Types of Work - MZ Media</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
      color: #fff;
    }
    * {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      min-height: 100%;
      overflow-x: hidden;
      font-family: 'Inter', sans-serif;
    }


    .dynamic-purple-glow {
      background: radial-gradient(ellipse at center, rgba(10, 0, 10, 0.3), transparent 70%);
      filter: blur(100px);
      position: absolute;
      width: 800px;
      height: 800px;
      border-radius: 50%;
      z-index: 0;
      pointer-events: none;
    }

    .glow-top-left {
      top: 5%;
      left: 5%;
      transform: translate(-50%, -50%);
    }

    .glow-bottom-right {
      top: 75%;
      right: 5%;
      transform: translate(50%, 50%);
    }

    .service-card {
      background: linear-gradient(145deg, rgba(98, 0, 234, 0.3), rgba(0, 204, 255, 0.2));
      border: 1px solid rgba(128, 0, 255, 0.3);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      border-radius: 1rem;
      padding: 2rem;
      flex-shrink: 0;
      width: 320px;
      height: 220px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: flex-start;
      text-align: left;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(98, 0, 234, 0.4), 0 0 50px rgba(0, 204, 255, 0.4);
    }

    .service-card-icon {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      width: 64px;
      height: 64px;
      opacity: 0.2;
      transform: rotate(30deg);
    }

    .slider-wrapper {
      overflow: hidden;
      width: 100%;
      margin: 2rem 0;
      -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
      mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .slider-content {
      display: flex;
      white-space: nowrap;
      animation-timing-function: linear;
      animation-iteration-count: infinite;
    }

    .slide-left {
      animation-name: slideLeft;
    }

    .slide-right {
      animation-name: slideRight;
    }

    @keyframes slideLeft {
      from {
        transform: translateX(0%);
      }

      to {
        transform: translateX(-100%);
      }
    }

    @keyframes slideRight {
      from {
        transform: translateX(-100%);
      }

      to {
        transform: translateX(0%);
      }
    }

    .slider-content>* {
      margin-right: 2rem;
    }

    @media (max-width: 767px) {
      .service-card {
        width: 260px;
        height: 180px;
        padding: 1.5rem;
      }

      .service-card-icon {
        width: 56px;
        height: 56px;
        top: 1rem;
        right: 1rem;
      }

      .service-card h3 {
        font-size: 1.125rem;
      }

      .service-card p {
        font-size: 0.875rem;
      }

      .slider-content>* {
        margin-right: 1.5rem;
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animated-heading {
      opacity: 0;
      transition: opacity 0.3s;
    }

    .animated-heading.visible {
      animation: fadeInUp 0.8s cubic-bezier(.77, 0, .18, 1) forwards;
      opacity: 1;
    }
  </style>
</head>

<section id="core-services">
  <body class="min-h-screen w-full overflow-hidden p-0 m-0">
  <div class="relative flex flex-col items-center px-4 pt-20 overflow-hidden">
    <div class="dynamic-purple-glow glow-top-left"></div>
    <div class="dynamic-purple-glow glow-bottom-right"></div>

    <div class="relative z-10 text-center pb-12">
      <p class="text-base uppercase tracking-widest text-gray-400 mb-2 animated-heading" id="coreServicesSub"></p>
      <h2 class="text-5xl md:text-6xl font-bold animated-heading" id="coreServicesHeading">
        Types of Work <br class="md:hidden"> We Do
      </h2>
    </div>

    <div class="slider-wrapper pb-5 pt-4">
      <div id="sliderLeft" class="slider-content slide-left"></div>
    </div>

    <div class="slider-wrapper pb-5 pt-4">
      <div id="sliderRight" class="slider-content slide-right"></div>
    </div>
  </div>

  <script>
    const serviceData = [
  {
    title: 'YouTube Videos',
    description: 'Grow a personal brand in any niche with our trendy edits.',
    icon: 'fa-brands fa-youtube'
  },
  {
    title: 'Short Form Videos',
    description: 'Byte sized top of the funnel videos for Instagram Reels and TikTok',
    icon: 'fa-solid fa-film'
  },
  {
    title: 'SAAS Video',
    description: 'Organic podcasts to build credibility among your audience',
    icon: 'fa-solid fa-microphone'
  },
  {
    title: 'Creatives & VSLs',
    description: 'Scale content and convert more with paid ads.',
    icon: 'fa-solid fa-paint-brush'
  },
  {
    title: 'Explainer Videos',
    description: 'Simplify complex ideas into engaging, easy-to-understand animations.',
    icon: 'fa-solid fa-lightbulb'
  },
  {
    title: 'Product Demos',
    description: "Showcase your product's features and benefits with compelling visuals.",
    icon: 'fa-solid fa-cube'
  }
];

    function createServiceCard(data) {
      const card = document.createElement('div');
      card.className = 'service-card';
      card.innerHTML = `
        <i class="service-card-icon ${data.icon}" aria-hidden="true" style="font-size:3rem; color:#a855f7; position:absolute; top:1.5rem; right:1.5rem; opacity:0.2;"></i>
        <div class="z-10">
          <h3 class="text-2xl font-semibold mb-2">${data.title}</h3>
          <p class="text-gray-300 text-base">${data.description}</p>
        </div>`;
      return card;
    }

    function populateSlider(sliderElement) {
      serviceData.forEach(data => sliderElement.appendChild(createServiceCard(data)));
      const cardWidth = 320 + 32;
      const numDuplicates = Math.ceil(window.innerWidth * 2 / cardWidth);
      for (let i = 0; i < numDuplicates; i++) {
        serviceData.forEach(data => sliderElement.appendChild(createServiceCard(data)));
      }
      const totalWidth = sliderElement.scrollWidth / 2;
      const animationSpeed = 0.1;
      const duration = totalWidth / animationSpeed / 1000;
      sliderElement.style.animationDuration = `${duration}s`;
    }

    const sliderLeft = document.getElementById('sliderLeft');
    const sliderRight = document.getElementById('sliderRight');

    populateSlider(sliderLeft);
    populateSlider(sliderRight);

    let resizeTimeout;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        sliderLeft.innerHTML = '';
        sliderRight.innerHTML = '';
        populateSlider(sliderLeft);
        populateSlider(sliderRight);
      }, 250);
    });

    document.addEventListener('DOMContentLoaded', function() {
  const heading = document.getElementById('coreServicesHeading');
  const sub = document.getElementById('coreServicesSub');
  if (sub) sub.textContent = "Core Services";

  function animateOnScroll() {
    const rect = heading.getBoundingClientRect();
    if (rect.top < window.innerHeight - 100) {
      heading.classList.add('visible');
      if (sub) sub.classList.add('visible');
      window.removeEventListener('scroll', animateOnScroll);
    }
  }
  window.addEventListener('scroll', animateOnScroll);
  animateOnScroll();
});
  </script>
</body>
</section>

</html>
