<!-- PHP -->
<?php
include '../services/MapService.class.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);
$filterBar = $mapData -> generateFilterBar();
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
    <title> Rapids Cemetery Map </title>

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

    <script src="../js/MapScript.js"></script>
    <link rel="stylesheet" href="/pages/css/maps.css" type="text/css">
</head>
<body>

<!-- Navigation -->
<?php include '../components/Navigation.php'; ?>

<!--Map Filters -->
<div class="secondmenublock">
    <div class="container">
        <div class="secondmenu">
            <div style="text-align: center;">
                <ul style="margin-left:110px; margin-top: 1.5%;">
                    <?php
                    echo $filterBar;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class=".popup-overlay">
    <div class=".popup-content">

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

    function loadObjectInfo(idTrackableObject) {
        $.ajax({
            type: "GET",
            url: "ajaxCalls.php",
            data: "getMapCardInfoID="+String(idTrackableObject),
            dataType:"text",
            success: function(data) {
                $(".popup-content").append(data);
                $(".popup-overlay, .popup-content").show("fast");
            }
        });
    }

    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });
    $("#flip").on('click',function(){
        $(this).children('i.fa-sort-down').toggleClass('i.fa-sort-up');
    });

    function shutdown() {
        $(".popup-overlay, .popup-content").hide("fast");
    }


</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>

<style>
    .popup-overlay{
        z-index:999;
        position: absolute;
        background:#ffffff;

        width:100%;
        height:100%;
        left:0%;
        top:0%;
    }
    .popup-overlay.active{
        /*displays pop-up when "active" class is present*/
        visibility:visible;
        text-align:center;
    }
    .popup-content.active {
        /*Shows pop-up content when "active" class is present */
        visibility:visible;
    }/*
.gm-style-iw {
	width: 500px !important;
	height: 500px;
	top: 15px !important;
	left: 0px !important;
	background-color: #fff0;
	box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
	border: 1px solid rgba(72, 181, 233, 0.6);
	border-radius: 2px 2px 10px 10px;
}*/
    #panel, #flip {
        padding: 5px;
        text-align: center;
        background-color: #e5eecc;
        border: solid 1px #c3c3c3;
    }
    #panel {
        display: none;
    }
    .secondmenu input[type="radio"] {
        opacity: 0;
    }
    .paragraph{margin: 80px 0px 10px!important;}
</style>