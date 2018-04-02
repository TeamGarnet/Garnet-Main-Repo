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
            $eventObject = new Event($eventArray['idEvent'], stripcslashes($eventArray['name']), $eventArray['description'], $eventArray['startTime'], $eventArray['endTime'], $eventArray['idWiderAreaMap'], stripcslashes($eventArray['locationName']));

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

    public function formatEventInfo() {
        $allEventObjects = $this -> getAllEventEntries();
        $formattedEventInfo = "";

        foreach ($allEventObjects as $eventObject) {
            date_default_timezone_set('America/New_York');
            $unixStartTime = strtotime($eventObject->getStartTime());
            $formattedStartTime = date("M-d-Y \at g:i A" , $unixStartTime);

            $unixEndTime = strtotime($eventObject->getStartTime());
            $formattedEndTime = date("M d-Y  \at g:i A" , $unixEndTime);

            $formattedEventInfo .= '<div style="margin-bottom: 2%;" class="locationContainer col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="eventInfo"><p class="eventName">'
                . $eventObject->getName() . '</p><p class="eventLocationName">'
                . $eventObject -> getLocationName() . '</p><p class="eventStartTime">' . $formattedStartTime . ' - ' . $formattedEndTime . '</p><p class="eventDescription">' . $eventObject-> getDescription() . '</p>'
                .'</div>';
        }
        return $formattedEventInfo;
    }
}