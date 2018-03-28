<?php
include_once 'data/EventData.class.php';
include_once 'models/Event.class.php';
/**
 */

class EventService {
    public function __construct(){
    }

    public function getAllEventEntries() {
        $eventDataClass = new EventData();
        $allEventDataObjects =  $eventDataClass -> readEvent();
        $allEventData = array();

        foreach ($allEventDataObjects as $eventArray) {
            $eventObject = new Event($eventArray['idEvent'], $eventArray['name'], $eventArray['description'], $eventArray['startTime'], $eventArray['endTime'], $eventArray['idWiderAreaMap'], $eventArray['locationName']);

            array_push($allEventData, $eventObject);
        }
        return $allEventData;
    }

    public function createEventEntry($name, $description, $startTime, $endTime, $idWiderAreaMap) {
        $startTime = filter_var($startTime, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $endTime = filter_var($endTime, FILTER_SANITIZE_STRING);
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        //create Event Object
        $eventDataClass = new EventData();
        $eventDataClass -> createEvent($name, $description, $startTime, $endTime, $idWiderAreaMap);
    }

    public function updateEventEntry($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap) {
        $startTime = filter_var($startTime, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $endTime = filter_var($endTime, FILTER_SANITIZE_STRING);
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $eventDataClass = new EventData();
        $eventDataClass -> updateEvent($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap);
    }

    public function deleteEventEntry($idEvent) {
        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idEvent) || $idEvent == "") {
            return;
        } else {
            $eventDataClass = new EventData();
            $eventDataClass -> deleteEvent($idEvent);
        }
    }

    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllEventEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "18" . strval($model->getIdEvent());
            $editAndDelete = "</td><td><button onclick='updateEvent("
                . $objectRowID . ","
                . $model->getIdEvent() . ","
                . $model->getIdWiderAreaMap()
                . ")'>Update</button>"
                . "</td><td><button onclick=" . '"deleteEvent('
                . $model->getIdEvent()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model->getName()
                . "</td><td>" . $model->getLocationName()
                . "</td><td>" . $model->getDescription()
                . "</td><td>" . $model->getStartTime()
                . "</td><td>" . $model->getEndTime()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}