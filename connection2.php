<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "property";


if (!$property_con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect");
}
// echo "done";