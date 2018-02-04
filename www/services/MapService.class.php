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
        $setMarkerCode = "marker.setMap(map);";
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";

        //Example output for foreach loop
        /*                                                  
         * var marker0 = new google.maps.Marker({
         * position: {lat: 47.544, lng: 21.32123},
         * title: 'Pin Name'
         * });
         * marker0.setMap(map)
         */
        foreach ($pinObjectsArray as $pin) {
            /* Uncomment this if you need to see the how the objects for the pins look */
            //echo "<br>";
            //echo "<br>";
            //print_r($pin);

            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName .  " = new google.maps.Marker({
            position: {lat: " . $pin -> getLatitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'" . $pin -> getPinDesign() . "',
            title: '" . $pin -> getName() . "' });";



            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
            $markerCounter += 1;
        }

        return $generatedMarkers;
    }

    public function generateInfoWindowConfig($pin, $markerName) {
        //TODO something is wrong with this. It only makes one window
        /*
        The will be returned from the generatePinInfo Window function
        Then when the link is clicked a card of the object will be echoed.
        */
        $infoWindowContent = ' " ' ."<div id=" . "'infoWindow'><image src='"
            . $pin -> getImageLocation() . "' alt='"
            . $pin -> getImageDescription() . "' ></image><br><h2>"
            . $pin -> getName() . "</h2><br><a href='#' onclick='loadObjectInfo("
            . $pin -> getIdTrackableObject() . ");'> Learn more about "
            . $pin -> getName() . "</a> </div>" . '"';

        $infoWindow = "var infoWindow = new google.maps.InfoWindow({ 
        content: " . $infoWindowContent . "});";


        $infoWindowListener = $markerName . ".addListener('click', function() {
        infoWindow.open(map, " . $markerName . ");});";


        return $infoWindow . $infoWindowListener;
    }
}