<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        echo "You are being logged out!"; // This line will be removed, currently for testing only.
        unset($_SESSION['idUser']);
        session_destroy();
    }
    header("Location: login.php");
    exit;
