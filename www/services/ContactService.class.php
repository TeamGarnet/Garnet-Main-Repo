<?php
include_once 'data/ContactData.class.php';
include_once 'models/Contact.class.php';
include_once 'data/ErrorCatching.class.php';

/*
 * ContactService.class.php: Used to communication contact.php and admin portal page with backend.
 * Functions:
 *  getAllContactEntries()
 *  formatContactInfo($pinObjectsArray)
 *  createContactEntry($pin, $markerName)
 *  updateContactEntry()
 *  deleteContactEntry($idContact)
 *  getAllEntriesAsRows()
 */

class ContactService {
    public function __construct() {
    }

    /**
     * Collects all the contact information and formats it to web correct HTML and CSS
     * @return string: A string contain HTML to be appended to the page.
     *
     * @return string
     * Examlpe Output:
     * <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
     * <div class="contactCardOutter">
     * <div class="contactCard">
     * <p class="name">Name </p>
     * <p class="title">Title </p>
     * <p class="description">Description </p>
     * <p class="email">Email </p>
     * <p class="phone">Phone </p>
     * </div>
     * </div>
     * </div>
     * *
     */
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


    /**
     * Retrieves all contact data from the database and forms Contact Objects
     * @return array : An array of Contact objects
     */
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

    /*
     * Takes in form data from an admin user and sanitizes the information. Then send the data to the data class for processing.
     * @param $name: Contact's preferred name
     * @param $email: Contact's email
     * @param $description: Contact's description of relation to Rapids Cemetery
     * @param $phone: Contact's phone number
     * @param $title: Contact's position to Rapids Cemetery
     */
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

    /*
     * Updates contact currently in the database.
     * @param $idContact: Database ID for contact.
     * @param $name: Updated name for contact
     * @param $email: Updated email for contact
     * @param $description: Updated description for contact
     * @param $phone: Updated phone for contact
     * @param $title: Updated title for contact
     */
    public function updateContactEntry($idContact, $name, $email, $description, $phone, $title) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $contactDataClass = new ContactData();
        $contactDataClass -> updateContact($idContact, $name, $email, $description, $phone, $title);
    }

    /*
     * Deletes Contact for Entry
     * @param $idContact: id of contact to be deleted
     */
    public function deleteContactEntry($idContact) {
        $idContact = filter_var($idContact, FILTER_SANITIZE_NUMBER_INT);
        if (empty($idContact) || $idContact == "") {
            return;
        } else {
            $contactDataClass = new ContactData();
            $contactDataClass -> deleteContact($idContact);
        }
    }

    /*
     * Retrieves all the contact entries and formats to display in a table.
     * @return string: A string of a table in html
     * Example Output:
     <tr id="171">
    <td>John Curran</td>
     <td>JohnCurren@Rapids.com</td>
    <td>My name is John and I'm usually at the cemetery Sundays 12:30-3:30PM.</td>
    <td>750285028</td>
    <td>titleName1</td>
    <td><button class="btn basicBtn" onclick="updateContact(171,1)">Update</button></td>
    <td><button class="btn basicBtn" onclick="deleteContact(1)"> Delete</button></td>
    </tr>
     */
    public function getAllEntriesAsRows() {
        $allmodels = $this -> getAllContactEntries();
        $html = "";
        foreach ($allmodels as $model) {
            $objectRowID = "17" . strval($model -> getIdContact());
            $editAndDelete = "</td><td><button class='btn basicBtn' onclick='updateContact("
                . $objectRowID . ","
                . $model -> getIdContact()
                . ")'>Update</button>"
                . "</td><td><button class='btn basicBtn' onclick=" . '"deleteContact('
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