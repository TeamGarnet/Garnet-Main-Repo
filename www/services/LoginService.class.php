<?php
include_once "data/LoginData.class.php";
include_once 'data/ErrorCatching.class.php';

/*
 * LoginService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  validatePassword($email, $password)
 */

class LoginService {

    /**
     * Creates an Admin Account after validating that the user has admin access to create accounts.
     * @param $userName
     * @param $pwd
     * @param $masterEmail
     * @param $masterPWD
     * @return bool|null
     */
    public function createAccount($userName, $pwd, $masterEmail, $masterPWD) {
        $LoginData = new LoginData();
        $userName = filter_var($userName, FILTER_SANITIZE_EMAIL);
        $masterEmail = filter_var($masterEmail, FILTER_SANITIZE_EMAIL);

        $masterStatus = $this -> loginAccount($masterEmail, $masterPWD);
        if ($masterStatus) {
            $salt = $this -> getSalt();
            $hashedPWD = hash('sha256', $pwd . $salt);

            $status = $LoginData -> createAccount($userName, $hashedPWD, $salt);
            return $status;
        }
        return false;
    }

    /**
     * Logs in an admin user. Finds the salt for the user and then compares the passwords for validation.
     * @param $userName
     * @param $pwd
     * @return bool|null
     */
    public function loginAccount($userName, $pwd) {
        $LoginData = new LoginData();

        $userName = filter_var($userName, FILTER_SANITIZE_EMAIL);
        $salt = $LoginData -> getAccountSalt($userName);

        if (gettype($salt) == "string") {
            $saltedPWD = $pwd . $salt;
            $hashedPWD = hash('sha256', $saltedPWD);
            $status = $LoginData -> loginAccount($userName, $hashedPWD);
        } else {
            $status = false;
        }
        return $status;
    }

    /**
     * Generates a Salt for a newly created account.
     * @return string
     */
    public function getSalt() {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
        $randStringLen = 64;

        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString = $randString . $charset[rand(0, strlen($charset) - 1)];
        }

        return $randString;
    }
}

?>