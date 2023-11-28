<?php
require_once '../database/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintId = $_POST['complaint_id'];
    $selectedStaffId = $_POST['staff_id'];

    // Fetch the selected staff's name
    $selectedStaffQuery = "SELECT name FROM staff WHERE id = '$selectedStaffId'";
    $selectedStaffResult = mysqli_query($conn, $selectedStaffQuery);

    if ($selectedStaffResult && mysqli_num_rows($selectedStaffResult) > 0) {
        $selectedStaffRow = mysqli_fetch_assoc($selectedStaffResult);
        $selectedStaffName = $selectedStaffRow['name'];

        // Update the complaint with the selected staff's name
        $updateQuery = "UPDATE complaints SET staff = '$selectedStaffName' WHERE id = $complaintId";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Successfully assigned staff
            echo "<script>alert('Staff assigned successfully!');</script>";
            header('Location: admin.php');
        } else {
            // Failed to assign staff
            echo "<script>alert('Failed to assign staff. Please try again.');</script>";
            header('Location: admin.php');
        }
    } else {
        // Failed to fetch selected staff's name
        echo "<script>alert('Failed to fetch selected staff's name.');</script>";
        header('Location: admin.php');
    }
}
?>