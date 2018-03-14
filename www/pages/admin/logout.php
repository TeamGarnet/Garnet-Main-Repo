<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        echo "You are being logged out!"; // This line will be removed, currently for testing only.
        unset($_SESSION['idUser']);
        session_destroy();
    }
    else if(!isset($_SESSION['idUser'])) {
        echo "No session for a user, but redirecting anyway"; // This line will be removed, currently for testing only.
    }
    header("Location: login.php");
    exit;
