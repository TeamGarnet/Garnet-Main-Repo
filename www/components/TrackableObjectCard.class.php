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
        $modalContent = "<div style='margin:3%;' class='graveInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:200px;height:auto;/></br><h2>"
            . $this-> firstName . " " . $this -> lastName . "</br><h4 class='locationDate'>("
            . $this -> birth . " - " . $this -> death . ")" . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;

        echo  $modal;
        return $modal;
    }

    public function getNaturalHistoryInfo() {
        $modalContent = "<div style='margin:3%;' class='naturalHistoryInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:200px;height:auto;/></br><h2>"
            . $this-> commonName . "</br><h4>"
            . $this -> scientificName . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;
        echo  $modal;
        return $modal;
    }

    public function getMiscObjectInfo() {
        $modalContent = "<div style='margin:3%;' class='miscObjectInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription ."' style=width:200px;height:auto;/></br><h2>"
            . $this -> name . "</br><h4> Hazardous Location: "
            . $this -> isHazard . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $modalContent . $modalStyle;
        echo  $modal;
        return $modal;
    }

    public function getModalClosure() {
        return "</br><button onclick='shutdown()' class='btn' style='border-radius:25px;color: #ec5e07;background-color: #fff;border-color: #ec5e07; padding:5px !important; margin-top: 2%;'>Return To Map</button></div>";
    }
}