<?php
session_start();
if(isset($_SESSION['idUser'])) {
    echo "Your session is running " . $_SESSION['idUser'];
} else {
    header('Location: login.php');
}
include '../../services/GraveService.class.php';
$graveService = new GraveService();
/*
var_dump($graveService->getAllGraveEntries());
$graveService -> createGraveEntry("firstName", "M", "lastName", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't", "1",43.109362, -77.659403, "Test", "Test", "", 1);
*/
$graveService -> updateGraveEntry("14","5","firstName2", "M", "lastName", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't", "1",43.109362, -77.659403, "Test", "Test", "", 1);
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


