<?php
session_start();
include("../connection.php");
include("../function.php"); //from function.php
$user_data = check_dashboard_admin($con);

if (isset($user_data["username"])) {
    if (isset($_GET['dlt_id'])) {
        $dlt_id = $_GET['dlt_id'];

        $data = $dlt_id . 'image1.jpg';
        $dir = "../uploads/";
        $dirHandle = opendir($dir);
        while ($file = readdir($dirHandle)) {
            if ($file == $data) {
                unlink($dir . "/" . $file); //give correct path,
            }
        }
        closedir($dirHandle);
        $data = $dlt_id . 'image2.jpg';
        $dir = "../uploads/";
        $dirHandle = opendir($dir);
        while ($file = readdir($dirHandle)) {
            if ($file == $data) {
                unlink($dir . "/" . $file); //give correct path,
            }
        }
        closedir($dirHandle);



        $delete = mysqli_query($con, "DELETE FROM `property` WHERE `property_id`='$dlt_id'");
        unset($_GET['dlt_id']);
        header("Location: manage.php");
    }

    $query = "select property_id, property_name, city, image1, image2 FROM property";
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
            width: 70%;
            border: 1px solid var(--colour1);
            margin: 50px;
            border-collapse: collapse;
        }

        tr {
            color: var(--colour1);
        }

        tr:nth-child(odd) {
            background-color: var(--colour5);
        }

        td,
        th {
            text-align: center;
            border: 1px solid var(--colour1);
            padding: 0.5rem;
            text-align: center;
            max-width: 250px;
        }


        button {
            padding: 0.5rem 1.5rem;
            margin: 0px;
        }

        a {
            font-weight: 900;
            color: var(--colour1);
        }

        button {
            margin: 0px;
        }

        img {
            width: 100px;
            margin: 2px;
        }

        .images {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <?php include("../shared/header.php") ?>
    <?php if (isset($user_data["username"])) { ?>

        <div class="container">
            <td>
                <?php echo "<a href='upload.php'><button>Add a new property</button></a>"; ?>
            </td>
        </div>

        <div class="box">
            <table>
                <tr>
                    <th>
                        <h4>Sr.No</h4>
                    </th>
                    <th>
                        <h4>Property Id</h4>
                    </th>
                    <th>
                        <h4>Property Name</h4>
                    </th>
                    <th>
                        <h4>City</h4>
                    </th>
                    <th>
                        <h4>Image1</h4>
                    </th>
                    <th>
                        <h4>Image2</h4>
                    </th>
                    <th>
                        <h4>Action</h4>
                    </th>

                </tr>
                <?php $sr = 1;
                foreach ($table as $row) {
                    $id = $row["property_id"]; ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $row["property_id"]; ?></td>
                        <td><?php echo $row["property_name"]; ?></td>
                        <td><?php echo $row["city"]; ?></td>
                        <td calss="images">
                            <img src="/Innovative/uploads/<?php echo $row["image1"]; ?>" alt="">
                        </td>
                        <td calss="images">
                            <img src="/Innovative/uploads/<?php echo $row["image2"]; ?>" alt="">
                        </td>
                        <td>
                            <?php echo "<a href='edit.php?edit_id=", urlencode($id), "'><button>Edit</button></a>"; ?>


                            <button onclick="onDelete(<?php echo $id ?>);">Delete</button>
                        </td>
                    </tr>
            <?php }
            } else {
                echo "Please Login";
            } ?>
            </table>
        </div>
        <script>
            function onDelete(id) {
                const ans = confirm("Are you sure you want to delete?");
                if (ans) {
                    window.location.href = `manage.php?dlt_id=${id}`;
                }
            }
        </script>
</body>

</html>