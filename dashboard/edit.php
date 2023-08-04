<?php
session_start();
include("../connection.php");
include("../function.php"); //from function.php
$user_data = check_dashboard_admin($con);

if (isset($user_data["username"])) {
	$property_name = $property_id = $description = $city = $address = $address_link = $price = $image1 = $image2 = $contact_number = $contact_email = "";
	$eproperty_name = $eproperty_id = $edescription = $ecity = $eaddress = $eaddress_link = $eprice = $eimage1 = $eimage2 = $econtact_number = $econtact_email = "";
	$flag = 0;
	$eerror = "";
	if (isset($_GET["edit_id"])) {
		$edit_id = $_GET["edit_id"];
		$query = "select * from property where property_id = '$edit_id' limit 1";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {

			$property_data = mysqli_fetch_assoc($result);
		}
		$property_name = $property_data["property_name"];
		$description = $property_data["description"];
		$city = $property_data["city"];
		$address = $property_data["address"];
		$address_link = $property_data["address_link"];
		$price = $property_data["price"];
		$image1 = $property_data["image1"];
		$image2 = $property_data["image2"];
		$contact_number = $property_data["contact_number"];
		$contact_email = $property_data["contact_email"];
		$flag = 1;
		$dir1 = "uploads/" . $image1;
		$dir2 = "uploads/" . $image2;
		// $_FILES['image1'] = fopen($dir1, 'r');
		// $_FILES['image2'] = fopen($dir2, 'r');
	} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
		//something was posted


		if (empty($_POST["property_name"]) || empty($_POST["description"])  || empty($_POST["city"]) || empty($_POST["address"]) || empty($_POST["address_link"]) || empty($_POST["price"]) || empty($_FILES["image1"]) || empty($_FILES["image2"]) || empty($_POST["contact_number"]) || empty($_POST["contact_email"])) {
			$eerror = "All fields are required to be filled!";

			$flag = 1;
		} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			//something was posted


			if (empty($_POST["property_name"])  || empty($_POST["description"])  || empty($_POST["city"]) || empty($_POST["address"]) || empty($_POST["address_link"]) || empty($_POST["price"]) || empty($_FILES["image1"]) || empty($_FILES["image2"]) || empty($_POST["contact_number"]) || empty($_POST["contact_email"])) {
				$eerror = "All fields are required to be filled!";
				$flag = 1;
			} else {
				$property_name = $_POST["property_name"];
				$property_id = $edit_id;
				$description = $_POST["description"];
				$city = $_POST["city"];
				$address = $_POST["address"];
				$address_link = $_POST["address_link"];
				$price = $_POST["price"];
				$image1 = $property_id . "image1";
				$image2 = $property_id . "image2";
				$contact_number = $_POST["contact_number"];
				$contact_email = $_POST["contact_email"];
				//images
				$uploaddir = 'uploads/';
				$imgname = $property_id . "image1" . "jpg";
				$tempimgname = $_FILES['image1']['tmp_name'];
				$uploadfile = $uploaddir . $imgname;
				$imgname2 = $property_id . "image2" . "jpg";
				$tempimgname2 = $_FILES['image2']['tmp_name'];
				$uploadfile2 = $uploaddir . $imgname2;

				if (move_uploaded_file($tempimgname, $uploadfile)) {
					echo "File is valid, and was successfully uploaded.\n";
				} else {
					$flag = 1;
					$eimage1 = "Something went wrong uploading the image";
				}
				if (move_uploaded_file($tempimgname2, $uploadfile2)) {
					echo "File is valid, and was successfully uploaded.\n";
				} else {
					$flag = 1;
					$eimage2 = "Something went wrong uploading the image";
				}
				//property name
				if (strlen($property_name) < 3 or !preg_match("/^([a-zA-Z0-9' ]+)$/", $property_name)) {
					$eproperty_name = "Invalid Name";
					$flag = 1;
				}
				if (strlen($city) < 2 or !preg_match("/^([a-zA-Z0-9' ]+)$/", $city)) {
					$ecity = "Invalid city";
					$flag = 1;
				}
				//description
				if (strlen($description) < 2 or !preg_match("/^([a-zA-Z0-9' ]+)$/", $description)) {
					$edescription = "Invalid description";
					$flag = 1;
				}
				//address
				if (strlen($address) < 2 or !preg_match("/^([a-zA-Z0-9' ]+)$/", $address)) {
					$eaddress = "Invalid address";
					$flag = 1;
				}
				//address_link
				if (strlen($address_link) < 2 or !preg_match("/^([a-zA-Z0-9' ]+)$/", $address_link)) {
					$eaddress_link = "Invalid address link";
					$flag = 1;
				}
				if (strlen($price) < 2 or !preg_match("/^([0-9,]+)$/", $price)) {
					$eprice = "Invalid price";
					$flag = 1;
				}
				//contact_number
				if (strlen($contact_number) < 2 or !preg_match("/^([0-9,]+)$/", $contact_number)) {
					$econtact_number = "Invalid Contact number";
					$flag = 1;
				}
				//contact_email
				if (strlen($contact_email) < 5 or !preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $contact_email)) {
					$econtact_email = "Invalid Email id";
					$flag = 1;
				}
			}
			if ($flag == 0) {
				$query = "update property set `property_name`='$property_name',`description`='$description',`city`='$city',`address`='$address',`address_link`='$address_link',`price`='$price',`contact_number`='$contact_number',`contact_email`='$contact_email' where `property_id`='$edit_id'";
				// $query = "insert into property (property_id,property_name,description,city,address,address_link,price,image1,image2,contact_number,contact_email) values ('$property_id','$property_name','$description','$city','$address','$address_link','$price','$image1','$image2','$contact_number','$contact_email')";

				mysqli_query($con, $query);
				unset($_FILES['image1']);
				unset($_FILES['image2']);
				header("Location: upload.php");
				die;
			}
		}
	}
?>




	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="description" content="">
		<link rel="stylesheet" type="text/css" href="../style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Edit</title>
		<style>
			form{
			background-color: var(--colour5);
			padding: 30px;
			border-radius: 4px;
		}
		.submit{
			margin: 10px 0px;
		}
		</style>
	</head>

	<body>
		<?php include("../shared/header.php") ?>


		<div class="form_box">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" style='width:500px;' enctype='multipart/form-data'>
				<h2 class="form_box heading">Edit</h2>
				<h2 class="form_box heading"><?php echo $property_id;?></h2>
				<p class="error"><?php echo $eerror; ?></p>

				<label class="">Property name</label>
				<input type="text" name="property_name" value="<?php if ($flag) {
																	echo "$property_name";
																} ?>">
				<p class="error"><?php echo $eproperty_name; ?></p>


				<label class="">Description</label>
				<textarea name="description"><?php if ($flag) {
													echo $description;
												} ?></textarea>
				<p class="error"><?php echo $edescription; ?></p>

				<label class="">City</label>
				<input type="text" name="city" value="<?php if ($flag) {
															echo $city;
														} ?>">
				<p class="error"><?php echo $ecity; ?></p>

				<label class="">Address</label>
				<input type="text" name="address" value="<?php if ($flag) {
																echo "$address";
															} ?>">
				<p class="error"><?php echo $eaddress; ?></p>

				<label class="">Address link</label>
				<textarea name="address_link"><?php if ($flag) {
																					echo htmlspecialchars( $address_link);
																				} ?></textarea>
				<p class="error"><?php echo $eaddress_link; ?></p>

				<label class="">Price</label>
				<input type="text" name="price" maxlength="20" value="<?php if ($flag) {
																			echo "$price";
																		} ?>">
				<p class="error"><?php echo $eprice; ?></p>

				<label class="">First Image</label>
				<input type="file" name="image1" accept=".jpg, .jpeg, .png">
				<p class="error"><?php echo $eimage1; ?></p>

				<label class="">Second Image</label>
				<input type="file" name="image2" accept=".jpg, .jpeg, .png">
				<p class="error"><?php echo $eimage2; ?></p>

				<label class="">Dealers Contact Number</label>
				<input type="text" name="contact_number" pattern="[0-9]{10}" maxlength="10" placeholder="9898989898" value="<?php if ($flag) {
																																echo "$contact_number";
																															} ?>">
				<p class="error"><?php echo $econtact_number; ?></p>

				<label class="">Dealers Email Id</label>
				<input type="email" name="contact_email"  value="<?php if ($flag) {
																					echo "$contact_email";
																				} ?>">
				<p class="error"><?php echo $econtact_email; ?></p>

				<div class=""><input type="submit" class="submit"></div>
				<div class=""><a href="index.php"> Manage</a></div>
			</form>
		</div>
	<?php } ?>
	</body>

	</html>