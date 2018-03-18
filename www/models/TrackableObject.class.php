<?php
/**
 */

class TrackableObject {
    private $idTrackableObject;
    private $longitude;
    private $latitude;
    private $qrCode;
    private $hint;
    private $imageDescription;
    private $imageLocation;
    private $idTypeFilter;
    private $idGrave;
    private $idHistoryHistory;
    private $idMisc;
    private $type;

    /**
     * TrackableObject constructor.
     * @param $idTrackableObject
     * @param $longitude
     * @param $latitude
     * @param $qrCode
     * @param $hint
     * @param $imageDescription
     * @param $imageLocation
     * @param $idTypeFilter
     * @param $idGrave
     * @param $idHistoryHistory
     * @param $idMisc
     * @param $type
     */
    public function __construct($idTrackableObject, $longitude, $latitude, $qrCode, $hint, $imageDescription, $imageLocation, $idTypeFilter, $idGrave, $idHistoryHistory, $idMisc, $type) {
        $this -> idTrackableObject = $idTrackableObject;
        $this -> longitude = $longitude;
        $this -> latitude = $latitude;
        $this -> qrCode = $qrCode;
        $this -> hint = $hint;
        $this -> imageDescription = $imageDescription;
        $this -> imageLocation = $imageLocation;
        $this -> idTypeFilter = $idTypeFilter;
        $this -> idGrave = $idGrave;
        $this -> idHistoryHistory = $idHistoryHistory;
        $this -> idMisc = $idMisc;
        $this -> type = $type;
    }

    /**
     * @return mixed
     */
    public function getIdTrackableObject() {
        return $this -> idTrackableObject;
    }

    /**
     * @param mixed $idTrackableObject
     */
    public function setIdTrackableObject($idTrackableObject) {
        $this -> idTrackableObject = $idTrackableObject;
    }

    /**
     * @return mixed
     */
    public function getLongitude() {
        return $this -> longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude) {
        $this -> longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude() {
        return $this -> latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude) {
        $this -> latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getQrCode() {
        return $this -> qrCode;
    }

    /**
     * @param mixed $qrCode
     */
    public function setQrCode($qrCode) {
        $this -> qrCode = $qrCode;
    }

    /**
     * @return mixed
     */
    public function getHint() {
        return $this -> hint;
    }

    /**
     * @param mixed $hint
     */
    public function setHint($hint) {
        $this -> hint = $hint;
    }

    /**
     * @return mixed
     */
    public function getImageDescription() {
        return $this -> imageDescription;
    }

    /**
     * @param mixed $imageDescription
     */
    public function setImageDescription($imageDescription) {
        $this -> imageDescription = $imageDescription;
    }

    /**
     * @return mixed
     */
    public function getImageLocation() {
        return $this -> imageLocation;
    }

    /**
     * @param mixed $imageLocation
     */
    public function setImageLocation($imageLocation) {
        $this -> imageLocation = $imageLocation;
    }

    /**
     * @return mixed
     */
    public function getIdTypeFilter() {
        return $this -> idTypeFilter;
    }

    /**
     * @param mixed $idTypeFilter
     */
    public function setIdTypeFilter($idTypeFilter) {
        $this -> idTypeFilter = $idTypeFilter;
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
    public function getIdHistoryHistory() {
        return $this -> idHistoryHistory;
    }

    /**
     * @param mixed $idHistoryHistory
     */
    public function setIdHistoryHistory($idHistoryHistory) {
        $this -> idHistoryHistory = $idHistoryHistory;
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
    public function getType() {
        return $this -> type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this -> type = $type;
    }


}