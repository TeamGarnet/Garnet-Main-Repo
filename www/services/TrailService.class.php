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

    public function formatTrailLocationsInfo() {
        $allTrailObjectsInfo = $this ->getAllTrailLocationInfo();
        $formattedTrailLocationInfo = "";

        foreach ($allTrailObjectsInfo as $trailObjectInfo){
            $formattedTrailLocationInfo .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><div id=""><div class=""><p class="">'
                . $trailObjectInfo -> getLineColor() . '</p><p class="">'
                . $trailObjectInfo -> getName() . '</p><p class="">'
                . $trailObjectInfo -> getDescription() . '</p><a href="#" class="">'
                . $trailObjectInfo -> getUrl() . '</div></div></div>'
            ;
        };


        return $formattedTrailLocationInfo;
    }

}