<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us - Next Level Media</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    body {
      background-color: #000;
      color: white;
       font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
      transition: transform 0.3s ease;
    }
    .glass:hover {
      transform: translateY(-5px);
    }
    .contact-link {
      transition: all 0.3s ease;
    }
    .contact-link:hover {
      transform: scale(1.05);
      background-color: #1a1a1a;
    }
  </style>
</head>
<body>

  <?php include('components/navbar.php'); ?>

  <section class="min-h-screen flex items-center justify-center px-6 pt-32 pb-20">
    <div class="max-w-3xl w-full glass p-6 sm:p-10 rounded-xl text-white text-xs sm:text-sm md:text-base">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 text-center">Get in Touch with Next Level Media</h2>
      <p class="text-xs sm:text-sm text-gray-300 text-center mb-8">
        We’re not your average agency. We build brands, content machines, and growth systems that deliver results. Let’s start something amazing together!
      </p>

      <div class="space-y-6">

        <div class="bg-purple-600 contact-link text-white px-6 py-4 rounded-lg font-semibold flex items-center justify-between text-xs sm:text-sm md:text-base">
          <span><i class="fas fa-calendar-alt mr-2"></i>Schedule a Meeting</span>
          <a href="https://calendly.com/siamahmedshanto3954/30min" target="_blank" class="underline">Book Now</a>
        </div>
        
        <div class="bg-pink-600 contact-link text-white px-6 py-4 rounded-lg font-semibold flex items-center justify-between text-xs sm:text-sm md:text-base">
          <span><i class="fas fa-calendar-alt mr-2"></i>Visit Us</span>
          <a href="https://www.instagram.com/nextlevelmedia_production/" target="_blank" class="underline">Instagram</a>
        </div>

        <div class="bg-blue-600 contact-link text-white px-6 py-4 rounded-lg font-semibold flex items-center justify-between text-xs sm:text-sm md:text-base">
          <span><i class="fas fa-envelope mr-2"></i>Send us an Email</span>
          <a href="mailto:workforsiambruh@gmail.com?subject=Let's%20Work%20Together" class="underline">workforsiambruh@gmail.com</a>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg text-xs sm:text-sm md:text-base">
          <h3 class="text-lg sm:text-xl font-bold mb-2">Business Hours</h3>
          <p class="text-gray-400">We’re available 24/7 — yes, even at 3AM 🚀</p>
          <p class="text-gray-400">Based in Sylhet, Bangladesh</p>
        </div>

        <div class="bg-gray-900 p-6 rounded-lg text-xs sm:text-sm md:text-base">
          <h3 class="text-lg sm:text-xl font-bold mb-2">What We Do</h3>
          <ul class="list-disc list-inside text-gray-300 space-y-1">
            <li>Performance-Based Marketing</li>
            <li>Video Content & Branding</li>
            <li>Landing Pages & Automation</li>
            <li>Creative Partnerships</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <?php include('components/footer.php'); ?>

</body>
</html>