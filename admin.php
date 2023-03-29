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

	<?php include("./shared/adminheader.php") ?>
	<?php include("./shared/hero.php") ?>
	<?php include("./shared/feature.php") ?>
	<?php include("./shared/footer.php") ?>
</body>

</html>