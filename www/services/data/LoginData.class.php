<?php
ob_start();
include_once 'DatabaseConnection.class.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  validatePassword($email, $password)
 */

class LoginData {

    /**
     * Creates a new User into the database for admin login
     * @param $userName
     * @param $pwd
     * @param $salt
     * @return bool|null
     */
    public function createAccount($userName, $pwd, $salt) {
        try {
            $dbconn = $this -> getDBInfo(1);
            $statement = $dbconn -> prepare("INSERT INTO `User` (email, password, salt) VALUES (:email, :pwd, :salt)");

            $statement -> bindValue(':email', $userName);
            $statement -> bindValue(':pwd', $pwd);
            $statement -> bindValue(':salt', $salt);

            $result = $statement -> execute();
            return $result;
        } catch (Exception $e) {
            echo $e;
            return null;
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
     * Finds the user id for the specifed email and hashed pwd combination
     * @param $userName
     * @param $pwd
     * @return bool|null
     */
    public function loginAccount($userName, $pwd) {
        try {
            $dbconn = $this -> getDBInfo(1);
            $statement = $dbconn -> prepare("SELECT idUser FROM `User` WHERE email=:email AND password=:pwd");

            $statement -> bindValue(':email', $userName);
            $statement -> bindValue(':pwd', $pwd);
            $statement -> execute();
            $result = $statement -> fetchAll();

            $numRows = count($result);
            if ($numRows == 1) {
                return $result[0]['idUser'];
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo $e;
            return null;
        }
    }

    /**
     * Returns the salt for the specified email
     * @param $email
     * @return bool|null
     */
    public function getAccountSalt($email) {
        try {
            $dbconn = $this -> getDBInfo(1);
            $statement = $dbconn -> prepare("SELECT salt FROM `User` WHERE email=:email");

            $statement -> bindValue(':email', $email);

            $statement -> execute();
            $result = $statement -> fetchAll();

            $numRows = count($result);
            if ($numRows == 1) {
                return $result['0']['salt'];
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo $e;
            return null;
        }
    }
}

?>