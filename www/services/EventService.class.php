<?php
require_once '../../data/EventData.class.php';
require_once '../../models/Event.class.php';
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
            $eventObject = new Event($eventArray['idEvent'], $eventArray['name'], $eventArray['description'], $eventArray['startTime'], $eventArray['endTime'], $eventArray['idWiderAreaMap']);

            array_push($allEventData, $eventObject);
        }
        return $allEventDataObjects;
    }

    public function createEventEntry($name, $description, $startTime, $endTime, $idWiderAreaMap) {
        $startTime = filter_var($startTime, FILTER_SANITIZE_EMAIL);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $endTime = filter_var($endTime, FILTER_SANITIZE_STRING);
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        //create Event Object
        $eventDataClass = new EventData();
        $eventDataClass -> createEvent($startTime, $description, $endTime, $idWiderAreaMap, $name);
    }

    public function updateEventEntry($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap) {
        $startTime = filter_var($startTime, FILTER_SANITIZE_EMAIL);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $endTime = filter_var($endTime, FILTER_SANITIZE_STRING);
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $eventDataClass = new EventData();
        $eventDataClass -> updateEvent($idEvent, $name, $startTime, $description, $endTime, $idWiderAreaMap);
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
}