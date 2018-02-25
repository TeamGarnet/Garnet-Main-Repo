<?php
/**
 */

class FilterBar {
    private $filterBar;
    private $filterButtonArray;

    public function __construct($filterButtonArray) {
        $this -> setFilterButtonArray($filterButtonArray);

        $filterBarCode = "";

        foreach ($filterButtonArray as $filterButton) {
            $filterButtonCode = "<li><a href='#' class='btn filterButton' style='background-color: " . $filterButton -> getButtonColor() . ";'" .
                "onclick=" . "\"refreshFilters('" . $filterButton -> getTable() . "'," . $filterButton -> getFilterID() . ")" . "\">" .
                $filterButton -> getFilterName() .
                "</a></li>";

            $filterBarCode = $filterBarCode . $filterButtonCode;
        }
        $filterBarCode  = $filterBarCode . "<a href='#' class='btn filterButton' style='background-color: #2c3e50;' onclick=" . "\"resetFilters()\">Reset Filters</a> ";

        $this -> setFilterBar($filterBarCode);
    }

    public function getFilterBar() {
        return $this -> filterBar;
    }

    public function setFilterBar($filterBar) {
        $this -> filterBar = $filterBar;
    }

    /**
     * @return mixed
     */
    public function getFilterButtonArray() {
        return $this -> filterButtonArray;
    }

    public function setFilterButtonArray($filterButtonArray) {
        $this -> filterButtonArray = $filterButtonArray;
    }
}