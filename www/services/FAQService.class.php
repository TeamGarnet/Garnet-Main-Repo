<?php
include_once 'data/FAQData.class.php';
include_once 'models/FAQ.class.php';

/*
 * FAQService.class.php: Used to communication faq.php and admin portal page with backend.
 * Functions:
 *  getAllFAQEntries()
 *  createFAQEntry($name, $description, $startTime, $endTime, $idWiderAreaMap)
 *  updateFAQEntry($idFAQ, $name, $description, $startTime, $endTime, $idWiderAreaMap)
 *  deleteFAQEntry($idFAQ)
 *  getAllEntriesAsRows()
 *  formatFAQInfo()
 */

class FAQService {
    public function __construct() {
    }

    public function formatFAQInfo() {
        $allFAQObjectsInfo = $this -> getAllFAQEntries();
        $formattedFAQInfo = "";

        foreach ($allFAQObjectsInfo as $faqObjectInfo) {
            $formattedFAQInfo .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="faqCardContainer"><div class="faqCard"><p class="q">'
                . $faqObjectInfo -> getQuestion() . '</p><p class="a">'
                . $faqObjectInfo -> getAnswer() . '</p><hr class="style17"></div></div></div>';
        };


        return $formattedFAQInfo;
    }

    /*
     * Collects all the FAQ information and formats it to web correct HTML and CSS
     * @return string: A string contain HTML to be appended to the page.
     */

    /**
     * Retrieves all FAQ data from the database and forms FAQ Objects
     * @return array : An array of FAQ objects
     */
    public function getAllFAQEntries() {
        $fAQDataClass = new FAQData();
        $allFAQDataObjects = $fAQDataClass -> readFAQ();
        $allFAQData = array();

        foreach ($allFAQDataObjects as $fAQArray) {
            $fAQObject = new FAQ($fAQArray['idFAQ'], stripcslashes($fAQArray['question']), stripcslashes($fAQArray['answer']));

            array_push($allFAQData, $fAQObject);
        }
        return $allFAQData;
    }

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $name: FAQ's preferred name
     * @param $description: FAQ's description of relation to Rapids Cemetery
     * @param $startTime: FAQ's startTime
     * @param $endTime: FAQ's endTime
     * @param $idWiderAreaMap: FAQ's attached location
     */

    public function createFAQEntry($question, $answer) {
        $question = filter_var($question, FILTER_SANITIZE_STRING);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);

        //create FAQ Object
        $fAQDataClass = new FAQData();
        $fAQDataClass -> createFAQ($question, $answer);
    }

    /*
     * Updates FAQ currently in the database.
     * @param $idFAQ: FAQ's preferred id
     * @param $name: FAQ's preferred name
     * @param $description: FAQ's description of relation to Rapids Cemetery
     * @param $startTime: FAQ's startTime
     * @param $endTime: FAQ's endTime
     * @param $idWiderAreaMap: FAQ's attached location
     */
    public function updateFAQEntry($idFAQ, $question, $answer) {
        $question = filter_var($question, FILTER_SANITIZE_STRING);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);

        $fAQDataClass = new FAQData();
        $fAQDataClass -> updateFAQ($idFAQ, $question, $answer);
    }

    /*
     * Deletes FAQ for Entry
     * @param $idFAQ: id of FAQ to be deleted
     */
    public function deleteFAQEntry($idFAQ) {
        $idFAQ = filter_var($idFAQ, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idFAQ) || $idFAQ == "") {
            return;
        } else {
            $fAQDataClass = new FAQData();
            $fAQDataClass -> deleteFAQ($idFAQ);
        }
    }

    /*
     * Retrieves all the FAQ entries and formats to display in a table.
     * @return string: A string of a table in html
     */
    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllFAQEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "15" . strval($model -> getIdFAQ());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateFAQ("
                . $objectRowID . ","
                . $model -> getIdFAQ()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteFAQ('
                . $model -> getIdFAQ()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>"
                . $model -> getQuestion()
                . "</td><td>" . $model -> getAnswer()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}