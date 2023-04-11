<?php
session_start();
include("connection.php");
include("connection2.php");
include("function.php"); //from function.php
$user_data = check_login($con);
$loginstyle = "";
$logoutstyle = "";
$search_page = 1;
if (isset($_SESSION['user_id'])) {
	$loginstyle = "style='display:none;'";
}
if (!isset($_SESSION['user_id'])) {
	$logoutstyle = "style='display:none;'";
}
if(isset($_SESSION['search_str'])){
	$array=search($property_con,$_SESSION['search_str']);
	// print_r($array);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>ListingLane</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<?php include("./shared/header.php") ?>



	<?php if(sizeof($array)==0){
		echo "<h1>No match found</h1>";
	}
	foreach($array as $row){?>
		<img src="./uploads/<?php echo $row['image1'];?>">
		<?php
		echo $row['property_name'];
		echo "<br>";
		echo $row['description'];
		echo "<br>";
		echo $row['city'];
		echo "<br>";
		echo $row['address'];
		echo "<br>";
		echo $row['price'];
		echo "<br>";
		echo $row['contact_number'];
		echo "<br>";
		echo $row['contact_email'];
		echo "<br>";
		}?>
	<?php include("./shared/footer.php") ?>

</body>
</html>