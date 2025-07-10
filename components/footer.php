<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Level Media Footer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Pure black background for the body, ensuring consistency */
        body {
            background-color: #000000; /* Pure Black */
            font-family: 'Space Grotesk', sans-serif; /* Changed to Space Grotesk */
            color: #F3F4F6; /* Light text color */
            
        }

        /* Custom styles for subtle hover effects on links and icons */
        .footer-link:hover, .social-icon:hover {
            color: #9CA3AF; /* Gray-400 on hover */
            transition: color 0.3s ease;
        }

        /* Modal specific styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure it's on top */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #1a1a1a; /* Dark background for modal */
            border-radius: 0.75rem; /* rounded-xl */
            padding: 2rem;
            max-width: 90%;
            max-height: 90%;
            overflow-y: auto; /* Enable scrolling for long content */
            position: relative;
            transform: translateY(20px); /* Start slightly below */
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal-overlay.open .modal-content {
            transform: translateY(0); /* Slide into view */
            opacity: 1;
        }

        .modal-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #9CA3AF; /* Gray-400 */
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .modal-close-btn:hover {
            color: #F3F4F6; /* Light text color on hover */
        }

        /* Responsive text sizes for modal content */
        .modal-text-responsive {
            font-size: 0.875rem; /* Default text-sm for mobile */
        }
        @media (min-width: 640px) { /* sm breakpoint */
            .modal-text-responsive {
                font-size: 1rem; /* text-base */
            }
        }
        @media (min-width: 1024px) { /* lg breakpoint */
            .modal-text-responsive {
                font-size: 1.125rem; /* text-lg */
            }
        }
    </style>
</head>
<body class="bg-black">
    <footer class="bg-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Top Section: Logo and Navigation Links -->
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left mb-8">
                <!-- Logo -->
                <div class="mb-6 sm:mb-0">
                    <a href="#" class="text-white text-2xl font-bold uppercase tracking-wider">
                        Next Level Media
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8 text-gray-300 text-sm sm:text-base">
                    <a href="#" id="terms-link" class="footer-link hover:text-gray-400">Terms & Conditions</a>
                    <a href="#" id="refund-link" class="footer-link hover:text-gray-400">Refund Policy</a>
                    <a href="#" id="privacy-link" class="footer-link hover:text-gray-400">Privacy Policy</a>
                </nav>
            </div>

            <!-- Separator Line -->
            <hr class="border-gray-700 my-8">

            <!-- Bottom Section: Copyright and Social Icons -->
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left text-gray-500 text-sm">
                <!-- Copyright Text -->
                <p class="mb-6 sm:mb-0">
                    &copy; 2025 Next Level Media | All rights reserved.
                </p>

                <!-- Social Media Icons -->
                <div class="flex space-x-6 text-xl">
                    <a href="https://www.instagram.com/nextlevelmedia_production/" target=_blank  class="social-icon hover:text-white" aria-label="LinkedIn">
                        <i class="fab fa-instagram"></i>
                    </a>
                    
                    <a href="https://www.facebook.com/nextzenedit" target=_blank class="social-icon hover:text-white" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Terms & Conditions Modal -->
    <div id="terms-modal" class="modal-overlay hidden">
        <div class="modal-content w-full sm:w-3/4 lg:w-1/2">
            <button class="modal-close-btn" data-modal-id="terms-modal">&times;</button>
            <h3 class="text-2xl font-bold text-white mb-4">Terms & Conditions</h3>
            <p class="modal-text-responsive text-gray-300 leading-relaxed">
                Welcome to Next Level Media! These terms and conditions outline the rules and regulations for the use of Next Level Media's Website.
                By accessing this website we assume you accept these terms and conditions. Do not continue to use Next Level Media if you do not agree to take all of the terms and conditions stated on this page.
                The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.
                <br><br>
                **Cookies:** We employ the use of cookies. By accessing Next Level Media, you agreed to use cookies in agreement with the Next Level Media's Privacy Policy. Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.
                <br><br>
                **License:** Unless otherwise stated, Next Level Media and/or its licensors own the intellectual property rights for all material on Next Level Media. All intellectual property rights are reserved. You may access this from Next Level Media for your own personal use subjected to restrictions set in these terms and conditions.
                <br><br>
                You must not:
                * Republish material from Next Level Media
                * Sell, rent or sub-license material from Next Level Media
                * Reproduce, duplicate or copy material from Next Level Media
                * Redistribute content from Next Level Media
                <br><br>
                This Agreement shall begin on the date hereof. Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Next Level Media does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Next Level Media,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Next Level Media shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.
                <br><br>
                Next Level Media reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.
                <br><br>
                You warrant and represent that:
                * You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;
                * The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;
                * The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy
                * The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.
                <br><br>
                You hereby grant Next Level Media a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.
            </p>
        </div>
    </div>

    <!-- Refund Policy Modal -->
    <div id="refund-modal" class="modal-overlay hidden">
        <div class="modal-content w-full sm:w-3/4 lg:w-1/2">
            <button class="modal-close-btn" data-modal-id="refund-modal">&times;</button>
            <h3 class="text-2xl font-bold text-white mb-4">Refund Policy</h3>
            <p class="modal-text-responsive text-gray-300 leading-relaxed">
                At Next Level Media, we strive for your complete satisfaction with our services. Our refund policy is as follows:
                <br><br>
                **1. Eligibility for Refund:**
                Refunds are considered on a case-by-case basis. Generally, refunds may be issued if:
                * The service was not delivered as described.
                * There was a clear and demonstrable failure on our part to meet agreed-upon service levels.
                * A request for cancellation is made within a specified cooling-off period (if applicable to the service).
                <br><br>
                **2. Non-Refundable Services:**
                Certain services, once initiated or completed, may be non-refundable. This includes, but is not limited to:
                * Custom strategy development and consultation fees.
                * Third-party advertising spend (e.g., Google Ads, Facebook Ads).
                * Services where significant work has already been performed and delivered.
                <br><br>
                **3. Refund Process:**
                To request a refund, please contact our support team at [Your Support Email] within [Number] days of the issue arising. You will need to provide:
                * Your name and contact information.
                * Details of the service purchased.
                * A clear explanation of why you are requesting a refund.
                * Any supporting documentation or evidence.
                <br><br>
                We will review your request and respond within [Number] business days. If approved, refunds will be processed back to the original payment method within [Number] business days. Please note that it may take additional time for the refund to appear on your statement depending on your bank or payment provider.
                <br><br>
                **4. Changes to Policy:**
                Next Level Media reserves the right to modify this refund policy at any time. Any changes will be posted on this page.
            </p>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacy-modal" class="modal-overlay hidden">
        <div class="modal-content w-full sm:w-3/4 lg:w-1/2">
            <button class="modal-close-btn" data-modal-id="privacy-modal">&times;</button>
            <h3 class="text-2xl font-bold text-white mb-4">Privacy Policy</h3>
            <p class="modal-text-responsive text-gray-300 leading-relaxed">
                Your privacy is critically important to us. At Next Level Media, we have a few fundamental principles:
                <br><br>
                * We don’t ask you for personal information unless we truly need it.
                * We don’t share your personal information with anyone except to comply with the law, develop our products, or protect our rights.
                * We don’t store personal information on our servers unless required for the on-going operation of one of our services.
                <br><br>
                It is Next Level Media's policy to respect your privacy regarding any information we may collect while operating our website.
                <br><br>
                **Website Visitors:** Like most website operators, Next Level Media collects non-personally-identifying information of the sort that web browsers and servers typically make available, such as the browser type, language preference, referring site, and the date and time of each visitor request. Next Level Media’s purpose in collecting non-personally identifying information is to better understand how Next Level Media’s visitors use its website. From time to time, Next Level Media may release non-personally-identifying information in the aggregate, e.g., by publishing a report on trends in the usage of its website.
                <br><br>
                Next Level Media also collects potentially personally-identifying information like Internet Protocol (IP) addresses for logged in users and for users leaving comments on [Blog URL] blogs/sites. Next Level Media only discloses logged in user and commenter IP addresses under the same circumstances that it uses and discloses personally-identifying information as described below.
                <br><br>
                **Gathering of Personally-Identifying Information:** Certain visitors to Next Level Media’s websites choose to interact with Next Level Media in ways that require Next Level Media to gather personally-identifying information. The amount and type of information that Next Level Media gathers depends on the nature of the interaction. For example, we ask visitors who sign up at [Your Website URL] to provide a username and email address. Those who engage in transactions with Next Level Media are asked to provide additional information, including as necessary the personal and financial information required to process those transactions. In each case, Next Level Media collects such information only insofar as is necessary or appropriate to fulfill the purpose of the visitor’s interaction with Next Level Media. Next Level Media does not disclose personally-identifying information other than as described below. And visitors can always refuse to supply personally-identifying information, with the caveat that it may prevent them from engaging in certain website-related activities.
                <br><br>
                **Protection of Certain Personally-Identifying Information:** Next Level Media discloses potentially personally-identifying and personally-identifying information only to those of its employees, contractors and affiliated organizations that (i) need to know that information in order to process it on Next Level Media’s behalf or to provide services available at Next Level Media’s websites, and (ii) that have agreed not to disclose it to others. Some of those employees, contractors and affiliated organizations may be located outside of your home country; by using Next Level Media’s websites, you consent to the transfer of such information to them. Next Level Media will not rent or sell potentially personally-identifying and personally-identifying information to anyone. Other than to its employees, contractors and affiliated organizations, as described above, Next Level Media discloses potentially personally-identifying and personally-identifying information only in response to a subpoena, court order or other governmental request, or when Next Level Media believes in good faith that disclosure is reasonably necessary to protect the property or rights of Next Level Media, third parties or the public at large.
                <br><br>
                If you are a registered user of an Next Level Media website and have supplied your email address, Next Level Media may occasionally send you an email to tell you about new features, solicit your feedback, or just keep you up to date with what’s going on with Next Level Media and our products. If you send us a request (for example via email or via one of our feedback mechanisms), we reserve the right to publish it in order to help us clarify or respond to your request or to help us support other users. Next Level Media takes all measures reasonably necessary to protect against the unauthorized access, use, alteration or destruction of potentially personally-identifying and personally-identifying information.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get references to the policy links
            const termsLink = document.getElementById('terms-link');
            const refundLink = document.getElementById('refund-link');
            const privacyLink = document.getElementById('privacy-link');

            // Get references to the modal elements
            const termsModal = document.getElementById('terms-modal');
            const refundModal = document.getElementById('refund-modal');
            const privacyModal = document.getElementById('privacy-modal');

            // Get all close buttons
            const closeButtons = document.querySelectorAll('.modal-close-btn');

            /**
             * Opens a specified modal.
             * @param {HTMLElement} modalElement - The modal element to open.
             */
            function openModal(modalElement) {
                modalElement.classList.add('open');
                modalElement.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling on body when modal is open
            }

            /**
             * Closes a specified modal.
             * @param {HTMLElement} modalElement - The modal element to close.
             */
            function closeModal(modalElement) {
                modalElement.classList.remove('open');
                // Use a timeout to allow the transition to complete before hiding
                setTimeout(() => {
                    modalElement.classList.add('hidden');
                    document.body.style.overflow = ''; // Restore body scrolling
                }, 300); // Match transition duration
            }

            // Add event listeners to open modals
            termsLink.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior
                openModal(termsModal);
            });

            refundLink.addEventListener('click', (e) => {
                e.preventDefault();
                openModal(refundModal);
            });

            privacyLink.addEventListener('click', (e) => {
                e.preventDefault();
                openModal(privacyModal);
            });

            // Add event listeners to close modals using the close button
            closeButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const modalId = e.target.dataset.modalId;
                    const modalToClose = document.getElementById(modalId);
                    if (modalToClose) {
                        closeModal(modalToClose);
                    }
                });
            });

            // Close modal when clicking outside the content (on the overlay)
            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) { // Check if the click was directly on the overlay
                        closeModal(overlay);
                    }
                });
            });
        });
    </script>
</body>
</html>
