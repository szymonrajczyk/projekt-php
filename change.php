<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    $new = $_POST['new'];
    $current = md5($_POST['current']);
    $check = "SELECT haslo FROM users WHERE login = '$_SESSION[login]';";
    $result = mysqli_fetch_row(mysqli_query($link, $check));
    $old = $result[0];
    print_r($old."<br>");
    print_r($current);
    if ($old == $current) {
        $query = "UPDATE users SET haslo = '".md5($new)."' WHERE login = '$_SESSION[login]'";
        mysqli_query($link, $query);
        $_SESSION['alert'] = "Hasło zostało zmienione!";
        header('location: index.php');
    } else {
        $_SESSION['alert'] = "Podane błędne hasło!";
        header("location: update.php?oid=$_SESSION[login]");
    }
?>