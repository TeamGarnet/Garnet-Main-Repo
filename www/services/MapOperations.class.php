//DO NOT USE THIS CODE, IT IS OLD AND ONLY FOR REFERENCE
//<?php
//include '../services/DatabaseConnection.class.php';
////Collect an instance of the DB
//$db = Database::getInstance();
//$mysqli = $db->getConnection();
//echo "Connected to DB";
//
//class MapOperations {
//    public function setCoordinates () {
//
//    }
//
//    public function getCoordinates(){
//
//    }
//
//    public function getAllCoordinatesByType ($type) {
//        $map = [];
//        try {
//            $query = "SELECT * FROM Map WHERE type = :type";
//
//            $query->bindParam(':type', $type, PDO::PARAM_STR);
//            $query->execute();
//            $query->setFetchMode(PDO::FETCH_CLASS,"Map");
//            while ($row = $query->fetch()) {
//                $map[] = $row;
//            }
//            echo 'Here is the map ' . "\n";
//            echo var_dump($map);
//            return $map;
//
//        } catch(PDOException $e){
//            echo $e->getMessage();
//            exit();
//        }
//
//    }
//}