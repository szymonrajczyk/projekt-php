<?php
session_start();
$_SESSION['alert'] = "";
$link = mysqli_connect("localhost","root", "", "rajcar");
if (isset($_POST['log']) && !empty($_POST['login']) && !empty($_POST['password']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];  
    $check = "SELECT id, login, haslo FROM users WHERE login = '".$login."' AND haslo = '".md5($password)."';";
    if (mysqli_num_rows($result = mysqli_query($link, $check)) > 0)
    {
        $row = mysqli_fetch_assoc($result);   
        $_SESSION['logged'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id'];
        $_SESSION['alert'] = "Logowanie udane!";
        header('location: index.php');
    }
    else {
        $_SESSION['alert'] = "Podano błędne dane!";
        header('location: logowanie.php');
    }
} else {
    $_SESSION['alert'] = "Nie podano danych!";
    header('location: logowanie.php');
}
mysqli_close($link);
?>