<?php

/*
*
DatabaseConnection.class.php: Connection and closure settings to garnet database
Follows singleton pattern of returning an instance to parent method.
To make a connection to the database and make a query simple use the lines:

    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $sql_query = "SELECT foo FROM .....";
    $result = $mysqli->query($sql_query);
*/

class DatabaseConnection {

    private $_connection;

    private static $_instance; //The single instance


    /**
     * Retrieves and instance of the Database. If an instance is already
     * made it returns the same instance. If there is no previous instance
     * then a new instance is created.
     * @return DatabaseConnection
     */
    public static function getInstance() {
        if (!self ::$_instance) { // If no instance then make one
            self ::$_instance = new self();
        }
        return self ::$_instance;
    }


    /**
     * DatabaseConnection constructor.
     */
    private function __construct() {
        try {
            /***** UPDATE NEEDED:  dsn, username, and password  *****/
            $dsn = 'mysql:host=localhost;port=3306;dbname=RapidsCemetery';
            $username = 'root';
            $password = '';
            //$password = '$peedingT1ckets4the$l0w!';
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $this -> _connection = new PDO($dsn, $username, $password, $options);

        } catch (PDOException $e) {
            #Open log file and add error message
            echo $e -> getMessage() . "\n";
            $logFile = 'RapidsCemeteryPHPErrors.txt';
            $currentLogFile = file_get_contents($logFile);
            $currentLogFile .= "\n" . date('l jS \of F Y h:i:s A') . $e -> getMessage();
            file_put_contents($logFile, $currentLogFile);
            exit();
        }
    }


    /**
     * Retrieves an instance of the Database connection, not the instance.
     * @return PDO
     */
    function getConnection() {
        $dbh = null;
        return $this -> _connection;
    }


    // Magic method clone is empty to prevent duplication of connection
    private function __clone() {
    }


    /**
     * @param $objName - Name of Object / Database Table
     * @param string $sqlString - Complete sql select statement
     * @return array - An associative array of objects pulled from the database
     */
    function returnObject($objName, $sqlString = "") {
        try {
            $results = array();
            if ($sqlString == "") {
                $sqlString = "SELECT * FROM " . $objName;
            }
            $stmnt = $this -> getConnection() -> prepare($sqlString);
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
