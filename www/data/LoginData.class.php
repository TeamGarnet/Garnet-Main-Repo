<?php

/*
 *
 */
include '../../services/DatabaseConnection.class.php';

class LoginData {

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

    public function validatePassword($email, $password) {
        global $loginUserQuery;

        //TODO: hash them password gurl
        try {
            echo "Validating Password Against DB";
            $idUser = null;
            //$stmt = $this -> getDBInfo(1) -> prepare($loginUserQuery);
            $stmt = $this -> getDBInfo(1) -> prepare("SELECT idUser FROM `User` WHERE email=:email AND password=:pwd"
            );
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':pwd', $password);
            //print_r($stmt);
            $stmt -> execute();
            $count = $stmt -> rowCount();
            if ($count == 1) {
                $idUser = $stmt -> fetch();
                print_r($stmt -> fetch());
            }
            echo $idUser[0] . "<br/>";
            return $idUser;
        } catch (PDOException $e) {
            echo $e -> getMessage();
            die();
        }
    }
}

?>