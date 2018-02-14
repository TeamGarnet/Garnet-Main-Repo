<?php
include '../data/LoginData.class.php';

/*
 *
 */

class LoginService {


    public function validatePassword($email, $password) {
        $LoginData = new LoginData();
        // Sanitize
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        echo "Validate Password Function <br/>";
        echo "User: " . $email . "<br/>";
        echo "Pass: " . $password . "<br/>";
        $validatedResult = $LoginData -> validatePassword($email, $password);
        echo "Is this a user? " . $validatedResult . "<br/>";
        return $validatedResult;
    }
}

?>