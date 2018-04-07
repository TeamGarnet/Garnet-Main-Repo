<?php
include_once 'data/EventData.class.php';
include_once 'models/Event.class.php';

/*
 * EventService.class.php: Used to communication trails.php and admin portal page with backend.
 * Functions:
 *  getAllEventEntries()
 *  createEventEntry($name, $description, $startTime, $endTime, $idWiderAreaMap)
 *  updateEventEntry($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap)
 *  deleteEventEntry($idEvent)
 *  getAllEntriesAsRows()
 *  formatEventInfo()
 */
class EventService {
    public function __construct() {
    }

    /**
     * Retrieves all event data from the database and forms Event Objects
     * @return array : An array of Event objects
     */
    public function getAllEventEntries() {
        $eventDataClass = new EventData();
        $allEventDataObjects = $eventDataClass -> readEvent();
        $allEventData = array();

        foreach ($allEventDataObjects as $eventArray) {
            $eventObject = new Event($eventArray['idEvent'], stripcslashes($eventArray['name']), $eventArray['description'], $eventArray['startTime'], $eventArray['endTime'], $eventArray['idWiderAreaMap'], stripcslashes($eventArray['locationName']));

            array_push($allEventData, $eventObject);
        }
        return $allEventData;
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $name: Event's preferred name
     * @param $description: Event's description of relation to Rapids Cemetery
     * @param $startTime: Event's startTime
     * @param $endTime: Event's endTime
     * @param $idWiderAreaMap: Event's attached location
     */
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

    /*
     * Updates event currently in the database.
     * @param $idEvent: Event's preferred id
     * @param $name: Event's preferred name
     * @param $description: Event's description of relation to Rapids Cemetery
     * @param $startTime: Event's startTime
     * @param $endTime: Event's endTime
     * @param $idWiderAreaMap: Event's attached location
     */
    public function updateEventEntry($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap) {
        $startTime = filter_var($startTime, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $endTime = filter_var($endTime, FILTER_SANITIZE_STRING);
        $idWiderAreaMap = filter_var($idWiderAreaMap, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $eventDataClass = new EventData();
        $eventDataClass -> updateEvent($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap);
    }

    /*
     * Deletes Event for Entry
     * @param $idEvent: id of event to be deleted
     */
    public function deleteEventEntry($idEvent) {
        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idEvent) || $idEvent == "") {
            return;
        } else {
            $eventDataClass = new EventData();
            $eventDataClass -> deleteEvent($idEvent);
        }
    }

    /*
     * Retrieves all the event entries and formats to display in a table.
     * @return string: A string of a table in html
     */
    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllEventEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "18" . strval($model -> getIdEvent());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateEvent("
                . $objectRowID . ","
                . $model -> getIdEvent() . ","
                . $model -> getIdWiderAreaMap()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteEvent('
                . $model -> getIdEvent()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getName()
                . "</td><td>" . $model -> getLocationName()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getStartTime()
                . "</td><td>" . $model -> getEndTime()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }

    /*
     * Collects all the event information and formats it to web correct HTML and CSS
     * @return string: A string contain HTML to be appended to the page.
     */
    public function formatEventInfo() {
        $allEventObjects = $this -> getAllEventEntries();
        $formattedEventInfo = "";

        foreach ($allEventObjects as $eventObject) {
            date_default_timezone_set('America/New_York');
            $unixStartTime = strtotime($eventObject -> getStartTime());
            $dateStart = date("M d, Y", $unixStartTime);
            $timeStart = date("g:i A", $unixStartTime);
            $formattedStartTime = $dateStart . " " . $timeStart;

            $unixEndTime = strtotime($eventObject -> getStartTime());
            $dateEnd = date("M d, Y", $unixEndTime);
            $timeEnd = date("g:i A", $unixStartTime);
            $formattedEndTime = $dateEnd . " " . $timeEnd;

            if ($formattedStartTime == null || $formattedStartTime == "" || $formattedStartTime == "Nov 30, -0001 12:00 AM") {
                $formattedStartTime = "Unknown Start Time";
            }
            if ($formattedEndTime == null || $formattedEndTime == "" || $formattedEndTime == "Nov 30, -0001 12:00 AM") {
                $formattedEndTime = "Unknown End Time";
            }

            $formattedEventInfo .= '<div style="margin-top: 4%; text-align: left;" class="locationContainer col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="eventInfo"><p class="eventName">'
                . $eventObject -> getName() . '</p><p class="eventLocationName">'
                . $eventObject -> getLocationName() . '</p><p class="eventStartTime">' . $formattedStartTime . ' - ' . $formattedEndTime . '</p><p class="eventDescription">' . $eventObject -> getDescription() . '</p>'
                . '<hr class="style17"></div></div>';
        }
        return $formattedEventInfo;
    }
}