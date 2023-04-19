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
				<input type="text" id="user_label" name="user_id" value="<?php echo $user_id ?>">
				<p class="error"><?php echo $euser_id; ?></p>
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