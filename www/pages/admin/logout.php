<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        echo "Your session is running " . $_SESSION['idUser'];
        echo "But you are now being logged out!";
        unset($_SESSION['idUser']);
        session_destroy();
    }
    
    header("Location: login.php");
    exit;
