<?php
include_once 'services/MapService.class.php';
include_once 'services/GraveService.class.php';
include_once 'services/EventService.class.php';
include_once 'services/NaturalHistoryService.class.php';
include_once 'services/HistoricFilterService.class.php';
include_once 'services/ContactService.class.php';
include_once 'services/FAQService.class.php';
include_once 'services/TypeFilterService.class.php';
include_once 'services/MiscObjectService.class.php';

echo("request type: " . $_SERVER['REQUEST_METHOD'] . "<br>");
echo("action type: " . $_POST['action'] . "<br>");

if(isset($_GET['getMapCardInfoID'])) {
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
}

//Delete Checks
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 'delete') {
    echo("inside delete checks <br>");
    if (!empty($_POST['deleteGrave'])) {
        $service = new GraveService();
        $service ->deleteGraveEntry($_POST['deleteGrave']);
        unset($_POST['deleteGrave']);

    } else if (!empty($_POST['deleteNH'])) {
        echo("param status deleteNH: " . $_POST['deleteNH'] . "<br>");
        $service = new NaturalHistoryService();
        echo("Made Object");
        $service ->deleteNaturalHistoryEntry($_POST['deleteNH']);
        echo("Deleted Object");
        unset($_POST['deleteNH']);

    } else if (!empty($_POST['deleteMisc'])) {
        echo("param status deleteMisc: " . $_POST['deleteMisc'] . "<br>");
        $service = new MiscObjectService();
        echo("Made Object");
        $service -> deleteMiscObjectEntry($_POST['deleteMisc']);
        echo("Deleted Object");
        unset($_POST['deleteMisc']);

    } else if (!empty($_POST['deleteType'])) {
        echo("param status deleteType: " . $_POST['deleteType'] . "<br>");
        $service = new TypeFilterService();
        echo("Made Object");
        $service ->deleteTypeFilterEntry($_POST['deleteType']);
        echo("Deleted Object");
        unset($_POST['deleteType']);

    } else if (!empty($_POST['deleteHistoricFilter'])) {
        echo("param status deleteHistoricFilter: " . $_POST['deleteHistoricFilter'] . "<br>");
        $service = new HistoricFilterService();
        echo("Made Object");
        $service ->deleteHistoricFilterEntry($_POST['deleteHistoricFilter']);
        echo("Deleted Object");
        unset($_POST['deleteHistoricFilter']);

    } else if (!empty($_POST['deleteFAQ'])) {
        echo("param status deleteFAQ: " . $_POST['deleteFAQ'] . "<br>");
        $service = new FAQService();
        echo("Made Object");
        $service ->deleteFAQEntry($_POST['deleteFAQ']);
        echo("Deleted Object");
        unset($_POST['deleteFAQ']);

    } else if (!empty($_POST['deleteLocation'])) {
        echo("param status deleteLocation: " . $_POST['deleteLocation'] . "<br>");
        $service = new WiderAreaMapService();
        echo("Made Object");
        $service ->deleteWiderAreaMapEntry($_POST['deleteLocation']);
        echo("Deleted Object");
        unset($_POST['deleteLocation']);

    } else if (!empty($_POST['deleteContact'])) {
        echo("param status deleteContact: " . $_POST['deleteContact'] . "<br>");
        $service = new ContactService();
        echo("Made Object");
        $service ->deleteContactEntry($_POST['deleteContact']);
        echo("Deleted Object");
        unset($_POST['deleteContact']);

    } else if (!empty($_POST['deleteEvent'])) {
        echo("param status deleteEvent: " . $_POST['deleteEvent'] . "<br>");
        $service = new EventService();
        echo("Made Object");
        $service ->deleteEventEntry($_POST['deleteEvent']);
        echo("Deleted Object");
        unset($_POST['deleteEvent']);
    }
}

if (isset($_POST['updateGraveEntry'])) {
    $data = json_decode($_POST['updateGraveEntry']);
    var_dump($data);
}

