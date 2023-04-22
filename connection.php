<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "listing lane";


if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("Could Not establish database connection\n ERROR: " . mysqli_connect_error());
}
