<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Video Display - MZ Media</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Tailwind & AOS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- ✅ Space Grotesk font -->
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000;
      background-image: radial-gradient(circle at top left, #1a0033 1%, transparent 20%),
                        radial-gradient(circle at bottom right, #330066 1%, transparent 20%);
      background-size: 800px 800px;
      background-repeat: no-repeat;
      background-position: top left, bottom right;
      font-family: 'Space Grotesk', sans-serif;
      color: white;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      box-sizing: border-box;
    }

    .dynamic-purple-glow {
      background: radial-gradient(ellipse at center, rgba(128, 0, 128, 0.3), transparent 70%);
      filter: blur(100px);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 600px;
      height: 600px;
      border-radius: 50%;
      z-index: 0;
      pointer-events: none;
    }

    .video-container {
      position: relative;
      width: 100%;
      max-width: 450px;
      aspect-ratio: 4 / 6;
      overflow: hidden;
      border-radius: 1.5rem;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1);
      background-color: #1a1a1a;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .video-container video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 1.5rem;
    }

    @media (max-width: 640px) {
      .video-container {
        max-width: 90%;
        margin: 0 auto;
      }
    }
  </style>
</head>

<body class="text-white font-sans" >

  <div class="dynamic-purple-glow"></div>

  <main class="relative flex flex-col items-center justify-center w-full">
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
      What Our Clients Say<br>
      <span class="text-sm md:text-xl font-normal text-gray-600">
        See how we’ve helped creators and companies elevate their brand and boost their impact.
      </span>
    </h1>

    <div class="video-container" data-aos="zoom-in" data-aos-duration="1200" data-aos-delay="200">
      <video controls playsinline preload="metadata" poster="https://nextlevelmedia.digital/review-thumb.png">
        <source src="http://nextlevelmedia.digital/components/videos/review.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
    <div class="mt-4 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
  <h3 class="text-lg md:text-xl font-semibold text-white">Mike Over</h3>
  <p class="text-sm text-gray-400">Fitness Coach</p>
</div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      offset: 120,
      easing: 'ease-in-out',
    });
  </script>

</body>
</html>
