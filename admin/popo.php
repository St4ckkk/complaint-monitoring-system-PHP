<?php
session_start();
require_once '../database/connection.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php"); // Redirect to login page if not logged in
    exit();
}

// Function to display a success or error message
function showMessage($message, $isError = false)
{
    $class = $isError ? 'error' : 'success';
    echo "<div class='$class'>$message</div>";
}

// Check if the form for adding/editing police has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add new police record
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $badge_number = mysqli_real_escape_string($conn, $_POST['badge_number']);

        $addPoliceQuery = "INSERT INTO police (name, badge_number) VALUES ('$name', '$badge_number')";
        if (mysqli_query($conn, $addPoliceQuery)) {
            showMessage('Police record added successfully.');
        } else {
            showMessage('Error adding police record.', true);
        }
    } elseif (isset($_POST['edit'])) {
        // Edit existing police record
        $police_id = mysqli_real_escape_string($conn, $_POST['police_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $badge_number = mysqli_real_escape_string($conn, $_POST['badge_number']);

        $editPoliceQuery = "UPDATE police SET name='$name', badge_number='$badge_number' WHERE id='$police_id'";
        if (mysqli_query($conn, $editPoliceQuery)) {
            showMessage('Police record updated successfully.');
        } else {
            showMessage('Error updating police record.', true);
        }
    } elseif (isset($_POST['delete'])) {
        // Delete police record
        $police_id = mysqli_real_escape_string($conn, $_POST['police_id']);

        $deletePoliceQuery = "DELETE FROM police WHERE id='$police_id'";
        if (mysqli_query($conn, $deletePoliceQuery)) {
            showMessage('Police record deleted successfully.');
        } else {
            showMessage('Error deleting police record.', true);
        }
    }
}

// Fetch all police records from the database
$result = mysqli_query($conn, "SELECT * FROM police");
$num = mysqli_num_rows($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC-CMS Police Records</title>
    <link rel="stylesheet" href="../assets/css/police.css">
    <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
</head>

<body>
    <div class="container">

        <div class="nav">
            <p>SC-CMS</p>
            <a href="../partials/logout.php">
                <button class="logb">
                    Logout
                </button>
            </a>
        </div>

        <div class="dash-main">
            <h2>Police Records</h2>

            <!-- Display success/error messages -->
            <?php
            if (isset($_SESSION['message'])) {
                showMessage($_SESSION['message'], isset($_SESSION['error']));
                unset($_SESSION['message']);
                unset($_SESSION['error']);
            }
            ?>

            <!-- Display the list of police records -->
            <table class="com-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Badge Number</th>

                    <th>Actions</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['password']; ?>
                        </td>
                        <td>
                            <?php echo $row['badge_number']; ?>
                        </td>
                        <!-- Add more columns as needed -->

                        <!-- Action buttons for each record -->
                        <td>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="police_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="edit" value="Edit">
                                <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure?')">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <!-- Form for adding a new police record -->
            <h3>Add New Police Record</h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <!-- Add input fields for the new police record -->
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="name">Email:</label>
                <input type="text" name="email" required>
                <label for="badge_number">Badge Number:</label>
                <input type="text" name="badge_number" required>

                <!-- Add more input fields as needed -->

                <input type="submit" name="add" value="Add">
            </form>
        </div>
    </div>
</body>

</html>