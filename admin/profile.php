<?php
    include "connection.php";
    include "navbar.php";

    // Check if the user is logged in before accessing the profile
    if (!isset($_SESSION['login_admin'])) {
        header("location: admin_login.php"); // Redirect to the login page if not logged in
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style type="text/css">
        .wrapper
        {
            width: 300px;
            margin: 0 auto;
        }
        .profile-img {
            height: 110px;
            width: 120px;
        }
    </style>
</head>
<hr>
<body>
    
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: lavender; margin: 0;">
    <div class="container" style="width: 60%; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <form action="" method="">
            <button class="btn btn-default" style="display: block; margin-left: 650px; width: 100px; padding: 10px; font-size: 16px; background-color: #4CAF50; 
            color: white; border: none; border-radius: 5px; cursor: pointer;" name="Submit1">Edit</button>
        </form>
        <div class="wrapper" style="text-align: center;">
        <?php
            // Ensure the session variable is set
            if (isset($_SESSION['login_admin'])) {
                $q = mysqli_query($db, "SELECT * FROM admin WHERE username='$_SESSION[login_admin]';");

                // Check if query executed successfully
                if ($q) {
                    $row = mysqli_fetch_assoc($q);

                    if ($row) {
                        echo "<h2>My Profile</h2>";
                        echo "<div style='margin-bottom: 20px;'>
                        <img class='img-circle profile-img' src='images/" . $row['pic'] . "' alt='profile picture' style='width: 120px; height: 120px; border-radius: 50%;'>
                        </div>";
        ?>
                        <div><b>Welcome,</b>
                            <h4>
                                <?php echo $_SESSION['login_admin']; ?>
                            </h4>
                        </div>
                        <?php
                        echo "<table class='table table-bordered' style='width: 100%; border-collapse: collapse; margin: 20px auto; text-align: left; font-family: Arial, sans-serif;'>";
                        echo "<thead style='background-color: #f2f2f2;'>";
                        echo "<tr style='border-bottom: 2px solid #ddd;'>";
                        echo "<th style='padding: 10px; text-align: left;'>Field</th>";
                        echo "<th style='padding: 10px; text-align: left;'>Details</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        echo "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'><b>First Name:</b></td><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $row['first_name'] . "</td></tr>";
                        echo "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'><b>Last Name:</b></td><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $row['last_name'] . "</td></tr>";
                        echo "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'><b>User Name:</b></td><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $row['username'] . "</td></tr>";
                        echo "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'><b>Password:</b></td><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $row['password'] . "</td></tr>";
                        echo "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'><b>Email:</b></td><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $row['email'] . "</td></tr>";
                        echo "<tr><td style='padding: 10px;'><b>Contact:</b></td><td style='padding: 10px;'>" . $row['contact'] . "</td></tr>";

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No data found for the logged-in admin.</p>";
                    }
                } else {
                    echo "<p>Error executing query: " . mysqli_error($db) . "</p>";
                }
            } else {
                echo "<p>Session not set. Please log in.</p>";
            }
        ?>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer>
        <div class="footer-logo">
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
                    <li><a href="login.php">Login/Register</a></li><br>
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
