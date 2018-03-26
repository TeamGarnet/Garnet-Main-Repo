<?php
/**
 */

class TypeFilter {
    private $idTypeFilter;
    private $type;
    private $pinDesign;
    private $buttonColor;

    /**
     * TypeFilter constructor.
     * @param $idTypeFilter
     * @param $type
     * @param $pinDesign
     * @param $buttonColor
     */
    public function __construct($idTypeFilter, $type, $pinDesign, $buttonColor) {
        $this -> idTypeFilter = $idTypeFilter;
        $this -> type = $type;
        $this -> pinDesign = $pinDesign;
        $this -> buttonColor = $buttonColor;
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
    public function getType() {
        return $this -> type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this -> type = $type;
    }

    /**
     * @return mixed
     */
    public function getPinDesign() {
        return $this -> pinDesign;
    }

    /**
     * @param mixed $pinDesign
     */
    public function setPinDesign($pinDesign) {
        $this -> pinDesign = $pinDesign;
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
}