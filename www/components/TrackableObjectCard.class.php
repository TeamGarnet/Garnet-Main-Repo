<?php

class TrackableObjectCard {
    // Grave attribtues
    private $firstName;
    private $middleName;
    private $lastName;
    private $birth;
    private $death;

    // Natural History attributes
    private $commonName;
    private $scientificName;

    // Miscellaneous Object attributes
    private $name;
    private $isHazard;

    // Common attributes
    private $description;

    public function __construct($cardDataArray) {
        foreach($cardDataArray as $key => $value) {
            $stringValue = (string)$value;
            $cardDataArray[$key] = $stringValue;
        }
        $type = $cardDataArray['type'];
        switch ($type) {
            case 'Grave':
                $this -> setGraveInfo($cardDataArray);
                $this -> getGraveInfo();
                break;
            case 'Natural History':
                $this -> setNaturalHistoryInfo($cardDataArray);
                $this -> getNaturalHistoryInfo();
                break;
            default:
                $this -> setMiscObjectInfo($cardDataArray);
                $this -> getMiscObjectInfo();
                break;
        }
    }

    public function setGraveInfo($cardDataArray) {
        $this -> firstName = $cardDataArray['firstName'];
        $this -> middleName = $cardDataArray['middleName'];
        $this -> lastName = $cardDataArray['lastName'];
        $this -> birth = $cardDataArray['birth'];
        $this -> death = $cardDataArray['death'];
        $this -> description = $cardDataArray['description'];
    }

    public function setNaturalHistoryInfo($cardDataArray) {
        $this -> commonName = $cardDataArray['commonName'];
        $this -> scientificName = $cardDataArray['scientificName'];
        $this -> description = $cardDataArray['description'];
    }

    public function setMiscObjectInfo($cardDataArray) {
        $this -> name = $cardDataArray;
        $this -> isHazard = $cardDataArray['isHazard'];
        $this -> description = $cardDataArray['description'];
    }

    public function getGraveInfo() {
        $modal = $this -> createModal();
        return "$modal" . "<div id='graveFullName'>" . $this -> firstName . " " . $this -> middleName . " " . $this -> lastName . "</div>" .
            "<div id='birthDeathDate'>" . $this -> birth . " - " . $this -> death . "</div>" .
            "<div id='description'>" . $this -> description . "</div>";
    }

    public function getNaturalHistoryInfo() {
        echo "<div id='scientificName'>" . $this -> scientificName . "</div>" .
            "<div id='commonName'>" . $this -> commonName . "</div>" .
            "<div id ='description'>" . $this -> description . "</div>";
    }

    public function getMiscObjectInfo() {
        echo "<div id='name'>" . $this -> name . "</div>" .
            "<div id='isHazard'> Hazard?" . $this -> isHazard . "</div>" .
            "<div id = 'description'>" . $this -> description . "</div>";
    }

    private function createModal() {
        return "<!-- Modal -->
        <div id='myModal' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
        
            <!-- Modal content-->
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Modal Header</h4>
              </div>
              <div class='modal-body'>
                <p>Some text in the modal.</p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
              </div>
            </div>
        
          </div>
        </div>";
    }
}