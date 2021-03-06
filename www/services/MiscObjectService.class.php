<?php
include_once 'data/MiscObjectData.class.php';
include_once 'models/MiscObject.class.php';
include_once 'TrackableObjectService.class.php';
include_once 'data/ErrorCatching.class.php';

/*
 * MiscService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  getAllMiscEntries()
 *  createMiscEntry($name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateMiscEntry($idMisc, $name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  deleteMiscEntry($idMisc)
 *  getAllEntriesAsRows()
 *  formatMiscInfo()
 */

class MiscObjectService extends TrackableObjectService {
    public function __construct() {
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $name: Misc's  name
     * @param isHazard: Whether the object is in a hazard location or not
     * @param $description: Misc's description
     * @param $longitude: Float for longitude location of misc (ie. 99.999999)
     * @param $latitude: Float for latitude location of misc (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for misc. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function createMiscObjectEntry($name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $isHazard = filter_var($isHazard, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        //create Trackable Object
        $lastInsertIdTrackableObject = $this -> createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        //create MiscObject Object
        $miscObjectDataClass = new MiscObjectData();
        $lastInsertIdMiscObject = $miscObjectDataClass -> createMiscObject($name, $isHazard, $description);

        //Update Trackable Object to know MiscObject Object
        $this -> updateObjectEntryID("Misc", $lastInsertIdMiscObject, $lastInsertIdTrackableObject);
    }


    /*
     * Updates misc currently in the database.
     * @param $name: Misc's  name
     * @param isHazard: Whether the object is in a hazard location or not
     * @param $description: Misc's description
     * @param $idTrackableObject: TrackableObject ID for object
     * @param $longitude: Float for longitude location of misc (ie. 99.999999)
     * @param $latitude: Float for latitude location of misc (ie. 99.999999)
     * @param $hint: Scavenger hunt hit for misc. For Version 2 of application
     * @param $imageDescription: Description and alt text for image
     * @param $imageLocation: Location of image
     * @param $idTypeFilter: ID for the attached type filter
     */
    public function updateMiscObjectEntry($idTrackableObject, $idMiscObject, $name, $isHazard, $description, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $isHazard = filter_var($isHazard, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this -> updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter);

        $miscObjectDataClass = new MiscObjectData();
        $miscObjectDataClass -> updateMiscObject($idMiscObject, $name, $isHazard, $description);
    }


    /*
     * Deletes Misc for Entry
     * @param $idMisc: id of misc to be deleted
     */
    public function deleteMiscObjectEntry($idMiscObject) {
        $idMiscObject = filter_var($idMiscObject, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idMiscObject) || $idMiscObject == "") {
            return;
        } else {
            $miscObjectDataClass = new MiscObjectData();
            $miscObjectDataClass -> deleteMiscObject($idMiscObject);
        }
    }

    /*
     * Retrieves all the misc entries and formats to display in a table.
     * @return string: A string of a table in html
     * Example Output:
     * <tr id="121">
      <td>Bee Hive</td>
      <td>There is a bee hive in this area</td>
      <td>No</td><td>43.129617</td>
      <td>-77.639403</td>
      <td>imageDescription</td>
      <td>/images/pins/default.png</td>
      <td>Miscellaneous</td>
      <td><button class="btn basicBtn" onclick="updateMisc(121,1,8,3)">Update</button></td>
      <td><button class="btn basicBtn" onclick="deleteMisc(1)"> Delete</button></td>
    </tr>
     */
    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllMiscObjectEntries();
        $html = "";
        foreach ($allModels as $model) {
            $objectRowID = "12" . strval($model -> getIdMisc());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateMisc("
                . $objectRowID . ","
                . $model -> getIdMisc() . ","
                . $model -> getIdTrackableObject() . ","
                . $model -> getIdTypeFilter()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteMisc('
                . $model -> getIdMisc()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getName()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getIsHazard()
                . "</td><td>" . $model -> getLongitude()
                . "</td><td>" . $model -> getLatitude()
                . "</td><td>" . $model -> getImageDescription()
                . "</td><td>" . $model -> getImageLocation()
                . "</td><td>" . $model -> getType()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }


    /**
     * Retrieves all Misc data from the database and forms Misc Objects
     * @return array : An array of Misc objects
     */
    public function getAllMiscObjectEntries() {
        $miscObjectDataClass = new MiscObjectData();
        $allMiscObjectDataObjects = $miscObjectDataClass -> readMiscObject();
        $allMiscObject = array();

        foreach ($allMiscObjectDataObjects as $miscObjectArray) {
            $miscObject = new MiscObject($miscObjectArray['idMisc'], stripcslashes($miscObjectArray['name']), stripcslashes($miscObjectArray['description']), $miscObjectArray['isHazard'],
                $miscObjectArray['idTrackableObject'], $miscObjectArray['longitude'], $miscObjectArray['latitude'], '', stripcslashes($miscObjectArray['imageDescription']), $miscObjectArray['imageLocation'], $miscObjectArray['idTypeFilter'], stripcslashes($miscObjectArray['type']));

            array_push($allMiscObject, $miscObject);
        }
        return $allMiscObject;
    }
}