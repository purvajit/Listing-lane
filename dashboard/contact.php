<?php
session_start();
include("../connection.php");
include("../function.php"); //from function.php


$user_data = check_dashboard_admin($con); // if it passes it means that user is admin else he would be redirected to home page
if (isset($user_data["username"])) {
    if (isset($_GET['dlt_id'])) {
        $dlt_id = $_GET['dlt_id'];
        $delete = mysqli_query($con, "DELETE FROM `contact` WHERE `id`='$dlt_id'");
        unset($_GET['dlt_id']);
        header("Location: ./contact.php");
    }

    $query = "SELECT * FROM `contact` WHERE 1";
    $all_property = $con->query($query);
    $table = array();
    while ($row = mysqli_fetch_assoc($all_property)) {
        $table[] = $row;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <style>
        .box {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        table {
            border: 1px solid var(--colour1);
            border-collapse: collapse;
        }

        tr,
        th {
            color: var(--colour1);
        }

        td {
            border: 1px solid var(--colour1);
            padding: 1rem;
            text-align: justify;
            max-width: 250px;
        }

        button {
            padding: 0.5rem 1.5rem;
        }

        a {
            font-weight: 900;
            color: var(--colour1);
        }
    </style>
</head>

<body>
    <?php include("../shared/header.php") ?>
    <?php if (isset($user_data["username"])) { ?>
        <div class="box">
            <table>
                <tr>
                    <td>
                        <h4>Sr.No</h4>
                    </td>
                    <td>
                        <h4>User Id</h4>
                    </td>
                    <td>
                        <h4>First Name</h4>
                    </td>
                    <td>
                        <h4>Email</h4>
                    </td>
                    <td>
                        <h4>Time</h4>
                    </td>
                    <td>
                        <h4>Message</h4>
                    </td>
                    <td>
                        <h4>Delete</h4>
                    </td>

                </tr>
                <?php $sr = 1;
                foreach ($table as $row) {
                    $id = $row["id"]; ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td>
                            <a href="mailto:<?php echo $row["email_id"]; ?>"><?php echo $row["email_id"]; ?></a>
                        </td>
                        <td><?php echo $row["time"]; ?></td>
                        <td><?php echo $row["message"]; ?></td>

                        <td>
                            <button>
                                <?php echo "<a href='contact.php?dlt_id=", urlencode($id), "'>Delete</a>"; ?>
                            </button>
                        </td>
                    </tr>
            <?php }
            } else {
                echo "Please Login";
            } ?>
            </table>
        </div>
        <?php include("../shared/footer.php") ?>

</body>

</html>