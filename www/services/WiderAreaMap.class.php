<?php
include_once 'DatabaseConnection.class.php';

class WiderAreaMap {

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
}