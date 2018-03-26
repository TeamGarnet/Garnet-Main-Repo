<?php
include_once 'services/MapService.class.php';
include_once 'services/GraveService.class.php';

if(isset($_GET['getMapCardInfoID'])) {
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
} else if (isset($_GET['deleteGrave'])) {
    $graveService = new GraveService();
    $graveService ->deleteGraveEntry($_GET['deleteGrave']);
    unset($_GET['deleteGrave']);
}
else if (isset($_POST['updateGraveEntry'])) {
    //$graveService = new GraveService();
    $string1 = '';
    $json = $_POST['updateGraveEntry'];
    $assoc_array = json_decode($json, true);
    foreach($assoc_array as $key => $value) {
        $string1 += $assoc_array[$key];
    }
    echo $string1;
}

