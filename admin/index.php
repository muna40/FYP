<?php
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Griha Sewa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <!-- Hero Section -->
    <section class="hero">
        <h3> तपाईंको सन्तुष्टि,<br> 
            हाम्रो प्राथमिकता !!</h3>
        <input type="text" placeholder="Search here...">
        <br><br>
        <button class="contactus-button">Contact Us</button>
    </section>
    <hr>
    
    <!-- Service Categories Section -->
    <section class="service-categories">
        <h2>Our Goals</h2>
        <div class="services">
            <div class="service-item">
                <img src="images/repair.png" alt="AC Repair">
                <h4>REPAIR</h4>
            </div>
            <div class="service-item">
                <img src="images/improve.png" alt="Carpenter">
                <h4>IMPROVE</h4>
            </div>
            <div class="service-item">
                <img src="images/maintain.png" alt="Electrician">
                <h4>MAINTAIN</h4>
            </div>
        </div>
    </section>

    <!-- Recommended Section -->
    <section class="recommended">
        <h2>We Provide</h2>
        <br>
        <div class="recommendation-icons">
            <div class="icon">
                <img src="images/fast-services.png" alt="Fast Services">
                <p>Fast Services</p>
            </div>
            <div class="icon">
                <img src="images/safety.png" alt="Safety">
                <p>Safety</p>
            </div>
            <div class="icon">
                <img src="images/Experience&Expertise.png" alt="Experience & Expertise">
                <p>Experience & Expertise</p>
            </div>
            <div class="icon">
                <img src="images/CustomerSupport.png" alt="Customer Support">
                <p>Customer Support</p>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-logo">
            <img src="images/.png" alt="">
            <h3>Griha Sewa</h3><br>
            <p>"Trusted solutions for every corner of your home."</p>
        </div>
        <div class="footer-links">
            <div>
                <h4>Customer Support</h4><br>
                <p>Griha Sewa</p><br>
                <p>grihasewa@gmail.com</p><br>
                <p>+977 9805339948</p>
            </div>
            <div>
                <h4>Quick Links</h4><br>
                <ul>
                    <li><a href="login.html">Login/Register</a></li><br>
                    <li><a href="#">About Us</a></li><br>
                    <li><a href="#">Book Now</a></li>
                </ul>
            </div>
            <div>
                <h4>Legal</h4><br>
                <ul>
                    <li><a href="#">Privacy Policy</a></li><br>
                    <li><a href="#">Terms of Use</a></li><br>
                    <li><a href="#">FAQs</a></li><br>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
