<?php
session_start();
require_once '../database/connection.php';


function showMessage($message, $isError = false)
{
    $class = $isError ? 'error' : 'success';
    echo "<div class='$class'>$message</div>";
}

// Check if the form for adding a new police record has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Add new police record
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $badge_number = mysqli_real_escape_string($conn, $_POST['badge_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $addPoliceQuery = "INSERT INTO police (name, badge_number, email, password) VALUES ('$name', '$badge_number', '$email', '$password')";
    if (mysqli_query($conn, $addPoliceQuery)) {
        echo "<script>alert('Police added successfully.'); window.location.href='add_popo.php';</script>";
    } else {
        showMessage('Error adding police record.', true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC-CMS Add Police Record</title>
    <link rel="stylesheet" href="../assets/css/police.css">
    <link rel="stylesheet" href="../assets/css/complaint.css">
    <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
</head>
<style>
    img {
        display: block;
        margin: auto;
        width: 200px;
        height: 200px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="container">

        <div class="nav">
            <p>SC-CMS</p>
            <a href="popo.php">
                <button class="logb">Return</button>
            </a>
        </div>
        <img src="../assets/img/PNP_-_South_Cotabato_PPO_29-removebg-preview.png" width="100px" height="100px" alt=""
            srcset="">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="badge_number">Badge Number:</label>
                <input type="text" id="badge_number" name="badge_number" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" name="add" value="Add">
            </div>
        </form>
    </div>
</body>

</html>