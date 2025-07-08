<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Client Benefits Carousel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animated-heading { opacity: 0; transition: opacity 0.3s; }
    .animated-heading.visible { animation: fadeInUp 0.8s cubic-bezier(.77,0,.18,1) forwards; opacity: 1; }
    .carousel-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #000;
      cursor: pointer;
      transition: background-color 0.1s ease;
    }
    .carousel-dot.active { background-color: #F3F4F6; }
    body {
      background-color: #000000;
      font-family: 'Inter', sans-serif;
      color: #F3F4F6;
    }
    .card-inner {
      transition: transform 0.1s ease, box-shadow 0.1s ease;
    }
    .card-inner:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body class="bg-black text-gray-100 min-h-screen flex items-center justify-center py-12">
  <section class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <p class="text-gray-400 uppercase text-sm tracking-widest mb-2 animated-heading" id="feedbackSub">Feedback</p>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight animated-heading" id="feedbackHeading">
        How We <br class="sm:hidden"> Benefit Our Clients
      </h2>
    </div>

    <div class="relative overflow-hidden">
      <div id="carousel-wrapper" class="flex transition-all duration-700 ease-in-out">
        <!-- Slides will be inserted here -->
      </div>
      <div id="carousel-dots" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2"></div>
      <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-700 bg-opacity-75 text-white p-2 rounded-full shadow-lg hover:bg-opacity-100 focus:outline-none hidden sm:block">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-700 bg-opacity-75 text-white p-2 rounded-full shadow-lg hover:bg-opacity-100 focus:outline-none hidden sm:block">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </section>

  <script>
    const clientsData = [
      { name: 'Thales Peterson', niche: 'Football Coach.', views: '10K subs', subs: '20K viewers', image: 'https://nextlevelmedia.digital/components/images/CL6.jpg' },
      { name: 'Dan Kieft', niche: 'Content Creator', views: '78K subs', subs: '1M viewers', image: 'https://nextlevelmedia.digital/components/images/CL5.jpg' },
      { name: 'Trade with Pat', niche: 'Trading Related Niche', views: '200K subs', subs: '3M viewers', image: 'https://nextlevelmedia.digital/components/images/CL1.jpg' },
      { name: 'Kallaway', niche: 'Creator Growth Strategy Niche', views: '', subs: '2M viewers', image: 'https://nextlevelmedia.digital/components/images/CL3.jpg' },
      { name: 'Revive Systems', niche: 'Fitness Related Niche', views: '$60K sales', subs: '', image: 'https://nextlevelmedia.digital/components/images/CL4.jpg' }
    ];

    const carouselWrapper = document.getElementById('carousel-wrapper');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const carouselDotsContainer = document.getElementById('carousel-dots');

    let currentIndex = 0;
    let itemsPerView = 1;
    let slides = [];
    let totalSlides = 0;
    let intervalId;
    const autoSlideInterval = 5000;

    function renderSlides() {
      carouselWrapper.innerHTML = '';
      clientsData.forEach(client => {
        const slideDiv = document.createElement('div');
        slideDiv.classList.add('carousel-slide', 'flex-shrink-0', 'w-full', 'sm:w-1/2', 'lg:w-1/3', 'p-4');
        slideDiv.innerHTML = `
          <div class="card-inner relative rounded-xl shadow-lg bg-gradient-to-b from-zinc-900 via-black to-zinc-800">
            <img src="${client.image}" alt="${client.name}" class="w-full h-64 object-cover rounded-t-xl">
            <div class="p-6">
              <h3 class="text-xl font-semibold text-white mb-2">${client.name}</h3>
              <p class="text-gray-400 text-sm mb-4">${client.niche}</p>
              <div class="flex items-center justify-between text-gray-400 text-sm">
                ${client.views ? `<span>${client.views}</span>` : ''}
                ${client.subs ? `<span>${client.subs}</span>` : ''}
              </div>
            </div>
          </div>`;
        carouselWrapper.appendChild(slideDiv);
      });
      slides = Array.from(carouselWrapper.children);
      totalSlides = slides.length;
    }

    function updateItemsPerView() {
      if (window.innerWidth >= 1024) {
        itemsPerView = 3;
      } else if (window.innerWidth >= 640) {
        itemsPerView = 2;
      } else {
        itemsPerView = 1;
      }
      updateCarousel();
      generateDots();
    }

    function generateDots() {
      carouselDotsContainer.innerHTML = '';
      const numDots = Math.ceil(totalSlides / itemsPerView);
      for (let i = 0; i < numDots; i++) {
        const dot = document.createElement('div');
        dot.classList.add('carousel-dot');
        if (i === Math.floor(currentIndex / itemsPerView)) {
          dot.classList.add('active');
        }
        dot.dataset.index = i * itemsPerView;
        dot.addEventListener('click', () => {
          currentIndex = parseInt(dot.dataset.index);
          updateCarousel();
          resetAutoSlide();
        });
        carouselDotsContainer.appendChild(dot);
      }
    }

    function updateDots() {
      const dots = Array.from(carouselDotsContainer.children);
      dots.forEach(dot => {
        const dotPageIndex = Math.floor(parseInt(dot.dataset.index) / itemsPerView);
        const currentPageIndex = Math.floor(currentIndex / itemsPerView);
        dot.classList.toggle('active', dotPageIndex === currentPageIndex);
      });
    }

    function updateCarousel() {
      const slideWidth = slides[0].offsetWidth;
      const translateValue = -(currentIndex * slideWidth);
      carouselWrapper.style.transform = `translateX(${translateValue}px)`;
      updateDots();
    }

    function nextSlide() {
      const maxIndex = totalSlides - itemsPerView;
      currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
      updateCarousel();
    }

    function prevSlide() {
      const maxIndex = totalSlides - itemsPerView;
      currentIndex = currentIndex > 0 ? currentIndex - 1 : maxIndex;
      updateCarousel();
    }

    function startAutoSlide() {
      intervalId = setInterval(nextSlide, autoSlideInterval);
    }

    function resetAutoSlide() {
      clearInterval(intervalId);
      startAutoSlide();
    }

    prevBtn.addEventListener('click', () => { prevSlide(); resetAutoSlide(); });
    nextBtn.addEventListener('click', () => { nextSlide(); resetAutoSlide(); });
    window.addEventListener('resize', () => { updateItemsPerView(); resetAutoSlide(); });

    window.onload = function () {
      renderSlides();
      updateItemsPerView();
      startAutoSlide();
    };

    document.addEventListener('DOMContentLoaded', function () {
      const heading = document.getElementById('feedbackHeading');
      const sub = document.getElementById('feedbackSub');
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
</html>
