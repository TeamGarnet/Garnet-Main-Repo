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
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title> Rapids Cemetery Map </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/thirdParty/font-awesome.css" type="text/css">
    <link href="css/thirdParty/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/thirdParty/YouTubePopUp.css" rel="stylesheet">
    <link href="css/thirdParty/imagehover.css" rel="stylesheet">
    <link href="css/thirdParty/dropdoun.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


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
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">



    <script src="../js/MapScript.js"></script>
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
</DOCTYPE>

<!-- Javascript -->
<script type="text/javascript">
    var map, infoWindow, mark;
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
					icon: "images/Pin.png"
				});
				var myVar = setInterval(updateUserLocation, 15000);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
		
		//its in ms so 1000ms/second
		
    }
	
	function updateUserLocation(){
		<!-- This needs to be tested -->
        // HTML5 geolocation.
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
					icon: "images/Pin.png",
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
                //alert(data);
                showModal(data);
            }
        });
    }

    function showModal(data) {
        infoWindow.close();
        $("#popup-content").html('');
        $("#popup-content").append(data);
        //$("#popup-content").show("fast");

        $("#exampleModalLong").modal("show")

        //window.scroll(0,document.body.scrollHeight);
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
        $("#popup-content").html('');
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