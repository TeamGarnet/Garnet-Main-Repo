<?php
/**
 */

class FilterBar {
    private $filterBar;
    private $filterButtonArray;

    public function __construct($filterButtonArray) {
        $this -> setFilterButtonArray($filterButtonArray);

        $filterBarCode = "<nav class='navbar navbar-default navbar-fixed-bottom'><div class='container' id='filterContainer2'><div class='navbar-header'><a class='navbar-brand' href='#'>Select Filters:</a>
        <!-- Mobile Menu -->
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#mobile-dropdown'>
          <!-- Hamburger Menu -->
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
        </button>
      </div>
		<div class='collapse navbar-collapse' id='mobile-dropdown'>
        <ul class='nav navbar-nav navbar-left'>";

        foreach ($filterButtonArray as $filterButton) {
			$filterButtonCode = "<li><button type='button' class='btn btn-default' style='background-color: " . $filterButton -> getButtonColor() . ";'" .
				"onclick=" . "\"refreshFilters('" . $filterButton -> getTable() . "'," . $filterButton -> getFilterID() . ")" . "\">" .
				$filterButton -> getFilterName() . "</button></li>";
            /**$filterButtonCode = "<li><a href='#' class='btn filterButton' style='background-color: " . $filterButton -> getButtonColor() . ";'" .
                "onclick=" . "\"refreshFilters('" . $filterButton -> getTable() . "'," . $filterButton -> getFilterID() . ")" . "\">" .
                $filterButton -> getFilterName() .
                "</a></li>";
			*/

            $filterBarCode = $filterBarCode . $filterButtonCode;
        }
		$filterBarCode = $filterBarCode . "<ul class='nav navbar-nav navbar-right'><li><a href='#' onclick=" . "\"resetFilters()\">Reset Filters</a></li></ul></div></div></nav>";
        /*$filterBarCode  = $filterBarCode . "<a href='#' class='btn filterButton' style='background-color: #2c3e50;' onclick=" . "\"resetFilters()\">Reset Filters</a> ";
		*/
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