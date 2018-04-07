<?php
include_once 'data/TrailData.class.php';
include_once 'models/TrailObject.class.php';

/*
 * TrailService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  getAllTrailLocationInfo()
 *  formatTrailLocationsInfo()
 *  getTrailLocationsAsJSON()

 */
class TrailService {


    public function __construct() {
    }


    /**
     * Retrieves all Trail data from the database and forms Trail Objects
     * @return array : An array of Trail objects
     */
    public function getAllTrailLocationInfo() {
        $trailDataClass = new TrailData();
        $allTrailData = $trailDataClass -> getAllTrailLocations();

        $allTrailObjects = array();

        foreach ($allTrailData as $trailArray) {
            $trailObject = new TrailObject($trailArray['idWiderAreaMap'], $trailArray['name'], stripcslashes($trailArray['description']), $trailArray['url'], $trailArray['longitude'], $trailArray['address'], $trailArray['city'], $trailArray['state'], $trailArray['zipcode']);

            array_push($allTrailObjects, $trailObject);
        }
        return $allTrailObjects;
    }

    /*
     * Collects all the FAQ information and formats it to web correct HTML and CSS
     * @return string: A string contain HTML to be appended to the page.
     */
    public function formatTrailLocationsInfo() {
        $allTrailObjectsInfo = $this -> getAllTrailLocationInfo();
        $formattedTrailLocationInfo = "";

        foreach ($allTrailObjectsInfo as $trailObjectInfo) {
            $formattedTrailLocationInfo .= '<div style="margin-top: 4%;" class="locationContainer col-xs-12 col-sm-6 col-md-6 col-lg-6"><div id=""><div class="locationInfo"><p class="locationDescription">'
                . $trailObjectInfo -> getLineColor() . '</p><p style="text-align: left;" class="locationName">'
                . $trailObjectInfo -> getName() . '</p><p style="text-align: left;" class="locationDescription">Address: '
                . $trailObjectInfo->getAddress() .","
                . $trailObjectInfo->getCity() . " "
                . $trailObjectInfo->getState() . " "
                . $trailObjectInfo->getZipcode() . '</p><p style="text-align: left;" class="locationDescription">'
                . $trailObjectInfo -> getDescription() . '</p><a href="'
                . $trailObjectInfo -> getUrl() . '" class="btn locationURL" role="button">Visit Site</a><hr class="style17"></div></div></div>';
        };


        return $formattedTrailLocationInfo;
    }

    /*
     * Collects all the FAQ information and formats it to web correct JSON for filtering
     * @return string: A string contain JSON to be appended to the page.
     */
    public function getTrailLocationsAsJSON() {
        $trailDataClass = new TrailData();
        $allTrailData = $trailDataClass -> getAllTrailLocations();

        $serializedAllTrailData = array();

        foreach ($allTrailData as $trailArray) {
            $trailObject = new TrailObject($trailArray['idWiderAreaMap'], $trailArray['name'], stripcslashes($trailArray['description']), $trailArray['url'], $trailArray['longitude'], $trailArray['address'], $trailArray['city'], $trailArray['state'], $trailArray['zipcode']);
            $serializedTrailObject = $trailObject -> jsonSerialize();

            array_push($serializedAllTrailData, $serializedTrailObject);
        }
        return $serializedAllTrailData;
    }

}