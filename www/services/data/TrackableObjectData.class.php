<?php
include_once 'DatabaseConnection.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  checkForInUseTypeFilters($idTypeFilter)
 *  updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter)
 *  updateObjectEntryID($objectType, $objectID, $idTrackableObject)
 *  deleteTrackableObjectEntry($idTrackableObject)
 */
class TrackableObjectData {
    /**
     * Retrieves the Database information needed.
     * @param $returnConn : An int that designates whether to return the DB instance
     * or the connection. 0 = instance, 1 = connection
     * @return DatabaseConnection|null|PDO : Can return the DB instance, connection,
     * or null if neither are found.
     */
    private function getDBInfo($returnConn) {
        try {
            $instance = DatabaseConnection ::getInstance();
            $conn = $instance -> getConnection();
            if ($returnConn == 0) {
                return $instance;
            } else if ($returnConn == 1) {
                return $conn;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo $e -> getMessage();
        }
        return null;
    }

    public function createTrackableObjectEntry($longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        try {
            //global $createTrackableObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO TrackableObject (longitude, latitude, hint, imageDescription, imageLocation, idTypeFilter) VALUES (:longitude, :latitude, :hint, :imageDescription, COALESCE(:imageLocation, DEFAULT(imageLocation)), :idTypeFilter)");

            $stmt -> bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt -> bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt -> bindParam(':hint', $hint, PDO::PARAM_STR);
            $stmt -> bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);

            $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            if ($imageLocation == "" || empty($imageLocation)) {
                $imageLocation= null;
                $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            }

            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);

            $stmt -> execute();
            return $this -> getDBInfo(1) -> lastInsertId();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateTrackableObjectEntry($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter) {
        try {
            //global $updateTrackableObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TrackableObject
SET longitude = :longitude, latitude = :latitude, hint = :hint, imageDescription = :imageDescription, imageLocation = COALESCE(:imageLocation, DEFAULT(imageLocation)), idTypeFilter = :idTypeFilter WHERE idTrackableObject = :idTrackableObject;");

            $stmt -> bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt -> bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt -> bindParam(':hint', $hint, PDO::PARAM_STR);
            $stmt -> bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            if ($imageLocation == "" || empty($imageLocation)) {
                $imageLocation= null;
                $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':imageLocation', $imageLocation, PDO::PARAM_STR);
            }
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);
            $stmt -> bindParam(':idTrackableObject', $idTrackableObject, PDO::PARAM_STR);

            $stmt -> execute();
            return $this -> getDBInfo(1) -> lastInsertId();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateObjectEntryID($objectType, $objectID, $idTrackableObject) {
        try {
            if ($objectType == "Grave") {
                //global $updateGraveEntryIdQuery;
                $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TrackableObject SET idGrave = :objectID WHERE idTrackableObject = :idTrackableObject");

            } elseif ($objectType == "Natural History") {
                //global $updateNaturalHistoryEntryIdQuery;
                $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TrackableObject SET idNaturalHistory = :objectID WHERE idTrackableObject = :idTrackableObject");

            } elseif ($objectType == "Misc") {
                //global $updateMiscEntryIdQuery;
                $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TrackableObject SET idMisc = :objectID WHERE idTrackableObject = :idTrackableObject");

            } else {
                echo "Can not find Object type to update TrackableObjectEntry on line 65 of TrackableObjectData.class.php";
            }

            $stmt -> bindParam(':objectID', $objectID, PDO::PARAM_STR);
            $stmt -> bindParam(':idTrackableObject', $idTrackableObject, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteTrackableObjectEntry($idTrackableObject) {
        //This function should not need to be used due to DB cascading options
    }

    public function checkForInUseTypeFilters($idTypeFilter) {
        try {
            //global $deleteEventQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("SELECT idTrackableObject FROM TrackableObject WHERE idTypeFilter = :idTypeFilter");
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);
            $stmt -> execute();
            $count = $stmt -> rowCount();
            return $count;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}