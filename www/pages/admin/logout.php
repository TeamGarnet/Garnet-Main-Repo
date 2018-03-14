<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        echo "Your session is running " . $_SESSION['idUser']; // This line will be removed, currently for testing only.
        echo "But you are now being logged out!"; // This line will be removed, currently for testing only.
        unset($_SESSION['idUser']);
        session_destroy();
    }
    header("Location: login.php");
    exit;
