<?php
  include "connection.php";
  include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <hr>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		.srch {
			padding-left: 1000px;
		}

		body {
			background-color: white;
			font-family: "Lato", sans-serif;
			transition: background-color .5s;
		}

		.sidenav {
			height: 100%;
			margin-top: 101px;
			width: 0;
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
			color: white;
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

		.book {
			width: 400px;
			margin: 0px auto;
		}

		.form-control {
			background-color: #98c8ef;
			color: black;
			height: 40px;
		}
	</style>
</head>
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
        </div><br><br>

        <div class="h"><a href="add.php">Add Books</a></div>
        <div class="h"><a href="request.php">Book Request</a></div>
        <div class="h"><a href="issue_info.php">Issue Information</a></div>
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>

        <div class="container" style="text-align: center;">
            <h2 style="color:black; font-family: Lucida Console; text-align: center"><b>Add New Books</b></h2><br>

            <form class="book" action="" method="post" enctype="multipart/form-data">
                <input type="text" name="Sid" class="form-control" placeholder="Service ID" required=""><br>
                <input type="text" name="service_name" class="form-control" placeholder="Service Name" required=""><br>
                <input type="text" name="description" class="form-control" placeholder="Description" required=""><br>
                <input type="text" name="price" class="form-control" placeholder="Price" required=""><br>
                <input type="text" name="category" class="form-control" placeholder="Category" required=""><br>
                <input type="text" name="availability" class="form-control" placeholder="Availability" required=""><br>
                <input type="text" name="created_at" class="form-control" placeholder="Created At" required=""><br>
                <input type="text" name="updated_at" class="form-control" placeholder="Updated At" required=""><br>
                <label style="color:black;">Upload Picture:</label><br>
                <input type="file" name="pic" class="form-control" required=""><br>
                <button style="text-align: center;" class="btn btn-default" type="submit" name="submit">ADD</button>
            </form>
        </div>

        <?php
    // Ensure the form data is safely passed and sanitized
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['login_admin'])) {
            // Assigning the form inputs to variables
            $service_id = $_POST['Sid'];
            $service_name = $_POST['service_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $availability = $_POST['availability'];
            $created_at = $_POST['created_at'];
            $updated_at = $_POST['updated_at'];

            // Sanitize inputs to prevent SQL injection
            $service_id = mysqli_real_escape_string($db, $service_id);
            $service_name = mysqli_real_escape_string($db, $service_name);
            $description = mysqli_real_escape_string($db, $description);
            $price = mysqli_real_escape_string($db, $price);
            $category = mysqli_real_escape_string($db, $category);
            $availability = mysqli_real_escape_string($db, $availability);
            $created_at = mysqli_real_escape_string($db, $created_at);
            $updated_at = mysqli_real_escape_string($db, $updated_at);

            // Check if the service ID already exists
            $check_query = "SELECT * FROM services WHERE Sid = '$service_id'";
            $check_result = mysqli_query($db, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('Service ID already exists. Please use a different ID.');</script>";
            } else {
                // Handle file upload
                // Handle file upload
$picture = $_FILES['pic']['name'];
$temp_name = $_FILES['pic']['tmp_name'];
$folder = "images/" . basename($picture);

// Ensure the directory exists and is writable
if (!is_dir('images')) {
    mkdir('images', 0777, true); // Create the directory if it doesn't exist
}

if (move_uploaded_file($temp_name, $folder)) {
    // Insert the new service data into the database
    $insert_query = "INSERT INTO services (Sid, Service_name, Description, Price, Category, Availability, Created_at, Updated_at, Picture) 
                     VALUES ('$service_id', '$service_name', '$description', '$price', '$category', '$availability', '$created_at', '$updated_at', '$picture')";
    if (mysqli_query($db, $insert_query)) {
        echo "<script>alert('Service Added Successfully.');</script>";
    } else {
        echo "<script>alert('Error adding service.');</script>";
    }
} else {
    echo "<script>alert('Error uploading picture.');</script>";
}

            }
        } else {
            echo "<script>alert('You need to login first.');</script>";
        }
    }
?>

    </div>
    

    <script>
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
    </script>
    
</body>
</html>
