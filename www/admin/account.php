<?php
include('../services/LoginService.class.php');
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- The meta tags MUST come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title> Admin Account Creation </title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Favicon Info -->
    <link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../css/admin/login.css" type="text/css">


</head>
<body>
<div id="login">

    <img src="../images/AdminLogo.png"
         srcset="../images/AdminLogo@2x.png 2x,
             ../images/AdminLogo@3x.png 3x"
         class="logo create"/>

    <div id="headline" class="create"><h4>Administrator Account Creation</h4></div>

    <div id="divider" class="create"></div>

    <form action="login.php" method="post" class="create">

        <label for="masterEmail" class="create">Master Email</label>
        <input type="text" id="masterEmail" name="masterEmail" placeholder="Enter Master Email">

        <label for="masterPWD" class="create">Master Password</label>
        <input type="password" id="masterPWD" name="masterPWD" placeholder="Enter Master Password" class="create">

        <label for="newEmail" class="create">Set New Email</label>
        <input type="text" id="newEmail" name="newEmail" placeholder="Enter Email">

        <label for="newPwd" class="create">Set New Password</label>
        <input type="password" id="newPwd" name="newPwd" placeholder="Enter Password" class="create">

        <div id="divider" class="create"></div>

        <button type="submit" class="button" name="submit" value="Create Admin">
            <div id="buttonText">Create Admin</div>
        </button>
    </form>
</div>
</body>
</html>

