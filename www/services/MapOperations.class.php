<?php

//Collect an instance of the DB
$db = Database::getInstance();
$mysqli = $db->getConnection();

class MapOperations {
    public function setCoordinates () {

    }

    public function getCoordinates(){

    }

    public function getAllCoordinatesByType ($type) {
        $map = [];
        try {
            $query = "SELECT * FROM Map WHERE type = :type";

            $query->bindParam(':type', $type, PDO::PARAM_STR);
            $query->execute();
            $query->setFetchMode(PDO::FETCH_CLASS,"Map");
            while ($row = $query->fetch()) {
                $map[] = $row;
            }
            echo 'Here is the map ' . "\n";
            echo var_dump($map);
            return $map;

        } catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }
}