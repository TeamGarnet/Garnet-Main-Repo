<?php
include('../services/LoginService.class.php');
$errorMsgLogin = '';
if (isset($_POST['Login'])) {
    if ($_POST['email'] != "" && $_POST['password'] != "") {
        $LoginService = new LoginService();
        $validateUser = $LoginService -> loginAccount($_POST['email'], $_POST['password']);
        if ($validateUser) {
            session_start();
            $_SESSION['idUser'] = $validateUser;
            header('Location: home.php');
        } else {
            $errorMsgLogin = "Incorrect email and password combination";
        }
    }
} else {
    if ( isset($_POST['newEmail']) && isset($_POST['newPwd']) && isset($_POST['masterEmail']) && isset($_POST['masterPWD']) ) {
        $LoginService = new LoginService();
        $validateUser = $LoginService -> createAccount($_POST['newEmail'], $_POST['newPwd'],$_POST['masterEmail'],$_POST['masterPWD']);
        if ($validateUser == false) {
            $errorMsgLogin = "Account Not Created";
        }
    }
}
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

    <title> Admin Login </title>

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
         class="logo"/>

    <div id="headline"><h4>Administrator Login</h4></div>
    </br>

    <div id="divider"></div>

    <form method="post" action="" name="login">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" autocomplete="off" placeholder="Enter email"/>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="off" placeholder="Enter password"/>

        <div class="errorMsg"><?php echo $errorMsgLogin; ?></div>

        <button type="Login" class="button" name="Login" value="Login">
            <div id="buttonText">Login</div>
        </button>
    </form>

</div>
</body>
</html>


