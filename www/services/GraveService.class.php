<?php
include_once 'data/GraveObjectData.class.php';
include_once 'models/Grave.class.php';
include_once 'TrackableObjectService.class.php';
include_once 'data/ErrorCatching.class.php';

/*
 * GraveService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  getAllGraveEntries()
 *  createGraveEntry($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateGraveEntry($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  deleteGraveEntry($idGrave)
 *  getAllEntriesAsRows()
 *  formatGraveInfo()
 */

class GraveService extends TrackableObjectService {

    public function __construct() {
    }

    public function createGraveEntry($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $middleName = filter_var($middleName, FILTER_SANITIZE_STRING);
        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        $birth = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($birth)));
        $death = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($death)));
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);

        if (empty($idHistoricFilter) || $idHistoricFilter == "") {
            $idHistoricFilter = 0;
        }

        //create Trackable Object
        $lastInsertIdTrackableObject = $this -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        //create Grave Object
        $graveDataClass = new GraveObjectData();
        $lastInsertIdGrave = $graveDataClass -> createGraveObject($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter);

        //Update Trackable Object to know Grave Object
        $this -> updateObjectEntryID("Grave", $lastInsertIdGrave, $lastInsertIdTrackableObject);
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $firstName: Grave's first name
     * @param $middleName: Grave's middle name or
     * @param $lastName: Grave's last name
     * @param $birth: Grave's birth date
     * @param $death: Grave's last name
     * @param $description: Grave's description
     * @param $idHistoricFilter: ID for the attached historical filter (optional)
     * @param $longitude: Float for longitude location of grave (ie. 99.999999)
     * @param $latitude: Float for latitude location of grave (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for grave. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */

    public function updateGraveEntry($idTrackableObject, $idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {

        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $middleName = filter_var($middleName, FILTER_SANITIZE_STRING);
        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        $birth = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($birth)));
        $death = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($death)));
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idHistoricFilter) || $idHistoricFilter == "") {
            $idHistoricFilter = 0;
        }
        $this -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $graveDataClass = new GraveObjectData();
        $graveDataClass -> updateGraveObject($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter);
    }

    /*
     * Updates grave currently in the database.
     * @param $firstName: Grave's first name
     * @param $middleName: Grave's middle name or
     * @param $lastName: Grave's last name
     * @param $birth: Grave's birth date
     * @param $death: Grave's last name
     * @param $description: Grave's description
     * @param $idHistoricFilter: ID for the attached historical filter (optional)
     * @param $idTrackableObject: TrackableObject ID for object
     * @param $longitude: Float for longitude location of grave (ie. 99.999999)
     * @param $latitude: Float for latitude location of grave (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for grave. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */

    public function deleteGraveEntry($idGrave) {
        $idGrave = filter_var($idGrave, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idGrave) || $idGrave == "") {
            return false;
        } else {
            $graveDataClass = new GraveObjectData();
            $graveDataClass -> deleteGraveObject($idGrave);
            return true;
        }

    }

    /*
     * Deletes Grave for Entry
     * @param $idGrave: id of grave to be deleted
     */

    public function getAllEntriesAsRows() {
        $allGraveModels = $this -> getAllGraveEntries();
        $html = "";
        foreach ($allGraveModels as $graveModel) {
            $historicFilterName = 'No Historic Filter';
            $historicFilterNullID = 'null';
            if ($graveModel -> getHistoricFilterName() != null) {
                $historicFilterName = $graveModel -> getHistoricFilterName();
                $historicFilterNullID = $graveModel -> getIdHistoricFilter();
            }
            $objectRowID = "10" . strval($graveModel -> getIdGrave());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateGrave("
                . $objectRowID . ","
                . $graveModel -> getIdGrave() . ","
                . $graveModel -> getIdTrackableObject() . ","
                . $historicFilterNullID . ","
                . $graveModel -> getIdTypeFilter()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteGrave('
                . $graveModel -> getIdGrave()
                . ')"> Delete</button>';

            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $graveModel -> getFirstName()
                . "</td><td>" . $graveModel -> getMiddleName()
                . "</td><td>" . $graveModel -> getLastName()
                . "</td><td>" . $graveModel -> getBirth()
                . "</td><td>" . $graveModel -> getDeath()
                . "</td><td>" . $graveModel -> getDescription()
                . "</td><td>" . $graveModel -> getLongitude()
                . "</td><td>" . $graveModel -> getLatitude()
                . "</td><td>" . $graveModel -> getImageDescription()
                . "</td><td>" . $graveModel -> getImageLocation()
                . "</td><td>" . $historicFilterName
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }

    /*
     * Retrieves all the grave entries and formats to display in a table.
     * @return string: A string of a table in html
     */

    /**
     * Retrieves all Grave data from the database and forms Grave Objects
     * @return array : An array of Grave objects
     */
    public function getAllGraveEntries() {
        $graveDataClass = new GraveObjectData();
        $allGraveDataObjects = $graveDataClass -> readGraveObject();
        $allGraveObjects = array();

        foreach ($allGraveDataObjects as $graveArray) {
            $graveObject = new Grave($graveArray['idGrave'], $graveArray['firstName'], $graveArray['middleName'], $graveArray['lastName'], $graveArray['birth'], $graveArray['death'], stripcslashes($graveArray['description']), $graveArray['idHistoricFilter'], stripcslashes($graveArray['historicFilterName']),
                $graveArray['idTrackableObject'], $graveArray['longitude'], $graveArray['latitude'], '', stripcslashes($graveArray['imageDescription']), $graveArray['imageLocation'], $graveArray['idTypeFilter'], stripcslashes($graveArray['type']));

            array_push($allGraveObjects, $graveObject);
        }

        return $allGraveObjects;
    }

}