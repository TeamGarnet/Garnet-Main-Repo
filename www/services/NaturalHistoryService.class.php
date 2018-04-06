<?php
include_once 'data/NaturalHistoryObjectData.class.php';
include_once 'models/NaturalHistory.class.php';
include_once 'TrackableObjectService.class.php';

/**
 */
class NaturalHistoryService extends TrackableObjectService {
    public function __construct() {
    }

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

    public function updateNaturalHistoryEntry($idTrackableObject, $idNaturalHistory, $scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $naturalHistoryDataClass -> updateNaturalHistoryObject($idNaturalHistory, $commonName, $scientificName, $description);
    }

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