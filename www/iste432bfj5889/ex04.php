<?php
/**
 * Class: ${NAME}
 * Date: 4/13/2018
 * Description:
 */
function createHash($txt){
    $salt = getSalt();
    return hash('sha256', $txt.$salt);
}
function getSalt() {
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
    $randStringLen = 64;

    $randString = "";
    for ($i = 0; $i < $randStringLen; $i++) {
        $randString = $charset[mt_rand(0, strlen($charset) - 1)];
    }

    return $randString;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = $_POST['info'];
    echo createHash($data['text']);
    return createHash($data['text']);

}
?>
<!-- HTML -->
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

    <body>
    <label for="txt">Hashing Example</label></br>
    <input type="text" id="txt" name="txt" autocomplete="off" placeholder="Enter text"/>

    <button onclick="createHash()" id="btn"> Generate Hash </button>

    </body>
</html>

<!--- JS --->
<script type="text/javascript">
function createHash() {

    var formData = {
        'text': $('#txt').val()
    };


    $.ajax({
        method: "POST",
        url: "ex04.php",
        data: {
            info: formData
        }
    }).done(function (data) {
        alert(data);
    });
}
</script>