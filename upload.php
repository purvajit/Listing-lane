<?php
session_start();
include("connection.php");
include("connection2.php");
include("function.php"); //from function.php
$user_data = check_login($con);



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Upload</title>
</head>

<body>
    <header>
        <img src="./images/templogo.png" alt="logo" class="logo" />
        <nav>
            <ul class="nav_links">
                <li><a></a></li>
                <li><a href="admin.php">Manage</a></li>
                <li><a></a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a></a></li>
                <li><a>Hi <?php echo $_SESSION["user_id"]; ?></a></li>
                <!-- <li><a href="signup.php" >signup</a></li> -->
            </ul>
        </nav>
    </header>

    <div class="form_box" style='height:500px;'>
		<form class="form" name="form" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
			<h2 class="form_box heading">Upload</h2>
			<a></a>
			<div class="form_box item">
				<label class="form_label">Property name</label>
				<input type="text" name="property_name"  maxlength="20" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Property id</label>
				<input type="text" name="property_id" value=""  maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">City</label>
				<input type="text" name="city"   maxlength="50" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Address</label>
				<input type="text" name="address"   maxlength="100" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Address link</label>
				<input type="text" name="address_link"   maxlength="200" required>
			</div>
			<div class="form_box"><input type="submit" class="submit" value="Submit" required></div>
			<div class="form_box item"><a href="admin.php"> Manage</a></div>
			<a></a>
			<a></a>
		</form>
	</div>
</body>

</html>