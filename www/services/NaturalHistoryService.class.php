<?php
include_once 'data/NaturalHistoryObjectData.class.php';
include_once 'models/NaturalHistory.class.php';
include_once 'TrackableObjectService.class.php';

/*
 * NaturalHistoryService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  getAllNaturalHistoryEntries()
 *  createNaturalHistoryEntry($scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateNaturalHistoryEntry($idNaturalHistory, $scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  deleteNaturalHistoryEntry($idNaturalHistory)
 *  getAllEntriesAsRows()
 *  formatNaturalHistoryInfo()
 */
class NaturalHistoryService extends TrackableObjectService {
    public function __construct() {
    }

    /**
     * Retrieves all NaturalHistory data from the database and forms NaturalHistory Objects
     * @return array : An array of NaturalHistory objects
     */
    public function getAllNaturalHistoryEntries() {
        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $allNaturalHistoryDataObjects = $naturalHistoryDataClass -> readNaturalHistoryObject();
        $allNaturalHistoryObject = array();

        foreach ($allNaturalHistoryDataObjects as $naturalHistoryArray) {
            $naturalHistoryObject = new NaturalHistory($naturalHistoryArray['idNaturalHistory'], stripcslashes($naturalHistoryArray['commonName']), stripcslashes($naturalHistoryArray['scientificName']), stripcslashes($naturalHistoryArray['description']),
                $naturalHistoryArray['idTrackableObject'], $naturalHistoryArray['longitude'], $naturalHistoryArray['latitude'], stripcslashes($naturalHistoryArray['hint']), stripcslashes($naturalHistoryArray['imageDescription']), $naturalHistoryArray['imageLocation'], $naturalHistoryArray['idTypeFilter'], stripcslashes($naturalHistoryArray['type']));

            array_push($allNaturalHistoryObject, $naturalHistoryObject);
        }
        return $allNaturalHistoryObject;
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $scientificName: NaturalHistory's scientific name
     * @param $commonName: NaturalHistory's common name
     * @param $description: NaturalHistory's description
     * @param $longitude: Float for longitude location of natural history (ie. 99.999999)
     * @param $latitude: Float for latitude location of natural history (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for natural history. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function createNaturalHistoryEntry($scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        //create Trackable Object
        $lastInsertIdTrackableObject = $this -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        //create NaturalHistory Object
        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $lastInsertIdNaturalHistory = $naturalHistoryDataClass -> createNaturalHistoryObject($scientificName, $commonName, $description);

        //Update Trackable Object to know NaturalHistory Object
        $this -> updateObjectEntryID("Natural History", $lastInsertIdNaturalHistory, $lastInsertIdTrackableObject);
    }

    /*
     * Updates natural history currently in the database.
     * @param $idTrackableObject: TrackableObject ID for object
     * @param $scientificName: NaturalHistory's scientific name
     * @param $commonName: NaturalHistory's common name
     * @param $description: NaturalHistory's description
     * @param $longitude: Float for longitude location of natural history (ie. 99.999999)
     * @param $latitude: Float for latitude location of natural history (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for natural history. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function updateNaturalHistoryEntry($idTrackableObject, $idNaturalHistory, $scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $naturalHistoryDataClass -> updateNaturalHistoryObject($idNaturalHistory, $commonName, $scientificName, $description);
    }

    /*
     * Deletes NaturalHistory for Entry
     * @param $idNaturalHistory: id of natural history to be deleted
     */
    public function deleteNaturalHistoryEntry($idNaturalHistory) {
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idNaturalHistory) || $idNaturalHistory == "") {
            return false;
        } else {
            $naturalHistoryDataClass = new NaturalHistoryObjectData();
            $naturalHistoryDataClass -> deleteNaturalHistoryObject($idNaturalHistory);
            return true;
        }
    }

    /*
     * Retrieves all the natural history entries and formats to display in a table.
     * @return string: A string of a table in html
     */
    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllNaturalHistoryEntries();
        $html = "";
        foreach ($allModels as $model) {
            $objectRowID = "11" . strval($model -> getIdNaturalHistory());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateNH("
                . $objectRowID . ","
                . $model -> getIdNaturalHistory() . ","
                . $model -> getIdTrackableObject() . ","
                . $model -> getIdTypeFilter()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteNH('
                . $model -> getIdNaturalHistory()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getCommonName()
                . "</td><td>" . $model -> getScientificName()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getLongitude()
                . "</td><td>" . $model -> getLatitude()
                . "</td><td>" . $model -> getImageDescription()
                . "</td><td>" . $model -> getImageLocation()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}