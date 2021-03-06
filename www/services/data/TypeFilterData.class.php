<?php
include_once 'DatabaseConnection.class.php';
include_once 'ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getDBInfo($returnConn)
 *  createTypeFilter($type, $pinDesign, $buttonColor)
 *  readTypeFilter()
 *  updateTypeFilter($idTypeFilter, $pinDesign, $type, $buttonColor)
 *  deleteTypeFilter($idTypeFilter)
 */

class TypeFilterData {
    /**
     * Takes sanitized information and create a new object.
     * @param $type
     * @param $pinDesign
     * @param $buttonColor
     */
    public function createTypeFilter($type, $pinDesign, $buttonColor) {
        try {
            //global $createTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("INSERT INTO TypeFilter (pinDesign, type, buttonColor) VALUES (COALESCE(:pinDesign, DEFAULT(pinDesign)), :type, COALESCE(:buttonColor, DEFAULT(buttonColor)) )");

            if ($pinDesign == "" || empty($pinDesign)) {
                $pinDesign = null;
                $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            }

            $stmt -> bindParam(':type', $type, PDO::PARAM_STR);

            if ($buttonColor == "" || empty($buttonColor)) {
                $buttonColor = null;
                $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);
            }

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        } catch (Exception $ex) {
            echo $ex -> getMessage();
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
    public function readTypeFilter() {
        try {
            //global $getAllTypeFilterEntriesQuery;
            return $this -> getDBInfo(0) -> returnObject("", "SELECT * FROM TypeFilter");
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Takes sanitized information and updates a object in the database.
     * @param $idTypeFilter
     * @param $pinDesign
     * @param $type
     * @param $buttonColor
     */
    public function updateTypeFilter($idTypeFilter, $pinDesign, $type, $buttonColor) {
        try {
            //global $updateTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("UPDATE TypeFilter SET idTypeFilter = :idTypeFilter , pinDesign = COALESCE(:pinDesign, DEFAULT(pinDesign)), type = :type, buttonColor = COALESCE(:buttonColor, DEFAULT(buttonColor)) WHERE idTypeFilter = :idTypeFilter");

            if ($pinDesign == "" || empty($pinDesign)) {
                $pinDesign = null;
                $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            }

            $stmt -> bindParam(':type', $type, PDO::PARAM_STR);
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);

            if ($buttonColor == "" || empty($buttonColor)) {
                $buttonColor = null;
                $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);
            } else {
                $stmt -> bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);
            }

            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }

    /**
     * Deletes an object from the database
     * @param $idTypeFilter
     */
    public function deleteTypeFilter($idTypeFilter) {
        try {
            //global $deleteTypeFilterQuery;
            $stmt = $this -> getDBInfo(1) -> prepare("DELETE FROM TypeFilter WHERE idTypeFilter = :idTypeFilter");
            $stmt -> bindParam(':idTypeFilter', $idTypeFilter, PDO::PARAM_STR);
            $stmt -> execute();
        } catch (PDOException $e) {
            $errorService = new ErrorCatching();
            $errorService -> logError($e);
            exit();
        }
    }
}