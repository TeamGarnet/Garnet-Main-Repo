<?php
include_once 'data/HistoricFilterData.class.php';
include_once 'data/GraveObjectData.class.php';
include_once 'models/HistoricFilter.class.php';

/**
 */
class HistoricFilterService {
    public function __construct() {
    }

    public function getAllHistoricFilterEntries() {
        $historicFilterDataClass = new HistoricFilterData();
        $allHistoricFilterDataObjects = $historicFilterDataClass -> readHistoricFilter();
        $allHistoricFilterData = array();

        foreach ($allHistoricFilterDataObjects as $historicFilterArray) {
            $historicFilterObject = new HistoricFilter($historicFilterArray['idHistoricFilter'], stripcslashes($historicFilterArray['historicFilterName']), $historicFilterArray['dateStart'], $historicFilterArray['dateEnd'], stripcslashes($historicFilterArray['description']), $historicFilterArray['buttonColor']);

            array_push($allHistoricFilterData, $historicFilterObject);
        }
        return $allHistoricFilterData;
    }

    public function createHistoricFilterEntry($historicFilterName, $dateStart, $description, $dateEnd, $buttonColor) {
        $dateStart = filter_var($dateStart, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $dateEnd = filter_var($dateEnd, FILTER_SANITIZE_STRING);
        if ($buttonColor == null) {
            $buttonColor = "#bdc3c7";
        }
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $historicFilterName = filter_var($historicFilterName, FILTER_SANITIZE_STRING);

        //create HistoricFilter Object
        $historicFilterDataClass = new HistoricFilterData();
        $historicFilterDataClass -> createHistoricFilter($historicFilterName, $dateStart, $description, $dateEnd, $buttonColor);
    }

    public function updateHistoricFilterEntry($idHistoricFilter, $historicFilterName, $dateStart, $description, $dateEnd, $buttonColor) {
        $dateStart = filter_var($dateStart, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $dateEnd = filter_var($dateEnd, FILTER_SANITIZE_STRING);
        if ($buttonColor == null) {
            $buttonColor = "#bdc3c7";
        }
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $historicFilterName = filter_var($historicFilterName, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);

        $historicFilterDataClass = new HistoricFilterData();
        $historicFilterDataClass -> updateHistoricFilter($idHistoricFilter, $historicFilterName, $dateStart, $description, $dateEnd, $buttonColor);
    }

    public function deleteHistoricFilterEntry($idHistoricFilter) {
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);

        if ($idHistoricFilter == 0 || $idHistoricFilter == "0") {
            return "Cannot delete 'No Historic Filter' default filter.";
        }
        $graveDataClass = new GraveObjectData();
        $graveDataClass -> unsetHistoricFilterId($idHistoricFilter);

        $historicFilterDataClass = new HistoricFilterData();
        $historicFilterDataClass -> deleteHistoricFilter($idHistoricFilter);
        return null;
    }


    public
    function getAllEntriesAsRows() {
        $allModels = $this -> getAllHistoricFilterEntries();
        $html = "";
        //TODO may need to make a function that makes a JS array to hold the info
        foreach ($allModels as $model) {
            $idHistoricFilter = strval($model -> getIdHistoricFilter());
            $objectRowID = "14" . $idHistoricFilter;
            $editAndDelete = "</td><td><button onclick='updateHistoricFilter("
                . $objectRowID . ","
                . $model -> getIdHistoricFilter()
                . ")'>Update</button>"
                . "</td>";

            if($idHistoricFilter != "0") {
                $editAndDelete = $editAndDelete . "<td><button onclick="
                    . '"deleteHistoricFilter('
                    . $model -> getIdHistoricFilter()
                    . ')"> Delete</button></td>';
            }

            $html = $html
                . "<tr id='" . $objectRowID . "'><td>" . $model -> getHistoricFilterName()
                . "</td><td>" . $model -> getDateStart()
                . "</td><td>" . $model -> getDateEnd()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getButtonColor()
                . $editAndDelete
                . "</tr>";
        }
        return $html;
    }

    public
    function getAllFiltersForSelect() {
        $filters = $this -> getAllHistoricFilterEntries();
        $filterHTML = "";
        foreach ($filters as $filter) {
            $filterHTML = $filterHTML . "<option value='"
                . $filter -> getIdHistoricFilter() . "'>"
                . $filter -> getHistoricFilterName() . "</option>";
        }
        return $filterHTML;
    }
}