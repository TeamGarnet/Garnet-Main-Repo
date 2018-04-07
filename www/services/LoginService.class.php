<?php
include_once "data/LoginData.class.php";

/*
 * LoginService.class.php: Used to communication rapidsMap.php and admin portal page with backend.
 * Functions:
 *  validatePassword($email, $password)
 */
class LoginService {

    /*
     * Retrieves login verification
     */
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