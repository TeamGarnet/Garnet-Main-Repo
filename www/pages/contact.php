<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../pages/css/thirdParty/font-awesome.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="../pages/css/contact.css" type="text/css">
    <link rel="stylesheet" href="../pages/css/staticNavigation.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Favicon Info -->
    <link rel="apple-touch-icon" sizes="57x57" href="../pages/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../pages/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../pages/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../pages/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../pages/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../pages/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../pages/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../pages/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../pages/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../pages/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../pages/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../pages/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../pages/favicon/favicon-16x16.png">
    <link rel="manifest" href="../pages/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../pages/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="../pages/favicon/site.webmanifest">
    <link rel="mask-icon" href="../pages/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <title> Contacts </title>
</head>
<body>

    <!-- Navigation -->
    <?php include '../components/StaticNav.php'?>



<div class="container" id="pageContent">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="text-align: center; font-weight:bolder; padding-bottom: 2%;">Rapids History Contacts</h3>
        </div>
    </div>

<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="contactCardOutter">
				<div class="contactCard">
					<p class="name">Name </p>
					<p class="title">Title </p>
					<p class="description">Description </p>
					<p class="email">Email </p>
					<p class="phone">Phone </p>
				</div>
			</div>
		</div>
	
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="contactCardOutter">
				<div class="contactCard">
					<p class="name">Name </p>
					<p class="title">Title </p>
					<p class="description">Description </p>
					<p class="email">Email </p>
					<p class="phone">Phone </p>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="contactCardOutter">
				<div class="contactCard">
					<p class="name">Name </p>
					<p class="title">Title </p>
					<p class="description">Description </p>
					<p class="email">Email </p>
					<p class="phone">Phone </p>
				</div>
			</div>
		</div>
	</div>

    <div class="row">
        <?php
        echo $allTrailInfo;
        ?>
    </div>
</div>

</body>
</html>