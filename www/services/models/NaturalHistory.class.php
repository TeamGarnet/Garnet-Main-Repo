<?php
include_once 'TrackableObject.class.php';

/**
 */
class NaturalHistory extends TrackableObject {
    private $idNaturalHistory;
    private $commonName;
    private $scientificName;
    private $description;

    /**
     * NaturalHistory constructor.
     * @param $idNaturalHistory
     * @param $commonName
     * @param $scientificName
     * @param $description
     */
    public function __construct($idNaturalHistory, $commonName, $scientificName, $description,
                                $idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter, $type) {
        $this -> idNaturalHistory = $idNaturalHistory;
        $this -> commonName = $commonName;
        $this -> scientificName = $scientificName;
        $this -> description = $description;
        TrackableObject ::__construct($idTrackableObject, $longitude, $latitude, $hint, $imageDescription, $imageLocation, $idTypeFilter, $type);
    }

    /**
     * @return mixed
     */
    public function getIdNaturalHistory() {
        return $this -> idNaturalHistory;
    }

    /**
     * @param mixed $idNaturalHistory
     */
    public function setIdNaturalHistory($idNaturalHistory) {
        $this -> idNaturalHistory = $idNaturalHistory;
    }

    /**
     * @return mixed
     */
    public function getCommonName() {
        return $this -> commonName;
    }

    /**
     * @param mixed $commonName
     */
    public function setCommonName($commonName) {
        $this -> commonName = $commonName;
    }

    /**
     * @return mixed
     */
    public function getScientificName() {
        return $this -> scientificName;
    }

    /**
     * @param mixed $scientificName
     */
    public function setScientificName($scientificName) {
        $this -> scientificName = $scientificName;
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


}