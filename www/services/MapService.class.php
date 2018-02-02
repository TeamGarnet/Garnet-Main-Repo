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
                echo $pin['name'];
            }
        }
        echo $mapData;
        return $allPinObjects;
    }
}