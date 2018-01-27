<?php
#connectionHandling.php: Connection and closure settings to garnet database
#Follows singleton pattern of returning an instance to parent method.
//To make a connection to the database and make a query simple use the lines:
//
//    $db = Database::getInstance();
//    $mysqli = $db->getConnection();
//    $sql_query = "SELECT foo FROM .....";
//    $result = $mysqli->query($sql_query);

class Database {
    private $_connection;
    private static $_instance; //The single instance

    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        try {
            $dsn = 'mysql:host=129.21.183.74;dbname=garnet';
            $username = 'root';
            $password = '$peedingT1ckets4the$l0w!';
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $this->_connection = new PDO($dsn, $username, $password, $options);
            echo "I connected";

        } catch (PDOException $e) {
            #Open log file and add error message
            $logFile = 'phpErrors.txt';
            $currentLogFile = file_get_contents($logFile);
            $currentLogFile .= "\n" . date('l jS \of F Y h:i:s A') . $e->getMessage();
            file_put_contents($logFile, $currentLogFile);
            exit();
        }
    }

    function getConnection() {
        $dbh = null;
        return $this->_connection;
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
}
