<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    if(!empty($_SESSION['alert'])) {
        echo '<script>alert("'.$_SESSION['alert'].'")</script>';
    }
    $_SESSION['alert'] = "";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_lr.css">
    <link rel="icon" href="icon.png">
    <title>Rejestracja</title>
</head>
<body>
<form method="POST" action="register.php">
    <p>Login: <FONT color="red">*</FONT></p><input type="text" name="login" placeholder="login" required><br>
    <p>Hasło: <FONT color="red">*</FONT></p><input type="password" name="password1" placeholder="hasło" required><br>
    <p>Powtórz hasło: <FONT color="red">*</FONT></p><input type="password" name="password2" placeholder="powtórz hasło" required><br>
    <p>E-mail: <FONT color="red">*</FONT></p><input type="text" name="email" placeholder="mail@example.com" required><br><br>
    <button type="submit" name="register">Zarejestruj się</button>
</form>
<br><p>Posiadasz już konto? <a href="logowanie.php"><b>Zaloguj się</b></a></p>
<p><a href="index.php"><b>Wróć na stronę główną</b></a></p>
</body>
</html>