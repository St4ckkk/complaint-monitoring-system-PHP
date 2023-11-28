<?php
session_start();
require_once '../database/connection.php';

$result = mysqli_query($conn, "SELECT * FROM complaints");
$num = mysqli_num_rows($result);

$result1 = mysqli_query($conn, "SELECT * FROM complaints where status='Resolved' ");
$num1 = mysqli_num_rows($result1);

$result2 = mysqli_query($conn, "SELECT * FROM complaints where status='Pending' ");
$num2 = mysqli_num_rows($result2);

$result3 = mysqli_query($conn, "SELECT * FROM complaints where Priority='High' ");
$num3 = mysqli_num_rows($result3);

$result4 = mysqli_query($conn, "SELECT * FROM complaints where staff='Unassigned' AND status='Pending'");
$num4 = mysqli_num_rows($result4);

$sqlStaff = "SELECT * FROM staff";
$resultStaff = mysqli_query($conn, $sqlStaff);
$staffMembers = mysqli_fetch_all($resultStaff, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../css/police.css">
    <link rel="shortcut icon" href="../favicon/complaint.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="nav">
            <p>SC-CMS</p>
            <p1>All Complaints:
                <?php echo $num; ?>
            </p1>
            <p1>Resolved Complaints:
                <?php echo $num1; ?>
            </p1>
            <p1>Pending Complaints:
                <?php echo $num2; ?>
            </p1>
            <p1>High Priority Complaints:
                <?php echo $num3; ?>
            </p1>
            <p1>Unassigned Complaints:
                <?php echo $num4; ?>
            </p1>
            <a href="../logout.php">
                <button class="logb">
                    Logout
                </button>
            </a>
        </div>
        <div class="content">
            <div class="con-updates">
                <p>Complain Id <i class="fas fa-angle-down"></i></i></p>
                <p>Category <i class="fas fa-angle-down"></i></i></p>
                <p>Location <i class="fas fa-angle-down"></i></i></p>
                <p>Priority <i class="fas fa-angle-down"></i></i></p>
                <p>Year <i class="fas fa-angle-down"></i></i></p>
                <p>Date <i class="fas fa-angle-down"></i></i></p>
                <p>Staff <i class="fas fa-angle-down"></i></i></p>
                <p>Status <i class="fas fa-angle-down"></i></i></p>
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

                    $em = $_SESSION['name'];

                    $sql = "SELECT * FROM complaints ";
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
                                <?php
                                if ($row['staff'] == 'Unassigned') {
                                    // Display dropdown for assigning police
                                    ?>
                                    <form action="assign.php" method="post">
                                        <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
                                        <select name="staff_id">
                                            <?php foreach ($staffMembers as $staff): ?>
                                                <option value="<?php echo $staff['id']; ?>">
                                                    <?php echo $staff['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="ress">Assign</button>
                                    </form>
                                    <?php
                                } else {
                                    // Display assigned staff name
                                    $assignedStaffQuery = "SELECT name FROM staff WHERE name = '{$row['staff']}'";
                                    $assignedStaffResult = mysqli_query($conn, $assignedStaffQuery);
                                    $assignedStaffInfo = mysqli_fetch_assoc($assignedStaffResult);

                                    $assignedStaffInfo = $assignedStaffInfo ?? [];

                                    if ($assignedStaffInfo) {

                                        echo $assignedStaffInfo['name'];
                                    } else {

                                        echo "Unassigned";
                                    }
                                }
                                ?>
                            </td>


                            <td class="tab" colspan="2">
                                <!-- Display Resolve button -->
                                <?php if ($row['status'] == "Resolved"): ?>
                                    <a href="resolved.php?id=<?php echo $row['id']; ?>"><button
                                            class='alress'>Resolved</button></a>
                                <?php else: ?>
                                    <a href="resolved.php?id=<?php echo $row['id']; ?>"><button
                                            class='ress'>Resolve</button></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>