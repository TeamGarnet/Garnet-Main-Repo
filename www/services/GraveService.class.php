<?php
include '../../data/GraveObjectData.class.php';
include '../../models/Grave.class.php';

/**
 */

class GraveService {

    public function __construct(){
    }

    public function getAllGraveEntries() {
        $graveDataClass = new GraveObjectData();
        $allGraveDataObjects =  $graveDataClass -> readGraveObject();
        $allGraveObject = array();

        foreach ($allGraveDataObjects as $graveArray) {
            $graveObject = new Grave($graveArray['idGrave'], $graveArray['firstName'], $graveArray['middleName'], $graveArray['lastName'], $graveArray['birth'], $graveArray['death'], $graveArray['description'], $graveArray['idHistoricFilter'], $graveArray['historicFilterName'],
                $graveArray['idTrackableObject'], $graveArray['longitude'], $graveArray['latitude'], $graveArray['qrCode'], $graveArray['hint'], $graveArray['imageDescription'], $graveArray['mageLocation'], $graveArray['idTypeFilter'], $graveArray['$type']);

            array_push($allGraveObject, $graveObject);
        }
        return $allGraveDataObjects;
    }

    public function createGraveEntry() {}

    public function updateGraveEntry() {}

    public function deleteGraveEntry() {

    }

}