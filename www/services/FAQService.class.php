<?php
include_once 'data/FAQData.class.php';
include_once 'models/FAQ.class.php';

class FAQService {
    public function __construct(){
    }

    public function getAllFAQEntries() {
        $fAQDataClass = new FAQData();
        $allFAQDataObjects =  $fAQDataClass -> readFAQ();
        $allFAQData = array();

        foreach ($allFAQDataObjects as $fAQArray) {
            $fAQObject = new FAQ($fAQArray['idFAQ'], $fAQArray['question'], $fAQArray['answer']);

            array_push($allFAQData, $fAQObject);
        }
        return $allFAQData;
    }
	
	public function formatFAQInfo() {
        $allFAQObjectsInfo = $this ->getAllFAQEntries();
        $formattedFAQInfo = "";

        foreach ($allFAQObjectsInfo as $faqObjectInfo){
            $formattedFAQInfo .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="faqCardContainer"><div class="faqCard"><p class="q">'
                . $faqObjectInfo -> getQuestion() . '</p><p class="a">'
                . $faqObjectInfo -> getAnswer() . '</p></div></div></div>'
            ;
        };


        return $formattedFAQInfo;
    }

    public function createFAQEntry($question, $answer) {
        $question = filter_var($question, FILTER_SANITIZE_EMAIL);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);

        //create FAQ Object
        $fAQDataClass = new FAQData();
        $fAQDataClass -> createFAQ($question, $answer);
    }

    public function updateFAQEntry($idFAQ, $question, $answer) {
        $question = filter_var($question, FILTER_SANITIZE_EMAIL);
        $answer = filter_var($answer, FILTER_SANITIZE_STRING);

        $fAQDataClass = new FAQData();
        $fAQDataClass -> updateFAQ($idFAQ, $question, $answer);
    }

    public function deleteFAQEntry($idFAQ) {
        $idFAQ = filter_var($idFAQ, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idFAQ) || $idFAQ == "") {
            return;
        } else {
            $fAQDataClass = new FAQData();
            $fAQDataClass -> deleteFAQ($idFAQ);
        }
    }

    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllFAQEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "15" . strval($model->getIdFAQ());
            $editAndDelete = "</td><td><button onclick='updateFAQ("
                . $objectRowID . ","
                . $model->getIdFAQ()
                . ")'>Update</button>"
                . "</td><td><button onclick=" . '"deleteFAQ('
                . $model->getIdFAQ()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>"
                . $model->getQuestion()
                . "</td><td>" . $model->getAnswer()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}