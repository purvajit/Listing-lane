<?php
session_start();
include("connection.php");
include("function.php"); //from function.php
$user_data = check_login($con);
$loginstyle = "";
$logoutstyle = "";
$adminstyle = "style='display:none;'";
$search_page = 1;
if (isset($_SESSION['user_id'])) {
	$loginstyle = "style='display:none;'";
}
if (!isset($_SESSION['user_id'])) {
	$logoutstyle = "style='display:none;'";
}
if (isset($_SESSION['admin'])) {
	$adminstyle = "";
}
$search_str = "";
$array = array();
if (!empty($_GET["search_str"])) {
	$search_str = $_GET['search_str'];
	$array = search($con, trim($search_str));
	unset($_GET["search_str"]);
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (!empty($_POST['search_str'])) {
		$search_str = $_POST['search_str'];
		$array = search($con, trim($search_str));
	}
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
	<style>
    .form_label {
        font-size: 2rem;
        font-weight: 700;
    }

    .form_block {
        width: 100%;
    }

    input {
        padding: 1rem;
    }

    input[type="submit"] {
        width: 10%;
    }
	form{
		display: flex;
		gap: 2rem;
	}
</style>
</head>

<body>
	<div class="container">

		<?php include("./shared/header.php") ?>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="search_str" value="<?php if (isset($search_str)) {
															echo trim($search_str);
														} ?> " required>
			 <input type="submit" class="submit" value="Search" />

		</form>

		<?php if (sizeof($array) == 0) {
			echo "<h1>No match found</h1>";
		}
		foreach ($array as $row) { ?>
			<img src="./uploads/<?php echo $row['image1']; ?>" style="width:100px;">
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
		} ?>
	</div>
		<?php include("./shared/footer.php") ?>

</body>

</html>