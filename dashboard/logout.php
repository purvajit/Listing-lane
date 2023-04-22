<?php

session_start();

if (isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
	unset($_SESSION['admin']);
} else {
	echo '<script>alert("You are already logged out")</script>'; //problem

}
header("Location: ../index.php");
die;
