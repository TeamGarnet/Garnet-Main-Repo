<?php
include_once 'services/MapService.class.php';
include_once 'services/GraveService.class.php';

echo("request type: " . $_SERVER['REQUEST_METHOD'] . "<br>");

if(isset($_GET['getMapCardInfoID'])) {
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
}

//Delete Checks
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['deleteGrave'])) {
        $graveService = new GraveService();
        $graveService ->deleteGraveEntry($_POST['deleteGrave']);
        unset($_GET['deleteGrave']);
    }
}


else if (isset($_POST['updateGraveEntry'])) {
    var_dump($_POST['updateGraveEntry']);
}

