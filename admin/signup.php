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
</head>
<body>
    <section>
        <div class="reg_img">
            <br><br>
            <div class="box2">
                <h1 style="text-align: center; font-size: 37px; font-family: lucida console;">Griha Sewa</h1> <br>
                <h1 style="text-align: center; font-size: 27px; font-family: lucida console;">Admin Registration Form</h1> <br>
               <form name="Registration" action="" method="post">
               <div class="login"> 
                    <input class="form-control" type="text" name="first" placeholder="First Name" required=""><br>
                    <input class="form-control" type="text" name="last" placeholder="Last Name" required=""><br>
                    <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                    <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                    <input class="form-control" type="text" name="address" placeholder="Address" required=""><br>
                    <input class="form-control" type="email" name="email" placeholder="Email" required=""><br>
                    <input class="form-control" type="text" name="contact" placeholder="Contact" required=""><br>
                    <input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color:black; width: 75px; height: 30px;">
                </div>
               </form>
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

if(isset($_POST['submit'])) {
    $count = 0;

    // Check for existing username
    $sql = "SELECT username FROM `admin` WHERE username='$_POST[username]'";
    $res = mysqli_query($db, $sql);

    if(mysqli_num_rows($res) > 0) {
        $count = 1;
    }

    if($count == 0) {
       
        $sql = "INSERT INTO admin (first_name, last_name, username, password, email, contact) 
                VALUES ('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', '$_POST[email]', '$_POST[contact]','user.png')";

        if(mysqli_query($db, $sql)) {
            ?>
            <script type="text/javascript">
                alert("Registration successful");
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Error: <?php echo mysqli_error($db); ?>");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("The username already exists.");
        </script>
        <?php
    }
}
?>

</body>
</html>
