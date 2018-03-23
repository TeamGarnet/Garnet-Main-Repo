<?php
require_once '../../data/TypeFilterData.class.php';
require_once '../../models/TypeFilter.class.php';
require_once '../../data/TrackableObjectData.class.php';
/**
 */

class TypeFilterService {
    public function __construct(){
    }

    public function getAllTypeFilterEntries() {
        $typeFilterDataClass = new TypeFilterData();
        $allTypeFilterDataObjects =  $typeFilterDataClass -> readTypeFilter();
        $allTypeFilterData = array();

        foreach ($allTypeFilterDataObjects as $typeFilterArray) {
            $typeFilterObject = new TypeFilter($typeFilterArray['idTypeFilter'], $typeFilterArray['type'],$typeFilterArray['pinDesign'], $typeFilterArray['buttonColor']);

            array_push($allTypeFilterData, $typeFilterObject);
        }
        return $allTypeFilterDataObjects;
    }

    public function createTypeFilterEntry($type, $pinDesign, $buttonColor) {
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);
        $type = filter_var($type, FILTER_SANITIZE_STRING);

        //create TypeFilter Object
        $typeFilterDataClass = new TypeFilterData();
        $typeFilterDataClass -> createTypeFilter($pinDesign, $type, $buttonColor);
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
            echo "type null";
        } else {
            $trackableObjectDataClass = new TrackableObjectData();
            $typeFilterUseAmount = $trackableObjectDataClass -> checkForInUseTypeFilters($idTypeFilter);

            if ($typeFilterUseAmount = 0) {
                $typeFilterDataClass = new TypeFilterData();
                $typeFilterDataClass -> deleteTypeFilter($idTypeFilter);
                echo "typefilter not used";
            } else {
                echo "The Type filter is currently in use by a Grave, Natural History, or Misc Object. Unattach this filter before the filter can be deleted.";
                return "The Type filter is currently in use by a Grave, Natural History, or Misc Object. Unattach this filter before the filter can be deleted.";
            }

        }
    }
}