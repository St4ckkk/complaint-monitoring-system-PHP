<?php
session_start();
require_once '../database/connection.php';
$trimmedMail = str_replace(".com", "", $_SESSION['registered-email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/complaint.css" />
    <title>Pending Complaints</title>
</head>

<body>
    <div class="container">
        <div class="nav">
            <p><a href="../dashboard.php" class="hlink">VoxFlow</a></p>
            <p1>Pending Complaints</p1>
            <a href="../destroy.php"><button class="logb">Logout</button></a>
        </div>
        <table class="com-table">
            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Mobile No.</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Time of Registration</th>
                    <th>Staff</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM complaints where email= '$trimmedMail' AND status='Pending'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>

                        <td scope="row" class="id">
                            <?php echo $row['C_Id'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Mob'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Category'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Location'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Priority'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Description'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['Reg_time'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['staff'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['status'] ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>