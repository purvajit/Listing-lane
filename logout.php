<?php

session_start();

if (isset($_SESSION['username'])) {
	unset($_SESSION['username']);
	unset($_SESSION['is_admin']);
	session_destroy();
}
header("Location: index.php");
die;
