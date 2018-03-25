<?php
include_once '../services/MapService.class.php';
include_once 'services/GraveService.class.php';

if(isset($_GET['getMapCardInfoID'])) {
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
}

/*
if (isset($_POST['updateGraveEntry'])) {

    $graveService -> updateGraveEntry(
    $_POST['idGrave'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['birth'], $_POST['death'], $_POST['description'], $_POST['idHistoricFilter'], $_POST['historicFilterName'],
                $_POST['idTrackableObject'], $_POST['longitude'], $_POST['latitude'], $_POST['qrCode'], $_POST['hint'], $_POST['imageDescription'], $_POST['mageLocation'], $_POST['idTypeFilter'], $_POST['$type']);
    unset($_POST['updateGraveEntry']);
    //unset the rest of the data, maybe
}
*/

if (isset($_GET['deleteGrave'])) {
    $graveService = new GraveService();
    var_dump("id = " . $_GET['deleteGrave']);
    $graveService ->deleteGraveEntry($_GET['deleteGrave']);
    unset($_GET['deleteGrave']);
}


