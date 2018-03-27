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
        echo("param status: " . $_POST['deleteNH'] . "<br>");
        $service = new NaturalHistoryService();
        $service ->deleteNaturalHistoryEntry($_POST['deleteNH']);
        unset($_POST['deleteNH']);

    } else if (!empty($_POST['deleteMisc'])) {
        echo("param status: " . $_POST['deleteMisc'] . "<br>");
        $service = new MiscObjectService();
        $service -> deleteMiscObjectEntry($_POST['deleteMisc']);
        unset($_POST['deleteMisc']);

    } else if (!empty($_POST['deleteType'])) {
        echo("param status: " . $_POST['deleteType'] . "<br>");
        $service = new TypeFilterService();
        $service ->deleteTypeFilterEntry($_POST['deleteType']);
        unset($_POST['deleteType']);

    } else if (!empty($_POST['deleteHistoricFilter'])) {
        echo("param status: " . $_POST['deleteHistoricFilter'] . "<br>");
        $service = new HistoricFilterService();
        $service ->deleteHistoricFilterEntry($_POST['deleteHistoricFilter']);
        unset($_POST['deleteHistoricFilter']);

    } else if (!empty($_POST['deleteFAQ'])) {
        echo("param status: " . $_POST['deleteFAQ'] . "<br>");
        $service = new FAQService();
        $service ->deleteFAQEntry($_POST['deleteFAQ']);
        unset($_POST['deleteFAQ']);

    } else if (!empty($_POST['deleteLocation'])) {
        echo("param status: " . $_POST['deleteLocation'] . "<br>");
        $service = new WiderAreaMapService();
        $service ->deleteWiderAreaMapEntry($_POST['deleteLocation']);
        unset($_POST['deleteLocation']);

    } else if (!empty($_POST['deleteContact'])) {
        echo("param status: " . $_POST['deleteContact'] . "<br>");
        $service = new ContactService();
        $service ->deleteContactEntry($_POST['deleteContact']);
        unset($_POST['deleteContact']);

    } else if (!empty($_POST['deleteEvent'])) {
        echo("param status: " . $_POST['deleteEvent'] . "<br>");
        $service = new EventService();
        $service ->deleteEventEntry($_POST['deleteEvent']);
        unset($_POST['deleteEvent']);
    }
}


else if (isset($_POST['updateGraveEntry'])) {
    var_dump($_POST['updateGraveEntry']);
}

