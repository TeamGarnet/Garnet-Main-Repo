<?php
echo "Loading includes..." . "\n";
include '../services/TrackableObject.class.php';
echo "Loaded includes" . "\n" . "Incoming Map Data" . "\n";
$trackableObject = new TrackableObject();
$mapData = $trackableObject->returnObject("FAQ", "");

echo $mapData;

?>

<!DOCTYPE html>

</DOCTYPE>
