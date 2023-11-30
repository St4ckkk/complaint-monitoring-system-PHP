<?php

require_once '../database/connection.php';

session_start();

if (isset($_SESSION['email'])) {
    header('location: index.php');

} elseif (isset($_POST['email'])) {
    $sem = $_POST['email'];
    $fullName = $_POST['full_name'];
    $spass = $_POST['password'];

    $sql = mysqli_query($conn, "INSERT INTO users (name, email, upassword, joining_date) VALUES ('$fullName','$sem', '$spass', current_timestamp())");

    session_start();
    $_SESSION['email'] = $sem;
    header('location: index.php');

} elseif (isset($_POST['registered-email'])) {
    $pem = $_POST['registered-email'];
    $ppass = $_POST['registered-password'];
    $badgeNumber = $_POST['badge_number'];

    $query = "SELECT email, upassword FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $pem);
    $stmt->execute();
    $stmt->bind_result($dbemail, $dbpassword);
    $stmt->fetch();
    $stmt->close();

    if ($dbemail == $pem && $dbpassword == $ppass && $pcode == null) {
        session_start();
        $_SESSION['registered-email'] = $pem;

        header('location: ../user/user_dashboard.php');
    } elseif (!empty($badgeNumber)) {
        $query1 = "SELECT email, password, badge_number FROM police WHERE email = ?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("s", $pem);
        $stmt->execute();
        $stmt->bind_result($dbemail1, $dbpassword1, $dbBadgeNumber);
        $stmt->fetch();
        $stmt->close();

        if ($dbemail1 == $pem && $dbpassword1 == $ppass) {

            $query2 = "SELECT name FROM police WHERE email = ?";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("s", $dbemail1);
            $stmt->execute();
            $stmt->bind_result($dbname);
            $stmt->fetch();
            $stmt->close();

            session_start();
            $_SESSION['registered-email'] = $pem;
            $_SESSION['name'] = $dbname;
            header('location:../police/police_dashboard.php');
        }

    } else {
        if ($dbemail == null) {
            ?>
            echo '
            <script>
                alert("There\'s no account with this Email. Sign-in");
                window.location.href = "index.php"; // Adjust the URL as needed
            </script>';
        <?php } else { ?>
            echo '
            <script>
                alert("Incorrect Username or Password");
                window.location.href = "index.php"; // Adjust the URL as needed
            </script>';

            <?php
        }
    }
}
?>