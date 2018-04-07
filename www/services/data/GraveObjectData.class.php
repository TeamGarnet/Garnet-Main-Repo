<?php
include_once 'DatabaseConnection.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getAllContactEntries()
 *  formatContactInfo($pinObjectsArray)
 *  createContactEntry($pin, $markerName)
 *  updateContactEntry()
 *  deleteContactEntry($idContact)
 *  getAllEntriesAsRows()
 */
class GraveObjectData {
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

    public function createGraveObject($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter) {
        try {
            //global $createGraveObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO Grave (firstName,middleName,lastName,birth,death,description,idHistoricFilter)VALUES (:firstName,:middleName,:lastName,:birth,:death,:description,:idHistoricFilter)");


            $stmt -> bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt -> bindParam(':middleName', $middleName, PDO::PARAM_STR);
            $stmt -> bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt -> bindParam(':birth', $birth, PDO::PARAM_STR);
            $stmt -> bindParam(':death', $death, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            if ($idHistoricFilter == null) {
                $stmt -> bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_NULL);
            } else {
                $stmt -> bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_INT);
            }

            $stmt -> execute();
            return $this -> getDBInfo(1) -> lastInsertId();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readGraveObject() {
        try {
            //global $getAllGraveEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, firstName, middleName, lastName, birth, death, G.description, HF.idHistoricFilter, HF.historicFilterName, T.idTypeFilter, TF.type, G.idGrave FROM Grave G 
JOIN TrackableObject T ON G.idGrave = T.idGrave 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter 
LEFT OUTER JOIN HistoricFilter HF ON G.idHistoricFilter = HF.idHistoricFilter");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateGraveObject($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter) {
        try {

            //global $updateGraveObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE Grave SET firstName = :firstName, middleName = :middleName, lastName = :lastName, birth = :birth, death = :death, description = :description, idHistoricFilter = :idHistoricFilter WHERE idGrave = :idGrave");


            $stmt -> bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt -> bindParam(':middleName', $middleName, PDO::PARAM_STR);
            $stmt -> bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt -> bindParam(':birth', $birth, PDO::PARAM_STR);
            $stmt -> bindParam(':death', $death, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idGrave', $idGrave, PDO::PARAM_STR);
            if ($idHistoricFilter == null) {
                $stmt -> bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_NULL);
            } else {
                $stmt -> bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_INT);
            }

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteGraveObject($idGrave) {
        try {
            //global $deleteGraveObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM Grave WHERE idGrave = :idGrave");
            $stmt -> bindParam(':idGrave', $idGrave, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function unsetHistoricFilterId($idHistoricFilter) {
        try {
            //global $unsetHistoricFilterIdQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE Grave SET idHistoricFilter = NULL WHERE idHistoricFilter = :idHistoricFilter");
            $stmt -> bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }


    }
}