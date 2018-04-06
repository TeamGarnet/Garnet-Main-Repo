<?php
include_once 'data/TypeFilterData.class.php';
include_once 'models/TypeFilter.class.php';
include_once 'data/TrackableObjectData.class.php';

/**
 */
class TypeFilterService {
    public function __construct() {
    }

    public function getAllTypeFilterEntries() {
        $typeFilterDataClass = new TypeFilterData();
        $allTypeFilterDataObjects = $typeFilterDataClass -> readTypeFilter();
        $allTypeFilterData = array();

        foreach ($allTypeFilterDataObjects as $typeFilterArray) {
            $typeFilterObject = new TypeFilter($typeFilterArray['idTypeFilter'], stripcslashes($typeFilterArray['type']), $typeFilterArray['pinDesign'], $typeFilterArray['buttonColor']);

            array_push($allTypeFilterData, $typeFilterObject);
        }
        return $allTypeFilterData;
    }

    public function createTypeFilterEntry($type, $pinDesign, $buttonColor) {
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_STRING);
        if ($buttonColor == null) {
            $buttonColor = "#bdc3c7";
        }
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $type = filter_var($type, FILTER_SANITIZE_STRING);

        //create TypeFilter Object
        $typeFilterDataClass = new TypeFilterData();
        $typeFilterDataClass -> createTypeFilter($type, $pinDesign, $buttonColor);
    }

    public function updateTypeFilterEntry($idTypeFilter, $type, $pinDesign, $buttonColor) {
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_STRING);
        if ($buttonColor == null) {
            $buttonColor = "#bdc3c7";
        }
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $type = filter_var($type, FILTER_SANITIZE_STRING);

        $typeFilterDataClass = new TypeFilterData();
        $typeFilterDataClass -> updateTypeFilter($idTypeFilter, $pinDesign, $type, $buttonColor);
    }

    public function deleteTypeFilterEntry($idTypeFilter) {
        $idTypeFilter = filter_var($idTypeFilter, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idTypeFilter) || $idTypeFilter == "") {
            return null;
        } else {
            if ($idTypeFilter == 1 || $idTypeFilter == 2 || $idTypeFilter == 3 || $idTypeFilter == 4) {
                return "Grave, Natural History, Miscellaneous, and Hazard are default types that cannot be deleted.";
            }

            $trackableObjectDataClass = new TrackableObjectData();
            $typeFilterUseAmount = $trackableObjectDataClass -> checkForInUseTypeFilters($idTypeFilter);

            if ($typeFilterUseAmount == 0) {
                $typeFilterDataClass = new TypeFilterData();
                $typeFilterDataClass -> deleteTypeFilter($idTypeFilter);
                return null;
            } else {
                return "The Type filter is currently in use by a Miscellaneous Object. <br> Unattach this filter before the filter can be deleted.";
            }
        }
    }

    public function getAllEntriesAsRows() {
        $allModels = $this -> getAllTypeFilterEntries();
        $html = "";
        $idsNotDeletable = array("1", "2", "3", "4");
        foreach ($allModels as $model) {
            $idTypeFilter = strval($model -> getIdTypeFilter());
            $objectRowID = "13" . $idTypeFilter;
            $editAndDelete = "</td><td><button onclick='updateType("
                . $objectRowID . ","
                . $model -> getIdTypeFilter()
                . ")'>Update</button>"
                . "</td>";

            if(!in_array($idTypeFilter, $idsNotDeletable)) {
                $editAndDelete = $editAndDelete . "<td><button onclick="
                    . '"deleteType('
                    . $model -> getIdTypeFilter()
                    . ')"> Delete</button></td>';
            }
            else {
                $editAndDelete = $editAndDelete . "<td></td>";
            }

            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getType()
                . "</td><td>" . $model -> getPinDesign()
                . "</td><td>" . $model -> getButtonColor()
                . $editAndDelete
                . "</tr>";
        }
        return $html;
    }

    public function getAllFiltersForSelect() {
        $filters = $this -> getAllTypeFilterEntries();
        $customFilters = array_filter($filters, function ($filter) {
            if ($filter -> getType() != "Grave" && $filter -> getType() != "Natural History") {
                return true;
            } else {
                return false;
            }
        });
        $filterHTML = "";
        foreach ($customFilters as $customFilter) {
            $filterHTML = $filterHTML . "<option value='"
                . $customFilter -> getIdTypeFilter() . "'>"
                . $customFilter -> getType() . "</option>";
        }
        return $filterHTML;
    }
}