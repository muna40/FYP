<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>


    
<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
    .srch
    {
        padding-left: 1000px;
    }

    body 
    {
        font-family: "Lato", sans-serif;
        transition: background-color .5s;
    }

    .sidenav {
        height: 100%;
        margin-top: 102px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #222;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }

    .img-circle {
        margin-left: 20px;
    }

    .h:hover {
        color:white;
        width: 300px;
        height: 50px;
        background-color: #00544c;
    }
</style>

</header>
<hr>
<body>
<!--_________________sidenav_______________-->

<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

<div style="color: white; margin-left: 60px; font-size: 20px;">
            <?php
            if (isset($_SESSION['login_admin'])) {
                // Ensure the correct image path is used
                $imagePath = isset($_SESSION['pic']) ? htmlspecialchars($_SESSION['pic'], ENT_QUOTES) : 'user.png';
                echo "<img class='img-circle profile_img' height='120' width='120' src='images/$imagePath' alt='Profile Image'>";
                echo "<br><br>";
                echo "Welcome " . htmlspecialchars($_SESSION['login_admin'], ENT_QUOTES);
            } else {
                echo "No user logged in.";
            }
            ?>
        </div>
<br><br>
<div class="h"><a href="profile.php">Profile</a></div><br>
<div class="h"><a href="add.php">Add Services</a></div><br>
<div class="h"><a href="request.php">Request Booking</a></div><br>
<div class="h"><a href="booked_info.php">Booked Information</a></div>
</div>

<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
</div>

<script>
// Sidebar open/close functionality
function openNav() {
document.getElementById("mySidenav").style.width = "300px";
document.getElementById("main").style.marginLeft = "300px";
document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
document.getElementById("mySidenav").style.width = "0";
document.getElementById("main").style.marginLeft = "0";
document.body.style.backgroundColor = "white";
}

// Initialize sidebar as closed
document.getElementById("mySidenav").style.width = "0";
document.getElementById("main").style.marginLeft = "0";
document.body.style.backgroundColor = "white";
</script>
<div class="srch">
<form class="navbar-form" method="post">
        <input class="form-control" type="text" name="search" placeholder="Search users..." required>
        <button style="background-color: #6db6b9e6; padding: 10px 20px; font-size: 16px; cursor: pointer;" type="submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span> Search
        </button>
    </form>
		</div>

<h2 style="text-align: center;">List Of Users</h2>

<?php
// Handle search functionality
if (isset($_POST['submit'])) {
    $search_query = $_POST['search'];

    // Prepared statement to prevent SQL injection
    $search_sql = "SELECT Sid, service_name, description, price, category, availability, created_at, updated_at, Picture 
                   FROM services 
                   WHERE service_name LIKE ?";

    $stmt = mysqli_prepare($db, $search_sql);
    $search_param = "%$search_query%";
    mysqli_stmt_bind_param($stmt, "s", $search_param);
    mysqli_stmt_execute($stmt);
    $search_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($search_result) == 0) {
        echo "<p style='text-align: center; font-size: 16px; color: #ff0000;'>Sorry! No services found with that name. Try searching again.</p>";
    } else {
        echo "<div style='display: flex; justify-content: center;'>";
        echo "<table style='border-spacing: 10px; border-collapse: separate; width: 80%; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
        echo "<tr style='background-color: #6db6b9e6; color: #fff;'>";
        echo "<th style='padding: 10px;'>Service Name</th>";
        echo "<th style='padding: 10px;'>Description</th>";
        echo "<th style='padding: 10px;'>Price</th>";
        echo "<th style='padding: 10px;'>Category</th>";
        echo "<th style='padding: 10px;'>Availability</th>";
        echo "<th style='padding: 10px;'>Picture</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($search_result)) {
            echo "<tr style='background-color: #f9f9f9;'>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['service_name'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['description'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>$" . number_format($row['price'], 2) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['category'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['availability'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'><img src='" . htmlspecialchars($row['Picture'], ENT_QUOTES) . "' alt='Service Image' width='100'></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    mysqli_stmt_close($stmt); // Close prepared statement
} else {
    // Default display: list all services
    $res = mysqli_query($db, "SELECT * FROM `services` ORDER BY `service_name` ASC");

    if (mysqli_num_rows($res) == 0) {
        echo "<p style='text-align: center; font-size: 16px; color: #ff0000;'>Sorry! No services available.</p>";
    } else {
        echo "<div style='display: flex; justify-content: center;'>";
        echo "<table style='border-spacing: 10px; border-collapse: separate; width: 80%; border: 1px solid #ccc; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
        echo "<tr style='background-color: #6db6b9e6; color: #fff;'>";
        echo "<th style='padding: 10px;'>Service Name</th>";
        echo "<th style='padding: 10px;'>Description</th>";
        echo "<th style='padding: 10px;'>Price</th>";
        echo "<th style='padding: 10px;'>Category</th>";
        echo "<th style='padding: 10px;'>Availability</th>";
        echo "<th style='padding: 10px;'>Picture</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr style='background-color: #f9f9f9;'>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['service_name'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['description'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>$" . number_format($row['price'], 2) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['category'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($row['availability'], ENT_QUOTES) . "</td>";
            echo "<td style='padding: 10px;'><img src='" . htmlspecialchars($row['Picture'], ENT_QUOTES) . "' alt='Service Image' width='100'></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}
?>

</body>
<br><br><br>

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
