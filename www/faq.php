<?php
include_once 'services/FAQService.class.php';
$faqService = new FAQService();
$allFAQInfo = $faqService -> formatFAQInfo();

//print_r($allTrailInfo);
?>
<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/thirdParty/font-awesome.css" type="text/css">
    <link href="css/thirdParty/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/thirdParty/YouTubePopUp.css" rel="stylesheet">
    <link href="css/thirdParty/imagehover.css" rel="stylesheet">
    <link href="css/thirdParty/dropdoun.css" rel="stylesheet">
    <link href="css/thirdParty/style.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="css/faq.css" type="text/css">
    <link rel="stylesheet" href="css/navbar.css" type="text/css">

    <!-- Favicon Info -->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">

    <title> FAQ </title>
</head>
<body>

<!-- Navigation -->
<?php include_once 'components/NavBar.php' ?>


<div class="container" id="pageContent">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="text-align: center; font-weight:bolder; padding-bottom: 2%;">Frequently Asked Questions</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" >
            <a class="btn downloadLink" download="UserManual.pdf" href="UserManual.pdf"> Download User Manaul</a>
        </div>
    </div>
    <div class="row">
        <?php
        echo $allFAQInfo;
        ?>
    </div>
</div>

</body>
</html>