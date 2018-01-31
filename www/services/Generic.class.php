<?php
include '../services/DatabaseConnection.class.php';

/*
 * Hold generic functions that are not hooked to
 * specific feature or component.
 */
class Generic {
    private function getDBConn() {
        try{
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            var_dump($conn);
            return $conn;
        }
        catch(Exception $e){
            echo $e->getMessage();
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
    public function returnObject($objName, $sqlString=""){
        try{
            $results = array();
            if($sqlString == "") {
                $sqlString = "SELECT * FROM " .$objName;
            }
            $stmnt = $this->getDBConn()->prepare($sqlString);
            $stmnt->execute();
            $stmnt->setFetchMode(PDO::FETCH_CLASS,$objName);
            while($result = $stmnt->fetch()){ // or just fetchALl();
                $results[] = $result;
            }
            return $results;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

}