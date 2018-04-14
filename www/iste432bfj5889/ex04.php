<?php
/**
 * Class: ${NAME}
 * Date: 4/13/2018
 * Description:
 */
function createHash($txt){
    $salt = "myRand0msalt%";
    return hash('sha256',$txt, $salt);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo createHash($_POST['text']);
    return createHash($_POST['text']);

}
?>
<!-- HTML -->
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

    <body>
    <label for="txt">Hashing Example</label>
    <input type="text" id="txt" name="txt" autocomplete="off" placeholder="Enter text"/>

    <button onclick="createHash()" id="btn"> Generate Hash </button>
    <input type="text" id="output" name="'output"/>

    </body>
</html>

<!--- JS --->
<script type="text/javascript">
function createHash() {
    $(document).ready(function() {
        $('#btn').click(function() {
            var value = $('#txt').val();
            alert(value);
        });
    });
    var value2 = $('#txt').val();
    alert(value2);

    $.ajax({
        method: "POST",
        url: "ex04.php",
        data: {text: $('#txt').val()}
    }).done(function (data) {
        alert(data);
    });
}
</script>