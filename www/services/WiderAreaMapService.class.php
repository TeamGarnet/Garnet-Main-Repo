<?php
include_once 'data/WiderAreaMapData.class.php';
include_once 'data/EventData.class.php';
include_once 'models/WiderAreaMap.class.php';

/*
 * WiderAreaMapService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  createWiderAreaMapEntry($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode)
 *  updateWiderAreaMapEntry($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode)
 *  getAllEntriesAsRows()
 *  deleteWiderAreaMapEntry($idWiderAreaMap)
 *  generateMarkers()
 *  generateInfoWindowConfig($pin, $markerName, $markerCounter)
 */
class WiderAreaMapService {
    public function __construct() {
    }

    /**
     * Retrieves all Type filter data from the database and forms Type filter Objects
     * @return array : An array of Type filter objects
     */
    public function getAllWiderAreaMapEntries() {
        $widerAreaMapDataClass = new WiderAreaMapData();
        $allWiderAreaMapDataObjects = $widerAreaMapDataClass -> readWiderAreaMap();
        $allWiderAreaMapData = array();

        foreach ($allWiderAreaMapDataObjects as $widerAreaMapArray) {
            $widerAreaMapObject = new WiderAreaMap($widerAreaMapArray['idWiderAreaMap'], stripcslashes($widerAreaMapArray['name']), stripcslashes($widerAreaMapArray['description']), $widerAreaMapArray['url'], $widerAreaMapArray['longitude'], $widerAreaMapArray['latitude'], $widerAreaMapArray['address'], $widerAreaMapArray['city'], $widerAreaMapArray['state'], $widerAreaMapArray['zipcode']);

            array_push($allWiderAreaMapData, $widerAreaMapObject);
        }
        return $allWiderAreaMapData;
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $longitude: Float for longitude location of WiderAreaMap (ie. 99.999999)
     * @param $latitude: Float for latitude location of WiderAreaMap (ie. 99.999999)
     * @param $url: Site url for location
     * @param $name: Name of location
     * @param $description: Description of location
     * @param $address: Line 1 Address for location
     * @param $city: city of location
     * @param $state: state of location
     * @param $zipcode: zipcode of location
     */
    public function createWiderAreaMapEntry($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode) {
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_EMAIL);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);


        //create WiderAreaMap Object
        $widerAreaMapDataClass = new WiderAreaMapData();
        $widerAreaMapDataClass -> createWiderAreaMap($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode);
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $idWiderAreaMap: ID of widerAreaMap to be updated
     * @param $longitude: Float for longitude location of WiderAreaMap (ie. 99.999999)
     * @param $latitude: Float for latitude location of WiderAreaMap (ie. 99.999999)
     * @param $url: Site url for location
     * @param $name: Name of location
     * @param $description: Description of location
     * @param $address: Line 1 Address for location
     * @param $city: city of location
     * @param $state: state of location
     * @param $zipcode: zipcode of location
     */
    public function updateWiderAreaMapEntry($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode) {
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_EMAIL);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);

        $widerAreaMapDataClass = new WiderAreaMapData();
        $widerAreaMapDataClass -> updateWiderAreaMap($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode);
    }

    /*
     * Deletes WiderAreaMapObject for Entry
     * @param $idTrackableObject: id of WiderAreaMapObject to be deleted
     */
    public function deleteWiderAreaMapEntry($idWiderAreaMap) {
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idWiderAreaMap) || $idWiderAreaMap == "") {
            return;
        } else {
            $eventDataClass = new EventData();
            $eventDataClass -> deleteLocationConnectedEvents($idWiderAreaMap);

            $widerAreaMapDataClass = new WiderAreaMapData();
            $widerAreaMapDataClass -> deleteWiderAreaMap($idWiderAreaMap);
        }
    }

    /*
     * Retrieves all the wider area map entries and formats to display in a table.
     * @return string: A string of a table in html
     */
    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllWiderAreaMapEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "16" . strval($model -> getIdWiderAreaMap());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateLocation("
                . $objectRowID . ","
                . $model -> getIdWiderAreaMap()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteLocation('
                . $model -> getIdWiderAreaMap()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getName()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getUrl()
                . "</td><td>" . $model -> getLongitude()
                . "</td><td>" . $model -> getLatitude()
                . "</td><td>" . $model -> getAddress()
                . "</td><td>" . $model -> getCity()
                . "</td><td>" . $model -> getState()
                . "</td><td>" . $model -> getZipcode()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }

    /*
     * Retrieves all the wider area map entries and creates options for a select population.
     * @return string: A string of a options in html
     */
    public function getAllFiltersForSelect() {
        $filters = $this -> getAllWiderAreaMapEntries();
        $filterHTML = "";
        foreach ($filters as $filter) {
            $filterHTML = $filterHTML . "<option value='"
                . $filter -> getIdWiderAreaMap() . "'>"
                . $filter -> getName() . "</option>";
        }
        return $filterHTML;
    }

    /**
     * Creates Google Map markers with attached infoWindows.
     * @param $pinObjectsArray : an array of MapPin Objects
     * @return string : A string with Javascript and HTML to be added to
     * a Google Map that creates a marker.
     *
     * Example Output String for 1 Object:
     * var activeMarkerObjects = [];
     * var allMarkerObjects = [];
     * var marker0 = new google.maps.Marker({
     * position: {lat: 47.544, lng: 21.32123},
     * title: 'Pin Name'
     * });
     *
     * var infowindow = new google.maps.InfoWindow();
     * google.maps.event.addListener(marker0, 'click', (function(marker0) {
     * return function() {
     *  infoWindow.setContent("<div id='infoWindow'>
     * <image src='imageLocation' alt='imageDescription' ></image>
     * <br><h2 class='pinName'>Blue Flower</h2><br>
     * <a class= 'pinLink' href='#' onclick='loadObjectInfo(2);>
     * Learn more about Blue Flower </a> </div>");
     *  infoWindow.open(map,marker2);
     * }})(marker0));
     *
     * marker0.setMap(map)
     * allMarkerObjects.push(marker0);
     * activeMarkerObjects.push(marker0);
     *
     */
    public function generateMarkers() {
        $pinObjectsArray = $this -> getAllWiderAreaMapEntries();
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";

        foreach ($pinObjectsArray as $pin) {
            $markerName = "marker" . $markerCounter;
            $directionName = "direction" . $markerCounter;
            $markerPos = "var " . $directionName. " = new google.maps.LatLng(" . $pin -> getLatitude() . "," . $pin -> getLongitude() . "); directionList.push(" . $directionName . ");";
            $generatedMarkers .= $markerPos . "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin -> getLatitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'images/pins/greenMarker.png',
            title:'" . $pin -> getName() . "' ,
            map: map ,
            markerName: " . $markerName . "});";

            $generatedMarkers .= "allMarkerObjects.push(" . $markerName . ");";
            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName, $markerCounter);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;


            $markerCounter += 1;
        }

        return $generatedMarkers;
    }

    /**
     * Creates an Google Maps InfoWindow for a MapPin object marker.
     * @param $pin : a Map Pin Object
     * @param $markerName : the unique name for the marker that is currently being
     * created
     * @return string: A string with Javascript and HTML to be added to
     * a Google Map that creates an InfoWindow.
     *
     * Example OutPut for 1 InfoWindow:
     * var infowindow = new google.maps.InfoWindow();
     * google.maps.event.addListener(marker2, 'click', (function(marker2) {
     * return function() {
     *  infoWindow.setContent("<div><div style = 'width:250px;height:auto;text-align:center'>
     * <h4>Name</h4></br><p><a class='eventBtns btn' href='#' onclick='displayLocationInfo(1)'>View Information</a>
     * <a class='eventBtns btn' href='www.google.com'>Visit Site</a></p><p>
     * <a class='eventBtns btn' onclick='calculateAndDisplayRoute(directionsService, directionsDisplay, userLocation, directionList[2]")'>Generate Route</a>
     * </p></div></div>;
     *  infoWindow.open(map,marker2);
     * }})(marker2));
     */
    public function generateInfoWindowConfig($pin, $markerName, $markerCounter) {
        $infoWindowContent = '"' . "<div><div style = 'width:250px;height:auto;text-align:center'><h4>"
            . $pin -> getName()
            . "</h4></br><p><a class='eventBtns btn' href='#' onclick='displayLocationInfo("
            . $pin -> getIdWiderAreaMap() .")'>View Information</a><a class='eventBtns btn' href=" . "'"
            . $pin -> getUrl() . "'" . ">Visit Site</a></p><p><a class='eventBtns btn' onclick='calculateAndDisplayRoute(directionsService, directionsDisplay, userLocation, " . "directionList[" . $markerCounter . "]" . ")'>Generate Route</a></p></div></div>" . '"';


        $infoWindowGenerator = "var infowindow = new google.maps.InfoWindow();";
        $infoWindowListener = "google.maps.event.addListener(" . $markerName . ", 'click', (function(" . $markerName . ") {
            return function() {
                infoWindow.setContent(" . $infoWindowContent . ");
                infoWindow.open(map," . $markerName . ");
            }
            })(" . $markerName . "));";

        return $infoWindowGenerator . $infoWindowListener;
    }


}