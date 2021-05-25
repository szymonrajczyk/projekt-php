<?php
    session_start();
    $_SESSION['alert'] = "";
    $link = mysqli_connect("localhost","root", "", "rajcar");
    if (isset($_POST['register']) && !empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['email']))
    {
        $login = $_POST['login'];
        $password = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST["email"];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check = "SELECT login FROM users WHERE login = '".$login."';";
            if (mysqli_num_rows(mysqli_query($link, $check)) == 0)
            {
                if ($password == $password2)
                {
                    $query = "INSERT INTO `users` (`id`, `login`, `haslo`, `email`)
                    VALUES (DEFAULT, '".$login."', '".md5($password)."', '".$email."');";
                    mysqli_query($link, $query);
                    $_SESSION['alert'] = "Konto zostało utworzone!";
                    header('location: logowanie.php');
                }
                else {
                    $_SESSION['alert'] = "Hasła nie są takie same!";
                    header('location: rejestracja.php');
                }
            }
            else {
                $_SESSION['alert'] = "Istnieje już konto o podanym loginie!";
                header('location: logowanie.php');
            } 
        } 
        else {
            $_SESSION['alert'] = "Podano błędny email!";
            header('location: rejestracja.php'); 
        } 
        mysqli_close($link);
    } else {
        $_SESSION['alert'] = "Nie podano danych!";
        header('location: rejestracja.php');
    }
?>
