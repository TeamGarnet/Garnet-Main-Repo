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
        foreach ($cardDataArray as $key => $value) {
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
        $this -> description = stripcslashes($cardDataArray['description']);
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = stripcslashes($cardDataArray['imageDescription']);
    }

    public function getGraveInfo() {
        if ($this -> birth == "" && $this -> death == "") {
            $birthDate = "Unknown Birth Date";
            $deathDate = "Unkown Death Date";
        } else if ($this -> birth == "" && $this -> death != "") {
            $birthDate = "Unknown Birth Date";
            $deathDate = $this -> death;
        } else if ($this -> birth != "" && $this -> death == "") {
            $birthDate = $this -> birth;
            $deathDate = "Unkown Death Date";
        } else {
            $birthDate = $this -> birth;
            $deathDate = $this -> death;
        }
        $modalContent = "<div style='margin:3%;' class='graveInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription . "' style=width:200px;height:auto;/></br><h2>"
            . $this -> firstName . " " . $this -> lastName . "</br><h4 class='locationDate'>("
            . $birthDate . " - " . $deathDate . ")" . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $this -> getModalContainerBegin() . $modalContent . $modalStyle . $this -> getModalContainerEnd();

        echo $modal;
        return $modal;
    }

    public function getModalClosure() {
        return "";
    }

    public function getModalContainerBegin() {
        return '<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="position: absolute; top: 10px; left: 10px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body popupModal" id="popupModal">';
    }

    public function getModalContainerEnd() {
        return '</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Return to Map</button>
            </div>
        </div>
    </div>
</div>';
    }

    public function setNaturalHistoryInfo($cardDataArray) {
        $this -> commonName = stripcslashes($cardDataArray['commonName']);
        $this -> scientificName = stripcslashes($cardDataArray['scientificName']);
        $this -> description = stripcslashes($cardDataArray['description']);
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = stripcslashes($cardDataArray['imageDescription']);
    }

    public function getNaturalHistoryInfo() {
        $modalContent = "<div style='margin:3%;' class='naturalHistoryInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription . "' style=width:200px;height:auto;/></br><h2>"
            . $this -> commonName . "</br><h4>"
            . $this -> scientificName . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $this -> getModalContainerBegin() . $modalContent . $modalStyle . $this -> getModalContainerEnd();
        echo $modal;
        return $modal;
    }

    public function setMiscObjectInfo($cardDataArray) {
        $this -> name = $cardDataArray['name'];
        $this -> isHazard = $cardDataArray['isHazard'];
        $this -> description = stripcslashes($cardDataArray['description']);
        $this -> imageLocation = $cardDataArray['imageLocation'];
        $this -> imageDescription = stripcslashes($cardDataArray['imageDescription']);
    }

    public function getMiscObjectInfo() {
        $modalContent = "<div style='margin:3%;' class='miscObjectInfo'><img src='"
            . $this -> imageLocation . "' alt='"
            . $this -> imageDescription . "' style=width:200px;height:auto;/></br><h2>"
            . $this -> name . "</br><h4> Hazardous Location: "
            . $this -> isHazard . "</h4></h2>"
            . $this -> description;

        $modalStyle = $this -> getModalClosure();
        $modal = $this -> getModalContainerBegin() . $modalContent . $modalStyle . $this -> getModalContainerEnd();
        echo $modal;
        return $modal;
    }
}