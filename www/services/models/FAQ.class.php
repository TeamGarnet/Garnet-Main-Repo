<?php
/**
 */

class FAQ {
    private $idFAQ;
    private $question;
    private $answer;

    /**
     * FAQ constructor.
     * @param $idFAQ
     * @param $question
     * @param $answer
     */
    public function __construct($idFAQ, $question, $answer) {
        $this -> idFAQ = $idFAQ;
        $this -> question = $question;
        $this -> answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getIdFAQ() {
        return $this -> idFAQ;
    }

    /**
     * @param mixed $idFAQ
     */
    public function setIdFAQ($idFAQ) {
        $this -> idFAQ = $idFAQ;
    }

    /**
     * @return mixed
     */
    public function getQuestion() {
        return $this -> question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question) {
        $this -> question = $question;
    }

    /**
     * @return mixed
     */
    public function getAnswer() {
        return $this -> answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer) {
        $this -> answer = $answer;
    }



}