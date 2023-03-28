<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "product";


if (!$product_con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect");
}
// echo "done";