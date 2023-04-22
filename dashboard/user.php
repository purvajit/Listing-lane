<?php
session_start();
include("../connection.php");
include("../function.php"); //from function.php
$user_data = check_dashboard_admin($con);

if (isset($user_data["username"])) {
    if (isset($_GET['username'])) {
        $username = $_GET['username'];

        $query = "SELECT * FROM `user` WHERE username = '$username' limit 1";
        $data = $con->query($query);
        $data = mysqli_fetch_assoc($data);

        $new_status = 1 - (int)$data["is_active"];
        mysqli_query($con, "UPDATE `user` SET `is_active`= $new_status WHERE username = '$username'");
        unset($_GET['username']);
        header("Location: ./user.php");
    }

    $current_admin_user = $user_data["username"];
    // so admin can not block himself
    $query = "SELECT `username`, `first_name`, `last_name`, `email_id`, `is_admin`, `is_active` FROM `user` WHERE username != '$current_admin_user'";
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

        table{
            width: 70%;
            border: 1px solid var(--colour1);
            margin: 50px;
            border-collapse: collapse;
        }
        
        tr{
            color: var(--colour1);
        }
        tr:nth-child(odd){
            background-color: var(--colour2);
        }

        td,th {
            height: 60px;
            text-align:center;
            border: 1px solid var(--colour1);
            padding: 1rem;
            text-align: center;
            max-width: 250px;
        }

        button {
            padding: 0.5rem 1.5rem;
        }

        a {
            font-weight: 900;
            color: var(--colour1);
        }
        button{
            margin: 0px;
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
                        <h4>FirstName</h4>
                    </td>
                    <td>
                        <h4>Last Name</h4>
                    </td>
                    <td>
                        <h4>Status</h4>
                    </td>
                    <td>
                        <h4>Role</h4>
                    </td>
                    <td>
                        <h4>Change Status</h4>
                    </td>

                </tr>
                <?php $sr = 1;
                foreach ($table as $row) {
                    $id = $row["username"];
                    $color = $row["is_active"] == 1 ? "#049b706c" : "#630f0f6c";

                ?>
                    <tr style="background-color: <?php echo $color; ?>">
                        <td><b><?php echo $sr++; ?></b></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["first_name"]; ?></td>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?= $row["is_active"] == 1 ? "Active" : "Blocked" ?></td>
                        <td><?= $row["is_admin"] == 1 ? "<b>Admin</b>" : "User" ?></td>

                        <td>
                            <?php
                            if ($row["is_active"] == 1) {
                                echo "<a href='user.php?username=", urlencode($id), "'><button>Block</button></a>";
                            } else {
                                echo "<a href='user.php?username=", urlencode($id), "'><button>Unblock</button></a>";
                            } ?>

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