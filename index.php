<?php
session_start();
include("connection.php");
include("function.php"); //from function.php
$user_data = check_login($con);
$loginstyle = "";
$logoutstyle = "";
$adminstyle = "style='display:none;'";
$search_page = 0;
if (isset($_SESSION['user_id'])) {
	$loginstyle = "style='display:none;'";
}
if (!isset($_SESSION['user_id'])) {
	$logoutstyle = "style='display:none;'";
}
if (isset($_SESSION['admin'])) {
	$adminstyle = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>ListingLane</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<?php include("./shared/header.php") ?>
	<?php include("./shared/hero.php") ?>
	<?php include("./shared/feature.php") ?>
	<?php include("./shared/display.php") ?>
	<?php include("./shared/footer.php") ?>

</body>

</html>
<!-- <?php while ($row = mysqli_fetch_assoc($all_property)) {
		} ?> -->