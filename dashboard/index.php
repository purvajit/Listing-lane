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
    <style>
        .features_container {
            display: grid;
            grid-template-columns: repeat(4, 300px);
            justify-content: center;
            gap: 2rem;
            padding: 30px;
        }
        .feature{
            background-color: white;
        }
    </style>
</head>

<body>
    <?php include("../shared/header.php") ?>
    <div class="features features_container">

        <a href='manage.php'>
            <div class="feature">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=773&q=80" height="198" alt="" style="opacity:0.8;">
                <h2>Manage Properties</h2>
                <p>Edit or Delete existing properties</p>
            </div>
        </a>
        <a href='upload.php'>
            <div class="feature">
                <img src="https://images.unsplash.com/photo-1523841589119-b55aee0f66e7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt=""style="opacity:0.8;">
                <h2>Add New Properties</h2>
                <p>Add a new property</p>
            </div>
        </a>
        <a href='contact.php'>
            <div class="feature">
                <img src="https://images.unsplash.com/photo-1528747045269-390fe33c19f2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjB8fGNvbnRhY3R8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" alt=""style="opacity:0.8;">
                <h2>Contact</h2>
                <p>Manage the contact form</p>
            </div>
        </a>
        <a href='user.php'>
            <div class="feature">
                <img src="https://images.unsplash.com/photo-1512758017271-d7b84c2113f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt=""style="opacity:0.8;">
                <h2>Manage Users</h2>
                <p>Block and Unblock the users</p>
            </div>
        </a>
    </div>

    </div>
</body>

</html>