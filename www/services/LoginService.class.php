<?php
include '../../data/LoginData.class.php';

/*
 *
 */

class LoginService {


    public function validatePassword($email, $password) {
        $LoginData = new LoginData();
        // Sanitize
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        $validatedResult = $LoginData -> validatePassword($email, $password);
        return $validatedResult;
    }
}

?>