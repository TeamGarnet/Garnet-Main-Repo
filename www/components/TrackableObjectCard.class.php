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
        $modalContent = "<div class='.popup-overlay .active'><img src='images/download.jpg' style=width:100px;height:100px;/></br><h4>"
            . $this-> firstName . " " . $this -> lastName . "</br><h6>("
            . $this -> birth . " - " . $this -> death . ")" . "</h6></h4>"
            . $this -> description;

        $modalStyle = "</br><button onclick='shutdown()' class='btn' style='border-radius:25px;color: #ec5e07;background-color: #fff;border-color: #ec5e07;padding:5px !important; margin-top: 15px;'>Return To Map</button></div>";
        $modal = $modalContent . $modalStyle;

        echo $modal;
        return $modal;


        /*
        echo "<div id='graveFullName'>" . $this -> firstName . " " . $this -> middleName . " " . $this -> lastName . "</div>" .
            "<div id='birthDeathDate'>" . $this -> birth . " - " . $this -> death . "</div>" .
            "<div id='description'>" . $this -> description . "</div>";
        */
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