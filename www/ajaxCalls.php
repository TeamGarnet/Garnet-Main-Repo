<?php
include_once 'services/MapService.class.php';
include_once 'services/GraveService.class.php';

echo("request type: " . $_SERVER['REQUEST_METHOD']);
if(isset($_GET['getMapCardInfoID'])) {
    echo("In getMapcard");
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['deleteGrave'])) {
    $graveService = new GraveService();
    $status = $graveService ->deleteGraveEntry($_GET['deleteGrave']);
    echo("Status: " . $status);
    echo("unsetting deleteGrave");
    unset($_GET['deleteGrave']);
}
else if (isset($_POST['updateGraveEntry'])) {
    var_dump($_POST['updateGraveEntry']);
}

