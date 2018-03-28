<?php
include_once 'data/TrackableObjectData.class.php';
/**
 */

class TrackableObjectService {
    public function createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $trackableObjectData = new TrackableObjectData();
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $hint = filter_var($hint, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idTypeFilter = filter_var($idTypeFilter, FILTER_SANITIZE_NUMBER_INT);
        if ($imageLocation == null || $imageLocation == "") {
            $imageLocation = '/images/pins/default.png';
        }
        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);

        $lastInsertId = $trackableObjectData -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        return $lastInsertId;
    }


    public function updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $trackableObjectData = new TrackableObjectData();
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $hint = filter_var($hint, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idTypeFilter = filter_var($idTypeFilter, FILTER_SANITIZE_NUMBER_INT);
        if ($imageLocation == null || $imageLocation == "") {
            $imageLocation = '/images/pins/default.png';
        }
        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);
        $trackableObjectData -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);
    }

    public function updateObjectEntryID($objectType, $objectID, $idTrackableObject) {
        $trackableObjectData = new TrackableObjectData();
        $trackableObjectData -> updateObjectEntryID($objectType, $objectID, $idTrackableObject);
    }

    public function deleteTrackableObjectEntry($idTrackableObject) {
        //This function should never be needed beacause the DB has cascading deletes.
    }
}