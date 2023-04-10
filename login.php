<?php

session_start();

include("connection.php");
include("function.php");

// check_login($con);
// if (isset($_SESSION['user_id'])){
// 	header("Location: index.php");
// 	exit;
// }

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_id = $_POST['user_id'];
	$password = $_POST['password'];

	if (!empty($user_id) && !empty($password)) {

		//read from database customer table
		$query = "select * from customer where user_id = '$user_id' limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['password'] === $password) {
					if($user_data['admin']==0){
					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
					die;}
					else{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: admin.php");
						die;
					}
				}
			}
		}
		echo '<script>alert("Wrong username or password!")</script>';
		// echo "wrong username or password!";
	} else {
		echo '<script>alert("Wrong username or password!")</script>';
		// echo "wrong username or password!";
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body class="bg">
	<header>
		<img src="./images/templogo.png" alt="logo" class="logo"/>

		<nav>
			<ul class="nav_links">
				<li><a href="index.php #contact">Contact</a></li>
				<li><a></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a></a></li>
			</ul>
		</nav>
	</header>





	<div class="form_box" style='height:400px;'>
		<form class="form" name="form" method="post">
			<h2 class="form_box heading">LOGIN</h2>
			<a></a>
			<a></a>
			<div class="form_box item">
				<label class="form_label">User Id</label>
				<input type="text" name="user_id" value="" id="" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Password</label>
				<input type="password" name="password" id="" size="20" maxlength="20" required>
			</div>
			<div class="form_box"><input type="submit" class="submit" value="Login" required></div>
			<div class="form_box item">New here? <a href="signup.php"> Sign up</a></div>
			<a></a>
			<a></a>
		</form>
	</div>
</body>

</html>