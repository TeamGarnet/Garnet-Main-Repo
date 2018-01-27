<?php
#Connect.php: Connection settings to garnet database
try {
    $dsn = 'mysql:host=129.21.183.74;dbname=garnet';
    $username = 'root';
    $password = '$peedingT1ckets4the$l0w!';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    $dbh = new PDO($dsn, $username, $password, $options);
    echo "I connected";

} catch (PDOException $e) {
    #Open log file and add error message
    $logFile = 'phpErrors.txt';
    $currentLogFile = file_get_contents($logFile);
    $currentLogFile .= "\n" . date('l jS \of F Y h:i:s A') . $e;
    file_put_contents($logFile, $currentLogFile);
    exit();
}
