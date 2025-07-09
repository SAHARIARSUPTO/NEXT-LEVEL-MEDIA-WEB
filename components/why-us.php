<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Why US?</title>
</head>
<style>
     body {
            
            font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
         
            
        }
    .why-card {
  transition: transform 0.4s ease, background-color 0.3s ease, box-shadow 0.4s ease;
  transform: translateY(0);
}

.why-card:hover {
  transform: translateY(-10px) scale(1.02);
  background-color: rgba(0, 0, 0, 0.8); /* subtle dark background */
  box-shadow: 0 20px 40px rgba(128, 0, 128, 0.3); /* purple glow */
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
.why-choose-us-header h4,
.why-choose-us-header h2 {
    opacity: 0;
    transition: opacity 0.3s;
}
.why-choose-us-header.animated h4,
.why-choose-us-header.animated h2 {
    animation: fadeInUp 0.8s cubic-bezier(.77,0,.18,1) forwards;
    opacity: 1;
}
.why-choose-us-header.animated h2 {
    animation-delay: 0.2s;
}
</style>
<body>
    <section class="why-choose-us-section">
        <div class="why-choose-us-bg"></div>
        <div class="why-choose-us-container">
            <div class="why-choose-us-header">
                <h4>WHY WORK US</h4>
                <h2><br><span class="highlight">Here’s How We Do Things Differently
</span></h2>
            </div>
            <div class="why-choose-us-cards ">
                <div class="why-card mz-media-card hover:cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:scale-105 hover:bg-black hover:shadow-[0_20px_40px_rgba(168,85,247,0.3)]">

                    <div class="mz-media-logo">
                        <img src="main-logo.png" alt="next level media" />
                        <span class="mz-media-title">Next Level Media</span>
                    </div>
                    <ul>
                        <li><span class="check">&#10003;</span> In house team of 20+ Experts</li>
                        <li><span class="check">&#10003;</span> Results oriented</li>
                        <li><span class="check">&#10003;</span> Experience with 500+ Clients</li>
                        <li><span class="check">&#10003;</span> Personalised CRM</li>
                        <li><span class="check">&#10003;</span> 24/7 Support, Anytime You Need Us</li>
                    </ul>
                </div>
                <div class="why-card other-agencies-card">
                    <h3>Other Agencies</h3>
                    <ul>
                        <li><span class="cross">&#10005;</span> Unreliable Freelancers with slow turnarounds</li>
                        <li><span class="cross">&#10005;</span> Edits that fail to convert or perform.</li>
                        <li><span class="cross">&#10005;</span> Weak thumbnails and titles with no CTR strategy.</li>
                        <li><span class="cross">&#10005;</span> Lack of proper distribution systems</li>
                        <li><span class="cross">&#10005;</span> No expertise in funnels or lead capture systems.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <style>
        .why-choose-us-section {
            position: relative;
            min-height: 100vh;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* Remove extra space from top and bottom */
            padding-top: 0;
            padding-bottom: 0;
        }
.why-choose-us-bg {
  position: absolute;
  inset: 0;
  background: url('https://cdn.prod.website-files.com/6796419e2d5f03877896246e/67b5dd36b3452df31baf9345_Glow.avif') center/cover no-repeat;
  z-index: 1;
  opacity: 30%;
}

@media (max-width: 1024px) {
  .why-choose-us-bg {
    display: none !important;
    background: none !important;
  }

}
        .why-choose-us-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            /* Remove extra space from top and bottom */
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 24px;
            padding-right: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .why-choose-us-header {
            text-align: center;
            margin-bottom: 48px;
        }
        .why-choose-us-header h4 {
            color: #fff;
            font-size: 1.1rem;
            letter-spacing: 2px;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .why-choose-us-header h2 {
            color: #bdbdbd;
            font-size: 2.5rem;
            font-weight: 400;
            line-height: 1.2;
        }
        .why-choose-us-header .highlight {
            color: #fff;
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: -1px;
        }
        .why-choose-us-cards {
            display: flex;
            gap: 32px;
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
        }
        .why-card {
            background: #000; /* Changed from rgba(20, 22, 34, 0.95) to solid black */
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(0,0,0,0.25);
            padding: 36px 32px;
            min-width: 320px;
            max-width: 400px;
            flex: 1 1 320px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .mz-media-card {
            border: 1.5px solid #000000;
        }
        .other-agencies-card {
            border: 1.5px solid #23232e;
        }
.mz-media-logo {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    /* 50% black */
}

        .mz-media-logo img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #fff;
            object-fit: contain;
        }
        .mz-media-title {
            font-size: 1.7rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }
        .why-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }
        .why-card li {
            font-size: 1.1rem;
            color: #e0e0e0;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        .why-card li:last-child {
            margin-bottom: 0;
        }
        .check {
            color: #6fff8e;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .cross {
            color: #ff6f6f;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .other-agencies-card h3 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 24px;
        }
        @media (max-width: 900px) {
            .why-choose-us-cards {
                flex-direction: column;
                align-items: center;
                gap: 24px;
            }
            .why-card {
                max-width: 100%;
                width: 100%;
            }
        }
        @media (max-width: 600px) {
             .why-choose-us-header h4 {
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .why-choose-us-header h2 {
        font-size: 1.2rem;
    }

    .why-choose-us-header .highlight {
        font-size: 1.5rem;
    }

    .why-card {
        padding: 20px 12px;
        border-radius: 14px;
    }

    .mz-media-logo img {
        width: 32px;
        height: 32px;
    }

    .mz-media-title {
        font-size: 1rem;
    }

    .why-card li {
        font-size: 0.95rem;
    }

    .other-agencies-card h3 {
        font-size: 1.3rem;
    }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const header = document.querySelector('.why-choose-us-header');
            if (!header) return;
            const observer = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            header.classList.add('animated');
                            observer.unobserve(header);
                        }
                    });
                },
                { threshold: 0.5 }
            );
            observer.observe(header);
        });
    </script>
</body>
</html>