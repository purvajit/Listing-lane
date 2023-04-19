<?php
session_start();
include("connection.php");
include("function.php"); //from function.php
$user_data = check_login($con);
$search_page = 1;
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
		body {
			min-height: 100vh;
		}

		form {
			display: flex;
			gap: 1rem;
		}

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
	</style>
</head>

<body>
	<?php include("./shared/header.php") ?>
	<div class="container">

		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="text" name="search_str" value="<?php if (isset($search_str)) {
															echo trim($search_str);
														} ?> " required>
			<input type="submit" class="submit" value="search" />

		</form>




		<section class="properties container">



			<?php if (sizeof($array) == 0) {
				echo "<h1>No match found</h1>";
			}

			foreach ($array as $row) { ?>
				<a href="property.php?id=<?php echo $row["property_id"] ?>">
					<div class="property-box">
						<div class="property_image" style="background-image: url(./uploads/<?php echo $row["image1"] ?>), linear-gradient(black, white);"></div>
						<div class="detail">
							<div class="name"><?php echo ucfirst($row["property_name"]) ?></div>
							<div class="city"><?php echo ucfirst($row["city"]); ?></div>
							<div class="price"><i class="fa fa-rupee"></i><?php echo ucfirst($row["price"]) ?></div>
						</div>
					</div>
				</a>
			<?php } ?>
		</section>
	</div>
	<?php include("./shared/footer.php") ?>

</body>

</html>