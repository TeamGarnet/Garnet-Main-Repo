<?php
include 'TrackableObject.class.php';
/**
 */

class Grave extends TrackableObject {
    private $idGrave;
    private $firstName;
    private $middleName;
    private $lastName;
    private $birth;
    private $death;
    private $description;
    private $idHistoricFilter;
    private $historicFilterName;

    /**
     * Grave constructor.
     * @param $idGrave
     * @param $firstName
     * @param $middleName
     * @param $lastName
     * @param $birth
     * @param $death
     * @param $description
     * @param $idHistoricFilter
     * @param $historicFilterName
     */
    public function __construct($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter, $historicFilterName,
                                $idTrackableObject, $longitude, $latitude, $qrCode, $hint, $imageDescription, $imageLocation, $idTypeFilter, $idGrave, $idHistoryHistory, $idMisc, $type) {
        $this -> idGrave = $idGrave;
        $this -> firstName = $firstName;
        $this -> middleName = $middleName;
        $this -> lastName = $lastName;
        $this -> birth = $birth;
        $this -> death = $death;
        $this -> description = $description;
        $this -> idHistoricFilter = $idHistoricFilter;
        $this -> historicFilterName = $historicFilterName;
        TrackableObject::__construct($idTrackableObject, $longitude, $latitude, $qrCode, $hint, $imageDescription, $imageLocation, $idTypeFilter, $idGrave, $idHistoryHistory, $idMisc, $type);
    }


    /**
     * @return mixed
     */
    public function getIdGrave() {
        return $this -> idGrave;
    }

    /**
     * @param mixed $idGrave
     */
    public function setIdGrave($idGrave) {
        $this -> idGrave = $idGrave;
    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this -> firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName) {
        $this -> firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName() {
        return $this -> middleName;
    }

    /**
     * @param mixed $middleName
     */
    public function setMiddleName($middleName) {
        $this -> middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this -> lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName) {
        $this -> lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBirth() {
        return $this -> birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth) {
        $this -> birth = $birth;
    }

    /**
     * @return mixed
     */
    public function getDeath() {
        return $this -> death;
    }

    /**
     * @param mixed $death
     */
    public function setDeath($death) {
        $this -> death = $death;
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
    public function getIdHistoricFilter() {
        return $this -> idHistoricFilter;
    }

    /**
     * @param mixed $idHistoricFilter
     */
    public function setIdHistoricFilter($idHistoricFilter) {
        $this -> idHistoricFilter = $idHistoricFilter;
    }

    /**
     * @return mixed
     */
    public function getHistoricFilterName() {
        return $this -> historicFilterName;
    }

    /**
     * @param mixed $historicFilterName
     */
    public function setHistoricFilterName($historicFilterName) {
        $this -> historicFilterName = $historicFilterName;
    }
}