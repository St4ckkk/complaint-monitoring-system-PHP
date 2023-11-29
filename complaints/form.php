<?php
session_start();
require_once '../database/connection.php';

$em = $_SESSION['registered-email'];

if (isset($_SESSION['registered-email']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $mob = $_POST['mobile'];
  $category = $_POST['category'];
  $loc = $_POST['location'];
  $priority = $_POST['priority'];
  $desc = $_POST['description'];
  $em = $_SESSION['registered-email'];

  $query = mysqli_query($conn, "INSERT into complaints (email, Mob, Category, Location, Priority, Description, Reg_time) VALUES ('$em','$mob','$category','$loc','$priority','$desc',current_timestamp()) ");

  header("Location: pending.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SC-CMS Complaint Form</title>
  <link rel="stylesheet" href="../assets/css/complaint.css" />
  <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
</head>

<body>
  <div class="container">

    <div class="nav">
      <p><a href="../dashboard.php" class="hlink">SC-CMS</a></p>
      <a href="../dashboard.php"><button class="logb">Return</button></a>
    </div>

    <form action="form.php" method="post" enctype="multipart/form-data">

      <div>
        <label for="mobile">Mobile Number: (*optional)</label>
        <input type="tel" id="mobile" name="mobile">
      </div>
      <div>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
          <option value="">Select Category</option>
          <option value="Traffic Violations">Traffic Violations</option>
          <option value="Criminal Activities">Criminal Activities</option>
          <option value="Public Disturbance">Public Disturbance</option>
          <option value="Domestic Incidents">Domestic Incidents</option>
          <option value="Illegal Substance Use">Illegal Substance Use</option>
          <option value="Fraud and Scams">Fraud and Scams</option>
          <option value="Community Relations">Community Relations</option>
          <option value="Missing Persons">Missing Persons</option>
          <option value="Property Crimes">Property Crimes</option>
          <option value="Other">Other</option>
        </select>

      </div>
      <div>
        <label for="location">Location: </label>
        <input type="text" id="location" name="location">
      </div>
      <div>
        <label for="priority">Priority Level:</label>
        <select id="priority" name="priority" required>
          <option value="">Select Priority</option>
          <option value="High">High</option>
          <option value="Medium">Medium</option>
          <option value="Low">Low</option>
        </select>
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
      </div>
      <div>
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>

</body>

</html>