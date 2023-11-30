<?php
session_start();
require_once '../database/connection.php';

$em = $_SESSION['name'];


$result = mysqli_query($conn, "SELECT * FROM complaints where police= '$em' ");
$num = mysqli_num_rows($result);

$result1 = mysqli_query($conn, "SELECT * FROM complaints where police= '$em' AND status='Resolved' ");
$num1 = mysqli_num_rows($result1);

$result2 = mysqli_query($conn, "SELECT * FROM complaints where police= '$em' AND status='Pending' ");
$num2 = mysqli_num_rows($result2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police - Dashboard</title>
    <link rel="stylesheet" href="../assets/css/police.css">
    <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
</head>

<body>
    <div class="container">

        <div class="nav">
            <p>SC-CMS</p>
            <a href="../logout.php">
                <button class="logb">
                    Logout
                </button>
            </a>
        </div>
        <div class="wtext">
            <p>Welcome,
                <?php echo $_SESSION['name']; ?>
            </p>
        </div>

        <div class="dash-main">
            <div class="dash-img">
                <img src="../assets/img/Logo-of-SouthCot-Logo.png" alt="img">
            </div>
            <div class="dash-all">
                <p><a href="popo_total_complaints.php">Total Complaints:
                        <?php echo $num; ?>
                    </a></p>
                <p><a href="popo_resolved_complaints.php">Resolved Complaints:
                        <?php echo $num1; ?>
                    </a></p>
                <p><a href="popo_pending_complaints.php">Pending Complaints:
                        <?php echo $num2; ?>
                    </a></p>
                <p class="master"><a href="#" onClick=mastercode()> Admin Access </a></p>
            </div>
        </div>
    </div>
    <script>
        function mastercode() {
            var userInput = prompt("Enter the Master Code:");
            if (userInput == "5261") {
                window.location.href = "../admin/admin_dashboard.php";
            }
            else {
                alert("Dont try to overstep your boundaries🤡");
            }
        }
    </script>
</body>

</html>