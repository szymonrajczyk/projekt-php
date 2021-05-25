<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    $query = "DELETE FROM users WHERE login = '$_SESSION[login]'";
    mysqli_query($link, $query);
    $_SESSION['logged'] = false;
    $_SESSION['login'] = "";
    $_SESSION['id'] = "";
    $_SESSION['alert'] = "Konto zostało usunięte!";
    header('location: index.php');
?>