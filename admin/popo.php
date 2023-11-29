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
        // ... (Add your code to insert a new police record into the database)
        showMessage('Police record added successfully.');
    } elseif (isset($_POST['edit'])) {
        // Edit existing police record
        // ... (Add your code to update an existing police record in the database)
        showMessage('Police record updated successfully.');
    } elseif (isset($_POST['delete'])) {
        // Delete police record
        // ... (Add your code to delete a police record from the database)
        showMessage('Police record deleted successfully.');
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
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Badge Number</th>
                    <!-- Add more columns as needed -->
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
                <label for="badge_number">Badge Number:</label>
                <input type="text" name="badge_number" required>

                <!-- Add more input fields as needed -->

                <input type="submit" name="add" value="Add">
            </form>
        </div>
    </div>
</body>

</html>