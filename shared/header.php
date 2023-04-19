<?php

$isLoggedIn = false;
$isAdmin = false;
$search_page = 0;
if (isset($_SESSION['user_id'])) {
    $isLoggedIn = true;
}
if (!isset($_SESSION['user_id'])) {
    $isLoggedIn = false;
}
if (isset($_SESSION['admin'])) {
    $adminstyle = "";
    $isAdmin = true;
}
?>


<nav class="primary-nav container">
    <div class="logo">
        <img class="logo-image" src="./images/templogo.png" alt="Logo">
        <a class="logo-text" href="./">Listing Lane</a>
    </div>

    <ul class="primary-navigation" id="primary-navigation" role="list" data-open="false">
        <li><a href="newlistings.php">New</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php
        if ($isLoggedIn === false) {
            echo "<li><a href='login.php'>Login</a></li>";
        } else {
            echo "<li><a href='logout.php'>Logout</a></li>";
            echo "<img class='user-image' src='https://api.dicebear.com/5.x/shapes/svg?seed=imrraaj' alt='user_image'>";
            echo "<li><a href='#'> Welcome " . $_SESSION["user_id"] . "!</a></li>";
        }
        ?>
    </ul>
    <button class="menu-icon" id="menu"></button>
</nav>