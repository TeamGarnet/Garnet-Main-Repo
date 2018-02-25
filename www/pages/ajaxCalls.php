<?php
include '../services/MapService.class.php';

$mapService = new MapService();

if(isset($_GET['getMapCardInfoID'])) {
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
}
