<header>
		<img src="./images/templogo.png" alt="logo" class="logo" />

		<input type="text" name="Search" placeholder="search" maxlength="50" required>
		<nav>
			<ul class="nav_links">
				<li><a href="upload.php">Upload</a></li>
				<li><a></a></li>
				<li><a href="admin.php">Manage</a></li>
				<li><a></a></li>
				<li><a href="logout.php" <?php echo $logoutstyle; ?>>Logout</a></li>
				<li><a href="login.php" <?php echo $loginstyle; ?>>Login</a></li>
				<li><a <?php echo $logoutstyle; ?>>Hi <?php echo $_SESSION["user_id"]; ?></a></li>
				<!-- <li><a href="signup.php" >signup</a></li> -->
			</ul>
		</nav>
	</header>