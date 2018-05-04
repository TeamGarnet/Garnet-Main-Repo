<?php
include_once 'DatabaseConnection.class.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getAllContactEntries()
 *  formatContactInfo($pinObjectsArray)
 *  createContactEntry($pin, $markerName)
 *  updateContactEntry()
 *  deleteContactEntry($idContact)
 *  getAllEntriesAsRows()
 */

class FAQData {
    /**
     * Takes sanitized information and create a new object.
     * @param $question
     * @param $answer
     */
    public function createFAQ($question, $answer) {
        try {
            //global $createFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO FAQ (question,answer) VALUES (:question,:answer)");


            $stmt -> bindParam(':question', $question, PDO::PARAM_STR);
            $stmt -> bindParam(':answer', $answer, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Retrieves the Database information needed.
     * @param $returnConn : An int that designates whether to return the DB instance
     * or the connection. 0 = instance, 1 = connection
     * @return DatabaseConnection|null|PDO : Can return the DB instance, connection,
     * or null if neither are found.
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
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
        return null;
    }

    /**
     * Retrieves all the database entries.
     * @return array
     */
    public function readFAQ() {
        try {
            //global $getAllFAQEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idFAQ, question, answer FROM FAQ");
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Takes sanitized information and updates a object in the database.
     * @param $idFAQ
     * @param $question
     * @param $answer
     */
    public function updateFAQ($idFAQ, $question, $answer) {
        try {
            //global $updateFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE FAQ SET idFAQ = :idFAQ , question = :question , answer = :answer WHERE idFAQ = :idFAQ");

            $stmt -> bindParam(':question', $question, PDO::PARAM_STR);
            $stmt -> bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt -> bindParam(':idFAQ', $idFAQ, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Deletes an object from the database
     * @param $idFAQ
     */
    public function deleteFAQ($idFAQ) {
        try {
            //global $deleteFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM FAQ WHERE idFAQ = :idFAQ");
            $stmt -> bindParam(':idFAQ', $idFAQ, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }
}