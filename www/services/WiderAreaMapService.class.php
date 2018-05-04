<?php
include_once 'data/WiderAreaMapData.class.php';
include_once 'data/EventData.class.php';
include_once 'models/WiderAreaMap.class.php';
include_once 'data/ErrorCatching.class.php';

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
    /**
     * WiderAreaMapService constructor.
     */
    public function __construct() {
    }

    /**
     * @param $url
     * @param $name
     * @param $description
     * @param $longitude
     * @param $latitude
     * @param $address
     * @param $city
     * @param $state
     * @param $zipcode
     * @param $imageDescription
     * @param $imageLocation
     */
    public function createWiderAreaMapEntry($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode, $imageDescription, $imageLocation) {
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);


        //create WiderAreaMap Object
        $widerAreaMapDataClass = new WiderAreaMapData();
        $widerAreaMapDataClass -> createWiderAreaMap($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode, $imageDescription, $imageLocation);
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $idWiderAreaMap
     * @param $url
     * @param $name
     * @param $description
     * @param $longitude
     * @param $latitude
     * @param $address
     * @param $city
     * @param $state
     * @param $zipcode
     * @param $imageDescription
     * @param $imageLocation
     */
    public function updateWiderAreaMapEntry($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode, $imageDescription, $imageLocation) {
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);

        $widerAreaMapDataClass = new WiderAreaMapData();
        $widerAreaMapDataClass -> updateWiderAreaMap($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode, $imageDescription, $imageLocation);
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $idWiderAreaMap
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
     * Grabs all Wider Area Locatin Entries and returns them as rows for displaying.
     * Exmaple Output:
     * <tr id="161">
  <td>Susan B Anthony Home</td>
  <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu magna vitae ipsum placerat vestibulum. Sed sed tempor justo. Nunc bibendum sapien urna, quis condimentum justo porta ut. Donec et risus eu tortor faucibus tempus. Quisque velit nibh, fermentum sit amet lacus quis, blandit elementum nulla. Cras id consequat sem. Integer aliquet risus eu erat vehicula, vitae tristique sapien blandit.</td>
  <td>https://www.susanbanthonyhouse.orgindex.php</td><td>-77.628100</td>
  <td>43.153200</td>
  <td>17 Madison St</td>
  <td>Rochester</td>
  <td>NY</td>
  <td>14608</td>
  <td>dwq</td>
  <td>https://www.fiftyflowers.com/site_files/FiftyFlowers/Image/Product/salmon-dahlia-flower-350_5ae0c998.jpg</td>
  <td><button class="btn basicBtn" onclick="updateLocation(161,1)">Update</button></td>
  <td><button class="btn basicBtn" onclick="deleteLocation(1)"> Delete</button></td></tr>
    *
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
                . "</td><td>" . $model -> getImageDescription()
                . "</td><td>" . $model -> getImageLocation()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }

    /**
     * Retrieves all the wider area location data from the database and forms wider area location Objects
     * @return array : An array of wider area location objects
     */
    public function getAllWiderAreaMapEntries() {
        $widerAreaMapDataClass = new WiderAreaMapData();
        $allWiderAreaMapDataObjects = $widerAreaMapDataClass -> readWiderAreaMap();
        $allWiderAreaMapData = array();

        foreach ($allWiderAreaMapDataObjects as $widerAreaMapArray) {
            $widerAreaMapObject = new WiderAreaMap($widerAreaMapArray['idWiderAreaMap'], stripcslashes($widerAreaMapArray['name']), stripcslashes($widerAreaMapArray['description']), $widerAreaMapArray['url'], $widerAreaMapArray['longitude'], $widerAreaMapArray['latitude'], $widerAreaMapArray['address'], $widerAreaMapArray['city'], $widerAreaMapArray['state'], $widerAreaMapArray['zipcode'], $widerAreaMapArray['imageDescription'], $widerAreaMapArray['imageLocation']);

            array_push($allWiderAreaMapData, $widerAreaMapObject);
        }
        return $allWiderAreaMapData;
    }

    /*
     * Retrieves all the wider area map entries and creates options for a select population.
     * @return string: A string of a options in html
     * Example Output:
     *<option value="1">Susan B Anthony Home</option>
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
            $markerPos = "var " . $directionName . " = new google.maps.LatLng(" . $pin -> getLatitude() . "," . $pin -> getLongitude() . "); directionList.push(" . $directionName . ");";
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
            . $pin -> getIdWiderAreaMap() . ")'>View Information</a><a class='eventBtns btn' href=" . "'"
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