<?php

class TrackableObjectOperations {

    public function getAllMapData() {
        $map = [];
        try {
            $query = "select * from TrackableObject join GraveDetail on GraveDetail.idGraveDetail = TrackableObject.idGraveDetail;";

//            $query->bindParam(':type', $type, PDO::PARAM_STR);
            $query->execute();
            $query->setFetchMode(PDO::FETCH_CLASS,"TrackableObject");
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