<?php
include_once 'data/MapData.class.php';
include_once 'models/MapPin.class.php';
include_once 'models/FilterButton.class.php';
include_once 'components/FilterBar.class.php';
include_once 'components/TrackableObjectCard.class.php';
include_once 'data/ErrorCatching.class.php';

/*
 * MapService.class.php: Used to grab Google Map marker information from the
 * Database. Can create markers and info windows for the marksers.
 * Functions:
 *  getAllMapPinInfo()
 *  generateMarkers($pinObjectsArray)
 *  generateInfoWindowConfig($pin, $markerName)
 */

class MapService {

    public function __construct() {
    }

    /**
     * Retrieves all pin data from the database and forms MapPin Objects
     * @return array : An array of MapPin objects
     */
    public function getAllMapPinInfo() {
        $dataClass = new MapData();
        $mapData = $dataClass -> getAllMapPinInfo();
        $allPinObjects = array();

        foreach ($mapData as $pinArray) {
            $pinObject = new MapPin($pinArray['idTrackableObject'], $pinArray['longitude'], $pinArray['latitude'], stripcslashes($pinArray['imageDescription']), $pinArray['imageLocation'], $pinArray['name'], $pinArray['idTypeFilter'], $pinArray['pinDesign'], $pinArray['idHistoricFilter']);

            array_push($allPinObjects, $pinObject);
        }
        //var_dump($allPinObjects);
        return $allPinObjects;
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
    public function generateMarkers($pinObjectsArray) {
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";

        foreach ($pinObjectsArray as $pin) {
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin -> getLatitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'" . $pin -> getPinDesign() . "',
            title:'" . $pin -> getName() . "' ,
            map: map ,
            markerName: " . $markerName . ",
            idTypeFilter:" . $pin -> getFilterType() . ",
            idHistoricFilter:" . $pin -> getIdHistoricFilter() . "});";

            $generatedMarkers .= "allMarkerObjects.push(" . $markerName . ");";
            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
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
     *  infoWindow.setContent("<div id='infoWindow'>
     * <image src='imageLocation' alt='imageDescription' ></image>
     * <br><h2 class='pinName'>Blue Flower</h2><br>
     * <a class= 'pinLink' href='#' onclick='loadObjectInfo(2)';>
     * Learn more about Blue Flower </a> </div>");
     *  infoWindow.open(map,marker2);
     * }})(marker2));
     */
    public function generateInfoWindowConfig($pin, $markerName) {
        $infoWindowContent = '"' . "<div><div class='first' style = 'width:250px;height:auto;text-align:center'><img src='"
            . $pin -> getImageLocation()
            . "' alt='"
            . $pin -> getImageDescription() . "' style=width:100px;height:100px;/></br><h4>"
            . $pin -> getName()
            . "</h4>"
            . "<button onclick='loadObjectInfo("
            . $pin -> getIdTrackableObject() . ")' class='btn mapBtn'>Learn More</button></div></div>"
            . '"';

        $infoWindowGenerator = "var infowindow = new google.maps.InfoWindow();";
        $infoWindowListener = "google.maps.event.addListener(" . $markerName . ", 'click', (function(" . $markerName . ") {
            return function() {
                infoWindow.setContent(" . $infoWindowContent . ");
                infoWindow.open(map," . $markerName . ");
            }
            })(" . $markerName . "));";

        return $infoWindowGenerator . $infoWindowListener;
    }

    /**
     * Generates HTML and CSS for the filter bar
     * @return string: String of html to be appended to the map page.
     */
    public function generateFilterBar() {
        $allFilterObjects = $this -> getFilterInfo();
        $filterBar = new FilterBar($allFilterObjects);
        return $filterBar -> getFilterBar();
    }

    /**
     * Collects all the Filters that are available for filters.
     * @return array: An array of filter objects.
     */
    public function getFilterInfo() {
        $dataClass = new MapData();
        $filterData = $dataClass -> getAllFilters();
        $allFilterObjects = array();

        foreach ($filterData as $filterArray) {
            $pinObject = new FilterButton($filterArray['filterID'], $filterArray['filterName'], $filterArray['buttonColor'], $filterArray['table']);

            array_push($allFilterObjects, $pinObject);
        }
        return $allFilterObjects;
    }

    /**
     * Collects information for a specific TrackableObject.
     * @return array: An array of filter objects.
     */
    public function getMapCardInfo($idTrackableObject) {
        $mapData = new MapData();
        $cardData = $mapData -> getMapCardData($idTrackableObject);
        return new TrackableObjectCard($cardData);
    }
}