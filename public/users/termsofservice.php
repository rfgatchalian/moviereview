<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Movie Review System - Terms of Service</title>
    <link rel="stylesheet" href="./assets/css/termsofservice.css">
</head>

<body>

    <div id="terms-dialog" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDialog()">&times;</span>
            <div class="container">
                <h1>Cinespectrum Movie Review System - Terms of Service</h1>

                <p><span class="highlight">Last updated: November 14, 2023</span></p>

                <ol>
                    <li>
                        <h2>Acceptance of Terms</h2>
                        <p>
                            Welcome to Cinespectrum Movie Review System! By accessing or using our web-based application, you agree to comply with and be bound by these Terms of Service. If you do not agree with these terms, please refrain from using our services.
                        </p>
                    </li>

                    <li>
                        <h2>User Accounts</h2>
                        <p class="bold">Registered Users:</p>
                        <p>
                            To access certain features of the Cinespectrum Movie Review System, you may be required to create an account. You are responsible for maintaining the confidentiality of your account credentials and agree to notify us immediately of any unauthorized use.
                        </p>

                        <p class="bold">Termination:</p>
                        <p>
                            We reserve the right to terminate or suspend your account at our discretion without prior notice if we believe you have violated these Terms of Service or for any other reason.
                        </p>
                    </li>

                    <li>
                        <h2>User Responsibilities</h2>
                        <p class="bold">Accuracy of Information:</p>
                        <p>
                            You agree to provide accurate and complete information when using the Cinespectrum Movie Review System, including when registering for an account and submitting reviews.
                        </p>

                        <p class="bold">Code of Conduct:</p>
                        <p>
                            Users are expected to conduct themselves in a respectful manner. Any abusive, threatening, or harmful behavior towards other users or our system will not be tolerated.
                        </p>
                    </li>

                    <li>
                        <h2>Movie Reviews and Ratings</h2>
                        <p class="bold">User-Generated Content:</p>
                        <p>
                            Registered users may submit movie reviews and ratings. By submitting content, you grant Cinespectrum the right to use, reproduce, modify, adapt, publish, translate, and distribute the content in any form.
                        </p>

                        <p class="bold">Moderation:</p>
                        <p>
                            We reserve the right to moderate and remove content that violates these Terms of Service or is deemed inappropriate.
                        </p>
                    </li>

                    <li>
                        <h2>Privacy</h2>
                        <p class="bold">Privacy Policy:</p>
                        <p>
                            Your use of Cinespectrum is also governed by our Privacy Policy. Please review it to understand how we collect, use, and disclose information.
                        </p>
                    </li>

                    <li>
                        <h2>Intellectual Property</h2>
                        <p class="bold">Ownership:</p>
                        <p>
                            Cinespectrum and its content, including but not limited to text, graphics, logos, and images, are the property of Cinespectrum. You may not use, reproduce, or distribute our content without prior written permission.
                        </p>
                    </li>

                    <li>
                        <h2>Disclaimer of Warranties</h2>
                        <p>
                            Cinespectrum is provided "as is" and "as available." We make no warranties, express or implied, regarding the accuracy, completeness, reliability, or suitability of the information provided.
                        </p>
                    </li>

                    <li>
                        <h2>Limitation of Liability</h2>
                        <p>
                            Cinespectrum and its affiliates shall not be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with the use of our web-based application.
                        </p>
                    </li>

                    <li>
                        <h2>Changes to Terms</h2>
                        <p>
                            Cinespectrum reserves the right to update or modify these Terms of Service at any time without prior notice. Continued use of our services after such changes constitutes acceptance of the revised terms.
                        </p>
                    </li>

                    <li>
                        <h2>Contact Information</h2>
                        <p>
                            If you have any questions or concerns regarding these Terms of Service, please contact us at <a href="mailto:contact@cinespectrum.com">contact@cinespectrum.com</a>.
                        </p>
                    </li>
                </ol>

                <p class="italic">Thank you for using Cinespectrum Movie Review System! Enjoy exploring the world of cinema through our platform.</p>
            </div>
        </div>
    </div>

    <script>
        function openDialog() {
            document.getElementById("terms-dialog").style.display = "flex";
        }

        function closeDialog() {
            window.location.href = '../index.php';
        }

        // Open the dialog when the page loads (you can trigger it with your own event)
        window.onload = openDialog;
    </script>

</body>

</html>