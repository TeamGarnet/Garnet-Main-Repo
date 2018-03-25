<?php
/**
 */

class Event {
    private $idEvent;
    private $name;
    private $description;
    private $startTime;
    private $endTime;
    private $idWiderAreaMap;
    private $locationName;

    /**
     * Event constructor.
     * @param $idEvent
     * @param $name
     * @param $description
     * @param $startTime
     * @param $endTime
     * @param $idWiderAreaMap
     * @param $locationName
     */
    public function __construct($idEvent, $name, $description, $startTime, $endTime, $idWiderAreaMap, $locationName) {
        $this -> idEvent = $idEvent;
        $this -> name = $name;
        $this -> description = $description;
        $this -> startTime = $startTime;
        $this -> endTime = $endTime;
        $this -> idWiderAreaMap = $idWiderAreaMap;
        $this -> locationName = $locationName;
    }

    /**
     * @return mixed
     */
    public function getIdEvent() {
        return $this -> idEvent;
    }

    /**
     * @param mixed $idEvent
     */
    public function setIdEvent($idEvent) {
        $this -> idEvent = $idEvent;
    }

    /**
     * @return mixed
     */
    public function getLocationName() {
        return $this -> locationName;
    }

    /**
     * @param mixed $locationName
     */
    public function setLocationName($locationName) {
        $this -> locationName = $locationName;
    }


    /**
     * @return mixed
     */
    public function getName() {
        return $this -> name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this -> name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this -> description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this -> description = $description;
    }

    /**
     * @return mixed
     */
    public function getStartTime() {
        return $this -> startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime) {
        $this -> startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime() {
        return $this -> endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime) {
        $this -> endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getIdWiderAreaMap() {
        return $this -> idWiderAreaMap;
    }

    /**
     * @param mixed $idWiderAreaMap
     */
    public function setIdWiderAreaMap($idWiderAreaMap) {
        $this -> idWiderAreaMap = $idWiderAreaMap;
    }
}