<?php
/**
 */

class HistoricFilter {
    private $idHistoricFilter;
    private $historicFilterName;
    private $dateStart;
    private $dateEnd;
    private $description;
    private $buttonColor;

    /**
     * HistoricFilter constructor.
     * @param $idHistoricFilter
     * @param $historicFilterName
     * @param $dateStart
     * @param $dateEnd
     * @param $description
     * @param $buttonColor
     */
    public function __construct($idHistoricFilter, $historicFilterName, $dateStart, $dateEnd, $description, $buttonColor) {
        $this -> idHistoricFilter = $idHistoricFilter;
        $this -> historicFilterName = $historicFilterName;
        $this -> dateStart = $dateStart;
        $this -> dateEnd = $dateEnd;
        $this -> description = $description;
        $this -> buttonColor = $buttonColor;
    }

    /**
     * @return mixed
     */
    public function getIdHistoricFilter() {
        return $this -> idHistoricFilter;
    }

    /**
     * @param mixed $idHistoricFilter
     */
    public function setIdHistoricFilter($idHistoricFilter) {
        $this -> idHistoricFilter = $idHistoricFilter;
    }

    /**
     * @return mixed
     */
    public function getHistoricFilterName() {
        return $this -> historicFilterName;
    }

    /**
     * @param mixed $historicFilterName
     */
    public function setHistoricFilterName($historicFilterName) {
        $this -> historicFilterName = $historicFilterName;
    }

    /**
     * @return mixed
     */
    public function getDateStart() {
        return $this -> dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart) {
        $this -> dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd() {
        return $this -> dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd) {
        $this -> dateEnd = $dateEnd;
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