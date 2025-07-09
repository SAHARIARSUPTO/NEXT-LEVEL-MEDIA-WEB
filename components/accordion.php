<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>FAQ Accordion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #000000;
      font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
      color: #F3F4F6;
    }

    .accordion-item-header {
      background-color: rgba(255, 255, 255, 0.05);
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.04), rgba(0, 0, 0, 0.15));
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4), 0 6px 12px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .accordion-item-header:hover {
      background-color: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.2);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5), 0 8px 14px rgba(0, 0, 0, 0.3);
    }

    .accordion-item-body {
      background-color: rgba(255, 255, 255, 0.03);
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(6px);
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.5s ease-out, padding 0.5s ease-out;
    }

    .accordion-item-body.open {
      max-height: 500px;
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    .accordion-arrow {
      transition: transform 0.3s ease;
    }

    .accordion-item-header.active .accordion-arrow {
      transform: rotate(180deg);
    }

    .text-responsive {
      font-size: 1rem;
    }

    @media (min-width: 640px) {
      .text-responsive {
        font-size: 1.125rem;
      }
    }

    @media (min-width: 1024px) {
      .text-responsive {
        font-size: 1.25rem;
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
      animation: fadeInUp 0.8s cubic-bezier(.77,0,.18,1) forwards;
      opacity: 1;
    }
    
  </style>
</head>
<body class="min-h-screen text-gray-100  ">

  <section class="w-full max-w-6xl mx-auto pb-24 ">
    <div class="text-center mb-12">
      <p class="text-gray-400 uppercase text-sm tracking-widest mb-2 animated-heading" id="faqSub">Any <span class="text-[#5D3FD3]">Queries You Have</span></p>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight animated-heading" id="faqHeading">Questions You May Ask</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Item 1 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">Tell me about your agency?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            Our agency specializes in digital marketing solutions.
          </p>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">What if I don't get the results?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            We are committed to client success. Our contracts often include performance-based clauses or guarantees.
          </p>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">Tell me about your content plan?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            Our content plans are tailored to your specific business goals and target audience.
          </p>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">Why wouldn't I hire a freelancer?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            While freelancers are great for single tasks, an agency provides a full-team solution...
          </p>
        </div>
      </div>

      <!-- Item 5 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">What services will you provide?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            SEO, content marketing, web development, ads, branding — full digital growth package.
          </p>
        </div>
      </div>

      <!-- Item 6 -->
      <div class="accordion-item rounded-xl overflow-hidden">
        <button class="accordion-item-header w-full flex justify-between items-center p-5 rounded-xl cursor-pointer focus:outline-none">
          <span class="text-responsive font-semibold text-white">Tell me about your workflow?</span>
          <svg class="accordion-arrow w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="accordion-item-body px-5 text-gray-300">
          <p class="text-responsive">
            Discovery → Strategy → Creation → Testing → Results. Transparent and fast-tracked for growth.
          </p>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const accordionHeaders = document.querySelectorAll('.accordion-item-header');

      accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
          const currentItem = header.closest('.accordion-item');
          const body = currentItem.querySelector('.accordion-item-body');

          header.classList.toggle('active');
          body.classList.toggle('open');

          accordionHeaders.forEach(otherHeader => {
            if (otherHeader !== header) {
              const otherItem = otherHeader.closest('.accordion-item');
              const otherBody = otherItem.querySelector('.accordion-item-body');
              otherHeader.classList.remove('active');
              otherBody.classList.remove('open');
            }
          });
        });
      });

      // Heading animation on scroll
      const heading = document.getElementById('faqHeading');
      const sub = document.getElementById('faqSub');
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
