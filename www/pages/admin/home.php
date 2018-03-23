<?php
session_start();
if(isset($_SESSION['idUser'])) {
    echo "Your session is running " . $_SESSION['idUser'];
} else {
    header('Location: login.php');
}
include '../../services/GraveService.class.php';
include '../../services/NaturalHistoryService.class.php';
include '../../services/MiscObjectService.class.php';

include '../../services/ContactService.class.php';
include '../../services/FAQService.class.php';

include '../../services/HistoricFilterService.class.php';
include '../../services/TypeFilterService.class.php';

include '../../services/WiderAreaMapService.class.php';
include '../../services/EventService.class.php';
$graveService = new GraveService();
$naturalHistoryService = new NaturalHistoryService();
$miscObjectService = new MiscObjectService();

$contactService = new ContactService();
$fAQService = new FAQService();

$historicFilterService = new HistoricFilterService();
$typeFilterService = new TypeFilterService();

$widerAreaMapService = new WiderAreaMapService();
$eventService = new EventService();

//TODO: check if trackable object is working
///*
var_dump($graveService->getAllGraveEntries());
//$graveService -> createGraveEntry("firstName", "M", "lastName", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't", "1",43.109362, -77.659403, "graveService", "Test", "", 1);
$graveService -> updateGraveEntry("14","5","firstName2", "M", "lastName", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't", "1",43.109362, -70.659403, "UpdateTest", "Test", "", 1);
//$graveService -> deleteGraveEntry("5");

echo "<br><br>";
var_dump($naturalHistoryService->getAllNaturalHistoryEntries());
//$naturalHistoryService -> createNaturalHistoryEntry("naturalHistoryService", "commonName", "description", 40.109362, -77.659403, "naturalHistoryService", "Test", "", 2);
$naturalHistoryService->updateNaturalHistoryEntry("35","6","Test1", "commonName", "description", 43.109362, -77.659403, "UpdateTest", "Test", "", 2);
//$naturalHistoryService->deleteNaturalHistoryEntry("6");

echo "<br><br>";
var_dump($miscObjectService->getAllMiscObjectEntries());
//$miscObjectService -> createMiscObjectEntry("miscObjectService", "Yes", "description",43.109362, -77.659403, "miscObjectService", "Test2", "", 3);
$miscObjectService->updateMiscObjectEntry("36", "4", "name1", "Yes", "description",43.109362, -77.659403, "UpdateTest", "Test", "", 3);
//$miscObjectService->deleteMiscObjectEntry("4");
/*

echo "<br><br>";
var_dump($contactService->getAllContactEntries());
$contactService->createContactEntry("Name1", "email1@email.com", "description", "333-3333333", "Boss");
$contactService->updateContactEntry("6", "Name3", "email3@email.com", "description1", "333-3333333", "Boss3");
$contactService->deleteContactEntry("6");

echo "<br><br>";
var_dump($fAQService->getAllFAQEntries());
$fAQService->createFAQEntry("make a question?", "make an answer.");
$fAQService->updateFAQEntry("6", "make a question3?", "make an answer.3");
$fAQService->deleteFAQEntry("6");

echo "<br><br>";
var_dump($historicFilterService->getAllHistoricFilterEntries());
$historicFilterService->createHistoricFilterEntry("Name1", "3018/11/31", "description", "3018/11/31", "#4386f4");
$historicFilterService->updateHistoricFilterEntry("8", "Name3", "3318/11/33", "description3", "3038/11/31", "#6g86f4");
$historicFilterService->deleteHistoricFilterEntry("8");

echo "<br><br>";
var_dump($typeFilterService->getAllTypeFilterEntries());
$typeFilterService->createTypeFilterEntry("Name1", null, "#4386f4");
$typeFilterService->updateTypeFilterEntry("7", "Name3", "https:www.moma.org/collection/works/174300", null);
$typeFilterService->deleteTypeFilterEntry("7");

echo "<br><br>";
var_dump($widerAreaMapService->getAllWiderAreaMapEntries());
$widerAreaMapService->createWiderAreaMapEntry("www.google.com", "name1", "description", 43.109363, 43.109363, "Address1", "city1", "state1", 13345);
$widerAreaMapService->updateWiderAreaMapEntry("7", "www.facebook.com", "name3", "description3", -77.659403, -77.659403, "Address3", "city3", "state1", 13345);
$widerAreaMapService->deleteWiderAreaMapEntry("7");

echo "<br><br>";
var_dump($eventService->getAllEventEntries());
$eventService->createEventEntry("name1", "description", "11:00", "12:00", "1");
//TODO figure out how to get the correct time
$eventService->updateEventEntry("5", "name3", "description3", "12:00", "1:00", "2");
$eventService->deleteEventEntry("5");
*/
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../pages/css/admin/home.css" type="text/css">
    <link rel="apple-touch-icon" sizes="120x120" href="../../pages/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/pages/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/pages/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<p> Woah you made it </p>





<a href="logout.php">Logout</a>
</body>
</html>


