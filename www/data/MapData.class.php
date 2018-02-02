<?php
include '../services/DatabaseConnection.class.php';
include 'query.php';

class MapData {


    private function getDBInfo($returnConn) {
        try {
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            if ($returnConn == 0) {
                return $instance;
            } else if ($returnConn == 1) {
                return $conn;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return null;
    }

    public function getAllMapPinInfo() {
        global $getAllMapPinInfoQuery;
        try {
            $results = array();

            $stmt = $this->getDBInfo(1)->prepare($getAllMapPinInfoQuery);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS);
            while ($result = $stmt->fetch()) {
                $results[] = $result;
            }
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}