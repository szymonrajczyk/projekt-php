<?php
    session_start();
    $_SESSION['logged'] = false;
    $_SESSION['login'] = "";
    $_SESSION['id'] = "";
    $_SESSION['alert'] = "Wylogowano!";
    header('location: index.php');
?>