<?php

class TrackableObjectOperations {

    public function getAllMapData() {
        $map = [];
        try {
            $query = 'SELECT * FROM TrackableObject JOIN GraveDetail ON GraveDetail.idGraveDetail = TrackableObject.idGraveDetail';

//            $query->bindParam(':type', $type, PDO::PARAM_STR);e
            echo "Executing Query";
            $query->execute();
            //$query->setFetchMode(PDO::FETCH_CLASS,"TrackableObject");
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