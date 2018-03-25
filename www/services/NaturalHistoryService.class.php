<?php
require_once '../../data/NaturalHistoryObjectData.class.php';
require_once '../../models/NaturalHistory.class.php';
require_once 'TrackableObjectService.class.php';
/**
 */

class NaturalHistoryService extends TrackableObjectService{
    public function __construct(){
    }

    public function getAllNaturalHistoryEntries() {
        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $allNaturalHistoryDataObjects =  $naturalHistoryDataClass -> readNaturalHistoryObject();
        $allNaturalHistoryObject = array();

        foreach ($allNaturalHistoryDataObjects as $naturalHistoryArray) {
            $naturalHistoryObject = new NaturalHistory($naturalHistoryArray['idNaturalHistory'], $naturalHistoryArray['commonName'], $naturalHistoryArray['scientificName'], $naturalHistoryArray['description'],
                $naturalHistoryArray['idTrackableObject'], $naturalHistoryArray['longitude'], $naturalHistoryArray['latitude'], $naturalHistoryArray['hint'], $naturalHistoryArray['imageDescription'], $naturalHistoryArray['imageLocation'], $naturalHistoryArray['idTypeFilter'], $naturalHistoryArray['type']);

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
        $lastInsertIdNaturalHistory =  $naturalHistoryDataClass -> createNaturalHistoryObject($scientificName, $commonName, $description);

        //Update Trackable Object to know NaturalHistory Object
        $this -> updateObjectEntryID("Natural History", $lastInsertIdNaturalHistory, $lastInsertIdTrackableObject);
    }

    public function updateNaturalHistoryEntry($idTrackableObject, $idNaturalHistory, $scientificName, $commonName, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this ->updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $naturalHistoryDataClass = new NaturalHistoryObjectData();
        $naturalHistoryDataClass -> updateNaturalHistoryObject($idNaturalHistory, $commonName, $scientificName, $description);
    }

    public function deleteNaturalHistoryEntry($idNaturalHistory) {
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idNaturalHistory) || $idNaturalHistory == "") {
            return;
        } else {
            $naturalHistoryDataClass = new NaturalHistoryObjectData();
            $naturalHistoryDataClass -> deleteNaturalHistoryObject($idNaturalHistory);
        }
    }

    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllNaturalHistoryEntries();
        $html = "";
        foreach ($allModels as $model) {
            $objectRowID = "11" . strval($model->getIdTrackableObject());
            $editAndDelete = "</td><td><button onclick='updateNH("
                . $objectRowID
                . ")'>Update</button>"
                . "</td><td><button onclick=" . '"deleteNH('
                . $objectRowID
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model->getCommonName()
                . "</td><td>" . $model->getScientificName()
                . "</td><td>" . $model->getDescription()
                . "</td><td>" . $model->getLongitude()
                . "</td><td>" . $model->getLatitude()
                . "</td><td>" . $model->getImageDescription()
                . "</td><td>" . $model->getImageLocation()
                . "</td><td>" . $model->getType()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}