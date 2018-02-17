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
			
				<label for="username">Username</label>
				<input type="username" id="username" name="username" autocomplete="off" placeholder=" Enter username"/>

				<label for="password">Password</label>
				<input type="password" id="password" name="password" autocomplete="off" placeholder=" Enter password"/>

				<div class="errorMsg"><?php echo $errorMsgLogin; ?></div>
				
				<div id="forgotPassword"><a href="#">Forgot Password?</div></a>
				
				<button type="Login" class="button" name="Login" value="Login"><div id="buttonText">Login</div></button>
			</form>

		</div>
	</body>
</html>


