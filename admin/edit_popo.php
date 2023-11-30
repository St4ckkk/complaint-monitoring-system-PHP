<?php
session_start();
require_once '../database/connection.php';

$policeData = [
    'name' => '',
    'badge_number' => '',
    'email' => '',
    'password' => '',
]; // Initialize $policeData with default values

// Assuming you have the necessary logic to fetch the police record for editing
if (isset($_SESSION['registered-email']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve existing data for the police record to pre-fill the form
    $police_id = $_POST['police_id'];
    $query = mysqli_query($conn, "SELECT * FROM police WHERE id = '$police_id'");
    $policeData = mysqli_fetch_assoc($query) ?? $policeData; // Use default values if query result is null
}

// Check if the form for updating police details has been submitted
if (isset($_POST['update'])) {
    // Update police record
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $badge_number = mysqli_real_escape_string($conn, $_POST['badge_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $updatePoliceQuery = "UPDATE police SET name='$name', badge_number='$badge_number', email='$email', password='$password' WHERE id='$police_id'";
    if (mysqli_query($conn, $updatePoliceQuery)) {
        echo "<script>alert('Police record updated successfully.'); window.location.href='edit_popo.php';</script>";
        header('Location: popo.php');
    } else {
        showMessage('Error updating police record.', true);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC-CMS Edit Police Record</title>
    <link rel="stylesheet" href="../assets/css/police.css">
    <link rel="stylesheet" href="../assets/css/complaint.css">
    <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
</head>

<body>
    <div class="container">

        <div class="nav">
            <p>SC-CMS</p>
            <a href="../dashboard.php">
                <button class="logb">Return</button>
            </a>
        </div>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <input type="hidden" name="police_id" value="<?php echo $police_id; ?>">

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $policeData['name']; ?>" required>
            </div>
            <div>
                <label for="badge_number">Badge Number:</label>
                <input type="text" id="badge_number" name="badge_number"
                    value="<?php echo $policeData['badge_number']; ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $policeData['email']; ?>" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo $policeData['password']; ?>"
                    required>
            </div>

            <!-- Add more input fields as needed -->

            <div>
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>

</html>