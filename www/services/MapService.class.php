<?php
include '../data/MapData.class.php';
include '../models/Map.class.php';

class MapService {

    public function getAllMapPinInfo() {
        $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = array();

        foreach ($mapData as $pinArray) {

            $pinObject = new Map($pinArray['idTrackableObject'], $pinArray['longitude'], $pinArray['latitude'], $pinArray['imageDescription'], $pinArray['imageLocation'], $pinArray['name'], $pinArray['type'], $pinArray['pinDesign']);

            array_push($allPinObjects, $pinObject);
        }
        return $allPinObjects;
    }

    public function generateMarkers($pinObjectsArray) {
        $generatedMarkers = "";

        //Example output for foreach loop
        /*
         * var marker = new google.maps.Marker({
         * position: {lat: 47.544, lng: 21.32123},
         * title: 'Pin Name'
         * });
         * marker.setMap(map)
         */
        foreach ($pinObjectsArray as $pin) {
            echo "<br>";
            echo "<br>";
            print_r($pin);

            $generatedMarkers .= "var " . "marker = new google.maps.Marker({
            position: {lat: " . $pin -> getLatitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'" . $pin -> getPinDesign() . "',
            title: '" . $pin -> getName() . "'});  marker.setMap(map);";

            $infoWidowConfig = $this -> generateInfoWindowConfig($pin);
            $generatedMarkers . $infoWidowConfig;
        }

        return $generatedMarkers;
    }

    public function generateInfoWindowConfig($pin) {
        /*
        The will be returned from the generatePinInfo Window function
        Then when the link is clicked a card of the object will be echoed.
        */
        $infoWindowContent = "<div id='infoWindow'><image src='"
            . $pin -> getImageLocation() . "' alt='"
            . $pin -> getImageDescription() . "' ></image><br><h2>"
            . $pin -> getName() . "</h2><br><a href='#' onclick='loadObjectInfo("
            . $pin -> getIdTrackableObject() . "Learn more about "
            . $pin -> getName() . "</a> </div>";

        $infoWindow = "var infoWindow = new google.maps.InfoWindow({ 
        content: " . $infoWindowContent . "});";

        $infoWindowListener = "marker.addListener('click', function() {
        infoWindow.open(map, marker);});";

        return $infoWindowContent . $infoWindow . $infoWindowListener;
    }
}