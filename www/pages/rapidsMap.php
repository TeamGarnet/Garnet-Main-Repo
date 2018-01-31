<?php
echo "Loading includes..." . "\n";
include '../services/Generic.class.php';
echo "Loaded includes" . "\n" . "Incoming Map Data" . "\n";

$generic = new Generic();
$mapData = $generic->returnObject("FAQ", "");

echo $mapData;

?>

<!DOCTYPE html>

</DOCTYPE>
