<?php
include_once '../../services/DatabaseConnection.class.php';

/**
 */

class FAQData {
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
            echo $e -> getMessage();
        }
        return null;
    }

    public function createFAQ($question, $answer) {
        try {
            //global $createFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO FAQ (question,answer) VALUES (:question,:answer)");


            $stmt -> bindParam(':question', $question, PDO::PARAM_STR);
            $stmt -> bindParam(':answer', $answer, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function readFAQ() {
        try {
            //global $getAllFAQEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idFAQ, question, answer FROM FAQ");
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function updateFAQ($idFAQ, $question, $answer) {
        try {
            //global $updateFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE FAQ SET idFAQ = :idFAQ , question = :question , answer = :answer WHERE idFAQ = :idFAQ");

            $stmt -> bindParam(':question', $question, PDO::PARAM_STR);
            $stmt -> bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt -> bindParam(':idFAQ', $idFAQ, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }

    public function deleteFAQ($idFAQ) {
        try {
            //global $deleteFAQQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM FAQ WHERE idFAQ = :idFAQ");
            $stmt -> bindParam(':idFAQ', $idFAQ, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}