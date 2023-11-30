<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending complaints</title>
    <link rel="stylesheet" href="../assets/css/complaint.css">
</head>

<body>
    <div class="container">
        <div class="nav">

            <p><a href="police_dashboard.php" class="hlink">SC-CMS</a></p>
            <p1>Previous Complaints</p1>
            <a href="police_dashboard.php"><button class="logb">Return</button></a>
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
                    <th>Police</th>
                    <th colspan="2">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once '../database/connection.php';
                session_start();

                $em = $_SESSION['name'];

                $sql = "SELECT * FROM complaints where police= '$em' AND status='Pending' ";
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
                            <?php echo $row['police'] ?>
                        </td>
                        <td scope="row" class="tab">
                            <?php echo $row['status'] ?>
                        </td>
                        <td class="tab" colspan="2">
                            <!-- Display Resolve button -->
                            <?php if ($row['status'] == "Resolved"): ?>
                                <a href="resolved.php?id=<?php echo $row['id']; ?>"><button class='alress'>Resolved</button></a>
                            <?php else: ?>
                                <a href="resolved.php?id=<?php echo $row['id']; ?>"><button class='ress'>Resolve</button></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
</body>

</html>