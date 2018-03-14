<?php
include('../../services/LoginService.class.php');
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
    <link rel="stylesheet" href="../../pages/css/admin/home.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="120x120" href="../../pages/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/pages/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/pages/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
	<body>
		<div id="login">
			
			<img src="../../pages/images/AdminLogo.png" 
			srcset="../../pages/images/AdminLogo@2x.png 2x,
             ../../pages/images/AdminLogo@3x.png 3x"
			class="logo"/>
			
			<div id ="headline"><h4>Administrator Login</h4></div>
			
			<div id="divider"></div>

			<form method="post" action="" name="login">
			
				<label for="email">Email</label>
				<input type="text" id="email" name="email" autocomplete="off" placeholder=" Enter email"/>

				<label for="password">Password</label>
				<input type="password" id="password" name="password" autocomplete="off" placeholder=" Enter password"/>

				<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
				
				<div id="forgotPassword"><a href="#">Forgot Password?</div></a>
				
				<button type="Login" class="button" name="Login" value="Login"><div id="buttonText">Login</div></button>
			</form>

		</div>
	</body>
</html>


