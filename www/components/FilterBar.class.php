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
            $filterButtonCode = "<li><a href='#' class='btn' style='border-radius:25px;padding: 10px;background-color: " . $filterButton -> getButtonColor() .
                ";' data-filterID='" . $filterButton -> getFilterID() .
                "' data-table='".
                $filterButton -> getTable() .
                "'>" .
                $filterButton -> getFilterName() .
                "</a></li>";

            $filterBarCode = $filterBarCode . $filterButtonCode;
        }
        echo "<br><br><br><br>";
        echo "Filter Button Code from FilterBAr class";
        echo $filterBarCode;
        
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