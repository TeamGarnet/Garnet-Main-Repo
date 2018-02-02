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
            echo "<br>";
            print_r($pinObject);

            array_push($allPinObjects, $pinObject);
        }
        return $allPinObjects;
    }
}