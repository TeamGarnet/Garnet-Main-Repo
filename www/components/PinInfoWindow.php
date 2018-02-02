<?php

class PinInfoWindow {

    private $pinObject;

    public function __construct($pinObject) {
        $this->setPinObject($pinObject);
    }

    public function createInfoWindow() {
        $infoWindowString = "this should be the html that formats the infoWindow using the pinObject";


        return $infoWindowString;
    }

    /**
     * @return mixed
     */
    public function getPinObject() {
        return $this->pinObject;
    }

    /**
     * @param mixed $pinObject
     */
    public function setPinObject($pinObject) {
        $this->pinObject = $pinObject;
    }
}