<?php
include('../services/LoginService.class.php');
$errorMsgLogin = '';
if (isset($_POST['Login'])) {
    if ($_POST['email'] != "" && $_POST['password'] != "") {
        $LoginService = new LoginService();
        $validateUser = $LoginService -> validatePassword($_POST['email'], $_POST['password']);
        if ($validateUser) {
            session_start();
            $_SESSION['idUser'] = $validateUser;
            header('Location: home.php');
            //TODO: destory session on logout of broswer.
        } else {
            $errorMsgLogin = "Incorrect email and password combination";
        }
    }
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin/login.css" type="text/css">
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
</head>
<body>
<div id="login">

    <img src="../images/AdminLogo.png"
         srcset="../images/AdminLogo@2x.png 2x,
             ../images/AdminLogo@3x.png 3x"
         class="logo"/>

    <div id="headline"><h4>Administrator Login</h4></div>

    <div id="divider"></div>

    <form method="post" action="" name="login">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" autocomplete="off" placeholder="Enter email"/>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="off" placeholder="Enter password"/>

        <div class="errorMsg"><?php echo $errorMsgLogin; ?></div>

        <div id="forgotPassword"><a href="#">Forgot Password?</div>
        </a>

        <button type="Login" class="button" name="Login" value="Login">
            <div id="buttonText">Login</div>
        </button>
    </form>

</div>
</body>
</html>


