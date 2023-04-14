<?php

session_start();

include("connection.php");
include("function.php");

// check_login($con);
// if (isset($_SESSION['user_id'])){
// 	header("Location: index.php");
// 	exit;
// }

$flag = 0;
$user_id = $password = $euser_id = $epassword = $error = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	if (empty($_POST['user_id'])) {
		$flag = 1;
		$euser_id = "Username required";
	}
	if (empty($_POST['password'])) {
		$flag = 1;
		$epassword = "Password required";
	} else {
		$user_id = $_POST['user_id'];
		$password = $_POST['password'];
		//read from database user table
		$query = "select * from user where user_id = '$user_id' limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['password'] === $password) {
					if ($user_data['admin'] == 0) {
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					} else {
						$_SESSION['user_id'] = $user_data['user_id'];
						$_SESSION['admin'] = 1;
						header("Location: index.php");
						die;
					}
				} else {
					$epassword = "Wrong password";
					$flag = 1;
				}
			} else {
				$epassword = "User not found";
				$flag = 1;
			}
		}
	}
	// echo "wrong username or password!";
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
		<img src="./images/templogo.png" alt="logo" class="logo" />

		<nav>
			<ul class="nav_links">
				<li><a href="index.php #contact">Contact</a></li>
				<li><a></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a></a></li>
			</ul>
		</nav>
	</header>





	<div class="form_box">
		<form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
			<h2 class="form_box heading">LOGIN</h2>
			<label class="form_label">User Id</label>
			<input type="text" name="user_id" value="<?php if ($flag == 1) {
															echo $user_id;
														} ?>" id="" maxlength="20">
			<p class="error"><?php echo $euser_id; ?></p>
			<label class="form_label">Password</label>
			<input type="password" name="password" value="<?php if ($flag == 1) {
																echo $password;
															} ?>" size="20" maxlength="20">
			<p class="error"><?php echo $epassword; ?></p>
			<div class=""><input type="submit" class="submit" value="Login"></div>
			<div class="">New here? <a href="signup.php"> Sign up</a></div>
			<a></a>
			<a></a>
		</form>
	</div>
</body>

</html>