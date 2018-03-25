<?php
include_once '../../services/DatabaseConnection.class.php';
include_once 'query.php';


/**
 */
class UserData {


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


    public function userLogin($email, $password) {
        global $loginUserQuery;
        try {
            $hash_password = $password;
            //$hash_password = hash('sha256', $password);

            $stmt = $this -> getDBInfo(1) -> prepare($loginUserQuery);
            $stmt -> bindParam("email", $email, PDO::PARAM_STR);
            $stmt -> bindParam("password", $hash_password, PDO::PARAM_STR);
            $stmt -> execute();
            $count = $stmt -> rowCount();
            $data = $stmt -> fetch(PDO::FETCH_OBJ);

            if ($count) {
                $_SESSION['idUser'] = $data -> idUser; // Storing user session value
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e -> getMessage() . '}}';
            return null;
        }
    }

    public function userDetails($idUser) {
        global $userInfoQuery;
        try {
            $stmt = $this -> getDBInfo(1) -> prepare($userInfoQuery);
            $stmt -> bindParam("idUser", $idUser, PDO::PARAM_INT);
            $stmt -> execute();
            $data = $stmt -> fetch(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e -> getMessage() . '}}';
        }
    }
}
