<?php
    session_start();
    if(isset($_SESSION['idUser'])) {
        unset($_SESSION['idUser']);
        session_destroy();
    }
    header("Location: login.php");
    exit;
