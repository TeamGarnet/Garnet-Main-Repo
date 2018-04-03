<?php
include_once 'data/ContactData.class.php';
include_once 'models/Contact.class.php';

/**
 */
class ContactService {
    public function __construct() {
    }

    public function getAllContactEntries() {
        $contactDataClass = new ContactData();
        $allContactDataObjects = $contactDataClass -> readContact();
        $allContactData = array();

        foreach ($allContactDataObjects as $contactArray) {
            $contactObject = new Contact($contactArray['idContact'], $contactArray['name'], $contactArray['email'], stripcslashes($contactArray['description']), $contactArray['phone'], $contactArray['title']);

            array_push($allContactData, $contactObject);
        }
        return $allContactData;
    }

    public function formatContactInfo() {
        $allContactObjectsInfo = $this -> getAllContactEntries();
        $formattedContactInfo = "";

        foreach ($allContactObjectsInfo as $contactObjectInfo) {
            $formattedContactInfo .= '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="contactCardOutter"><div class="contactCard"><p class="name">'
                . $contactObjectInfo -> getName() . '</p><p class="title">'
                . $contactObjectInfo -> getTitle() . '</p><p class="description">'
                . $contactObjectInfo -> getDescription() . '</p><p class="email">'
                . $contactObjectInfo -> getEmail() . '</p><p class="phone">'
                . $contactObjectInfo -> getPhone() . '</p><hr class="style17"></div></div></div>';
        };


        return $formattedContactInfo;
    }

    public function createContactEntry($name, $email, $description, $phone, $title) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        //create Contact Object
        $contactDataClass = new ContactData();
        $contactDataClass -> createContact($name, $email, $description, $phone, $title);
    }

    public function updateContactEntry($idContact, $name, $email, $description, $phone, $title) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $contactDataClass = new ContactData();
        $contactDataClass -> updateContact($idContact, $name, $email, $description, $phone, $title);
    }

    public function deleteContactEntry($idContact) {
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idContact) || $idContact == "") {
            return;
        } else {
            $contactDataClass = new ContactData();
            $contactDataClass -> deleteContact($idContact);
        }
    }

    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllContactEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "17" . strval($model -> getIdContact());
            $editAndDelete = "</td><td><button onclick='updateContact("
                . $objectRowID . ","
                . $model -> getIdContact()
                . ")'>Update</button>"
                . "</td><td><button onclick=" . '"deleteContact('
                . $model -> getIdContact()
                . ')"> Delete</button>';
            $html = $html . "<tr id='" . $objectRowID . "'><td>" . $model -> getName()
                . "</td><td>" . $model -> getEmail()
                . "</td><td>" . $model -> getDescription()
                . "</td><td>" . $model -> getPhone()
                . "</td><td>" . $model -> getTitle()
                . $editAndDelete
                . "</td></tr>";
        }
        return $html;
    }
}