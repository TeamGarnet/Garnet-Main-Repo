<?php
include_once 'data/TrackableObjectData.class.php';
include_once 'data/ErrorCatching.class.php';

/*
 * TrackableObjectService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateObjectEntryID($objectType, $objectID, $idTrackableObject)
 *  deleteTrackableObjectEntry($idTrackableObject)
 */

class TrackableObjectService {

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $longitude: Float for longitude location of TrackableObject (ie. 99.999999)
     * @param $latitude: Float for latitude location of TrackableObject (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for TrackableObject. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $trackableObjectData = new TrackableObjectData();
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $hint = filter_var($hint, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idTypeFilter = filter_var($idTypeFilter, FILTER_SANITIZE_NUMBER_INT);

        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);

        $lastInsertId = $trackableObjectData -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        return $lastInsertId;
    }


    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $idTrackableObject: TrackableObject ID for object
     * @param $longitude: Float for longitude location of TrackableObject (ie. 99.999999)
     * @param $latitude: Float for latitude location of TrackableObject (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for TrackableObject. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $trackableObjectData = new TrackableObjectData();
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);
        $hint = filter_var($hint, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idTypeFilter = filter_var($idTypeFilter, FILTER_SANITIZE_NUMBER_INT);

        $imageLocation = filter_var($imageLocation, FILTER_SANITIZE_URL);
        $trackableObjectData -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);
    }

    /*
     * Retrieves the TrackableObject id and for updating after the bounded object has been created
     * @return int: ID of the attached trackableobject
     */
    public function updateObjectEntryID($objectType, $objectID, $idTrackableObject) {
        $trackableObjectData = new TrackableObjectData();
        $trackableObjectData -> updateObjectEntryID($objectType, $objectID, $idTrackableObject);
    }

    /*
     * Deletes TrackableObject for Entry
     * @param $idTrackableObject: id of TrackableObject to be deleted
     */
    public function deleteTrackableObjectEntry($idTrackableObject) {
        //This function should never be needed beacause the DB has cascading deletes.
    }
}