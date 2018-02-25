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
    private $imageLocation;
    private $imageDescription;

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
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = $cardDataArray['imageDescription'];
    }

    public function setNaturalHistoryInfo($cardDataArray) {
        $this -> commonName = $cardDataArray['commonName'];
        $this -> scientificName = $cardDataArray['scientificName'];
        $this -> description = $cardDataArray['description'];
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = $cardDataArray['imageDescription'];
    }

    public function setMiscObjectInfo($cardDataArray) {
        $this -> name = $cardDataArray;
        $this -> isHazard = $cardDataArray['isHazard'];
        $this -> description = $cardDataArray['description'];
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = $cardDataArray['imageDescription'];
    }

    public function getGraveInfo() {
        $modalContent = "<div class='.popup-overlay .active'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:100px;height:100px;/></br><h4>"
            . $this-> firstName . " " . $this -> lastName . "</br><h6>("
            . $this -> birth . " - " . $this -> death . ")" . "</h6></h4>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;

        return $modal;
    }

    public function getNaturalHistoryInfo() {
        $modalContent = "<div class='.popup-overlay .active'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:100px;height:100px;/></br><h4>"
            . $this-> commonName . "</br><h6>("
            . $this -> scientificName . "</h6></h4>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;

        return $modal;
    }

    public function getMiscObjectInfo() {
        $modalContent = "<div class='.popup-overlay .active'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:100px;height:100px;/></br><h4>"
            . $this-> name . "</br><h6> Hazardous Location: ("
            . $this -> isHazard . "</h6></h4>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;

        return $modal;
    }

    public function getModalClosure() {
        return "</br><button onclick='shutdown()' class='btn' style='border-radius:25px;color: #ec5e07;background-color: #fff;border-color: #ec5e07;padding:5px !important; margin-top: 15px;'>Return To Map</button></div>";
    }
}