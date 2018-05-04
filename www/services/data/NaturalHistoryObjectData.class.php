<?php
include_once 'DatabaseConnection.class.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  createContact($name, $email, $description, $phone, $title)
 *  readContact()
 *  updateContact($idContact, $name, $email, $description, $phone, $title)
 *  deleteContact($idContact)
 */

class NaturalHistoryObjectData {
    public function createNaturalHistoryObject($commonName, $scientificName, $description) {
        try {
            //global $createNaturalHistoryObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO NaturalHistory (commonName,scientificName,description) VALUES  (:commonName,:scientificName,:description)");


            $stmt -> bindParam(':commonName', $commonName, PDO::PARAM_STR);
            $stmt -> bindParam(':scientificName', $scientificName, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);

            $stmt -> execute();
            return $this -> getDBInfo(1) -> lastInsertId();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

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
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
        return null;
    }

    public function readNaturalHistoryObject() {
        try {
            //global $getAllNaturalHistoryEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, commonName, scientificName, description, T.idTypeFilter, TF.type, NM.idNaturalHistory FROM NaturalHistory NM 
JOIN TrackableObject T ON NM.idNaturalHistory = T.idNaturalHistory 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter");
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    public function updateNaturalHistoryObject($idNaturalHistory, $commonName, $scientificName, $description) {
        try {
            //global $updateNaturalHistoryObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE NaturalHistory SET idNaturalHistory = :idNaturalHistory, commonName = :commonName, scientificName = :scientificName, description = :description WHERE idNaturalHistory = :idNaturalHistory");

            $stmt -> bindParam(':commonName', $commonName, PDO::PARAM_STR);
            $stmt -> bindParam(':scientificName', $scientificName, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idNaturalHistory', $idNaturalHistory);

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    public function deleteNaturalHistoryObject($idNaturalHistory) {
        try {
            //global $deleteNaturalHistoryObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM NaturalHistory WHERE idNaturalHistory = :idNaturalHistory");
            $stmt -> bindParam(':idNaturalHistory', $idNaturalHistory, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }
}