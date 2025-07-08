<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Video Display - MZ Media</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    body {

      background-color: #000;
      background-image: radial-gradient(circle at top left, #1a0033 1%, transparent 20%),
                        radial-gradient(circle at bottom right, #330066 1%, transparent 20%);
      background-size: 800px 800px;
      background-repeat: no-repeat;
      background-position: top left, bottom right;
      font-family: 'Inter', sans-serif;
      color: white;
      min-height: 100vh; /* Ensure body takes full height for centering */
      display: flex;
      flex-direction: column;
      justify-content: center; /* Center content vertically */
      align-items: center; /* Center content horizontally */
      padding: 2rem; /* Add some padding around the video */
      box-sizing: border-box; /* Include padding in element's total width and height */
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
  max-width: 450px; /* Slightly wider */
  aspect-ratio: 4 /6; /* Taller than 4:5 */
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
      position: absolute; /* Position absolutely within the container */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover; /* This makes the video fill the container, cropping if necessary */
      border-radius: 1.5rem; /* Apply radius to video itself to match container */
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
      .video-container {
        max-width: 90%; /* Adjust width for very small screens */
        margin: 0 auto; /* Center on smaller screens */
      }
    }
  </style>
</head>

<body class="text-white font-sans">

  <div class="dynamic-purple-glow"></div>

  <main class="relative flex flex-col items-center justify-center  w-full ">
    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center" data-aos="fade-up" data-aos-duration="1000">
      Our Reviews From Clients
    </h1>

    <div class="video-container" data-aos="zoom-in" data-aos-duration="1200" data-aos-delay="200">
      <video controls playsinline preload="metadata">
        <source src="http://nextlevelmedia.digital/components/videos/review.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true, // Animation happens only once
      offset: 120, // Offset (in px) from the original trigger point
      easing: 'ease-in-out', // Easing function
    });
  </script>

</body>
</html>