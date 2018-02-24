<?php
include '../services/MapService.class.php';

$mapData = new MapService();
$allPinInfo = $mapData -> getAllMapPinInfo();
$markers = $mapData -> generateMarkers($allPinInfo);

?>

<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="css/maps.css" type="text/css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title> Rapids Cemetery Map </title>

	<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
$("#flip").on('click',function(){
    $(this).children('i.fa-sort-down').toggleClass('i.fa-sort-up');
});

function openup() {
  $(".popup-overlay, .popup-content").show("fast");
}
function shutdown() {
  $(".popup-overlay, .popup-content").hide("fast");
}
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
</style>
<style> 
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    display: none;
}
</style>
<style>
.secondmenu input[type="radio"] {
    opacity: 0;
}
.paragraph{margin: 80px 0px 10px!important;}
</style>
</head>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        var markers = [
    {
        "title": 'Civil War',
        "lat": '43.129465',
        "lng": '-77.639334',
        "description": '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help',
		"desc": '<img src=images/download.jpg style=width:100px;height:100px;float:left;"/><div ><center><h4>Robert Thomas</h4><h6>(1829 - 1879)</h6></center></div><p class=paragraph>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help</p>'
		
    },
    {
        "title": 'War of 1812',
        "lat": '43.129502',
        "lng": '-77.639313',
        "description": '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help',
        "desc": '<img src=images/download.jpg style=width:100px;height:100px;/><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help'
		
	},
    {
        "title": 'Revolutionary War',
        "lat": '43.129445',
        "lng": '-77.639267',
        "description":  '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help',
		"desc": '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help'
		
	},
    {
        "title": 'Spanish-American War',
        "lat": '43.129562',
        "lng": '-77.639158',
        "description":  '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help',
		"desc": '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help'
		
   },
    {
        "title": 'Rapids Flora',
        "lat": '43.129388',
        "lng": '-77.639036',
        "description":  '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help',
		"desc": '<img src=images/download.jpg style=width:100px;height:100px;/></br><h4>Robert Thomas</br><h6>(1829 - 1879)</h6></h4>Son of William Thomas,first Candlestick marker in Rochester,Robert was succeeded by his son Charles and help'
		
	}
    ];
        window.onload = function () {
            LoadMap();
        };

        var map;
        var marker;
        function LoadMap() {
            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 20,
				mapTypeId: 'satellite'
            };
            map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
           /* SetMarker(0);*/
        };
        function SetMarker(position) {
                if (marker != null) {
                marker.setMap(null);
            }
			var data = markers[position];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });
			var infoWindow = new google.maps.InfoWindow();
            infoWindow.setContent("<div><div class='first' style = 'width:250px;height:auto;text-align:center'>" + data.description + "</br></br><button onclick='openup()' class='btn' style='border-radius:25px;color: #ec5e07;background-color: #fff;border-color: #ec5e07;padding:5px !important;'>Learn More</button></div><div class='popup-overlay' style='display:none;'><div class='popup-content'>" + data.desc +"</br><button onclick='shutdown()' class='btn' style='border-radius:25px;color: #ec5e07;background-color: #fff;border-color: #ec5e07;padding:5px !important; margin-top: 15px;'>Return To Map</button></div></div></div>");
            infoWindow.open(map, marker);
        };
		$('.expand-one').click(function(){
    $('.content-one').slideToggle('slow');
});
    </script>

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
						<a class="navbar-brand" href="home.php"><img src="images/logo.png" class="img-responsive" alt="img"></a>
				</div>
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
p.content-one {
    display:none;
}
.flot-bottom li{ float:left;}
#flip p{float:left;}
#panel, #flip {
    line-height: 29px;
    text-align: center;
    background-color: #ffffff;
border: solid 1px #ffffff;}
#flip .btn-primary:hover{ background-color: #c19a23 !important;
border: solid 1px #ffffff;color: #fff !important;}
.col12 {background-color:#fff}
#flip .btn-primary {
   color: #c19a23 !important;
    background-color: #ffffff;
    border-color: #c19a23 !important;
}

</style>
<div class="selec">
<div class="container">

  <div class="col-sm-12 col-xs-12 col12">
<div id="flip"><p>Selected Filters</p> 

<div class="btn btn-primary">3 filters selected <i class="fas fa-sort-down"></i> 
</div></div>
<div id="panel">
<ul class="flot-bottom">
						<li>
							<label for="rbMarker0">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-danger ">
									<input type="radio" id="rbMarker0" name="rbMarker" value="0" onclick="SetMarker(this.value)" checked="checked" />Civil War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker1">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-warning ">
									<input type="radio" id="rbMarker1" name="rbMarker" value="1" onclick="SetMarker(this.value)" />War of 1812<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker4">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-primary ">
									<input type="radio" id="rbMarker4" name="rbMarker" value="4" onclick="SetMarker(this.value)" />Rapids Flora<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker2">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-success ">
									<input type="radio" id="rbMarker2" name="rbMarker" value="2" onclick="SetMarker(this.value)" />Revolutionary War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
						
							<label for="rbMarker3">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-info ">
									<input type="radio" id="rbMarker3" name="rbMarker" value="3" onclick="SetMarker(this.value)" />Spanish-American War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker4">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-primary ">
									<input type="radio" id="rbMarker4" name="rbMarker" value="4" onclick="SetMarker(this.value)" />Points of Interest<span class="space"></span>
								</span>
							</label>
						</li>
					</ul>
</div>
  </div>
</div>
</div>
	<div class="secondmenublock">
		<div class="container">
			<div class="secondmenu">
				<center>
					<ul style="">
						<li>
							<label for="rbMarker0">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-danger ">
									<input type="radio" id="rbMarker0" name="rbMarker" value="0" onclick="SetMarker(this.value)" checked="checked" />Civil War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker1">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-warning ">
									<input type="radio" id="rbMarker1" name="rbMarker" value="1" onclick="SetMarker(this.value)" />War of 1812<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker2">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-success ">
									<input type="radio" id="rbMarker2" name="rbMarker" value="2" onclick="SetMarker(this.value)" />Revolutionary War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker3">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-info ">
									<input type="radio" id="rbMarker3" name="rbMarker" value="3" onclick="SetMarker(this.value)" />Spanish-American War<span class="space"></span>
								</span>
							</label>
						</li>
						<li>
							<label for="rbMarker4">
								<span style=" border-radius:25px;padding:10x;" class="btn btn-primary ">
									<input type="radio" id="rbMarker4" name="rbMarker" value="4" onclick="SetMarker(this.value)" />Rapids Flora<span class="space"></span>
								</span>
							</label>
						</li>
					</ul>
				</center>		
			</div>
		</div>
	</div>

	
	
	<div id="dvMap" style="width: 100%; height: 100%"></div>

</body>
</html>
</DOCTYPE>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-sglJvUDWiUe_6Pe_sV9-SdtIvN_J-Vo&callback=initMap">
</script>

