<?php
session_start();
include("connection.php");
include("function.php"); //from function.php
$user_data = check_login($con);

if (isset($_GET['dlt_id'])) {
    $dlt_id = $_GET['dlt_id'];
    $delete = mysqli_query($con, "DELETE FROM `property` WHERE `property_id`='$dlt_id'");
    unset($_GET['dlt_id']);
    header("Location: manage.php");
}

$query = "select property_id,property_name,city FROM property";
$all_property = $con->query($query);
$table = array();
while ($row = mysqli_fetch_assoc($all_property)) {
    $table[] = $row;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
        .box{
            display:flex; 
            flex-direction:row; 
            justify-content:center;
        }
    </style>
</head>

<body>
    <?php include("./shared/header.php") ?>
    <div><?php echo "<a href='upload.php'>New</a>"; ?></div>
    <div class="box">
        <table>
            <tr>
                <td><h4>Sr.No</h4></td>
                <td><h4>Property Id</h4></td>
                <td><h4>Property Name</h4></td>
                <td><h4>City</h4></td>
                <td><h4>Edit</h4></td>
                <td><h4>Delete</h4></td>

            </tr>
            <?php $sr = 1;
            foreach ($table as $row) {
                $id = $row["property_id"]; ?>
                <tr>
                    <td><?php echo $sr++; ?></td>
                    <td><?php echo $row["property_id"]; ?></td>
                    <td><?php echo $row["property_name"]; ?></td>
                    <td><?php echo $row["city"]; ?></td>
                    <td><?php echo "<a href='index.php'>Edit</a>"; ?></td>
                    <td><?php echo "<a href='manage.php?dlt_id=", urlencode($id), "'>Delete</a>"; ?></td>

                </tr>
            <?php } ?>
        </table>
    </div>
    <?php include("./shared/footer.php") ?>

</body>

</html>