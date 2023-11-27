<?php

require_once './database/connection.php';

session_start();

if (isset($_SESSION['email'])) {
    header('location:dashboard.php');
} elseif (isset($_POST['email'])) {
    $sem = $_POST['email'];
    $spass = $_POST['password'];

    $sql = mysqli_query($conn, "INSERT INTO users (email, upassword, joining_date) VALUES ('$sem', '$spass', current_timestamp())");

    session_start();
    $_SESSION['email'] = $sem;
    header('location:dashboard.php');

} elseif (isset($_POST['police-email'])) {
    $pem = $_POST['police-email'];
    $ppass = $_POST['police-password'];

    $pcode = $_POST['code'];

    $query = "SELECT email, upassword FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $pem);
    $stmt->execute();
    $stmt->bind_result($dbemail, $dbpassword);
    $stmt->fetch();
    $stmt->close();

    if ($dbemail == $pem && $dbpassword == $ppass && $pcode == null) {
        session_start();
        $_SESSION['police-email'] = $pem;

        header('location:dashboard.php');
    } elseif ($pcode == '5t@11') {
        $query1 = "SELECT Email, Password FROM staff WHERE Email = ?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("s", $pem);
        $stmt->execute();
        $stmt->bind_result($dbemail1, $dbpassword1);
        $stmt->fetch();
        $stmt->close();

        if ($dbemail1 == $pem && $dbpassword1 == $ppass) {

            $query2 = "SELECT Name FROM staff WHERE Email = ?";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("s", $dbemail1);
            $stmt->execute();
            $stmt->bind_result($dbname);
            $stmt->fetch();
            $stmt->close();

            session_start();
            $_SESSION['police-email'] = $pem;
            $_SESSION['name'] = $dbname;
            header('location:./police/staff.php');
        }

    } else {
        if ($dbemail == null) {
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Unsuccessful</title>
            </head>

            <body>
                <a href="index.html">Return</a>
                <script>alert("Theres no account with this Email. Sign-in");</script>
            </body>

            </html>
        <?php } else { ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Unsuccessful</title>
            </head>

            <body>
                <a href="index.php">Return</a>
                <script>alert("Incorrect Username or Password");</script>
            </body>

            </html>

            <?php
        }
    }
}
?>