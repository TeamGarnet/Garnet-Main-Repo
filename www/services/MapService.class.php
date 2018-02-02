<?php
include '../data/MapData.class.php';
include '../models/Map.class.php';

class MapService {

    public function getAllMapPinInfo() {
       $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = array();
        echo "<br>";
        print_r($mapData);
        echo "<br>";
        foreach ($mapData as $pinArray) {
            echo "pinArray" . "<br>";
            print_r($pinArray);

            $pinObject = new Map($pinArray['idTrackableObject'], $pinArray['longitude'], $pinArray['latitude'], $pinArray['imageDescription'], $pinArray['imageLocation'], $pinArray['name'], $pinArray['type'], $pinArray['pinDesign']);
            array_push($allPinObjects, $pinObject);

        }

        echo "<br>";
        print_r($allPinObjects[1]);
        echo "<br>";
        print_r($allPinObjects[3]);
        return $allPinObjects;
    }
}