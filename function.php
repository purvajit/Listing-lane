<?php

function check_dashboard_admin($con)
{
	$user_data = check_login($con);
	if (!isset($user_data["username"]) || $user_data["is_admin"] == 0) {
		header("Location: ../index.php");
		die;
	} else return $user_data;
}
function check_login($con)
{
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$query = "select * from user where username = '$username' and is_active = 1 limit 1";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	// header("Location: login.php");
	// die;
}

function test_data($str)
{
	return htmlspecialchars(stripslashes(trim($str)));
}
function fetch_all_city($con)
{
	$query = "select DISTINCT city FROM property";
	$all_property = $con->query($query);
	$result = array();
	while ($row = mysqli_fetch_assoc($all_property)) {
		$result[] = $row;
	}
	return $result;
}

function fetch_by_city($con, $city)
{
	$query = "select * from  property where city = '$city'";
	$all_property = $con->query($query);
	$result = array();
	while ($row = mysqli_fetch_assoc($all_property)) {
		$result[] = $row;
	}
	return $result;
}


function search($con, $search_str)
{

	$query = "select * from  property 
    WHERE 
	`property_name` LIKE '%$search_str%'
	OR`description` LIKE '%$search_str%'
	OR `city` LIKE '%$search_str%'
	OR `address` LIKE '%$search_str%'
	OR `address_link` LIKE '%$search_str%'";
	$all_property = $con->query($query);
	$result2 = array();
	while ($row = mysqli_fetch_assoc($all_property)) {
		$result2[] = $row;
	}
	return $result2;
}



function search_properties_in_city_by_name($con, $search_str, $city)
{

	$query = "select * from  property 
    WHERE 
	`city` ='$city' AND (
	`property_name` LIKE '%$search_str%'
	OR`description` LIKE '%$search_str%'
	OR `city` LIKE '%$search_str%'
	OR `address` LIKE '%$search_str%'
	OR `address_link` LIKE '%$search_str%')";
	$all_property = $con->query($query);
	$result2 = array();
	while ($row = mysqli_fetch_assoc($all_property)) {
		$result2[] = $row;
	}
	return $result2;
}

function search_properties_by_id($con, $id)
{

	$query = "select * from property where property_id = '$id' limit 1";

	$result = mysqli_query($con, $query);
	if ($result && mysqli_num_rows($result) > 0) {
		$property = mysqli_fetch_assoc($result);
		return $property;
	}
}
