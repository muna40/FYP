<?php
session_start();
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
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Griha Sewa Logo">
            <h1>Griha Sewa</h1>
        </div>
        <br>
      
        <!-- Navigation Links -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <li><a href="feedback.php">Feedback</a></li>

                <?php if (isset($_SESSION['login_admin'])): ?>
                    <li><a href="users.php">User-Information</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Welcome Message and Buttons -->
        <?php if (isset($_SESSION['login_admin'])): ?>
    <div class="welcome-message" style="display: flex; align-items: center;">
        <div style="flex-grow: 1; color: black; font-size: 18px;">
            <?php 
               
                $profile_image = isset($_SESSION['pic']) ? $_SESSION['pic'] : 'default.jpg'; 
            ?>
            <img src="images/<?= htmlspecialchars($profile_image); ?>" alt="Profile Image" width="50" height="50" style="border-radius: 50%; margin-right: 10px;">
            <?= htmlspecialchars($_SESSION['login_admin']); ?>
        </div>
        <div class="auth-buttons">
            <a href="logout.php">Logout</a> <!-- Redirect to a proper logout script -->
        </div>
    </div>
<?php else: ?>
    <div class="auth-buttons">
        <a href="admin_login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    </div>
<?php endif; ?>

    </header>
</body>
</html>
