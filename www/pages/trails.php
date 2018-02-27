<?php
include '../services/TrailService.class.php';
$trailService = new TrailService();
$allTrailInfo = $trailService -> formatTrailLocationsInfo();

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

    <!--
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="apple-touch-icon" sizes="120x120" href="../pages/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../pages/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="../pages/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="../pages/css/thirdParty/font-awesome.css" type="text/css">


    <link href="../pages/css/thirdParty/bootstrap.min.css" rel="stylesheet"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    -->
    <link rel="stylesheet" href="../pages/css/trails.css" type="text/css">

    <title> Historic Trails </title>
</head>
<body>

    <!-- Navigation -->

    <div id="navigation">
    <?php //include '../components/StaticNav.php'; ?>
        <div id="header1s" class="header_sr" >
            <div class="newwrap">
                <div class="container">
                    <nav class="navbar navbar-default navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="home.php"><img src="../pages/images/Logo.png" class="img-responsive" alt="img"></a>
                            </div>
                            <div class="collapse navbar-collapse top-btn " id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-page navbar-right" style="margin-top:15px">
                                    <li ><a href="#">ABOUT</a></li>
                                    <li><a href="trails.php">HISTORIC TRAILS</a></li>
                                    <li><a href="#">CONTACT</a></li>
                                    <li><a href="#" class="btn btn-default btn-outline btn-circle collapsed" style="border-radius:25px;">Donate</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="text-align: center">Rapids History Trails</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <img class="center-block img-responsive" src="../pages/images/TrailMap.jpg" alt="Map of history trails in Rochester"/>
        </div>
    </div>


    <div class="row">

        <?php
        echo $allTrailInfo;
        ?>
<!-- Use this as an example of how the content will be created -->
        <!--
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
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

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
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

        -->
    </div>
</div>

</body>
</html>