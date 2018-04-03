<?php
include_once 'DatabaseConnection.class.php';

/**
 */
class WiderAreaMapData {
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

    public function createWiderAreaMap($url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode) {
        try {
            //global $createWiderAreaMapQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO WiderAreaMap (url,description, name, address, city, state, zipcode, longitude, latitude) VALUES (:url, :description,:name, :address, :city, :state, :zipcode, :longitude, :latitude)");


            $stmt -> bindParam(':url', $url, PDO::PARAM_STR);
            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':address', $address, PDO::PARAM_STR);
            $stmt -> bindParam(':city', $city, PDO::PARAM_STR);
            $stmt -> bindParam(':state', $state, PDO::PARAM_STR);
            $stmt -> bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
            $stmt -> bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt -> bindParam(':latitude', $latitude, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readWiderAreaMap() {
        try {
            //global $getAllWiderAreaMapEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idWiderAreaMap, name, description, url, longitude, latitude, address, city, state, zipcode FROM WiderAreaMap");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateWiderAreaMap($idWiderAreaMap, $url, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode) {
        try {
            //global $updateWiderAreaMapQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE WiderAreaMap SET idWiderAreaMap = :idWiderAreaMap , url = :url , description = :description , name = :name, longitude =:longitude, latitude =:latitude, city = :city, zipcode =:zipcode, address = :address  WHERE idWiderAreaMap = :idWiderAreaMap");

            $stmt -> bindParam(':url', $url, PDO::PARAM_STR);
            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idWiderAreaMap', $idWiderAreaMap, PDO::PARAM_STR);
            $stmt -> bindParam(':address', $address, PDO::PARAM_STR);
            $stmt -> bindParam(':city', $city, PDO::PARAM_STR);
            $stmt -> bindParam(':state', $state, PDO::PARAM_STR);
            $stmt -> bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
            $stmt -> bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt -> bindParam(':latitude', $latitude, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteWiderAreaMap($idWiderAreaMap) {
        try {
            //global $deleteWiderAreaMapQuery;
            //TODO: will need to call the event first
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM WiderAreaMap WHERE idWiderAreaMap = :idWiderAreaMap");
            $stmt -> bindParam(':idWiderAreaMap', $idWiderAreaMap, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}