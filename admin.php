<?php
session_start();
include("connection.php");
include("function.php"); //from function.php
$user_data = check_login($con);
$loginstyle = "";
$logoutstyle = "";
if (isset($_SESSION['user_id'])) {
	$loginstyle = "style='display:none;'";
}
if (!isset($_SESSION['user_id'])) {
	$logoutstyle = "style='display:none;'";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

	<header>
		<img src="./images/templogo.png" alt="logo" class="logo" />

		<input type="text" name="Search" placeholder="search" maxlength="50" required>
		<nav>
			<ul class="nav_links">
				<li><a href="upload.php">Upload</a></li>
				<li><a></a></li>
				<li><a href="admin.php">Manage</a></li>
				<li><a></a></li>
				<li><a href="logout.php" <?php echo $logoutstyle; ?>>Logout</a></li>
				<li><a href="login.php" <?php echo $loginstyle; ?>>Login</a></li>
				<li><a <?php echo $logoutstyle; ?>>Hi <?php echo $_SESSION["user_id"]; ?></a></li>
				<!-- <li><a href="signup.php" >signup</a></li> -->
			</ul>
		</nav>
	</header>


	<section class="hero">
		<div class="container">
			<div class="info">
				<h1>Listing Lane</h1>
				<h2>Your search ends here: Listing Lane connects you to your new home</h2>
				<p>Listing Lane is your go-to destination for all your real estate needs. Our user-friendly platform and comprehensive listings make finding your dream home a breeze.
					Our experienced real estate agents are here to guide you through every step of the process, whether you're buying or selling. 
					Join the thousands of satisfied customers who have found their perfect home on Listing Lane.
					Start your search today and discover the home you've been dreaming of.</p>
				<a class="submit" href="#">Explore Now</a>
			</div>
		</div>
	</section>




	<h1>Admin page</h1>

</body>

</html>