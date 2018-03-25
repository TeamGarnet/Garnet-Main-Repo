<?php
include_once '../../services/DatabaseConnection.class.php';
/**
 */

class MiscObjectData {
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

    public function createMiscObject($name, $isHazard, $description) {
        try {
            //global $createMiscObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO MiscObject (name, description, isHazard) VALUES (:name, :description, :isHazard)");


            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':isHazard', $isHazard, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);

            $stmt -> execute();
            return $this -> getDBInfo(1) -> lastInsertId();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readMiscObject() {
        try {
            //global $getAllMiscEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, name, T.idTypeFilter, TF.type, M.idMisc, M.name, M.description, M.isHazard FROM MiscObject M 
JOIN TrackableObject T ON M.idMisc = T.idMisc 
JOIN TypeFilter TF ON T.idTypeFilter = TF.idTypeFilter");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateMiscObject($idMisc, $name, $isHazard, $description) {
        try {
            //global $updateMiscObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE MiscObject SET idMisc = :idMisc , name = :name , description = :description , isHazard = :isHazard  WHERE idMisc = :idMisc");

            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':isHazard', $isHazard, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idMisc', $idMisc,PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteMiscObject($idMisc) {
        try {
            //global $deleteMiscObjectQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM MiscObject WHERE idMisc = :idMisc");
            $stmt -> bindParam(':idMisc', $idMisc, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}