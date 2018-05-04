<?php
include_once 'data/EventData.class.php';
include_once 'models/Event.class.php';
include_once 'data/ErrorCatching.class.php';

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

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
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
     *
     * Updates event currently in the database.
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
     *
     * Deletes Event for Entry
     * @param $idEvent: Event's preferred id
     * @param $name: Event's preferred name
     * @param $description: Event's description of relation to Rapids Cemetery
     * @param $startTime: Event's startTime
     * @param $endTime: Event's endTime
     * @param $idWiderAreaMap: Event's attached location
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
     * @param $idEvent: id of event to be deleted
     * Example Output:
     * <tr id="181">
      <td>Spring Festival Picnic</td>
      <td>Fredick Duglass Home</td>
      <td>The Spring Festival Picnic is a tradition we have where we have people enjoy the day with others</td>
      <td>2018-12-31 14:00:00</td>
      <td>2018-12-31 10:30:00</td>
      <td><button class="btn basicBtn" onclick="updateEvent(181,1,2)">Update</button></td>
      <td><button class="btn basicBtn" onclick="deleteEvent(1)"> Delete</button></td>
    </tr>
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
     * Team Garnet Notes: More validation should be done for formatting the dates and other type fields. For example the sponsors should be able to only put in a year for a grave. This should be done for the update and create forms as well as displaying information.
     * Collects all the event information and formats it to web correct HTML and CSS
     * @return string: A string contain HTML to be appended to the page.
     * Example Output:
     * <div class="eventInfo">
  <p class="eventName">Spring Festival Picnic</p>
  <p class="eventLocationName">Fredick Duglass Home</p>
  <p class="eventStartTime">Dec 31, 2018 2:00 PM - Dec 31, 2018 2:00 PM</p>
  <p class="eventDescription">The Spring Festival Picnic is a tradition we have where we have people enjoy the day with others</p>
  <hr class="style17">
</div>
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