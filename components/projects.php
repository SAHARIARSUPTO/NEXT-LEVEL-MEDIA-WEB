<?php
$videos = [
    // Shorts Section (Updated)
    ["id" => 1, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/3gDusm-pYr4", "title" => "Shorts Clip 1"],
    ["id" => 2, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/LPXvOwKmgF0", "title" => "Shorts Clip 2"],
    ["id" => 3, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/BSDP0qphx8o", "title" => "Shorts Clip 3"],
    ["id" => 4, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/kRtHRAsHKk8", "title" => "Shorts Clip 4"],
    ["id" => 5, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/A0K4cyrD48U", "title" => "Shorts Clip 5"],
    ["id" => 6, "category" => "shorts", "videoUrl" => "https://www.youtube.com/embed/v03bJY39b6U", "title" => "Shorts Clip 6"],

    // Other Categories
    ["id" => 7, "category" => "3d", "videoUrl" => "https://www.youtube.com/embed/BSDP0qphx8o", "title" => "YouTube Promo"],
    
    ["id" => 8, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=_VZpzlfgMog&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=1", "title" => "Quick Edit Sample"],
    ["id" => 9, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=vVjQcWh7pVI&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=24", "title" => "Quick Edit Sample"],
    ["id" => 10, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=ZdaiBOEJhTY&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=3", "title" => "Quick Edit Sample"],
    ["id" => 11, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=mF2so1ihSQ4&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=4", "title" => "Quick Edit Sample"],
    ["id" => 12, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=WyWPeGKKVIE&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=5", "title" => "Quick Edit Sample"],
    ["id" => 13, "category" => "youtube", "videoUrl" => "https://www.youtube.com/watch?v=m7VVOVvncjA&list=PLqJTtIbzjXQ9JNH8zi9WaCA9ePZHAj244&index=6", "title" => "Quick Edit Sample"],
    
    ["id" => 14, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail1.png", "title" => "Quick Edit Sample"],
    ["id" => 15, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail2.png", "title" => "Quick Edit Sample"],
    ["id" => 16, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail3.png", "title" => "Quick Edit Sample"],
    ["id" => 17, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail4.png", "title" => ""],
    ["id" => 18, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail5.png", "title" => ""],
    ["id" => 19, "category" => "thumbnails", "videoUrl" => "https://nextlevelmedia.digital/components/videos/thumbnail6.png", "title" => ""],

    // Ads
    ["id" => 20, "category" => "ad", "videoUrl" => "https://www.youtube.com/watch?v=s7p6OLwV_50", "title" => ""],
    ["id" => 21, "category" => "ad", "videoUrl" => "https://youtu.be/WMxo_4q0MNg?si=7qJCztvC7rDcDyks", "title" => ""],
    ["id" => 22, "category" => "ad", "videoUrl" => "https://youtu.be/AlsXNhTm4AA?si=WPcfwXd_c308ScLN", "title" => ""],
    ["id" => 23, "category" => "ad", "videoUrl" => "https://www.youtube.com/watchv=VrAAguJPBjclist=PLqJTtIbzjXQ94aO2wPZnliKi_rfz8DdJX&index=2", "title" => ""]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Projects</title>
   <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary-purple': '#8A2BE2',
            'deep-black': '#0A0A0A'
          },
          fontFamily: {
            grotesk: ['Space Grotesk', 'sans-serif']
          }
        }
      }
    }
  </script>
  <style>
    .play-button-overlay {
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s ease;
      cursor: pointer;
      z-index: 10;
    }

.video-card video,
.video-card img,
.video-card .youtube-thumbnail {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 0.75rem;
  display: block;
}

    .video-playing .play-button-overlay {
      opacity: 0;
      pointer-events: none;
    }

    .play-button {
      background-color: #8A2BE2;
      border-radius: 9999px;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s ease;
    }

    .play-button:hover {
      transform: scale(1.1);
    }

    .play-icon {
      fill: white;
      width: 20px;
      height: 20px;
      transform: translateX(2px);
    }

    .video-card {
      opacity: 0;
      transform: translateY(40px) scale(0.98);
      transition: opacity 0.7s cubic-bezier(.4,0,.2,1), transform 0.7s cubic-bezier(.4,0,.2,1);
    }
    .video-card.visible {
      opacity: 1;
      transform: none;
    }
    .aspect-16-9 {
      aspect-ratio: 16/9;
      width: 100%;
      max-width: 1200px; /* Increased from 900px */
      margin: 0 auto;
    }
    .aspect-9-16 {
      aspect-ratio: 9/16;
      width: 100%;
      max-width: 600px; /* Increased from 400px */
      margin: 0 auto;
    }
    .category-label {
      position: absolute;
      top: 0.75rem;
      left: 0.75rem;
      background: #8A2BE2;
      color: #fff;
      font-size: 0.85rem;
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      z-index: 20;
      pointer-events: none;
      opacity: 0.92;
      font-weight: 600;
      letter-spacing: 0.02em;
      text-transform: capitalize;
    }
  </style>
</head>
<body class="bg-deep-black text-white p-6 min-h-screen text-center font-grotesk justify-center">
  <section id="projects" class="pt-10">
    <div class="max-w-4xl mx-auto pb-24">
      <h2 class="text-xl sm:text-4xl font-bold text-center mb-4">What We’ve Created</h2>
      <span class="text-sm md:text-xl text-center font-normal text-gray-600 mb-8 block">Take a Look at Some of Our Standout Work</span>
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8 justify-items-center">
        <button class="filter-btn bg-gray-700 px-2 py-2 rounded-xl text-white text-md sm:text-base font-medium" data-category="youtube">Youtube Videos</button>
        <button class="filter-btn bg-gray-700 px-2 py-2 rounded-xl text-white text-md sm:text-base font-medium" data-category="ad">Ad Creative & VSL</button>
        <button class="filter-btn bg-gray-700 px-2 py-2 rounded-xl text-white text-md sm:text-base font-medium" data-category="thumbnails">Thumbnails</button>
        <button class="filter-btn bg-gray-700 px-2 py-2 rounded-xl text-white text-md sm:text-base font-medium" data-category="shorts">Short Form Content</button>
      </div>
      <div id="project-grid" class="grid grid-cols-1 px-5 sm:grid-cols-2 gap-6"></div>
    </div>

    <script>
      const videos = <?php echo json_encode($videos); ?>;
      const grid = document.getElementById("project-grid");
      const buttons = document.querySelectorAll(".filter-btn");

      function getAspectClass(category) {
        // Shorts are 9:16, others are 16:9
        return category === "shorts" ? "aspect-9-16" : "aspect-16-9";
      }

      function getYouTubeVideoId(url) {
        // Extracts video ID from standard YouTube URLs
        const ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
        // For the specific http://googleusercontent.com/youtube.com/ format, extract the last part as a pseudo-ID
        if (!ytMatch && url.includes("http://googleusercontent.com/youtube.com/")) {
            const parts = url.split('/');
            return parts[parts.length - 1]; // Returns "0", "1", etc.
        }
        return ytMatch ? ytMatch[1] : null;
      }

      function getYouTubeThumbnail(videoId) {
        // Uses standard YouTube thumbnail URL structure.
        // For the placeholder URLs (e.g., youtube.com/0), this will point to a non-existent image,
        // but it maintains the structure for real YouTube videos.
        return `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
      }

      function render(category) {
        grid.innerHTML = "";
        const filtered = category === "all" ? videos : videos.filter(v => v.category === category);

        filtered.forEach((v, index) => {
          const id = `video-${v.id}`; // Use video id for unique DOM element ID
          const isMp4 = v.videoUrl.endsWith(".mp4");
          const isYouTubeLike = v.videoUrl.includes("youtube.com/"); // Checks for any youtube.com mention
          const isImage = v.videoUrl.endsWith(".png") || v.videoUrl.endsWith(".jpg") || v.videoUrl.endsWith(".jpeg") || v.videoUrl.endsWith(".gif");
          const aspectClass = getAspectClass(v.category);

          let mediaHTML = "";

          if (isMp4) {
            mediaHTML = `
              <div class="relative ${aspectClass}">
                <video id="${id}" class="w-full h-full object-cover rounded-xl" preload="metadata"></video>
                <div class="absolute inset-0 flex items-center justify-center play-button-overlay" onclick="playVideo('${id}', this)">
                  <div class="play-button">
                    <svg class="play-icon" viewBox="0 0 24 24">
                      <path d="M8 5v14l11-7z"/>
                    </svg>
                  </div>
                </div>
                <div class="absolute bottom-2 left-2 flex gap-2 z-30">
                  <button class="custom-play bg-primary-purple/80 hover:bg-primary-purple text-white rounded-full w-10 h-10 flex items-center justify-center shadow" data-action="play" data-video="${id}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M8 5v14l11-7z" stroke="currentColor" fill="currentColor"/>
                    </svg>
                  </button>
                  <button class="custom-mute bg-primary-purple/80 hover:bg-primary-purple text-white rounded-full w-10 h-10 flex items-center justify-center shadow" data-action="mute" data-video="${id}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M9 9v6h4l5 5V4l-5 5H9z" stroke="currentColor" fill="currentColor"/>
                    </svg>
                  </button>
                  <button class="custom-fullscreen bg-primary-purple/80 hover:bg-primary-purple text-white rounded-full w-10 h-10 flex items-center justify-center shadow" data-action="fullscreen" data-video="${id}" title="Fullscreen">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M4 4h7M4 4v7M20 20h-7M20 20v-7M20 4v7M20 4h-7M4 20v-7M4 20h7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </div>
              </div>
            `;
          } else if (isYouTubeLike) {
            const videoId = getYouTubeVideoId(v.videoUrl);
            const thumbnailUrl = getYouTubeThumbnail(videoId);
            // Use the original v.videoUrl for the embed source, as the googleusercontent.com URLs are directly used by the player.
            const embedUrl = `${v.videoUrl}?autoplay=1&rel=0`; 

            mediaHTML = `
              <div class="relative ${aspectClass} youtube-container">
                <img src="${thumbnailUrl}" alt="Video Thumbnail" class="youtube-thumbnail w-full h-full object-cover rounded-xl" onerror="this.onerror=null; this.src='https://via.placeholder.com/480x360.png?text=Video+Thumbnail';" />
                <div class="absolute inset-0 flex items-center justify-center play-button-overlay" onclick="loadYouTubeVideo('${id}', '${embedUrl}', this)">
                  <div class="play-button">
                    <svg class="play-icon" viewBox="0 0 24 24">
                      <path d="M8 5v14l11-7z"/>
                    </svg>
                  </div>
                </div>
                <div id="youtube-iframe-${id}" class="absolute inset-0 hidden"></div>
              </div>
            `;
          } else if (isImage) {
            // Assume image
            mediaHTML = `
              <div class="relative aspect-16-9">
                <span class="category-label">${v.category.replace(/^\w/, c => c.toUpperCase())}</span>
                <img src="${v.videoUrl}" alt="${v.title || 'Image'}" class="w-full h-full object-contain rounded-xl" />
              </div>
            `;
          } else {
            // Fallback for unknown types, display a generic placeholder
            mediaHTML = `
              <div class="relative aspect-16-9 bg-gray-800 flex items-center justify-center rounded-xl">
                <p class="text-gray-400">Unsupported Media Type</p>
              </div>
            `;
          }

          grid.innerHTML += `
            <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg video-card relative group">
              ${mediaHTML}
            </div>
          `;

          // Dynamically set video source after element is in DOM for MP4s
          setTimeout(() => {
            if (isMp4) {
              const videoEl = document.getElementById(id);
              if (videoEl && !videoEl.src) {
                videoEl.src = v.videoUrl;
              }
            }
          }, 0);
        });

        // Animate cards on scroll
        animateOnScroll();

        // Attach custom controls for MP4s
        attachCustomControls();
      }

      function playVideo(id, btn) {
        const video = document.getElementById(id);
        const card = btn.closest('.video-card');

        // Pause all other videos
        document.querySelectorAll("video").forEach(v => {
          v.pause();
          v.closest('.video-card')?.classList.remove("video-playing");
        });

        video.play();
        card.classList.add("video-playing");
      }

      function loadYouTubeVideo(id, embedUrl, overlayElement) {
        // Hide overlay and thumbnail
        overlayElement.style.display = 'none';
        const container = overlayElement.closest('.youtube-container');
        const thumbnail = container.querySelector('.youtube-thumbnail');
        if (thumbnail) {
            thumbnail.style.display = 'none';
        }

        // Create and append iframe
        const iframeContainer = document.getElementById(`youtube-iframe-${id}`);
        iframeContainer.innerHTML = `<iframe src="${embedUrl}" class="w-full h-full rounded-xl" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        iframeContainer.classList.remove('hidden');
      }


      function attachCustomControls() {
        // Play/Pause
        document.querySelectorAll('.custom-play').forEach(btn => {
          btn.onclick = function(e) {
            e.stopPropagation();
            const video = document.getElementById(this.dataset.video);
            if (video.paused) {
              document.querySelectorAll("video").forEach(v => {
                v.pause();
                v.closest('.video-card')?.classList.remove("video-playing");
              });
              video.play();
              video.closest('.video-card').classList.add("video-playing");
              this.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="6" y="5" width="4" height="14" fill="currentColor"/><rect x="14" y="5" width="4" height="14" fill="currentColor"/></svg>`;
            } else {
              video.pause();
              video.closest('.video-card').classList.remove("video-playing");
              this.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" stroke="currentColor" fill="currentColor"/></svg>`;
            }
          };
        });

        // Mute/Unmute
        document.querySelectorAll('.custom-mute').forEach(btn => {
          btn.onclick = function(e) {
            e.stopPropagation();
            const video = document.getElementById(this.dataset.video);
            video.muted = !video.muted;
            if (video.muted) {
              this.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 9v6h4l5 5V4l-5 5H9z" stroke="currentColor" fill="currentColor"/><line x1="19" y1="5" x2="5" y2="19" stroke="white" stroke-width="2"/></svg>`;
            } else {
              this.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 9v6h4l5 5V4l-5 5H9z" stroke="currentColor" fill="currentColor"/></svg>`;
            }
          };
        });

        // Fullscreen
        document.querySelectorAll('.custom-fullscreen').forEach(btn => {
          btn.onclick = function(e) {
            e.stopPropagation();
            const video = document.getElementById(this.dataset.video);
            if (video.requestFullscreen) {
              video.requestFullscreen();
            } else if (video.webkitRequestFullscreen) {
              video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) {
              video.msRequestFullscreen();
            }
          };
        });
      }

      // Animation on scroll using Intersection Observer
      function animateOnScroll() {
        const cards = document.querySelectorAll('.video-card');
        const observer = new window.IntersectionObserver((entries, obs) => {
          entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
              setTimeout(() => {
                entry.target.classList.add('visible');
              }, i * 120); // Staggered animation
              obs.unobserve(entry.target);
            }
          });
        }, { threshold: 0.2 });

        cards.forEach(card => observer.observe(card));
      }

      // Initial render
      render("youtube"); // Render YouTube videos by default

      // Set initial active button style
      document.querySelector('.filter-btn[data-category="youtube"]').classList.remove("bg-gray-700");
      document.querySelector('.filter-btn[data-category="youtube"]').classList.add("bg-primary-purple", "active");


      buttons.forEach(btn => {
        btn.addEventListener("click", () => {
          buttons.forEach(b => {
            b.classList.remove("bg-primary-purple", "active");
            b.classList.add("bg-gray-700");
          });
          btn.classList.remove("bg-gray-700");
          btn.classList.add("bg-primary-purple", "active");
          render(btn.dataset.category);
        });
      });
    </script>
  </section>
</body>
</html>