<?php
include_once 'services/TrailService.class.php';
include_once 'services/EventService.class.php';
include_once 'services/WiderAreaMapService.class.php';


$trailService = new TrailService();
$allTrailInfo = $trailService -> formatTrailLocationsInfo();
$eventService = new EventService();
$allEventInfo = $eventService -> formatEventInfo();
$widerAreaMapService = new WiderAreaMapService();
$allMapPins = $widerAreaMapService -> generateMarkers();

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

    <link rel="stylesheet" href="css/trails.css" type="text/css">
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

    <title> Historic Trails </title>
</head>
<body>

<!-- Navigation -->
<?php include_once 'components/NavBar.php' ?>


<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#pageContent">Historic Trails</a></li>
    <li><a data-toggle="tab" href="#events">Rochester Events</a></li>
</ul>

<div class="tab-content">
    <div class="container tab-pane fade in active" id="pageContent">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 style="text-align: center; font-weight:bolder;">Trails</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <img class="center-block img-responsive" src="/images/TrailMap.jpg"
                     alt="Map of history trails in Rochester"/>
            </div>
        </div>


        <div class="row">

            <?php
            echo $allTrailInfo;
            ?>
        </div>
    </div>

    <div class="container tab-pane fade" id="events">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 style="text-align: center; font-weight:bolder;">Events</h3>
            </div>
        </div>

        <!-- Google Map -->
        <div id="map"></div>

        <!-- Event List -->
        <div class="row">
            <?php
            echo $allEventInfo;
            ?>
        </div>
    </div>
</div>


</body>
</html>

<script type="text/javascript">
    var map, infoWindow;
    var allMarkerObjects = [];
    var userLocation;
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({map: map});
    var directionList = {};

    function initMap() {
        var myLatlng = new google.maps.LatLng(43.149579, -77.609624);
        var mapOptions = {
            zoom: 12,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.roadmap
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer({map: map});
        infoWindow = new google.maps.InfoWindow;

        <?php
        echo $allMapPins;
        ?>

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                userLocation = pos;
                mark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: "images/pins/userMarker.png"
                });
                var myVar = setInterval(updateUserLocation, 15000);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

    }

    //calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);

    function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
        console.log(pointB);
        directionsService.route({
            origin: pointA,
            destination: pointB,
            avoidTolls: true,
            avoidHighways: false,
            travelMode: google.maps.TravelMode.DRIVING
        }, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>

<style>
    #map {
        height: 450px;
        weidth: auto;
    }
</style>