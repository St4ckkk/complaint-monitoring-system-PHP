<?php
require_once '../database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintId = $_POST['complaint_id'];
    $selectedPoliceId = $_POST['police_id'];

    // Fetch the selected police name
    $selectedPoliceQuery = "SELECT name FROM police WHERE id = '$selectedPoliceId'";
    $selectedPoliceResult = mysqli_query($conn, $selectedPoliceQuery);

    if ($selectedPoliceResult && mysqli_num_rows($selectedPoliceResult) > 0) {
        $selectedPoliceRow = mysqli_fetch_assoc($selectedPoliceResult);
        $selectedPoliceName = $selectedPoliceRow['name'];

        // Update the complaint with the selected staff's name
        $updateQuery = "UPDATE complaints SET police = '$selectedPoliceName' WHERE id = $complaintId";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Successfully assigned staff
            echo "<script>alert('Police assigned successfully!');</script>";
            header('Location: admin.php');
        } else {
            // Failed to assign staff
            echo "<script>alert('Failed to assign Police. Please try again.');</script>";
            header('Location: admin.php');
        }
    } else {
        // Failed to fetch selected staff's name
        echo "<script>alert('Failed to fetch selected Police name.');</script>";
        header('Location: admin.php');
    }
}
?>