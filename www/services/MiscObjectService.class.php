<?php
require_once '../../data/MiscObjectData.class.php';
require_once '../../models/MiscObject.class.php';
require_once 'TrackableObjectService.class.php';
/**
 */

class MiscObjectService extends TrackableObjectService {
    public function __construct(){
    }

    public function getAllMiscObjectEntries() {
        $miscObjectDataClass = new MiscObjectData();
        $allMiscObjectDataObjects =  $miscObjectDataClass -> readMiscObject();
        $allMiscObject = array();

        foreach ($allMiscObjectDataObjects as $miscObjectArray) {
            $miscObject = new MiscObject($miscObjectArray['idMisc'], $miscObjectArray['name'],$miscObjectArray['description'], $miscObjectArray['isHazard'],
                $miscObjectArray['idTrackableObject'], $miscObjectArray['longitude'], $miscObjectArray['latitude'], $miscObjectArray['hint'], $miscObjectArray['imageDescription'], $miscObjectArray['imageLocation'], $miscObjectArray['idTypeFilter'], $miscObjectArray['$type']);

            array_push($allMiscObject, $miscObject);
        }
        return $allMiscObject;
    }

    public function createMiscObjectEntry($name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $isHazard = filter_var($isHazard, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        //create Trackable Object
        $lastInsertIdTrackableObject = $this -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        //create MiscObject Object
        $miscObjectDataClass = new MiscObjectData();
        $lastInsertIdMiscObject =  $miscObjectDataClass -> createMiscObject($name, $isHazard, $description);

        //Update Trackable Object to know MiscObject Object
        $this -> updateObjectEntryID("Misc", $lastInsertIdMiscObject, $lastInsertIdTrackableObject);
    }

    public function updateMiscObjectEntry($idTrackableObject, $idMiscObject, $name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $isHazard = filter_var($isHazard, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this ->updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $miscObjectDataClass = new MiscObjectData();
        $miscObjectDataClass -> updateMiscObject($idMiscObject, $name, $isHazard, $description);
    }

    public function deleteMiscObjectEntry($idMiscObject) {
        $idMiscObject = filter_var($idMiscObject, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idMiscObject) || $idMiscObject == "") {
            return;
        } else {
            $miscObjectDataClass = new MiscObjectData();
            $miscObjectDataClass -> deleteMiscObject($idMiscObject);
        }
    }

    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllMiscObjectEntries();
        $html = "";
        foreach ($allModels as $model) {
            $html = $html . "<tr><td>" . $model->getName()
                . "</td><td>" . $model->getDescription()
                . "</td><td>" . $model->getIsHazard()
                . "</td><td>" . $model->getLongitude()
                . "</td><td>" . $model->getLatitude()
                . "</td><td>" . $model->getImageDescription()
                . "</td><td>" . $model->getImageLocation()
                . "</td><td>" . $model->getType()
                . "</td></tr>";
        }
        return $html;
    }
}