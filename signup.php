<?php
session_start();
include("connection.php");
include("function.php");
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit;
}

$user_id = $first_name = $last_name = $email_id = $password = '';
$euser_id = $efirst_name = $elast_name = $eemail_id = $epassword = '';
$flag = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	if (!empty($_POST['first_name'])) {
		$first_name = $_POST['first_name'];
		if (strlen($first_name) < 3 or !preg_match("/^([a-zA-Z' ]+)$/", $first_name)) {
			$efirst_name = "Invalid Name";
			$flag = 1;
		}
	} else {
		$efirst_name = "First Name required";
		$flag = 1;
	}
	if (!empty($_POST['last_name'])) {
		$last_name = $_POST['last_name'];
		if (strlen($last_name) < 3 or !preg_match("/^([a-zA-Z' ]+)$/", $last_name)) {
			$elast_name = "Invalid Name";
			$flag = 1;
		}
	} else {
		$elast_name = "Last Name required";
		$flag = 1;
	}

	if (!empty($_POST['user_id'])) {
		$user_id = $_POST['user_id'];
		if (strlen($user_id) < 3 or !preg_match("/^([a-zA-Z0-9]+)$/", $user_id)) {
			$euser_id = "User id should Alphanumeric";
			$flag = 1;
		} else {
			$q = "select count(*) as count from user where user_id = '" . $user_id . "' ";
			$test = $con->query($q);
			while ($row = mysqli_fetch_assoc($test)) {
				$result[] = $row;
			}
			if ($result[0]['count']) {
				$flag = 1;
				$euser_id = "User id already exists";
			}
		}
	} else {
		$flag = 1;
		$euser_id = "User id required";
	}
	if (!empty($_POST['email_id'])) {
		$email_id = $_POST['email_id'];
		if (strlen($email_id) < 10 or !preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $email_id)) {
			$eemail_id = "Invalid Email id";
			$flag = 1;
		} else {
			$q = "select count(*) as count from user where email_id = '" . $email_id . "' ";
			$test = $con->query($q);
			while ($row = mysqli_fetch_assoc($test)) {
				$result1[] = $row;
			}
			if ($result1[0]['count']) {
				$flag = 1;
				$eemail_id = "Email id already registered";
			}
		}
	} else {
		$flag = 1;
		$eemail_id = "Email id required";
	}


	if (!empty($_POST['password'])) {
		$password = $_POST['password'];
	} else {
		$flag == 1;
		$epassword = "Password required";
	}
	if ($flag == 0) {
		$query = "insert into user (user_id,first_name,last_name,email_id,admin,password) values ('$user_id','$first_name','$last_name','$email_id',0,'$password')";
		mysqli_query($con, $query) or die(mysqli_error($con));
		header("Location: login.php");
		die;
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
		<img src="./images/templogo.png" alt="logo" class="logo" />

		<nav>
			<ul class="nav_links">
				<li><a href="index.php">Contact</a></li>
				<li><a></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a></a></li>
			</ul>
		</nav>
	</header>




	<div class="form_box">
		<form name="form" method="POST">
			<h2 class="form_box heading">SIGN UP</h2>
			<label class="form_label">First Name</label>
			<input type="text" name="first_name" value="<?php if ($flag == 1) {
															echo $first_name;
														} ?>" maxlength="20">
			<p class="error"><?php echo $efirst_name; ?></p>

			<label class="form_label">Last Name</label>
			<input type="text" name="last_name" value="<?php if ($flag == 1) {
															echo $last_name;
														} ?>" maxlength="20">
			<p class="error"><?php echo $elast_name; ?></p>

			<label class="form_label">User Id</label>
			<input type="text" name="user_id" value="<?php if ($flag == 1) {
															echo $user_id;
														} ?>" maxlength="20">
			<p class="error"><?php echo $euser_id; ?></p>


			<label class="form_label">Email Id</label>
			<input type="email" name="email_id" value="<?php if ($flag == 1) {
															echo $email_id;
														} ?>" maxlength="50">
			<p class="error"><?php echo $eemail_id; ?></p>


			<label class="form_label">Password</label>
			<input type="password" name="password" value="<?php if ($flag == 1) {
																echo $password;
															} ?>" size="20" maxlength="10">
			<p class="error"><?php echo $epassword; ?></p>


			<div class=""> <input type="submit" class="submit" value="Sign up" /></div>
			<div class="" item">Have an account?<a href="login.php">Login</a></div>
			<a></a>
		</form>
	</div>
</body>

</html>