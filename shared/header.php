<?php
$isLoggedIn = false;
$isAdmin = false;




if (isset($_SESSION['username'])) {
    $isLoggedIn = true;
} else if (!isset($_SESSION['username'])) {
    $isLoggedIn = false;
}
if ($isLoggedIn && $_SESSION["is_admin"] == 1) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
?>


<nav class="primary-nav container">
    <div class="logo">
        <img class="logo-image" src="/Innovative/images/templogo.png" alt="Logo">
        <a class="logo-text" href="/Innovative">Listing Lane</a>
    </div>

    <ul class="primary-navigation" id="primary-navigation" role="list" data-open="false">
        <li><a href="/Innovative/newlistings.php">New</a></li>
        <li><a href="/Innovative/about.php">About</a></li>
        <li><a href="/Innovative/contact.php">Contact</a></li>
        <?php
        if ($isLoggedIn === false) {
            echo "<li><a href='/Innovative/login.php'>Login</a></li>";
        } else {
            echo "<li><a href='/Innovative/logout.php'>Logout</a></li>";
            echo "<img class='user-image' src='https://api.dicebear.com/5.x/shapes/svg?seed=" . $_SESSION["username"] . "' alt='user_image'>";
            echo "<li><a href='#'> " . $_SESSION["username"] . "!</a></li>";
        }
        ?>

        <?php
        if ($isLoggedIn === true && $isAdmin === true) {
            echo "<li><a href='/Innovative/dashboard'><button class='dashboard-btn'>Dashboard</button></a></li>";
        }
        ?>
    </ul>
    <button class="menu-icon" id="menu"></button>
</nav>