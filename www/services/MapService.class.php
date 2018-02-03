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

            //TODO delete this comment after the feature is complete
            echo "<br>";
            print_r($pinObject);

            array_push($allPinObjects, $pinObject);
        }
        return $allPinObjects;
    }

    public function generateMarkers($pinObjectsArray) {
        $addMarkerCode = "marker.setMap(map);";
        $startScript = "<script>";
        $endScript = "</script>";
        $markerCode = "";

        //Example output for foreach loop
        /*
         * var 1marker = new google.maps.Marker({
         * position: {lat: 47.544, lng: 21.32123},
         * map: map,
         * title: 'Pin Name'
         * });
         */
        foreach ($pinObjectsArray as $pin) {
            print_r( $pin);
            $markerCode .= "var " .  $pin['idTrackableObject']. "marker = new google.maps.Marker({
            position: {lat: " . $pin['latitude'] . ", lng: " . $pin['$longitude'] .
            "} map: map, title: '" . $pin['name'] . "'});";
        }

        $generatedMarkers = $startScript . $markerCode . $endScript;
        echo $generatedMarkers;
        return $generatedMarkers;
    }
}