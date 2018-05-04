<?php
include_once 'DatabaseConnection.class.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  createContact($name, $email, $description, $phone, $title)
 *  readContact()
 *  updateContact($idContact, $name, $email, $description, $phone, $title)
 *  deleteContact($idContact)
 */

class ContactData {
    /**
     * Takes sanitized information and create a new object.
     * @param $name
     * @param $email
     * @param $description
     * @param $phone
     * @param $title
     */
    public function createContact($name, $email, $description, $phone, $title) {
        try {
            //global $createContactQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO Contact (name,description,email, phone, title) VALUES (:name, :description,:email,:phone,:title)");


            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':title', $title, PDO::PARAM_STR);
            $stmt -> bindParam(':phone', $phone, PDO::PARAM_STR);

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
    public function readContact() {
        try {
            //global $getAllContactEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT idContact, name, email, description, phone, title FROM Contact");
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Takes sanitized information and updates a object in the database.
     * @param $idContact
     * @param $name
     * @param $email
     * @param $description
     * @param $phone
     * @param $title
     */
    public function updateContact($idContact, $name, $email, $description, $phone, $title) {
        try {
            //global $updateContactQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE Contact SET idContact = :idContact , name = :name , description = :description , email = :email, phone = :phone,  title= :title WHERE idContact = :idContact");

            $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
            $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
            $stmt -> bindParam(':description', $description, PDO::PARAM_STR);
            $stmt -> bindParam(':idContact', $idContact, PDO::PARAM_STR);
            $stmt -> bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt -> bindParam(':title', $title, PDO::PARAM_STR);

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Deletes an object from the database
     * @param $idContact
     */
    public function deleteContact($idContact) {
        try {
            //global $deleteContactQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM Contact WHERE idContact = :idContact");
            $stmt -> bindParam(':idContact', $idContact, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }
}