<?php
include '../data/MapData.class.php';

class MapService {

    public function getAllMapPinInfo() {
       $dataClass = new MapData();
        $mapData = $dataClass->getAllMapPinInfo();
        $allPinObjects = null;
        echo "<br>";
        print_r($mapData);
        echo "<br>";
        foreach ($mapData as $pinArray) {
            echo "pinArray" . "<br>";
            print_r($pinArray);
            foreach ($pinArray as $pin) {
                echo "<br>";
                print_r($pin);
            }
        }
        return $allPinObjects;
    }
}