<?php
include_once "data/LoginData.class.php";

/*
 * LoginService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  validatePassword($email, $password)
 */
class LoginService {

    public function getSalt() {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
        $randStringLen = 64;

        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString = $randString . $charset[rand(0, strlen($charset) - 1)];
        }

        return $randString;
    }

    public function loginAccount($userName, $pwd) {
        $LoginData = new LoginData();

        $userName = filter_var($userName, FILTER_SANITIZE_EMAIL);
        $salt = $LoginData -> getAccountSalt($userName);

        if (gettype($salt) == "string"){
            $saltedPWD = $pwd . $salt;
            $hashedPWD = hash('sha256', $saltedPWD);
            $status = $LoginData -> loginAccount($userName, $hashedPWD);
        } else {
            $status = false;
        }
        return $status;
    }

    public function createAccount($userName, $pwd, $masterEmail, $masterPWD) {
        $LoginData = new LoginData();
        $userName = filter_var($userName, FILTER_SANITIZE_EMAIL);
        $masterEmail = filter_var($masterEmail, FILTER_SANITIZE_EMAIL);

        $masterStatus = $this -> loginAccount($masterEmail, $masterPWD);
        if ($masterStatus){
            $salt = $this -> getSalt();
            $hashedPWD = hash('sha256', $pwd . $salt);

            $status = $LoginData -> createAccount($userName, $hashedPWD, $salt);
            return $status;
        }
        return false;
    }
}

?>