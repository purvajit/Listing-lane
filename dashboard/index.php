<?php
session_start();
include("../connection.php");
include("../function.php"); //from function.php

// new data (not stale one in session)
check_dashboard_admin($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
	<?php include("../shared/header.php") ?>
    <div class="features_container">
        <a class='feature' href='manage.php'>Properties</a>
        <a class='feature' href='contact.php'>Contact</a>
        <a class='feature' href='user.php'>User</a>
    </div>
	<?php include("../shared/footer.php") ?>

    </div>
</body>

</html>