<?php
session_start();
include("connection.php");
include("function.php");
$user_id = $first_name = $last_name = $email_id = $message = '';
$euser_id = $efirst_name = $elast_name = $eemail_id = $emessage = '';
$flag = 0;
$success = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    if (!empty($_POST['first_name'])) {
        $first_name = $_POST['first_name'];
        if (strlen($first_name) < 3 or !preg_match("/^([a-zA-Z' ]+)$/", $first_name)) {
            $efirst_name = "Invalid Name";
            $flag = 1;
        }
    } else {
        $efirst_name = "Name required";
        $flag = 1;
    }

    if (!empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        if (strlen($user_id) < 3 or !preg_match("/^([a-zA-Z0-9]+)$/", $user_id)) {
            $euser_id = "User id should Alphanumeric";
            $flag = 1;
        } else {
            $q = "select count(*) as count from user where user_id = '" . $user_id . "' ";
            $test = $con->query($q);
            while ($row = mysqli_fetch_assoc($test)) {
                $result[] = $row;
            }
            if ($result[0]['count']) {
            } else {
                $flag = 1;
                $euser_id = "User id does not exists";
            }
        }
    } else {
        $flag = 1;
        $euser_id = "User id required";
    }
    if (!empty($_POST['email_id'])) {
        $email_id = $_POST['email_id'];
        if (strlen($email_id) < 10 or !preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $email_id)) {
            $eemail_id = "Invalid Email id";
            $flag = 1;
        } else {
            $q = "select count(*) as count from user where email_id = '" . $email_id . "' ";
            $test = $con->query($q);
            while ($row = mysqli_fetch_assoc($test)) {
                $result1[] = $row;
            }
            if ($result1[0]['count']) {
            } else {
                $flag = 1;
                $eemail_id = "Email id does not exists";
            }
        }
    } else {
        $flag = 1;
        $eemail_id = "Email id required";
    }


    if (!empty($_POST['message'])) {
        $message = $_POST['message'];
    } else {
        $flag == 1;
        $emessage = "Message is required";
    }
    if ($flag == 0) {
        $query = "INSERT INTO `contact`(`user_id`, `email_id`, `message`) VALUES('$user_id', '$email_id', '$message')";
        mysqli_query($con, $query) or die(mysqli_error($con));
        $success = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create a new account | Listing Lane</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <style>
        .error {
            color: firebrick;
            font-weight: 500;
            display: inline;
        }

        .success {
            color: var(--colour1);
            font-weight: 500;
            display: block;
            text-align: center;
        }

        body,
        input,
        button,
        textarea {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .heading {
            text-align: center;
            margin: 2rem;
        }

        .heading h1 {
            line-height: 100%;
            margin: 0 0 1rem 0;
        }

        .form_box {
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 300px;
        }

        .form_block {
            margin-bottom: 2rem;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: medium;
            margin-block: 0.5rem;
        }

        input,
        textarea {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            border: 1px solid var(--colour2);
        }

        input:hover,
        input:focus,
        textarea:hover,
        textarea:focus {
            border-radius: 1px;
            outline: 2px solid var(--colour2);
        }

        input[type="submit"] {
            background-color: var(--colour2);
            border: 0;
        }

        input[type="submit"]:hover,
        input[type="submit"]:focus {
            outline: 2px solid var(--colour2);
            outline-offset: 1px;
        }

        .login_tip {
            margin-top: 0.5rem;
            font-weight: 600;
            font-size: 1.05rem;
            color: var(--colour1);
        }
    </style>
</head>

<body class="bg">
    <?php include('./shared/header.php') ?>


    <div class="form_box">
        <form name="form" method="POST">
            <h2 class="form_box heading">Contact Us</h2>
            <?php
            if ($success == true) {
                echo "<span class='success'>Message successfully submitted!!</span>";
            }
            ?>
            <div class="form_block">
                <label class="form_label">Name</label>
                <input type="text" name="first_name" value="<?php echo $first_name; ?>" maxlength="20">
                <p class="error"><?php echo $efirst_name; ?></p>
            </div>

            <div class="form_block">
                <label class="form_label">User Id</label>
                <input type="text" name="user_id" value="<?php echo $user_id; ?>" maxlength="20">
                <p class="error"><?php echo $euser_id; ?></p>
            </div>


            <div class="form_block">
                <label class="form_label">Email Id</label>
                <input type="email" name="email_id" value="<?php echo $email_id; ?>" maxlength="50">
                <p class="error"><?php echo $eemail_id; ?></p>

            </div>
            <div class="form_block">


                <label class="form_label">Message</label>
                <textarea name="message"><?php echo $message; ?></textarea>
                <p class="error"><?php echo $emessage; ?></p>
            </div>
            <input type="submit" class="submit" value="Send Message" />
        </form>
    </div>
</body>

</html>