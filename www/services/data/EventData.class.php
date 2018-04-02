<?php
include_once 'DatabaseConnection.class.php';

/**
 */
class EventData {
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

    public function createEvent($name, $description, $startTime, $endTime, $idWiderAreaMap) {
        try {
            //global $createEventQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO Event (name,description, startTime, endTime, idWiderAreaMap) VALUES (:name,:description, :startTime, :endTime, :idWiderAreaMap)");


            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idWiderAreaMap', $idWiderAreaMap, PDO::PARAM_STR);
            $stmt -> bindParam(':startTime', $startTime, PDO::PARAM_STR);
            $stmt -> bindParam(':endTime', $endTime, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readEvent() {
        try {
            //global $getAllEventEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idEvent, E.name, E.description, startTime, endTime, E.idWiderAreaMap, W.name AS locationName FROM Event E JOIN WiderAreaMap W ON E.idWiderAreaMap = W.idWiderAreaMap;");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateEvent($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap) {
        try {
            //global $updateEventQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE Event SET idEvent = :idEvent , name = :name , description = :description, startTime= :startTime, endTime = :endTime, idWiderAreaMap = :idWiderAreaMap WHERE idEvent = :idEvent");

            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idEvent', $idEvent, PDO::PARAM_STR);
            $stmt -> bindParam(':idWiderAreaMap', $idWiderAreaMap, PDO::PARAM_STR);
            $stmt -> bindParam(':startTime', $startTime, PDO::PARAM_STR);
            $stmt -> bindParam(':endTime', $endTime, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteEvent($idEvent) {
        try {
            //global $deleteEventQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM Event WHERE idEvent = :idEvent");
            $stmt -> bindParam(':idEvent', $idEvent, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteLocationConnectedEvents($idWiderAreaMap) {
        try {
            //global $deleteEventQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM Event WHERE idWiderAreaMap = :idWiderAreaMap");
            $stmt -> bindParam(':idWiderAreaMap', $idWiderAreaMap, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}