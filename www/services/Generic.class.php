<?php
include '../services/DatabaseConnection.class.php';

/*
 * Hold generic functions that are not hooked to
 * specific feature or component.
 */

class Generic {

    /**
     * Returns either the DB PDO or DB connection.
     * @param $returnConn : number {0/1}. Where 0 is return $instance and 1 is return $conn for DB
     * @return DatabaseConnection|null|PDO
     */
    private function getDBInfo($returnConn) {
        try {
            $instance = DatabaseConnection ::getInstance();
            $conn = $instance -> getConnection();
            if ($returnConn == 0) {
                return $instance;
            } else if ($returnConn == 1) {
                return $conn;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo $e -> getMessage();
        }
        return null;
    }

    /*
  * Takes a table name, and optional sql string
  * Prepares and executes the statement
  * @param $objName
  * @param $sqlString
  * @return: $results
  */
    public function returnObject($objName, $sqlString = "") {
        try {
            $results = array();
            if ($sqlString == "") {
                $sqlString = "SELECT * FROM " . $objName;
            }
            $stmnt = $this -> getDBInfo(1) -> prepare($sqlString);
            $stmnt -> execute();
            $stmnt -> setFetchMode(PDO::FETCH_CLASS, $objName);
            while ($result = $stmnt -> fetch()) { // or just fetchALl();
                $results[] = $result;
            }
            return $results;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

}