<?php
include '../data/TrailData.class.php';
include '../models/TrailObject.class.php';

class TrailService {


    public function __construct(){
    }


    public function getAllTrailLocationInfo() {
        $trailDataClass = new TrailData();
        $allTrailData = $trailDataClass -> getAllTrailLocations();

        $allTrailObjects = array();

        foreach ($allTrailData as $trailArray) {
            $trailObject = new TrailObject($trailArray['idWiderAreaMap'], $trailArray['name'], $trailArray['description'], $trailArray['url'], $trailArray['longitude'], $trailArray['address'], $trailArray['city'], $trailArray['state'], $trailArray['zipcode']);

            array_push($allTrailObjects, $trailObject);
        }
        return $allTrailObjects;
    }

}