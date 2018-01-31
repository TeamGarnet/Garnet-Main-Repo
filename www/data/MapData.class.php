<?php

class MapData {

    private function getAllMapPinInfo() {
        $query = "SELECT * FROM (
                    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, firstName FROM 
                      Grave G JOIN TrackableObject T ON G.idGrave = T.idGrave) AS `Map Pins`
                    UNION
                    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, name FROM 
                      MiscObject M JOIN TrackableObject T ON M.idMisc = T.idMisc
                    UNION
                    SELECT idTrackableObject, longitude, latitude, imageDescription, imageLocation, commonName FROM 
                      NaturalHistory NM JOIN  TrackableObject T ON NM.idNaturalHistory = T.idNaturalHistory";
    }

}