<?php
include '../data/MapData.class.php';

class MapService {

    public function getAllMapPinInfo() {
       $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = null;
        //loop through map data to get and create map pin objects
        print_r($mapData);
        echo "<br>";
        foreach ($mapData as $pinArray) {
            print_r($pinArray);
            foreach ($pinArray as $pin) {
                echo "<br>";
                echo $pin;
            }
        }
        echo $mapData;
        return $allPinObjects;
    }
}