<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "listing lane";


if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect");
}
// echo "done";