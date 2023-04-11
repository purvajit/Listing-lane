<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['search_str'])) {
        $_SESSION["search_str"] = $_POST["search_str"];
        header("Location: search.php");
    }
    else{
		echo '<script>alert("on data")</script>';
    }
}
?>
<header id="header">
    <img src="./images/templogo.png" alt="logo" class="logo" />
    <form class="search_box" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
        <input type="text" name="search_str" value="<?php if( $search_page ==1){echo $_SESSION["search_str"];} ?>" placeholder="search" maxlength="50" required>
        <button type="submit" class="submit">
    <span class="fa fa-search"></span>
</button>
    </form>
    <nav>
        <ul class="nav_links">
            <li><a href="#contact">Contact</a></li>
            <li><a href="logout.php" <?php echo $logoutstyle; ?>>Logout</a></li>
            <li><a href="login.php" <?php echo $loginstyle; ?>>Login</a></li>
            <li><a <?php echo $logoutstyle; ?>>Hi <?php echo $_SESSION["user_id"]; ?></a></li>
        </ul>
    </nav>
</header>