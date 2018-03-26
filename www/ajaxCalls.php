<?php
include_once 'services/MapService.class.php';
include_once 'services/GraveService.class.php';


if(isset($_GET['getMapCardInfoID'])) {
    echo("In getMapcard");
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
} else if (isset($_GET['deleteGrave'])) {
    echo("In deleteGrave");
    $graveService = new GraveService();
    echo("About to run delete grave...");
    $graveService ->deleteGraveEntry($_GET['deleteGrave']);
    echo("unsetting delteGrave");
    unset($_GET['deleteGrave']);
}
else if (isset($_POST['updateGraveEntry'])) {
    var_dump($_POST['updateGraveEntry']);
}

