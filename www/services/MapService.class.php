<?php
include '../data/MapData.class.php';
include '../models/MapPin.class.php';

/*
 * MapService.class.php: Used to grab Google Map marker information from the
 * Database. Can create markers and info windows for the marksers.
 * Functions:
 *  getAllMapPinInfo()
 *  generateMarkers($pinObjectsArray)
 *  generateInfoWindowConfig($pin, $markerName)
 */

class MapService {

    /**
     * Retrieves all pin data from the database and forms MapPin Objects
     * @return array : An array of MapPin objects
     */
    public function getAllMapPinInfo() {
        $dataClass = new MapData();
        $mapData = $dataClass -> getAllMapPinInfo();
        $allPinObjects = array();

        foreach ($mapData as $pinArray) {
            $pinObject = new MapPin($pinArray['idTrackableObject'], $pinArray['longitude'], $pinArray['latitude'], $pinArray['imageDescription'], $pinArray['imageLocation'], $pinArray['name'], $pinArray['type'], $pinArray['pinDesign']);

            array_push($allPinObjects, $pinObject);
        }
        return $allPinObjects;
    }


    /**
     * Creates Google Map markers with attached infoWindows.
     * @param $pinObjectsArray : an array of MapPin Objects
     * @return string : A string with Javascript and HTML to be added to
     * a Google Map that creates a marker.
     *
     * Example Output String for 1 Object:
     * var marker0 = new google.maps.Marker({
     * position: {lat: 47.544, lng: 21.32123},
     * title: 'Pin Name'
     * });
     *
     * var infowindow = new google.maps.InfoWindow();
     * google.maps.event.addListener(marker0, 'click', (function(marker0) {
     * return function() {
     *  infoWindow.setContent("<div id='infoWindow'>
     * <image src='imageLocation' alt='imageDescription' ></image>
     * <br><h2 class='pinName'>Blue Flower</h2><br>
     * <a class= 'pinLink' href='#' onclick='loadObjectInfo(2);>
     * Learn more about Blue Flower </a> </div>");
     *  infoWindow.open(map,marker2);
     * }})(marker0));
     *
     * marker0.setMap(map)
     *
     */
    public function generateMarkers($pinObjectsArray) {
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";

        foreach ($pinObjectsArray as $pin) {
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin -> getLatitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'" . $pin -> getPinDesign() . "',
            title: '" . $pin -> getName() . "' ,
            map: map });";


            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
            $markerCounter += 1;
        }

        return $generatedMarkers;
    }


    /**
     * Creates an Google Maps InfoWindow for a MapPin object marker.
     * @param $pin : a Map Pin Object
     * @param $markerName : the unique name for the marker that is currently being
     * created
     * @return string: A string with Javascript and HTML to be added to
     * a Google Map that creates an InfoWindow.
     *
     * Example OutPut for 1 InfoWindow:
     * var infowindow = new google.maps.InfoWindow();
     * google.maps.event.addListener(marker2, 'click', (function(marker2) {
     * return function() {
     *  infoWindow.setContent("<div id='infoWindow'>
     * <image src='imageLocation' alt='imageDescription' ></image>
     * <br><h2 class='pinName'>Blue Flower</h2><br>
     * <a class= 'pinLink' href='#' onclick='loadObjectInfo(2);>
     * Learn more about Blue Flower </a> </div>");
     *  infoWindow.open(map,marker2);
     * }})(marker2));
     */
    public function generateInfoWindowConfig($pin, $markerName) {
        $infoWindowContent = ' " ' . "<div id=" . "'infoWindow'><image src='"
            . $pin -> getImageLocation() . "' alt='"
            . $pin -> getImageDescription() . "' ></image><br><h2 class='pinName'>"
            . $pin -> getName() . "</h2><br><a class= 'pinLink' href='#' onclick='loadObjectInfo("
            . $pin -> getIdTrackableObject() . ");'> Learn more about "
            . $pin -> getName() . "</a> </div>" . '"';

        $infoWindowGenerator = "var infowindow = new google.maps.InfoWindow();";
        $infoWindowListener = "google.maps.event.addListener(" . $markerName . ", 'click', (function(" . $markerName . ") {
            return function() {
                infoWindow.setContent(" . $infoWindowContent . ");
                infoWindow.open(map," . $markerName . ");
            }
            })(" . $markerName . "));";

        return $infoWindowGenerator . $infoWindowListener;
    }
}