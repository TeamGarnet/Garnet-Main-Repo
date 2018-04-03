<?php
/**
 */

class Contact {
    private $idContact;
    private $name;
    private $email;
    private $description;
    private $phone;
    private $title;

    /**
     * Contact constructor.
     * @param $idContact
     * @param $name
     * @param $email
     * @param $description
     * @param $phone
     * @param $title
     */
    public function __construct($idContact, $name, $email, $description, $phone, $title) {
        $this -> idContact = $idContact;
        $this -> name = $name;
        $this -> email = $email;
        $this -> description = $description;
        $this -> phone = $phone;
        $this -> title = $title;
    }

    /**
     * @return mixed
     */
    public function getIdContact() {
        return $this -> idContact;
    }

    /**
     * @param mixed $idContact
     */
    public function setIdContact($idContact) {
        $this -> idContact = $idContact;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this -> name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this -> name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this -> email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this -> email = $email;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this -> description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this -> description = $description;
    }

    /**
     * @return mixed
     */
    public function getPhone() {
        return $this -> phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone) {
        $this -> phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this -> title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) {
        $this -> title = $title;
    }


}