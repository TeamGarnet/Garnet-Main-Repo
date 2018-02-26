<?php
include '../services/TrailService.class.php';
$trailService = new TrailService();
$allTrailInfo = $trailService ->getAllTrailLocationInfo();

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
</head>
<body>

    <!-- Navigation -->
    <?php include '../components/Navigation.php'; ?>


    <div id="content">
        <div id="title"><p>Rochester History Trails</p></div>
        <img src="images/TrailMap.jpg" alt="Trail Map" id="trailMap"/>
        <div id="mapLegend">
            <div class="lineContent">
                <div class="lineColor"><p>Red Line</p></div>
                <div class="lineName"><p>1. Genesee Riverway Trail</p></div>
                <div class="lineInfo"><p>Fanny pack direct trade air plant +1 retro
                    chambray poke blue bottle wayfarers dreamcatcher aesthetic microdosing
                    trust fund. Ugh shaman put a bird on it asymmetrical enamel pin selfies
                    kale chips bitters shoreditch franzen thundercats fixie. </p></div>
                <a href="#" class="lineLink">rochester.com</a>
            </div>
        </div>
    </div>

</body>
</html>