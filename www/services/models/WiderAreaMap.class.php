<?php
/**
 */

class WiderAreaMap {
    private $idWiderAreaMap;
    private $name;
    private $description;
    private $longitude;
    private $latitude;
    private $address;
    private $city;
    private $state;
    private $zipcode;

    /**
     * WiderAreaMap constructor.
     * @param $idWiderAreaMap
     * @param $name
     * @param $description
     * @param $longitude
     * @param $latitude
     * @param $address
     * @param $city
     * @param $state
     * @param $zipcode
     */
    public function __construct($idWiderAreaMap, $name, $description, $longitude, $latitude, $address, $city, $state, $zipcode) {
        $this -> idWiderAreaMap = $idWiderAreaMap;
        $this -> name = $name;
        $this -> description = $description;
        $this -> longitude = $longitude;
        $this -> latitude = $latitude;
        $this -> address = $address;
        $this -> city = $city;
        $this -> state = $state;
        $this -> zipcode = $zipcode;
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
    public function getAddress() {
        return $this -> address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address) {
        $this -> address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity() {
        return $this -> city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city) {
        $this -> city = $city;
    }

    /**
     * @return mixed
     */
    public function getState() {
        return $this -> state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state) {
        $this -> state = $state;
    }

    /**
     * @return mixed
     */
    public function getZipcode() {
        return $this -> zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode) {
        $this -> zipcode = $zipcode;
    }



}