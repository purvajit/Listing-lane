<?php
session_start();
include("connection.php");
include("function.php");
if (isset($_SESSION['username'])) {
	header("Location: index.php");
	exit;
}

$username = $first_name = $last_name = $email_id = $password = '';
$eusername = $efirst_name = $elast_name = $eemail_id = $epassword = '';
$flag = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	if (!empty($_POST['first_name'])) {
		$first_name = test_data($_POST['first_name']);
		if (strlen($first_name) < 3 or !preg_match("/^([a-zA-Z' ]+)$/", $first_name)) {
			$efirst_name = "Name should be 3 letters long and only include letters";
			$flag = 1;
		}
	} else {
		$efirst_name = "Name should be 3 letters long and only include letters";
		$flag = 1;
	}
	if (!empty($_POST['last_name'])) {
		$last_name = test_data($_POST['last_name']);
		if (strlen($last_name) < 3 or !preg_match("/^([a-zA-Z' ]+)$/", $last_name)) {
			$elast_name = "Name should be 3 letters long and only include letters";
			$flag = 1;
		}
	} else {
		$elast_name = "Name should be 3 letters long and only include letters";
		$flag = 1;
	}

	if (!empty($_POST['username'])) {
		$username = test_data($_POST['username']);
		if (strlen($username) < 3 or !preg_match("/^([a-zA-Z0-9]+)$/", $username)) {
			$eusername = "User id should be 3 letters long and contains alphanumeric characters only";
			$flag = 1;
		} else {
			$q = "select count(*) as count from user where username = '" . $username . "' ";
			$test = $con->query($q);
			while ($row = mysqli_fetch_assoc($test)) {
				$result[] = $row;
			}
			if ($result[0]['count']) {
				$flag = 1;
				$eusername = "Username is taken. Please login or enter another username";
			}
		}
	} else {
		$flag = 1;
		$eusername = "username is required";
	}
	if (!empty($_POST['email_id'])) {
		$email_id = test_data($_POST['email_id']);
		if (strlen($email_id) < 10 or !filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
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
				$eemail_id = "Please login to your existing account";
			}
		}
	} else {
		$flag = 1;
		$eemail_id = "Email id required";
	}


	if (!empty($_POST['password'])) {
		$password = test_data($_POST['password']);
		$password = password_hash($password, PASSWORD_DEFAULT);
	} else {
		$flag == 1;
		$epassword = "Password is required";
	}
	if ($flag == 0) {
		$query = "insert into user (username, first_name, last_name, email_id, is_admin, is_active, password) values ('$username','$first_name','$last_name','$email_id', 0, 1, '$password')";
		mysqli_query($con, $query) or die(mysqli_error($con));
		header("Location: login.php");
		die;
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Create a new account | Listing Lane</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style.css">
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
		form{
			background-color: var(--colour5);
			padding: 30px;
			border-radius: 4px;
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

		.login_tip {
			margin-top: 0.5rem;
			font-weight: 300;
			font-size: 1.05rem;
			color: var(--colour1);
		}
		a{
			font-weight: 600;
		}
	</style>
</head>

<body class="bg">
	<?php include('./shared/header.php') ?>


	<div class="form_box">
		<form name="form" method="POST">
			<h2 class="form_box heading">Create a new account</h2>

			<div class="form_block">
				<label class="form_label">First Name</label>
				<input type="text" name="first_name" value="<?php echo $first_name; ?>" maxlength="20">
				<p class="error"><?php echo $efirst_name; ?></p>
			</div>


			<div class="form_block">

				<label class="form_label">Last Name</label>
				<input type="text" name="last_name" value="<?php echo $last_name; ?>" maxlength="20">
				<p class="error"><?php echo $elast_name; ?></p>
			</div>


			<div class="form_block">
				<label class="form_label">Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" maxlength="20">
				<p class="error"><?php echo $eusername; ?></p>


			</div>
			<div class="form_block">
				<label class="form_label">Email Id</label>
				<input type="email" name="email_id" value="<?php echo $email_id; ?>" maxlength="50">
				<p class="error"><?php echo $eemail_id; ?></p>

			</div>
			<div class="form_block">


				<label class="form_label">Password</label>
				<input type="password" name="password" value="<?php echo $password; ?>" size="20" maxlength="10">
				<p class="error"><?php echo $epassword; ?></p>
			</div>
			<input type="submit" class="submit" value="Sign up" />
			<div class="login_tip" item">Already have an account? <a href="login.php">Login</a></div>
			<a></a>
		</form>
	</div>
</body>

</html>