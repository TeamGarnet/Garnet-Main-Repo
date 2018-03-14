<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        echo "Your session is running " . $_SESSION['idUser'];
        echo "But you are now being logged out!";
        unset($_SESSION['idUser']);
        session_destroy();
    }
    else if(!isset($_SESSION['idUser'])) {
        echo "No session for a user, but redirecting anyway";
    }
    header("Location: login.php");
    exit;
