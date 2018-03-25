<?php
include_once '../../services/DatabaseConnection.class.php';

/**
 */

class TypeFilterData {
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

    public function createTypeFilter($pinDesign, $type, $buttonColor) {
        try {
            //global $createTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO TypeFilter (pinDesign, type, buttonColor) VALUES (:pinDesign, :type, :buttonColor)");


            $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            $stmt -> bindParam(':type', $type, PDO::PARAM_STR);
            $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readTypeFilter() {
        try {
            //global $getAllTypeFilterEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT * FROM TypeFilter");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateTypeFilter($idTypeFilter, $pinDesign, $type, $buttonColor) {
        try {
            //global $updateTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TypeFilter SET idTypeFilter = :idTypeFilter , pinDesign = :pinDesign , type = :type, buttonColor= :buttonColor WHERE idTypeFilter = :idTypeFilter");

            $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            $stmt -> bindParam(':type', $type, PDO::PARAM_STR);
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);
            $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteTypeFilter($idTypeFilter) {
        try {
            //global $deleteTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM TypeFilter WHERE idTypeFilter = :idTypeFilter");
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}