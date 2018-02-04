<?php


class Map {

    private $idTrackableObject;
    private $latitude;
    private $longitude;
    private $imageDescription;
    private $imageLocation;
    private $name;
    private $type;
    private $pinDesign;

    public function __construct($idTrackableObject, $latitude, $longitude, $imageDescription, $imageLocation, $name, $type, $pinDesign) {
        $this->setIdTrackableObject($idTrackableObject);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setImageDescription($imageDescription);
        $this->setImageLocation($imageLocation);
        $this->setName($name);
        $this->setType($type);
        $this->setPinDesign($pinDesign);
    }

    public function toString () {

    }

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

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPinDesign() {
        return $this->pinDesign;
    }

    /**
     * @param mixed $pinDesign
     */
    public function setPinDesign($pinDesign) {
        $this->pinDesign = $pinDesign;
    }

}