<!-- PHP -->
<?php
include '/pages/services/MapService.class.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);

?>

<!-- HTML -->

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="/pages/css/maps.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Rapids Cemetery Map </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/pages/css/thirdParty/font-awesome.css" type="text/css">
    <link href="pages/css/thirdParty/bootstrap.min.css" rel="stylesheet"/>
    <link href="pages/css/thirdParty/YouTubePopUp.css" rel="stylesheet">
    <link href="pages/css/thirdParty/imagehover.css" rel="stylesheet">
    <link href="pages/css/thirdParty/dropdoun.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</head>
<body>

<!-- Navigation -->
<?php include '../components/Navigation.php'; ?>

<!--Map Filters -->
<div class="secondmenublock">
    <div class="container">
        <div class="secondmenu">
            <div style="text-align: center;">
                <ul style="margin-left:110px;">
                    <li><a href="#" class="btn btn-danger " style="border-radius:25px;padding: 10px;">Civil War</a></li>
                    <li><a href="#" class="btn btn-warning " style="border-radius:25px;padding: 10px">War of 1812</a></li>
                    <li><a href="#" class="btn btn-success " style="border-radius:25px;padding: 10px">Revolutionary
                            War</a></li>
                    <li><a href="#" class="btn btn-info " style="border-radius:25px;padding: 10px">Spanish-American
                            War</a></li>
                    <li><a href="#" class="btn btn-primary " style="border-radius:25px;">Rapids Flora</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Google Map-->
<div id="map"></div>

</body>

</html>
</DOCTYPE>

<!-- Javascript -->
<script type="text/javascript">
    var map, infoWindow;

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

        <!-- This needs to be tested -->
        // HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
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
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }


    //TODO: This method will be used to open the card components of objects -->
    function loadObjectInfo($idTrackableObject) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            //TODO: DO I need this check?
            if (this.readyState == 4 && this.status == 200) {
                console.log(xhr.responseText);
            } else {
                //TODO: find a way to figure out the error and save it to a log.
            }
            xmlhttp.open("GET", "../components/TrackableObjectCard.class.php?id=" + $idTrackableObject, true);
            xmlhttp.send();
        }
    }

</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>

