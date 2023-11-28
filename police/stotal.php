<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total complaints</title>
    <link rel="stylesheet" href="../css/complaint.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <p><a href="staff.php" class="hlink">SC-CMS</a></p>
            <p1>All Complaints</p1>
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
                    <th colspan="2">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once '../database/connection.php';
                session_start();

                $em = $_SESSION['name'];

                $sql = "SELECT * FROM complaints where staff= '$em' ";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>

                        <td scope="row" class="id">
                            <?php echo $row['id'] ?>
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
                        <?php
                        if ($row['status'] == "Resolved") {
                            ?>
                            <td class="tab"><a href="resolved.php?id=<?php echo $row['C_Id']; ?>"><button
                                        class='alress'>Resolved</button></a></td>
                            <?php
                        }
                        if ($row['status'] != "Resolved") {
                            ?>
                            <td class="tab"><a href="resolved.php?id=<?php echo $row['C_Id']; ?>"><button
                                        class='ress'>Resolve</button></a></td>


                        </tr>
                        <?php
                        }
                }
                ?>
            </tbody>
        </table>
</body>

</html>