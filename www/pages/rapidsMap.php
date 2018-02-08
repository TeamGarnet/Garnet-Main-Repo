<!-- PHP -->
<?php
include '../services/MapService.class.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);

?>

<!-- HTML -->

<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="css/maps.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title> Rapids Cemetery Map </title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/YouTubePopUp.css" rel="stylesheet">
	<link href="css/imagehover.css" rel="stylesheet">
	<link href="css/dropdoun.css" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

</head>
<body>

<!-- TODO: add the components for the nav bar and filters here -->
<div id="header1s" class="header_sr" >
  <div class="newwrap">
    <div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<a class="navbar-brand" href="home.php"><img src="images/logo.png" class="img-responsive" alt="img"></a>
				</div>
                          <!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse top-btn " id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-page navbar-right" style="margin-top:15px">
								<li ><a href="#">ABOUT</a></li>
								<li><a href="#">EVENTS</a></li>
								<li><a href="#">CONTACT</a></li>
								<li><a href="#" class="btn btn-default btn-outline btn-circle collapsed" style="border-radius:25px;">Donate</a></li>
                            </ul>
						</div>
			</div>
      </nav> 	
    </div>
  </div>
</div>
<style>
.secondmenublock{
  background-color: #ebece478;
}
.secondmenublock{
z-index:999;
position:fixed;
right: 0;
left: 0;
top:100px;
align-content:center;
}
.secondmenu li{
float:left;
padding:0px 10px;
margin-bottom:10px;
}
</style>

<div class="secondmenublock">
<div class="container">
<div class="secondmenu"><center>
		<ul style="margin-left:110px;">
		<li><a href="#" class="btn btn-danger " style="border-radius:25px;padding:10x;">Civil War</a></li>
		<li><a href="#" class="btn btn-warning " style="border-radius:25px;padding:10x">War of 1812</a></li>
		<li><a href="#" class="btn btn-success " style="border-radius:25px;padding:10x">Revolutionary War</a></li>
		<li><a href="#" class="btn btn-info " style="border-radius:25px;padding:10x">Spanish-American War</a></li>
		<li><a href="#" class="btn btn-primary " style="border-radius:25px;">Rapids Flora</a></li>
</ul></center>		
		</div>
</div>
</div>


    


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


 <script>
  var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: new google.maps.LatLng(43.129467, -77.639153),
          //mapTypeId: 'roadmap'
		  mapTypeId: 'satellite'
        });
  
        var iconBase = 'images/';
        var icons = {
          info: {
            icon: iconBase + 'marker.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(43.129465, -77.639334),
            type: 'info'
          }, {
            position: new google.maps.LatLng(43.129502, -77.639313),
            type: 'info'
          }, {
            position: new google.maps.LatLng(43.129445, -77.639267),
            type: 'info'
          }, {
            position: new google.maps.LatLng(43.129562, -77.639158),
            type: 'info'
          }, {
            position: new google.maps.LatLng(43.129388, -77.639036),
            type: 'info'
          }
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
      }
    </script>


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>

