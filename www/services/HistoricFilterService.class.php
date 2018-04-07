<?php
include_once 'data/HistoricFilterData.class.php';
include_once 'data/GraveObjectData.class.php';
include_once 'models/HistoricFilter.class.php';

/*
 * HistoricFilterService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  getAllHistoricFilterEntries()
 *  createHistoricFilterEntry($historicFilterName, $dateStart, $description, $dateEnd, $buttonColor)
 *  updateHistoricFilterEntry($idHistoricFilter, $historicFilterName, $dateStart, $description, $dateEnd, $buttonColor)
 *  deleteHistoricFilterEntry($idHistoricFilter)
 *  getAllEntriesAsRows()
 *  formatHistoric filterInfo()
 */
class HistoricFilterService {
    public function __construct() {
    }

    /**
     * Retrieves all Historic filter data from the database and forms Historic filter Objects
     * @return array : An array of Historic filter objects
     */
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

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $historicFilterName: Historic filter's  name
     * @param $dateStart: Historic filter's starting time period
     * @param $dateEnd: Historic filter's ending time period
     * @param $description: Historic filter's description
     * @param $buttonColor: Historic filter's filter button color
     */
    public function createHistoricFilterEntry($historicFilterName, $dateStart, $description, $dateEnd, $buttonColor) {
        $dateStart = filter_var($dateStart, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $dateEnd = filter_var($dateEnd, FILTER_SANITIZE_STRING);

        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $historicFilterName = filter_var($historicFilterName, FILTER_SANITIZE_STRING);

        //create HistoricFilter Object
        $historicFilterDataClass = new HistoricFilterData();
        $historicFilterDataClass -> createHistoricFilter($historicFilterName, $dateStart, $description, $dateEnd, $buttonColor);
    }

    /*
     * Updates historic filter currently in the database.
     * @param $historicFilterName: Historic filter's  name
     * @param $dateStart: Historic filter's starting time period
     * @param $dateEnd: Historic filter's ending time period
     * @param $description: Historic filter's description
     * @param $buttonColor: Historic filter's filter button color
     */
    public function updateHistoricFilterEntry($idHistoricFilter, $historicFilterName, $dateStart, $description, $dateEnd, $buttonColor) {
        $dateStart = filter_var($dateStart, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $dateEnd = filter_var($dateEnd, FILTER_SANITIZE_STRING);

        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $historicFilterName = filter_var($historicFilterName, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);

        $historicFilterDataClass = new HistoricFilterData();
        $historicFilterDataClass -> updateHistoricFilter($idHistoricFilter, $historicFilterName, $dateStart, $description, $dateEnd, $buttonColor);
    }

    /*
     * Deletes Historic filter for Entry
     * @param $idHistoric filter: id of historic filter to be deleted
     */
    public function deleteHistoricFilterEntry($idHistoricFilter) {
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);

        if (empty($idHistoricFilter) || $idHistoricFilter == "") {
            return null;
        } else {
            if ($idHistoricFilter == 0){
                return "This is a default filter that cannot be deleted.";
            }

            $historicFilterDataClass = new HistoricFilterData();
            $filterUseAmount = $historicFilterDataClass -> checkForInUseHistoricFilters($idHistoricFilter);

            if ($filterUseAmount == 0) {
                $historicFilterDataClass -> deleteHistoricFilter($idHistoricFilter);
                return null;
            } else {
                return "The Historic filter is currently in use by a Grave. <br> Unattach this filter before the filter can be deleted.";
            }
        }
    }

    /*
     * Retrieves all the historic filter entries and formats to display in a table.
     * @return string: A string of a table in html
     */
    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllHistoricFilterEntries();
        $html = "";
        //TODO may need to make a function that makes a JS array to hold the info
        foreach ($allModels as $model) {
            $idHistoricFilter = strval($model -> getIdHistoricFilter());
            $objectRowID = "14" . $idHistoricFilter;
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateHistoricFilter("
                . $objectRowID . ","
                . $model -> getIdHistoricFilter()
                . ")'>Update</button>"
                . "</td><td>";

            if($idHistoricFilter != "0") {
                $editAndDelete = $editAndDelete . "<button class='btn basicBtn' onclick="
                    . '"deleteHistoricFilter('
                    . $model -> getIdHistoricFilter()
                    . ')"> Delete</button>';
            }

            $html = $html
                . "<tr id='" . $objectRowID . "'><td>" . $model -> getHistoricFilterName()
                . "</td><td>" . $model -> getDateStart()
                . "</td><td>" . $model -> getDateEnd()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getButtonColor()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }

    /*
     * Retrieves all the historic filters and creates options for a select population.
     * @return string: A string of a options in html
     */
    public function getAllFiltersForSelect() {
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