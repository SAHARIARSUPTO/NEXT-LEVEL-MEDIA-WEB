<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Strategy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;

      color: #fff;
    }
    .timeline-dot {
      border: 3px solid #a855f7;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #0f0f1a;
      margin: auto;
      transition: transform 0.4s ease;
    }
    .timeline-dot:hover {
      transform: scale(1.3);
    }
    .timeline-line {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      width: 2px;
      height: 100%;
      background: linear-gradient(to bottom, #a855f7, #7e22ce);
      z-index: -10; /* Always behind */
    }
    @media (max-width: 767px) {
      .timeline-line {
        left: 20px;
        transform: none;
      }
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }
    .animated-card {
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .animated-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 20px 40px rgba(168, 85, 247, 0.35);
    }
    /* Add stacking context to card container */
    .space-y-20 {
      position: relative;
      z-index: 10;
    }
  </style>
</head>
<body>

  <section class="py-24 px-4">
    <div class="max-w-5xl mx-auto text-center mb-16">
      <h2 class="text-5xl font-bold text-white mb-4" data-aos="zoom-in">Our Strategy</h2>
      <p class="text-gray-300 text-lg" data-aos="fade">How we deliver <span class="text-purple-300 font-semibold">next-level results</span> through a focused approach.</p>
    </div>

    <div class="relative">
      <div class="timeline-line"></div>

      <div class="space-y-20 relative z-10">

        <!-- Step 1 -->
        <div class="flex items-center justify-between gap-10 flex-col md:flex-row" data-aos="fade">
          <div class="w-full md:w-1/2">
            <div class="rounded-2xl glass-card p-8 shadow-xl animated-card">
              <h3 class="text-3xl font-semibold mb-3">01. Idea Analysis</h3>
              <p class="text-gray-100 text-lg">We analyze your idea based on market trends, feasibility, and business goals.</p>
            </div>
          </div>
          <div class="hidden md:flex flex-col items-center w-10">
            <div class="timeline-dot"></div>
          </div>
          <div class="w-full md:w-1/2"></div>
        </div>

        <!-- Step 2 -->
        <div class="flex items-center justify-between gap-10 flex-col md:flex-row-reverse" data-aos="fade">
          <div class="w-full md:w-1/2">
            <div class="rounded-2xl glass-card p-8 shadow-xl animated-card">
              <h3 class="text-3xl font-semibold mb-3">02. Script Development</h3>
              <p class="text-gray-100 text-lg">We craft engaging scripts that align with your brand voice and audience.</p>
            </div>
          </div>
          <div class="hidden md:flex flex-col items-center w-10">
            <div class="timeline-dot"></div>
          </div>
          <div class="w-full md:w-1/2"></div>
        </div>

        <!-- Step 3 -->
        <div class="flex items-center justify-between gap-10 flex-col md:flex-row" data-aos="fade">
          <div class="w-full md:w-1/2">
            <div class="rounded-2xl glass-card p-8 shadow-xl animated-card">
              <h3 class="text-3xl font-semibold mb-3">03. Content Production</h3>
              <p class="text-gray-100 text-lg">We produce high-quality visuals and audio with our expert in-house team.</p>
            </div>
          </div>
          <div class="hidden md:flex flex-col items-center w-10">
            <div class="timeline-dot"></div>
          </div>
          <div class="w-full md:w-1/2"></div>
        </div>

        <!-- Step 4 -->
        <div class="flex items-center justify-between gap-10 flex-col md:flex-row-reverse" data-aos="fade">
          <div class="w-full md:w-1/2">
            <div class="rounded-2xl glass-card p-8 shadow-xl animated-card">
              <h3 class="text-3xl font-semibold mb-3">04. Distribution</h3>
              <p class="text-gray-100 text-lg">We distribute the content to ideal platforms to ensure visibility and engagement.</p>
            </div>
          </div>
          <div class="hidden md:flex flex-col items-center w-10">
            <div class="timeline-dot"></div>
          </div>
          <div class="w-full md:w-1/2"></div>
        </div>

        <!-- Step 5 -->
        <div class="flex items-center justify-between gap-10 flex-col md:flex-row" data-aos="fade">
          <div class="w-full md:w-1/2">
            <div class="rounded-2xl glass-card p-8 shadow-xl animated-card">
              <h3 class="text-3xl font-semibold mb-3">05. Optimization</h3>
              <p class="text-gray-100 text-lg">We refine strategies continuously using data-driven insights for long-term growth.</p>
            </div>
          </div>
          <div class="hidden md:flex flex-col items-center w-10">
            <div class="timeline-dot"></div>
          </div>
          <div class="w-full md:w-1/2"></div>
        </div>

      </div>
    </div>
  </section>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true,
      offset: 120,
      easing: 'ease-in-out'
    });
  </script>
</body>
</html>
