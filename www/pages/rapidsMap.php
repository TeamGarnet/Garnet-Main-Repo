<!-- PHP -->
<?php
include '../services/MapService.class.php';
include '../components/PinInfoWindow.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);

?>

<!-- HTML -->

<!DOCTYPE html>
<html>
<head>
    <title> Rapids Cemetery Map </title>
    <link rel="stylesheet" href="../css/infoWindow.css" type="text/css">
    <link rel="stylesheet" href="../css/maps.css" type="text/css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/rapidsMap.js"></script>
</head>
<body>

<div id="map"></div>


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

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
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

    function loadObjectInfo($idTrackableObject) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
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

<?php
echo $markers
?>

</body>

<!--
The will be returned from the generatePinInfo Window function
The when the link is clicked a card of the object will be echoed.
-->
<!--
<div id="infoWindow">
    <image src=" $pinObject['imageLocation']" alt="$pinObject['imageDescription']"> </image>
    <h2> $pinObject['name']</h2>
    <a href="#" onclick="loadObjectInfo($pinObject['idTrackableObject'])"> Learn more about $pinObject['name']</a>

</div>
-->


</html>
</DOCTYPE>
