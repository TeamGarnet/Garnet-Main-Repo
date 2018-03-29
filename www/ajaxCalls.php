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

// Update POST requests
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
    $service -> updateNaturalHistoryEntry((int)$nhData['idTrackableObject'], (int)$nhData['idNaturalHistory'], $nhData['ScientificName'],
        $nhData['CommonName'], $nhData['Description'], (float)$nhData['Longitude'],
        (float)$nhData['Latitude'], null, $nhData['ImageDescription'],
        $nhData['ImageLocation'], (int)$nhData['idTypeFilter']);
    unset($_POST['updateNaturalHistoryEntry']);
}
else if (isset($_POST['updateMiscObjectEntry'])) {
    $miscData = $_POST['updateMiscObjectEntry'];
    $service = new MiscObjectService();
    $service -> updateMiscObjectEntry((int)$miscData['idTrackableObject'], (int)$miscData['idMiscObject'], $miscData['Name'],
        $miscData['IsaHazard'], $miscData['Description'], $miscData['Longitude'],
        $miscData['Latitude'], null, $miscData['ImageDescription'],
        $miscData['ImageLocation'], (int)$miscData['idTypeFilter']);
    unset($_POST['updateMiscObjectEntry']);
}
else if (isset($_POST['updateTypeFilterEntry'])) {
    $filterData = $_POST['updateTypeFilterEntry'];
    $service = new TypeFilterService();
    $service -> updateTypeFilterEntry($filterData['idTypeFilter'], $filterData['Name'],
        $filterData['PinDesign'], $filterData['ButtonColor']);
    unset($_POST['updateTypeFilterEntry']);
}
else if (isset($_POST['updateHistoricFilterEntry'])) {
    $filterData = $_POST['updateHistoricFilterEntry'];
    $service = new HistoricFilterService();
    $service -> updateHistoricFilterEntry($filterData['idHistoricFilter'], $filterData['Name'], $filterData['StartDate'],
        $filterData['Description'], $filterData['EndDate'], $filterData['ButtonColor']);
    unset($_POST['updateHistoricFilterEntry']);
}
else if (isset($_POST['updateFAQEntry'])) {
    $faqData = $_POST['updateFAQEntry'];
    $service = new FAQService();
    $service -> updateFAQEntry($faqData['idFAQ'], $faqData['Question'], $faqData['Answer']);
    unset($_POST['updateFAQEntry']);
}
else if (isset($_POST['updateWiderAreaMapEntry'])) {
    $areaData = $_POST['updateWiderAreaMapEntry'];
    $service = new WiderAreaMapService();
    $service -> updateWiderAreaMapEntry($areaData['idWiderAreaMap'], $areaData['Site'], $areaData['Name'],
        $areaData['Description'], $areaData['Longitude'], $areaData['Latitude'],
        $areaData['Address'], $areaData['City'], $areaData['State'], $areaData['ZipCode']);
    unset($_POST['updateWiderAreaMapEntry']);
}
else if (isset($_POST['updateContactEntry'])) {
    $contactData = $_POST['updateContactEntry'];
    $service = new ContactService();
    $service -> updateContactEntry($contactData['idContact'], $contactData['Name'], $contactData['Email'],
        $contactData['Description'], $contactData['Phone'], $contactData['Title']);
    unset($_POST['updateContactEntry']);
}
else if (isset($_POST['updateEventEntry'])) {
    $eventData = $_POST['updateEventEntry'];
    $service = new EventService();
    $service -> updateEventEntry($eventData['idEvent'], $eventData['Name'], $eventData['Description'],
        $eventData['StartTime'], $eventData['EndTime'], $eventData['idWiderAreaMap']);
    unset($_POST['updateEventEntry']);
}

// Create POST requests
if(isset($_POST['createGraveEntry'])) {
    $graveData = $_POST['createGraveEntry'];
    $service = new GraveService();
    $service -> createGraveEntry($graveData['FirstName'], $graveData['MiddleName'], $graveData['LastName'],
        $graveData['BirthDate'], $graveData['DeathDate'], $graveData['Description'],
        null, $graveData['Longitude'], $graveData['Latitude'], null,
        $graveData['ImageDescription'], $graveData['ImageLocation'], null);
    unset($_POST['createGraveEntry']);
}
else if(isset($_POST['createNaturalHistoryEntry'])) {
    $nhData = $_POST['createNaturalHistoryEntry'];
    $service = new NaturalHistoryService();
    $service -> createNaturalHistoryEntry($nhData['ScientificName'], $nhData['CommonName'], $nhData['Description'],
        $nhData['Longitude'], $nhData['Latitude'], null, $nhData['ImageDescription'],
        $nhData['ImageLocation'], null);
    unset($_POST['createNaturalHistoryEntry']);
}
else if(isset($_POST['createMiscObjectEntry'])) {
    $miscData = $_POST['createMiscObjectEntry'];
    $service = new MiscObjectService();
    $service -> createMiscObjectEntry($miscData['Name'],$miscData['IsaHazard'], $miscData['Description'],
        $miscData['Longitude'], $miscData['Latitude'], null,
        $miscData['ImageDescription'], $miscData['ImageLocation'], null);
    unset($_POST['updateEventEntry']);
}
else if(isset($_POST['createTypeFilterEntry'])) {
    $filterData = $_POST['createTypeFilterEntry'];
    $service = new TypeFilterService();
    $service -> createTypeFilterEntry($filterData['Name'], $filterData['PinDesign'], $filterData['ButtonColor']);
    unset($_POST['createTypeFilterEntry']);
}
else if(isset($_POST['createHistoricFilterEntry'])) {
    $filterData = $_POST['createHistoricFilterEntry'];
    $service = new HistoricFilterService();
    $service -> createHistoricFilterEntry($filterData['Name'], $filterData['StartDate'], $filterData['Description'],
        $filterData['EndDate'], $filterData['ButtonColor']);
    unset($_POST['createHistoricFilterEntry']);
}
else if(isset($_POST['createFAQEntry'])) {
    $faqData = $_POST['createFAQEntry'];
    $service = new FAQService();
    $service -> createFAQEntry($faqData['Question'], $faqData['Answer']);
    unset($_POST['createFAQEntry']);
}
else if(isset($_POST['createWiderAreaMapEntry'])) {
    $areaData = $_POST['createWiderAreaMapEntry'];
    $service = new WiderAreaMapService();
    $service -> createWiderAreaMapEntry($areaData['Site'], $areaData['Name'], $areaData['Description'],
        $areaData['Longitude'], $areaData['Latitude'], $areaData['Address'],
        $areaData['City'], $areaData['State'], $areaData['ZipCode']);
    unset($_POST['createWiderAreaMapEntry']);
}
else if(isset($_POST['createContactEntry'])) {
    $contactData = $_POST['createContactEntry'];
    $service = new ContactService();
    $service ->createContactEntry($contactData['Name'], $contactData['Email'],
        $contactData['Description'], $contactData['Phone'], $contactData['Title']);
    unset($_POST['createContactEntry']);
}
else if(isset($_POST['createEventEntry'])) {
    $eventData = $_POST['createEventEntry'];
    $service = new EventService();
    $service -> createEventEntry($eventData['Name'], $eventData['Description'], $eventData['StartTime'],
        $eventData['EndTime'], null);
    unset($_POST['createEventEntry']);
}