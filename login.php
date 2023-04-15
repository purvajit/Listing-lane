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
	<style>
		.error {
			color: firebrick;
			font-weight: 500;
		}

		body,
		input,
		button,
		textarea {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		.heading {
			text-align: center;
			margin: 2rem;
		}

		.heading h1 {
			line-height: 100%;
			margin: 0 0 1rem 0;
		}

		form>* {
			margin-bottom: 2rem;
		}

		label>span:not(.error) {
			display: block;
			cursor: pointer;
			font-weight: 700;
			font-size: large;
		}

		label>span.error {
			display: block;
			margin-bottom: 1rem;
		}

		label>input {
			padding: 0.5rem;
			margin: 0.5rem 0;
			width: 90%;
		}

		label>textarea {
			padding: 0.5rem;
			margin: 0.5rem 0;
			width: 90%;
			height: 64px;
		}

		input[type="chechbox"] {
			display: inline;
			margin: 0;
			padding: 0;
		}

		.check {
			display: flex;
		}

		.check>* {
			width: 50%;
		}

		select {
			margin-bottom: 1rem;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body class="bg">

	<?php include('./shared/header.php') ?>
	<div class="form_box">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<h2 class="form_box heading">LOGIN</h2>


			<div>
				<label class="form_label" for="user_label">User Id</label>
				<input type="text" id="user_label" name="user_id" value="<?php echo $user_id ?>" id="" maxlength="20">
				<p class="error">*<?php echo $euser_id; ?></p>
			</div>
			<div>
				<label class="form_label" for="password_label">Password</label>
				<input type="password" id="password_label" name="password" value="<?php echo $password; ?>" size="20" maxlength="20">
				<p class="error">*<?php echo $epassword; ?></p>
			</div>
			<div class=""><input type="submit" class="submit" value="Login"></div>
			<div class="">New here? <a href="signup.php"> Sign up</a></div>
			<a></a>
			<a></a>
		</form>
	</div>
</body>

</html>