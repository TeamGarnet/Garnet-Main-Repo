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
include_once 'services/WiderAreaMapService.class.php';

if(isset($_GET['getMapCardInfoID'])) {
    $mapService = new MapService();
    $mapService -> getMapCardInfo($_GET['getMapCardInfoID']);
    unset($_GET['getMapCardInfoID']);
}

//Delete Checks
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 'delete') {
    if (!empty($_POST['deleteGrave'])) {
        $service = new GraveService();
        $service ->deleteGraveEntry($_POST['deleteGrave']);
        unset($_POST['deleteGrave']);

    } else if (!empty($_POST['deleteNH'])) {
        $service = new NaturalHistoryService();
        $service ->deleteNaturalHistoryEntry($_POST['deleteNH']);
        unset($_POST['deleteNH']);

    } else if (!empty($_POST['deleteMisc'])) {
        $service = new MiscObjectService();
        $service -> deleteMiscObjectEntry($_POST['deleteMisc']);
        unset($_POST['deleteMisc']);

    } else if (!empty($_POST['deleteType'])) {
        $service = new TypeFilterService();
        $status = $service ->deleteTypeFilterEntry($_POST['deleteType']);
        unset($_POST['deleteType']);
        echo $status;

    } else if (!empty($_POST['deleteHistoricFilter'])) {
        $service = new HistoricFilterService();
        $service ->deleteHistoricFilterEntry($_POST['deleteHistoricFilter']);
        unset($_POST['deleteHistoricFilter']);

    } else if (!empty($_POST['deleteFAQ'])) {
        $service = new FAQService();
        $service ->deleteFAQEntry($_POST['deleteFAQ']);
        unset($_POST['deleteFAQ']);

    } else if (!empty($_POST['deleteLocation'])) {
        $service = new WiderAreaMapService();
        $service ->deleteWiderAreaMapEntry($_POST['deleteLocation']);
        unset($_POST['deleteLocation']);

    } else if (!empty($_POST['deleteContact'])) {
        $service = new ContactService();
        $service ->deleteContactEntry($_POST['deleteContact']);
        unset($_POST['deleteContact']);

    } else if (!empty($_POST['deleteEvent'])) {
        $service = new EventService();
        $service ->deleteEventEntry($_POST['deleteEvent']);
        unset($_POST['deleteEvent']);
    }
}

if (isset($_POST['updateGraveEntry'])) {
    $graveData = $_POST['updateGraveEntry'];
    $service = new GraveService();
    $service -> updateGraveEntry($graveData['idTrackableObject'], $graveData['idGrave'], $graveData['FirstName'],
        $graveData['MiddleName'], $graveData['LastName'], $graveData['BirthDate'],
        $graveData['DeathDate'], $graveData['Description'], $graveData['idHistoricFilter'],
        $graveData['Longitude'], $graveData['Latitude'], null,
        $graveData['ImageDescription'], $graveData['ImageLocation'],
        $graveData['idTypeFilter']);
    unset($_POST['updateGraveEntry']);
}
else if (isset($_POST['updateNaturalHistoryEntry'])) {
    $nhData = $_POST['updateNaturalHistoryEntry'];
    $service = new NaturalHistoryService();
    $service -> updateNaturalHistoryEntry($nhData['idTrackableObject'], $nhData['idNaturalHistory'], $nhData['ScientificName'],
        $nhData['CommonName'], $nhData['Description'], $nhData['Longitude'],
        $nhData['Latitude'], null, $nhData['ImageDescription'],
        $nhData['ImageLocation'], $nhData['idTypeFilter']);
    unset($_POST['updateNaturalHistoryEntry']);
}
else if (isset($_POST['updateMiscObjectEntry'])) {
    unset($_POST['updateMiscObjectEntry']);
}
else if (isset($_POST['updateTypeFilterEntry'])) {
    unset($_POST['updateTypeFilterEntry']);
}
else if (isset($_POST['updateHistoricFilterEntry'])) {
    unset($_POST['updateHistoricFilterEntry']);
}
else if (isset($_POST['updateFAQEntry'])) {
    unset($_POST['updateFAQEntry']);
}
else if (isset($_POST['updateWiderAreaMapEntry'])) {
    unset($_POST['updateWiderAreaMapEntry']);
}
else if (isset($_POST['updateContactEntry'])) {
    unset($_POST['updateContactEntry']);
}
else if (isset($_POST['updateEventEntry'])) {
    unset($_POST['updateEventEntry']);
}
