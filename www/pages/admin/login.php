<!-- PHP -->
<?php
include('../../data/UserData.class.php');
include('../../data/URLs.php');
$userData = new UserData();

$errorMsgReg = '';
$errorMsgLogin = '';

if (!empty($_POST['loginSubmit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (strlen(trim($email)) > 1 && strlen(trim($password)) > 1) {
        $idUser = $userData -> userLogin($email, $password);
        if ($idUser) {
            $url = $BASEAdminURL . 'admin/home.php';
            header("Location: $url"); // Page redirecting to home.php
        } else {
            $errorMsgLogin = "Please check login details.";
        }
    }
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/pages/css/admin/home.css" type="text/css">
    <link rel="apple-touch-icon" sizes="60x60" href="../../pages/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../../pages/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../../pages/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../../pages/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../../pages/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../../pages/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../../pages/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../../pages/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../../pages/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../pages/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../pages/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../pages/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div id="login">
    <h3>Login</h3>

    <form method="post" action="" name="login">

        <label>Email</label>
        <input type="email" name="email" autocomplete="off"/>

        <label>Password</label>
        <input type="password" name="password" autocomplete="off"/>

        <div class="errorMsg"><?php echo $errorMsgLogin; ?></div>

        <input type="submit" class="button" name="loginSubmit" value="Login">
    </form>

</div>
</body>
</html>


