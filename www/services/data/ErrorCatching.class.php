<?php
/**
 * Class: ErrorService
 * Date: 5/3/2018
 * Description:
 */

class ErrorCatching {
    function logError($error) {
        $logFile = 'RapidsCemeteryPHPErrors.txt';

        $currentLogFile = file_get_contents($logFile);
        $currentLogFile .= "\n" . date('l jS \of F Y h:i:s A') . $error -> getMessage();
        file_put_contents($logFile, $currentLogFile);
    }
}