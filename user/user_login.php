<?php
include "connection.php";
include "navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Griha Sewa</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // JavaScript function to display pop-up messages
        function showAlert(message, type) {
            alert(type.toUpperCase() + ": " + message);
        }
    </script>
</head>
<body>
    <hr>
    <section>
        <div class="log_img">
            <br><br><br>
            <div class="box1">
                <h1 style="text-align: center; font-size: 36px; font-family: lucida console;">Griha Sewa</h1> <br> 
                <h1 style="text-align: center; font-size: 32px; font-family: lucida console;">Admin Login Form</h1> <br> <br>
                <form name="login" action="" method="POST">
                    <div class="login" style="padding-bottom: 71px; margin-bottom: -84px;"> 
                        <input class="form-control" type="text" name="username" placeholder="Username" required> <br><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required> <br>
                        <input class="btn btn-default" type="submit" name="submit" value="Login" style="color:black; width: 70px; height: 37px;">
                    </div>
                    <p style="color: black; padding-left: 50px;">
                        <br>
                        <a style="color: black;" href="#">Forgot password?</a> <br>
                        New to this website? <a style="color: black;" href="signup.php">Sign Up</a>
                    </p> 
                </form>
            </div>
        </div>
    </section>

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

    <?php
        if (isset($_POST['submit'])) 
        {
            $count = 0;
            $res=mysqli_query($db, "SELECT * FROM user WHERE username='$_POST[username]' && password='$_POST[password]';");
            $row=mysqli_fetch_assoc($res);
            $count = mysqli_num_rows($res);

            if ($count == 0) 
            {
    ?>
                <!--
                <script type="text/javascript">
                    window.location = "index.php"
                </script>   -->
                <div class="alert alert-danger" style="width: 600px; margin-left: 370px; background-color: #de1313; color: white">
                    <strong>The username and password doesn't match</strong>
                </div>
            <?php
            } else 
            {
                $_SESSION['login_user'] = $_POST['username'];
                $_SESSION['pic']=$row['pic'];

                ?>
                <script type="text/javascript">
                    window.location = "index.php"
                </script>
    <?php
            }
        } 
    ?>
</body>
</html>
