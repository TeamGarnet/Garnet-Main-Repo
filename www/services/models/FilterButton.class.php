<?php

class FilterButton {
    private $filterID;
    private $filterName;
    private $buttonColor;
    private $table;

    public function __construct($filterID,  $filterName, $buttonColor, $table) {
        $this -> setFilterID($filterID);
        $this -> setFilterName($filterName);
        $this -> setButtonColor($buttonColor);
        $this -> setTable($table);
    }

    /**
     * @return mixed
     */
    public function getFilterID() {
        return $this -> filterID;
    }

    /**
     * @param mixed $filterID
     */
    public function setFilterID($filterID) {
        $this -> filterID = $filterID;
    }

    /**
     * @return mixed
     */
    public function getFilterName() {
        return $this -> filterName;
    }

    /**
     * @param mixed $filterName
     */
    public function setFilterName($filterName) {
        $this -> filterName = $filterName;
    }

    /**
     * @return mixed
     */
    public function getButtonColor() {
        return $this -> buttonColor;
    }

    /**
     * @param mixed $buttonColor
     */
    public function setButtonColor($buttonColor) {
        $this -> buttonColor = $buttonColor;
    }

    /**
     * @return mixed
     */
    public function getTable() {
        return $this -> table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table) {
        $this -> table = $table;
    }


}