<?php
include '../services/DatabaseConnection.class.php';
include 'query.php';

class TrailData {
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

    public function getAllTrailLocations() {
        global $allTrailLocationQuery;
        try {
            $allTrailLocations = array();
            $stmt = $this -> getDBInfo(1) -> prepare($allTrailLocationQuery);
            $stmt -> execute();
            while($result = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                $allTrailLocations = array_merge($allTrailLocations, $result);
            }
            return $allTrailLocations;
        } catch (Exception $e) {
            echo $e -> getMessage();
            die();
        }
    }
}