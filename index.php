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
	<title>ListingLane</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<?php include("./shared/header.php")?>


	<!-- <h1>Index page</h1> -->
	<section class="hero">
		<div class="container">
			<div class="info">
				<h1>Listing Lane</h1>
				<h2>Your search ends here: Listing Lane connects you to your new home</h2>
				<p>Listing Lane is your go-to destination for all your real estate needs. Our user-friendly platform and comprehensive listings make finding your dream home a breeze.
					Our experienced real estate agents are here to guide you through every step of the process, whether you're buying or selling. Join the thousands of satisfied customers who have found their perfect home on Listing Lane.
					Start your search today and discover the home you've been dreaming of.</p>
				<a class="submit" href="#">Explore Now</a>
			</div>
		</div>
	</section>

	<section class="features_container">
		<div class="feature">
			<h2>Property Listings</h2>
			<p>A comprehensive database of properties available for sale. </p>
		</div>
		<div class="feature">
			<h2>Advanced Search</h2>
			<p>A search engine that allows users to filter results by location, price and other criteria.</p>
		</div>
		<div class="feature">
			<h2>Contact Forms</h2>
			<p>Contact forms that allow users to get in touch with real estate agents, schedule viewings.</p>
		</div>
	</section>
	<section>.</section>
	<section>.</section>
	<?php include("./shared/footer.php")?>

</body>

</html>