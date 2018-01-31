<?php


class Map {

    private $idTrackableObject;
    private $objectID;
    private $latitude;
    private $longitude;
    private $imageDescription;
    private $imageLocation;
    private $name;


    /**
     * @return mixed
     */
    public function getIdTrackableObject() {
        return $this->idTrackableObject;
    }

    /**
     * @param mixed $idTrackableObject
     */
    public function setIdTrackableObject($idTrackableObject) {
        $this->idTrackableObject = $idTrackableObject;
    }

    /**
     * @return mixed
     */
    public function getObjectID() {
        return $this->objectID;
    }

    /**
     * @param mixed $objectID
     */
    public function setObjectID($objectID) {
        $this->objectID = $objectID;
    }

    /**
     * @return mixed
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getImageDescription() {
        return $this->imageDescription;
    }

    /**
     * @param mixed $imageDescription
     */
    public function setImageDescription($imageDescription) {
        $this->imageDescription = $imageDescription;
    }

    /**
     * @return mixed
     */
    public function getImageLocation() {
        return $this->imageLocation;
    }

    /**
     * @param mixed $imageLocation
     */
    public function setImageLocation($imageLocation) {
        $this->imageLocation = $imageLocation;
    }



    //ideas for making a trackableObject type uniform:
    //make a variable that holds an id for what ever type it is
    //or a type variable that keeps track
    //or if statements that check to see which one is not null
    //or load them all into different hash maps

}