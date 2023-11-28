<?php
session_start();
require_once '../database/connection.php';

$em = $_SESSION['name'];


$result = mysqli_query($conn, "SELECT * FROM complaints");
$num = mysqli_num_rows($result);



// Fetch the admin's full name from the database
$adminInfoQuery = "SELECT full_name FROM admin LIMIT 1";
$adminInfoResult = mysqli_query($conn, $adminInfoQuery);

// Check if the query was successful and the result is not null
if ($adminInfoResult && mysqli_num_rows($adminInfoResult) > 0) {
    // Assuming the admin table has a column 'full_name'
    $adminInfo = mysqli_fetch_assoc($adminInfoResult);
    $adminFullName = $adminInfo['full_name'];
} else {
    // If there is no direct login for admin, display a generic welcome message or any other relevant information
    $adminFullName = "Administrator";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../css/police.css">
    <link rel="shortcut icon" href="../favicon/complaint.ico" type="image/x-icon">
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
                <?php echo $adminFullName; ?>
            </p>
        </div>

        <div class="dash-main">
            <div class="dash-img">
                <img src="../img/logo.png" alt="img">
            </div>
            <div class="dash-all">
                <p class="master"><a href="admin.php">Complaints:
                        <?php echo $num; ?>
                    </a></p>
            </div>
        </div>
    </div>
</body>

</html>