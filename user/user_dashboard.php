<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC-CMS User Dashboard</title>
    <link rel="shortcut icon" href="../assets/favicon/complaint.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/user_dashboard.css" />
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
        <div class="main">
            <div class="wtext">
                <p>Welcome, what can we do for you?
                </p>
            </div>

            <div class="uactions">
                <div class="item">
                    <a href="../complaints/form.php"><button class="actionb">Initialize Complaint</button></a>
                    <a href="../complaints/previous.php"><button class="actionb">Previous Complaints</button></a>
                    <a href="../complaints/resolved.php"><button class="actionb">Resolved Complaints</button></a>
                    <a href="../complaints/pending.php"><button class="actionb">Pending Complaints</button></a>
                </div>
                <img src="../assets/img/complain.jpg" alt="">
            </div>
        </div>
    </div>


</body>

</html>