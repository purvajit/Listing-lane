<?php
session_start();
include("connection.php");
include("connection2.php");
include("function.php"); //from function.php
$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$property_name= $_POST["property_name"];
	$property_id= $_POST["property_id"];
	$description= $_POST["description"];
	$city= $_POST["city"];
	$address= $_POST["address"];
	$address_link= $_POST["address_link"];
	$price= $_POST["price"];
	$image1= $_POST["image1"];
	$image2= $_POST["image2"];
	$contact_number= $_POST["contact_number"];
	$contact_email= $_POST["contact_email"];

	$password = $_POST['password'];

	if (!empty($property_name) && !empty($property_id) && !empty($description)  && !empty($address) && !empty($address_link) && !empty($price) && !empty($image1) && !empty($image2) && !empty($contact_number) && !empty($contact_email)) {

		//save to database
		// $user_id = random_num(20);
		$query = "insert into property (property_id,property_name,description,city,address,address_link,price,image1,image2,contact_number,contact_email) values ('$property_id','$property_name','$description','$city','$address','$address_link','$price','$image1','$image2','$contact_number','$contact_email')";

		mysqli_query($property_con, $query);

		header("Location: upload.php");
		die;
	} else {
		echo '<script>alert("Please enter some valid information!")</script>';
	}
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Upload</title>
</head>

<body>
    <header>
        <img src="./images/templogo.png" alt="logo" class="logo" />
        <nav>
            <ul class="nav_links">
                <li><a></a></li>
                <li><a href="admin.php">Manage</a></li>
                <li><a></a></li>
                <li><a href="admin.php">Home</a></li>
                <li><a></a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a></a></li>
                <li><a>Hi <?php echo $_SESSION["user_id"]; ?></a></li>
                <!-- <li><a href="signup.php" >signup</a></li> -->
            </ul>
        </nav>
    </header>

    <div class="form_box" style='height:1000px;'>
		<form class="form" name="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
			<h2 class="form_box heading">Upload</h2>
			<a></a>
			<div class="form_box item">
				<label class="form_label">Property name</label>
				<input type="text" name="property_name"  maxlength="20" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Property id</label>
				<input type="text" name="property_id" value=""  maxlength="20" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Description</label>
				<input type="textbox" name="description" value="" required>
			</div>
			<div class="form_box item">
				<label class="form_label">City</label>
				<input type="text" name="city"   maxlength="50" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Address</label>
				<input type="text" name="address"   maxlength="100" required>
			</div>
            <div class="form_box item">
				<label class="form_label">Address link</label>
				<input type="text" name="address_link"   maxlength="200" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Price</label>
				<input type="text" name="price"   maxlength="10" required>
			</div>
			<div class="form_box item">
				<label class="form_label">First Image</label>
				<input type="file" name="image1" required>
			</div>
			<div class="form_box item">
				<label class="form_label">Second Image</label>
				<input type="file" name="image2"  required>
			</div>
			<div class="form_box item">
				<label class="form_label">Contact Number</label>
				<input type="text" name="contact_number" pattern="[0-9]{10}" maxlength="10" placeholder="9898989898"  required>
			</div>
			<div class="form_box item">
				<label class="form_label">Email id</label>
				<input type="email" name="contact_email"  maxlength="10" required>
			</div>
			<div class="form_box"><input type="submit" class="submit" value="Submit" required></div>
			<div class="form_box item"><a href="admin.php"> Manage</a></div>
			<a></a>
			<a></a>
		</form>
	</div>
</body>

</html>