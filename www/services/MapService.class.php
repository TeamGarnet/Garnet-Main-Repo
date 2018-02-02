<?php
include '../data/MapData.class.php';

class MapService {
    private $dataClass;
    public function getAllMapPinInfo() {
        $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = null;
        //loop through map data to get and create map pin objects

        echo $mapData;
        return $allPinObjects;
    }
}