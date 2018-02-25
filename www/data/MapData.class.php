<?php
include '../services/DatabaseConnection.class.php';
include 'query.php';

/**
 * MapData.class.php: Handles all CRUD operations that are sent from the service and
 * business layers to the Database from mapping requests.
 */
class MapData {

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


    /**
     * Connects to the database and runs a query to pull all of the MapPin object
     * information.
     * @return array: An array of Map Pin Object information.
     */
    public function getAllMapPinInfo() {
        global $getAllMapPinInfoQuery;
        try {
            $mapPinData = array();

            $stmt = $this -> getDBInfo(1) -> prepare($getAllMapPinInfoQuery);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_CLASS, "MapPin.class");
            while ($result = $stmt -> fetch()) {
                array_push($mapPinData, $result);
            }
            return $mapPinData;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function getAllFilters() {
        global $filterBarQuery;
        try {
            $filterData = array();

            $stmt = $this -> getDBInfo(1) -> prepare($filterBarQuery);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_CLASS, "FilterButton.class");
            while ($result = $stmt -> fetch()) {
                array_push($filterData, $result);
            }
            return $filterData;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function getMapCardData($idTrackableObject) {
        global $filterTypeQuery;
        global $graveInfoQuery;
        global $naturalHistoryInfoQuery;
        global $miscInfoQuery;
        try {
            $objectCardData = array();

            // 1. Get the filter type to determine which subsequent table to use.
            $stmt = $this -> getDBInfo(1) -> prepare($filterTypeQuery);
            $stmt -> bindParam(':idTrackableObject',$idTrackableObject, PDO::PARAM_INT);
            $stmt -> execute();
            $filterType = strval($stmt -> fetch());

            // 2. Push filter type to array to pass up through service to create TrackableObjectCard
            $objectCardData['type'] = $filterType;

            // 3. Determine which query to use based on returned filter type.
            switch ($filterType) {
                case 'Grave':
                    $stmt = $this -> getDBInfo(1) -> prepare($graveInfoQuery);
                    break;
                case 'Natural History':
                    $stmt = $this -> getDBInfo(1) -> prepare($naturalHistoryInfoQuery);
                    break;
                default:
                    $stmt = $this -> getDBInfo(1) -> prepare($miscInfoQuery);
                    break;
            }

            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_ASSOC);
            while($result = $stmt -> fetch()) {
                array_push($objectCardData, $result);
            }
            return $objectCardData;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}