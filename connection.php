<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "user_login";


if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect");
}
// echo "done";