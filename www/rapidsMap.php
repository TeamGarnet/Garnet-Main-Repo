<!-- PHP -->
<?php
include_once 'services/MapService.class.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);
$filterBar = $mapData -> generateFilterBar();
?>

<!-- HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- The meta tags MUST come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title> Rapids Cemetery Map </title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

    <!-- Custom Style and Scripts -->
    <script src="js/MapScript.js"></script>
    <link rel="stylesheet" href="css/maps.css" type="text/css">
    <link rel="stylesheet" href="css/navbar.css" type="text/css">
    <link rel="stylesheet" href="css/filterbar.css" type="text/css">
</head>
<body style="background-image:url('/images/TrailBackground.png');">

<!-- Navigation -->
<?php include_once 'components/NavBar.php'; ?>

<!--Map Filters -->
<?php
echo $filterBar;
?>

<!-- Google Map-->
<div id="map"></div>

<!-- Modal -->
<div class="bottonMdl" id="popup-overlay" style="text-align:center;">
    <div class="bottomMdlContent" id="popup-content">

    </div>
</div>
</body>

</html>

<!-- Javascript -->
<script type="text/javascript">
    var map, infoWindow, mark;
    <!-- allMarkerObjects is populated on page load by PHP -->
    var allMarkerObjects = [];

    function initMap() {
        var myLatlng = new google.maps.LatLng(43.129467, -77.639153);
        var mapOptions = {
            zoom: 20,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        infoWindow = new google.maps.InfoWindow;

        <?php
        echo $markers
        ?>

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: "images/pins/userMarker.png"
                });
                /*
                UPDATE NEEDED:
                UPDATE INTERVAL TIME: 5 seconds
                Interval is currently commented out as Rapids Cemetery Sponsors
                are deciding on whether it is worth paying for an SSL Cert that
                will allow user location functionality through Google Maps.
                 */
                //setInterval(updateUserLocation, 15000);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function updateUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mark.setMap(null);
                mark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: "images/pins/userMarker.png"
                });
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: Geolocation must be on to see location.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    function loadObjectInfo(idTrackableObject) {
        $.ajax({
            type: "GET",
            url: "ajaxCalls.php",
            data: "getMapCardInfoID=" + String(idTrackableObject),
            dataType: "text",
            success: function (data) {
                showModal(data);
            }
        });
    }

    function showModal(data) {
        infoWindow.close();
        $("#popup-content").html('');
        $("#popup-content").append(data);
        $("#exampleModalLong").modal("show");
    }

</script>
<!------ UPDATE NEEDED:  Correct API Key for Google Maps Javascript ------>
<!------ Example API Key shown here: https://developers.google.com/maps/documentation/javascript/get-api-key ------->

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>
