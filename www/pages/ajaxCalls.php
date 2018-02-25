<?php
include '../services/MapService.class.php';

$mapService = new MapService();

if(isset($_GET['idTrackableObject'])) {
    $mapService -> getMapCardInfo($_GET['idTrackableObject']);
    unset($_GET['idTrackableObject']);
}


//class AjaxCalls {
//    public function getMapCardInfo($idTrackableObject) {
//        echo("In getMapCardInfo");
//        $dataClass = new MapData();
//        $cardData = $dataClass -> getMapCardData($idTrackableObject);
//        return new TrackableObjectCard($cardData);
//    }
//}
