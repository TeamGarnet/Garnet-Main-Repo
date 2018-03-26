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


