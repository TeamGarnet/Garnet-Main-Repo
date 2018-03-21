<?php
include 'TrackableObject.class.php';

/**
 */

class MiscObject extends TrackableObject{
    private $idMisc;
    private $name;
    private $description;
    private $isHazard;

    /**
     * MiscObject constructor.
     * @param $idMisc
     * @param $name
     * @param $description
     * @param $isHazard
     */
    public function __construct($idMisc, $name, $description, $isHazard,
                                $idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter, $type) {
        $this -> idMisc = $idMisc;
        $this -> name = $name;
        $this -> description = $description;
        $this -> isHazard = $isHazard;

        TrackableObject::__construct($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter, $type);
    }

    /**
     * @return mixed
     */
    public function getIdMisc() {
        return $this -> idMisc;
    }

    /**
     * @param mixed $idMisc
     */
    public function setIdMisc($idMisc) {
        $this -> idMisc = $idMisc;
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
    public function getisHazard() {
        return $this -> isHazard;
    }

    /**
     * @param mixed $isHazard
     */
    public function setIsHazard($isHazard) {
        $this -> isHazard = $isHazard;
    }


}