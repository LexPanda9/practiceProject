<?php
require_once("../controller/controller.php");
if (isset($_SESSION["logged_admin"]) && !empty($_SESSION["logged_admin"])) {

} else {
    header("location:admin-login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>DASHBOARD</h1>
    <?php if (isset($_SESSION["logged_admin"]) && !empty($_SESSION["logged_admin"])) { ?>
    <div>
       <a href="admin-logout.php">Log Out</a>
    </div>
    <?php } ?>
</body>
</html>