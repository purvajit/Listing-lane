<?php session_start();

if (!empty($_GET["id"])) {
    echo $_GET["id"];
}


?>fetch me the property by id

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Listing Lane</title>
    <link rel="stylesheet" href="./style.css?v=1">
</head>

<body>
    <?php include('./shared/header.php') ?>
    <section class="hero_section">
        <div class="hero">
            <div class="container">
                <div class="info">
                    <h1>Listing Lane</h1>
                    <h2>Your search ends here: Listing Lane connects you to your new home</h2>
                    <p>Listing Lane is your go-to destination for all your real estate needs. Our user-friendly platform and comprehensive listings make finding your dream home a breeze.
                        Our experienced real estate agents are here to guide you through every step of the process, whether you're buying or selling. Join the thousands of satisfied customers who have found their perfect home on Listing Lane.
                        Start your search today and discover the home you've been dreaming of.</p>
                    <button>Explore Now</button>
                </div>
            </div>
        </div>
    </section>
</body>