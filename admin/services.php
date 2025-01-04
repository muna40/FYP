<?php
include "connection.php";
include "navbar.php"; // Make sure session_start() is already called in navbar.php
// session_start(); // Remove this line since it's already included in navbar.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        .srch {
            padding-left: 1000px;
        }

        body {
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
            color: white;
            width: 300px;
            height: 50px;
            background-color: #00544c;
        }

        /* Added styles for gaps */
        .table-container {
            margin: 20px;
        }

        table {
            margin-top: 20px;
            border-spacing: 0 15px; /* Adds gap between rows */
            width: 100%;
            border-collapse: collapse; /* Ensures table borders are applied correctly */
        }

        table th, table td {
            padding: 15px;
            border: 1px solid #ddd; /* Add border to each cell */
        }

        th {
            background-color: #6db6b9e6;
        }

        /* Added styles for footer images */
        .footer-logo img {
            width: 50px; /* Adjust the size of the logo */
            height: auto;
        }
    </style>

    <hr>
    <body>
    <!--_________________sidenav_______________-->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="color: white; margin-left: 60px; font-size: 20px;">
            <?php
            if (isset($_SESSION['login_admin'])) {
                $imagePath = htmlspecialchars($_SESSION['pic'], ENT_QUOTES); // Safe handling
                echo "<img class='img-circle profile_img' height='120' width='120' src='images/" . $imagePath . "' alt='Profile Image'>";
                echo "<br><br>";
                echo "Welcome " . htmlspecialchars($_SESSION['login_admin'], ENT_QUOTES);
            } else {
                echo "No user logged in.";
            }
            ?>
        </div>

        <br><br>

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
        <input class="form-control" type="text" name="search" placeholder="Search services..." required>
        <button style="background-color: #6db6b9e6; padding: 10px 20px; font-size: 16px; cursor: pointer;" type="submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span> Search
        </button>
    </form>
    <form class="navbar-form" method="post">
        <input class="form-control" type="text" name="bid" placeholder="Enter Service ID" required>
        <button style="background-color: #6db6b9e6; padding: 10px 20px; font-size: 16px; cursor: pointer;" type="submit" name="submit_delete" class="btn btn-default">Delete</button>
    </form>
    </div>

    <h2 style="text-align: center;">List Of Services</h2>

    <div class="table-container">
    <?php
    if (isset($_POST['submit'])) {
        $search_query = mysqli_real_escape_string($db, $_POST['search']);
        
        $search_sql = "SELECT * FROM services WHERE service_name LIKE '%$search_query%' OR category LIKE '%$search_query%'";
        
        $search_result = mysqli_query($db, $search_sql);

        if (mysqli_num_rows($search_result) == 0) {
            echo "<p>Sorry! No service found. Try searching again.</p>";
        } else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr>";
            echo "<th>SID</th>";
            echo "<th>Service Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
            echo "<th>Category</th>";
            echo "<th>Availability</th>";
            echo "<th>Created At</th>";
            echo "<th>Updated At</th>";
            echo "<th>Picture</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($search_result)) {
                echo "<tr>";
                echo "<td>" . $row['Sid'] . "</td>";
                echo "<td>" . $row['service_name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['availability'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>" . $row['updated_at'] . "</td>";

                if (!empty($row['Picture'])) {
                    echo "<td><img src='images/" . htmlspecialchars($row['Picture'], ENT_QUOTES) . "' alt='" . htmlspecialchars($row['service_name'], ENT_QUOTES) . "' width='50' height='50'></td>";
                } else {
                    echo "<td>No Image</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        // Default query to display all services if no search is performed
        $res = mysqli_query($db, "SELECT * FROM services ORDER BY service_name ASC");

        if (mysqli_num_rows($res) == 0) {
            echo "<p>Sorry! No service found. Try searching again.</p>";
        } else {
            // Display the results in a table
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr>";
            echo "<th>SID</th>";
            echo "<th>Service Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
            echo "<th>Category</th>";
            echo "<th>Availability</th>";
            echo "<th>Created At</th>";
            echo "<th>Updated At</th>";
            echo "<th>Picture</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['Sid'] . "</td>";
                echo "<td>" . $row['service_name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['availability'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>" . $row['updated_at'] . "</td>";

                if (!empty($row['Picture'])) {
                    echo "<td><img src='images/" . htmlspecialchars($row['Picture'], ENT_QUOTES) . "' alt='" . htmlspecialchars($row['service_name'], ENT_QUOTES) . "' width='50' height='50'></td>";
                } else {
                    echo "<td>No Image</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    // Handle service deletion request
    if (isset($_POST['submit_delete'])) {
        $service_id = mysqli_real_escape_string($db, $_POST['bid']);

        // Ensure that the service exists before deleting
        $check_sql = "SELECT * FROM services WHERE Sid = '$service_id'";
        $check_result = mysqli_query($db, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Perform the delete operation
            $delete_sql = "DELETE FROM services WHERE Sid = '$service_id'";
            if (mysqli_query($db, $delete_sql)) {
                echo "<p>Service deleted successfully!</p>";
            } else {
                echo "<p>Failed to delete service.</p>";
            }
        } 
    }
    ?>
    <br><br>
    <footer>
        <div class="footer-logo">
            <img src="images/logo.png" alt="">
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
