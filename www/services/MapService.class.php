<?php
include '../data/MapData.class.php';

class MapService {

    public function getAllMapPinInfo() {
       $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = null;
        //loop through map data to get and create map pin objects
        foreach ($mapData as $pinArray) {
            foreach ($pinArray as $pin) {
                echo gettype($pin);
                //echo array_column($pin, 'name');
                //echo array_column($pinArray, 'idTrackableObject');
                echo "<br>";
                echo $pin['name'];
                echo "<br>";
                echo $pin['pinDesign'];
                echo "<br>";
            }
        }
        echo $mapData;
        return $allPinObjects;
    }
}