<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Next Level Media</title>

  <style>
    html, body {
      margin: 0;
      padding: 0;
      max-width: 100vw;
      overflow-x: hidden;
      background-color: black;
      color: white;
      font-family: sans-serif;
    }

    .glow-effect {
      background: radial-gradient(ellipse at center, rgba(231, 11, 231, 0.2), transparent 70%);
      filter: blur(100px);
      z-index: 0;
    }

    .floating-tags-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2rem;
      position: relative;
      height: 12rem;
    }

    .floating-tags-group {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .floating-tag {
      min-width: 180px;
      text-align: center;
      transition: transform 0.2s;
    }

    @keyframes floatLeft {
      0% { opacity: 0; transform: translateX(-60px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    @keyframes floatRight {
      0% { opacity: 0; transform: translateX(60px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    .animate-floatLeft {
      animation: floatLeft 1.2s ease-out forwards;
      opacity: 0;
    }

    .animate-floatRight {
      animation: floatRight 1.2s ease-out forwards;
      opacity: 0;
    }

    @keyframes fadeInSlideUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeInSlideUp {
      opacity: 0;
      animation: fadeInSlideUp 1s ease-out forwards;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-600 { animation-delay: 0.6s; }
    .delay-700 { animation-delay: 0.7s; }
    .delay-800 { animation-delay: 0.8s; }

    .grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
      text-align: center;
    }

    @media (max-width: 640px) {
      .floating-tags-container {
        flex-direction: column;
        gap: 1rem;
        height: auto;
      }

      .floating-tags-group {
        flex-direction: row;
        justify-content: center;
        gap: 0.5rem;
      }

      .floating-tag {
        min-width: 120px;
        font-size: 0.95rem;
        transform: none !important;
      }

      .animate-floatLeft,
      .animate-floatRight {
        animation: fadeInSlideUp 1s ease-out forwards;
        opacity: 0;
      }

     
    }
  </style>
</head>
<body>
  <section class="px-4 bg-black relative w-full overflow-hidden pt-16 pb-8">
    <!-- Responsive Glow Effects -->
    <div class="absolute inset-0 pointer-events-none z-0">
      <div class="glow-effect w-[60vw] h-[60vw] max-w-[400px] max-h-[400px] absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 rounded-full"></div>
      <div class="glow-effect w-[50vw] h-[50vw] max-w-[300px] max-h-[300px] absolute bottom-1/4 right-1/4 translate-x-1/2 translate-y-1/2 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
      <div class="text-center mb-12 md:mb-20">
        <h2 id="headline-animate" class="text-3xl md:text-5xl font-semibold leading-tight text-white max-w-4xl mx-auto delay-100 mt-10 animate-fadeInSlideUp">
          Tired of boring video content that don't stand out? <br>
          <span class="text-blue-400 text-sm sm:text-xl">It's time to upgrade the game with us!</span>
        </h2>

        <!-- Floating tags -->
        <div class="floating-tags-container mt-8 md:mt-12">
          <div class="floating-tags-group animate-floatLeft">
            <div class="floating-tag bg-blue-700 bg-opacity-70 backdrop-blur-sm text-sm px-4 py-2 rounded-full shadow-lg flex items-center -rotate-12 animate-fadeInSlideUp delay-200">
              <span>Podcast Editing</span> <span class="ml-2">🎙️</span>
            </div>
            <div class="floating-tag bg-purple-700 bg-opacity-70 backdrop-blur-sm text-sm px-4 py-2 rounded-full shadow-lg flex items-center rotate-6 animate-fadeInSlideUp delay-300">
              <span>Ad Creatives & VSL</span> <span class="ml-2">📈</span>
            </div>
          </div>

          <div class="floating-tags-group animate-floatRight ml-8">
            <div class="floating-tag bg-purple-700 bg-opacity-70 backdrop-blur-sm text-sm px-4 py-2 rounded-full shadow-lg flex items-center rotate-12 animate-fadeInSlideUp delay-400">
              <span>Short Form Content</span> <span class="ml-2">📱</span>
            </div>
            <div class="floating-tag bg-blue-700 bg-opacity-70 backdrop-blur-sm text-sm px-4 py-2 rounded-full shadow-lg flex items-center -rotate-6 animate-fadeInSlideUp delay-500">
              <span>Youtube Videos</span> <span class="ml-2">▶️</span>
            </div>
          </div>
        </div>
      </div>

<!-- Numbers grid: always 3 columns, animate all texts -->
<div class="grid grid-cols-3 gap-2 text-center mt-8 md:mt-0">
  <div class="flex flex-col items-center animate-fadeInSlideUp delay-300">
    <h3 class="text-xl sm:text-2xl md:text-4xl font-bold text-white mb-1 animate-fadeInSlideUp delay-400">
      <span class="count-up" data-target="200">0</span> <span class="text-blue-400">%</span>
    </h3>
    <p class="text-xs sm:text-sm text-gray-300 mb-1 animate-fadeInSlideUp delay-500">Engagement</p>
    <p class="text-[10px] text-gray-500 animate-fadeInSlideUp delay-600">Viral Edits</p>
  </div>

  <div class="flex flex-col items-center animate-fadeInSlideUp delay-400">
    <h3 class="text-xl sm:text-2xl md:text-4xl font-bold text-white mb-1 animate-fadeInSlideUp delay-500">
      <span class="count-up" data-target="5">0</span> <span class="text-blue-400">X</span>
    </h3>
    <p class="text-xs sm:text-sm text-gray-300 mb-1 animate-fadeInSlideUp delay-600">More Reach</p>
    <p class="text-[10px] text-gray-500 animate-fadeInSlideUp delay-700">Strategic Distribution</p>
  </div>

  <div class="flex flex-col items-center animate-fadeInSlideUp delay-500">
    <h3 class="text-xl sm:text-2xl md:text-4xl font-bold text-white mb-1 animate-fadeInSlideUp delay-600">
      <span class="count-up" data-target="50">0</span> <span class="text-blue-400">%</span>
    </h3>
    <p class="text-xs sm:text-sm text-gray-300 mb-1 animate-fadeInSlideUp delay-700">More Leads</p>
    <p class="text-[10px] text-gray-500 animate-fadeInSlideUp delay-800">Automated Systems</p>
  </div>
</div>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      function animateCountUp(el, target, duration = 1500) {
        let start = 0;
        let startTime = null;
        target = +target;
        function updateCount(currentTime) {
          if (!startTime) startTime = currentTime;
          const progress = Math.min((currentTime - startTime) / duration, 1);
          const value = Math.floor(progress * (target - start) + start);
          el.textContent = value;
          if (progress < 1) {
            requestAnimationFrame(updateCount);
          } else {
            el.textContent = target;
          }
        }
        requestAnimationFrame(updateCount);
      }

      const counters = document.querySelectorAll('.count-up');
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const el = entry.target;
            animateCountUp(el, el.getAttribute('data-target'));
            obs.unobserve(el);
          }
        });
      }, { threshold: 0.6 });

      counters.forEach(counter => observer.observe(counter));

      const headline = document.getElementById('headline-animate');
      if (headline) {
        headline.classList.remove('animate-fadeInSlideUp');
        const observer = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              headline.classList.add('animate-fadeInSlideUp');
              obs.unobserve(headline);
            }
          });
        }, { threshold: 0.6 });
        observer.observe(headline);
      }
    });
  </script>
</body>
</html>
