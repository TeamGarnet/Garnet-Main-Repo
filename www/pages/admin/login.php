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


