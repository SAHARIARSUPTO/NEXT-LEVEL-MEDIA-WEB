<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Level Up Your Business!</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d; /* Dark background */
            overflow: hidden; /* Hide scrollbars for the background effect */
        }

        /* Custom gradient background for the main section */
        .gradient-bg {
            background: radial-gradient(circle at 50% 50%, rgba(138, 43, 226, 0.2) 0%, rgba(0, 0, 0, 0) 70%),
                        radial-gradient(circle at 80% 20%, rgba(75, 0, 130, 0.15) 0%, rgba(0, 0, 0, 0) 60%),
                        radial-gradient(circle at 20% 80%, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0) 50%);
            background-color: #1a1a2e; /* Base dark color */
        }

        /* Animation for text elements */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .fade-in-up.delay-1 { animation-delay: 0.2s; }
        .fade-in-up.delay-2 { animation-delay: 0.4s; }
        .fade-in-up.delay-3 { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


    </style>
</head>
<body class="flex items-center justify-center  pt-16 pb-16 mb-16">

    <div class="relative w-full max-w-4xl mx-auto bg-gray-900 rounded-3xl shadow-2xl overflow-hidden
                p-6 md:p-12 lg:p-16 flex flex-col items-center justify-center text-center
                 ">

        <!-- Gradient background overlay -->
        <div class="absolute inset-0 gradient-bg"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full">
            <p class="text-gray-400 text-sm md:text-base font-semibold uppercase tracking-widest mb-4 fade-in-up">
                Work With Us
            </p>
            <h1 class="text-white text-4xl md:text-6xl lg:text-7xl font-extrabold mb-2 leading-tight fade-in-up delay-1">
                Let's Level Up
            </h1>
            <h2 class="text-purple-400 text-4xl md:text-6xl lg:text-7xl font-extrabold mb-12 leading-tight fade-in-up delay-2">
                Your Business!
            </h2>


    </div>
    <div class="container mx-auto p-4">
      <div class="bg-white rounded-lg shadow p-4 mb-4">
        <!-- Card content -->
      </div>
      <div class="bg-gray-100 rounded-lg shadow p-4">
        <!-- New component -->
      </div>
    </div>

    <script>
        // Simple JavaScript to trigger the animations on load
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach(el => {
                el.style.opacity = 0; // Ensure initial state is hidden
                el.style.transform = 'translateY(20px)'; 
                
            });
        });
    </script>
</body>
</html>
