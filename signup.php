<?php
session_start();
include("connection.php");
include("function.php");
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit;
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_id = $_POST['user_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email_id = $_POST['email_id'];

	$password = $_POST['password'];

	if (!empty($user_id) && !empty($first_name) && !empty($last_name) && !empty($email_id) && !empty($password)) {

		//save to database
		// $user_id = random_num(20);
		$query = "insert into customer (user_id,first_name,last_name,email_id,password) values ('$user_id','$first_name','$last_name','$email_id','$password')";

		mysqli_query($con, $query);

		header("Location: login.php");
		die;
	} else {
		echo '<script>alert("Please enter some valid information!")</script>';
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>SIGN UP</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body class="bg">
	<header>
		<img src="./images/templogo.png" alt="logo" class="logo"/>

		<nav>
			<ul class="nav_links">
				<li><a href="index.php">Contact</a></li>
				<li><a></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a></a></li>
			</ul>
		</nav>
	</header>




	<div class="form_box" style='height:500px;'>
		<form name="form" method="POST">
			<h2 class="form_box heading">SIGN UP</h2>
			<div class="form_box item">
				<label class="form_label">First Name</label>
				<input type="text" name="first_name" value="" id="" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Last Name</label>
				<input type="text" name="last_name" value="" id="" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">User Id</label>
				<input type="text" name="user_id" value="" id="" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Email Id</label>
				<input type="email" name="email_id" value="" id="" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Password</label>
				<input type="password" name="password" id="" size="20" maxlength="30" required>
			</div>
			<div class="form_box item"> <input type="submit" class="submit" value="Sign up" /></div>
			<div class="form_box item">Have an account?<a href="login.php">Login</a></div>
			<a></a>
		</form>
	</div>
</body>

</html>