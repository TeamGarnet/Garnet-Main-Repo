<?php
include '../services/DatabaseConnection.class.php';

class WiderAreaMap {
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
}