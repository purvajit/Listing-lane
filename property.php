<?php session_start();
include("connection.php");
include("function.php");
if (!empty($_GET["id"])) {
    $id =  test_data($_GET["id"]);
    $data = search_properties_by_id($con, $id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Listing Lane</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        img {
            max-width: 100%;
            display: block;
        }

        .img-block {
            display: flex;
        }

        .img-block>* {
            width: 50%;
        }

        .added {
            margin: 1rem 0;
            margin-top: 2rem;
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--colour2);
        }

        .property-heading {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .property-heading {
            color: var(--colour1);
            text-transform: capitalize;
        }

        .address {
            font-weight: 600;
            font-size: 1.125rem;
            color: var(--colour1);
            text-transform: capitalize;
        }

        .city {
            margin: 1rem 0;
            font-weight: 900;
            color: var(--colour2);
            text-transform: capitalize;
        }

        .description {
            text-transform: capitalize;
        }

        .line {
            margin: 1rem 0;
            width: 100%;
            height: 3px;
            background-color: var(--colour5);
        }

        .price {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
        }

        .price p {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--colour1);
        }

        .price button {
            cursor: pointer;
            padding: 1rem 2rem;
            font-weight: 700;
            border: 0;
            color: var(--colour1);
            background: var(--colour5);
        }

        .price button:hover,
        .price button:focus {
            outline: 2px solid var(--colour2);
            outline-offset: 1px;
        }

        .map {
            width: fit-content;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php include('./shared/header.php') ?>
    <section class="property">

        <div class="img-block">
            <img src="./uploads/<?php echo $data["image1"] ?>" alt="">
            <img src="./uploads/<?php echo $data["image2"] ?>" alt="">
        </div>

        <div class="container">

            <p class="added">Added 18 hours ago</p>

            <h1 class="property-heading">
                <?php echo $data["property_name"] ?>
            </h1>
            <p class="address"><?php echo $data["address"] ?></p>
            <p class="city"><?php echo $data["city"] ?> * <?php echo $data["city"] ?></p>

            <p class="description"><?php echo $data["description"] ?></p>

            <div class="line"></div>
            <div class="map">
                <?php echo $data["address_link"]; ?>
            </div>
            <style>
                iframe {
                    width: 1200px;
                    height: 400px;
                }
            </style>
            <div class="line"></div>
            <div class="price">
                <p>$<?php echo $data["price"] ?></p>

                <?php
                if ($isLoggedIn) {
                    echo "<a href='mailto:" . $data["contact_email"] . "'><button>Start an offer</button></a>";
                } else {
                    echo "<a href='login.php'><button>Login</button></a>";
                }
                ?>
            </div>

        </div>

    </section>

    <?php include('./shared/footer.php') ?>
</body>

</html>