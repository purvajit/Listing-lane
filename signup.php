<?php
session_start();
include("connection.php");
include("function.php");
if (isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit;
}


$user_id=$first_name=$last_name=$email_id=$password='';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$flag = 0;
	$user_error=0;
	$email_error=0;
	if(!empty($_POST['user_id'])){
		$user_id=$_POST['user_id'];
		$q="select count(*) as count from customer where user_id = '".$user_id."' ";
		$test=$con->query($q);
		while($row=mysqli_fetch_assoc($test)){
			$result[]=$row;
		}
		if($result[0]['count']){
			$flag=1;
			$user_error=1;
		}
	}
	if(!empty($_POST['email_id'])){
		$email_id=$_POST['email_id'];
		$q="select count(*) as count from customer where email_id = '".$email_id."' ";
		$test=$con->query($q);
		while($row=mysqli_fetch_assoc($test)){
			$result1[]=$row;
		}
		if($result1[0]['count']){
			$flag=1;
			$email_error=1;
		}
	}
	if(!empty($_POST['password'])){
		$password = $_POST['password'];
	}else{$flag==1;}
	if(!empty($_POST['first_name'])){
		$first_name = $_POST['first_name'];
	}else{$flag==1;}
	if(!empty($_POST['last_name'])){
		$last_name = $_POST['last_name'];
	}else{$flag==1;}
	if ($flag==0) {
		$query = "insert into customer (user_id,first_name,last_name,email_id,admin,password) values ('$user_id','$first_name','$last_name','$email_id',0,'$password')";
		mysqli_query($con, $query) or die(mysqli_error($con)); 
		header("Location: login.php");
		die;
	} elseif($user_error){
		echo '<script>alert("User id already exist! Try something else. ")</script>';
	}elseif($email_error){
		echo '<script>alert("Email Id already registered ")</script>';}
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
				<input type="text" name="first_name" value="<?php echo $first_name; ?>" pattern="^[A-Za-z]+"  maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Last Name</label>
				<input type="text" name="last_name" value="<?php echo $last_name; ?>" pattern="^[A-Za-z]+" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">User Id</label>
				<input type="text" name="user_id" value="<?php echo $user_id; ?>" pattern="^[A-Za-z]+[A-Za-z0-9_@.-]*" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Email Id</label>
				<input type="email" name="email_id" value="<?php echo $email_id; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Password</label>
				<input type="password" name="password" id="" size="20" maxlength="10" required>
			</div>
			<div class="form_box item"> <input type="submit" class="submit" value="Sign up" /></div>
			<div class="form_box item">Have an account?<a href="login.php">Login</a></div>
			<a></a>
		</form>
	</div>
</body>

</html>