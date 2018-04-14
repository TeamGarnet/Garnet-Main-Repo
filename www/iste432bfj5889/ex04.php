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
            alert($('#txt').val());
        });
    });
}
</script>