<?php

session_start();

include("connection.php");
include("function.php");
if (isset($_SESSION['username'])) {
	header("Location: index.php");
	die;
}

$flag = 0;
$username = $password = $eusername = $epassword = $error = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	if (empty($_POST['username'])) {
		$flag = 1;
		$eusername = "Username required";
	}
	if (empty($_POST['password'])) {
		$flag = 1;
		$epassword = "Password required";
	}
	if ($flag == 0) {
		$username = test_data($_POST['username']);
		$password = test_data($_POST['password']);
		//read from database user table
		$query = "select * from user where username = '$username' and is_active = 1 limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);
				$checkpassword = password_verify($password, $user_data["password"]);
				if ($checkpassword === true) {
					$_SESSION['username'] = $user_data['username'];
					$_SESSION['is_admin'] = $user_data['is_admin'];
					header("Location: index.php");
					die;
				} else {
					$epassword = "Wrong password";
					$flag = 1;
				}
			} else {
				$epassword = "User not found or User is blocked by the admins";
				$flag = 1;
			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style.css">
	<title>Login into your account | Listing Lane</title>
	<style>
		.error {
			color: firebrick;
			font-weight: 500;
			display: inline;
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

		.form_box {
			display: flex;
			justify-content: center;
			align-items: center;
			min-width: 300px;
		}

		.form_block {
			margin-bottom: 2rem;
		}

		label {
			display: block;
			font-weight: 600;
			font-size: medium;
			margin-block: 0.5rem;
		}

		input {
			width: 100%;
			padding: 0.5rem;
			font-size: 1rem;
			font-weight: 600;
			border: 1px solid var(--colour2);
		}

		input:hover,
		input:focus {
			border-radius: 1px;
			outline: 2px solid var(--colour2);
		}

		input[type="submit"] {
			background-color: var(--colour2);
			border: 0;
		}

		input[type="submit"]:hover,
		input[type="submit"]:focus {
			outline: 2px solid var(--colour2);
			outline-offset: 1px;
		}

		.signup_tip {
			margin-top: 0.5rem;
			font-weight: 600;
			font-size: 1.05rem;
			color: var(--colour1);
		}
	</style>
</head>

<body class="bg">

	<?php include('./shared/header.php') ?>
	<div class="form_box container">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<h2 class="form_box heading">LOGIN</h2>

			<div class="form_block">
				<label class="form_label" for="user_label">Username <span class="error">*</span></label>
				<input type="text" id="user_label" name="username" value="<?php echo $username ?>">
				<p class="error"><?php echo $eusername; ?></p>
			</div>
			<div class="form_block">
				<label class="form_label" for="password_label">Password <span class="error">*</span> </label>
				<input type="password" id="password_label" name="password" value="<?php echo $password; ?>">
				<p class="error"><?php echo $epassword; ?></p>

			</div>
			<input type="submit" class="submit" value="Login" />
			<p class="signup_tip">Do not have an account? <a href="signup.php">Create one!</a></p>
		</form>
	</div>
</body>

</html>