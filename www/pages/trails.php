<?php
include '../services/TrailService.class.php';
$trailService = new TrailService();
$allTrailInfo = $trailService ->getAllTrailLocationInfo();
//print_r($allTrailInfo);
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="/path/to/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Historic Trails </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/pages/css/thirdParty/font-awesome.css" type="text/css">
    <link href="/pages/css/thirdParty/bootstrap.min.css" rel="stylesheet"/>
    <link href="/pages/css/thirdParty/YouTubePopUp.css" rel="stylesheet">
    <link href="/pages/css/thirdParty/imagehover.css" rel="stylesheet">
    <link href="/pages/css/thirdParty/dropdoun.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <link rel="apple-touch-icon" sizes="120x120" href="/pages/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/pages/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/pages/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="/pages/css/trails.css" type="text/css">
    <link rel="stylesheet" href="/pages/css/maps.css" type="text/css">
</head>
<body>

    <!-- Navigation -->
    <div id="'navigation">
    <?php include '../components/Navigation.php'; ?>
    </div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Rapids History Trails</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <img class="center-block img-responsive" src="http://www.mobygames.com/images/shots/l/698755-dora-the-explorer-swiper-s-big-adventure-windows-screenshot.png" alt=""/>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6">
            <div id="">
                <div class="">
                    <p class="">Red Line</p>
                    <p class="">1. Genesee Riverway Trail</p>
                    <p class="">
                        The problem here is that you fixed the position of the fixednav but not the navspacer. When you do this, the fixednav and navspacer are on the same line since one is fixed and not the other. When you add padding to the navspacer, it </p>
                    <a href="#" class="">rochester.com</a>

                </div>
            </div>
        </div>

        <div class="col-xs-6 col-md-6 col-lg-6">
            <div id="">
                <div class="">
                    <p class="">Blue Line</p>
                    <p class="">1. Genesee Riverway Trail</p>
                    <p class="">
                        The problem here is that you fixed the position of the fixednav but not the navspacer. When you do this, the fixednav and navspacer are on the same line since one is fixed and not the other. When you add padding to the navspacer, it </p>
                    <a href="#" class="">rochester.com</a>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>