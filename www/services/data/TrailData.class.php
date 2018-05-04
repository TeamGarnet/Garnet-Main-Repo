<?php
include_once 'DatabaseConnection.class.php';
include_once 'query.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  getAllTrailLocations()
 */

class TrailData {
    public function getAllTrailLocations() {
        global $allTrailLocationQuery;
        try {
            $allTrailLocations = array();
            $stmt = $this -> getDBInfo(1) -> prepare($allTrailLocationQuery);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_CLASS, "TrailObject.class");
            while ($result = $stmt -> fetch()) {
                array_push($allTrailLocations, $result);
            }

            return $allTrailLocations;
        } catch (Exception $e) {
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
}