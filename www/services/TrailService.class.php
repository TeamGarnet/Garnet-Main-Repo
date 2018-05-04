<?php
include_once 'data/TrailData.class.php';
include_once 'models/TrailObject.class.php';
include_once 'data/ErrorCatching.class.php';

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

    /*
    * Collects all the FAQ information and formats it to web correct HTML and CSS
    * @return string: A string contain HTML to be appended to the page.
     * Example Output:
     * <div style="margin-top: 4%;" class="locationContainer col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <div id="">
        <div class="locationInfo">
          <p class="locationDescription"></p>
          <p style="text-align: left;" class="locationName">Susan B Anthony Home</p>
          <img src="https://www.fiftyflowers.com/site_files/FiftyFlowers/Image/Product/salmon-dahlia-flower-350_5ae0c998.jpg" alt="dwq">
          <p></p>
          <p style="text-align: left;" class="locationDescription">Address: 17 Madison St,Rochester NY 14608</p>
          <p style="text-align: left;" class="locationDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu magna vitae ipsum placerat vestibulum. Sed sed tempor justo. Nunc bibendum sapien urna, quis condimentum justo porta ut. Donec et risus eu tortor faucibus tempus. Quisque velit nibh, fermentum sit amet lacus quis, blandit elementum nulla. Cras id consequat sem. Integer aliquet risus eu erat vehicula, vitae tristique sapien blandit.</p>
          <a href="https://www.susanbanthonyhouse.orgindex.php" class="btn locationURL" role="button">Visit Site</a>
          <hr class="style17">
        </div>
      </div>
    </div>
    */
    public function formatTrailLocationsInfo() {
        $allTrailObjectsInfo = $this -> getAllTrailLocationInfo();
        $formattedTrailLocationInfo = "";

        foreach ($allTrailObjectsInfo as $trailObjectInfo) {
            $formattedTrailLocationInfo .= '<div style="margin-top: 4%;" class="locationContainer col-xs-12 col-sm-6 col-md-6 col-lg-6"><div id=""><div class="locationInfo"><p class="locationDescription">'
                . $trailObjectInfo -> getLineColor() . '</p><p style="text-align: left;" class="locationName">'
                . $trailObjectInfo -> getName()
                . '</p><img src="' . $trailObjectInfo -> getImageLocation() . '" alt="' . $trailObjectInfo -> getImageDescription() . '">'
                . '</p><p style="text-align: left;" class="locationDescription">Address: '
                . $trailObjectInfo -> getAddress() . ","
                . $trailObjectInfo -> getCity() . " "
                . $trailObjectInfo -> getState() . " "
                . $trailObjectInfo -> getZipcode() . '</p><p style="text-align: left;" class="locationDescription">'
                . $trailObjectInfo -> getDescription() . '</p><a href="'
                . $trailObjectInfo -> getUrl() . '" class="btn locationURL" role="button">Visit Site</a><hr class="style17"></div></div></div>';
        };


        return $formattedTrailLocationInfo;
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
            $trailObject = new TrailObject($trailArray['idWiderAreaMap'], $trailArray['name'], stripcslashes($trailArray['description']), $trailArray['url'], $trailArray['longitude'], $trailArray['address'], $trailArray['city'], $trailArray['state'], $trailArray['zipcode'], $trailArray['imageDescription'], $trailArray['imageLocation']);
            array_push($allTrailObjects, $trailObject);
        }
        return $allTrailObjects;
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
            $trailObject = new TrailObject($trailArray['idWiderAreaMap'], $trailArray['name'], stripcslashes($trailArray['description']), $trailArray['url'], $trailArray['longitude'], $trailArray['address'], $trailArray['city'], $trailArray['state'], $trailArray['zipcode'], $trailArray['imageDescription'], $trailArray['imageLocation']);
            $serializedTrailObject = $trailObject -> jsonSerialize();

            array_push($serializedAllTrailData, $serializedTrailObject);
        }
        return $serializedAllTrailData;
    }

}