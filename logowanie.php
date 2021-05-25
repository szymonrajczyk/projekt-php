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
    <title>Zaloguj się</title>
    <link rel="stylesheet" href="style_lr.css">
    <link rel="icon" href="icon.png">
</head>
<body>
    <form method="POST" action="login.php">
        <p>Login: <FONT color="red">*</FONT></p><input type="text" name="login" placeholder="login" required><br>
        <p>Hasło: <FONT color="red">*</FONT></p><input type="password" name="password" placeholder="hasło" required><br><br>
        <button type="submit" name="log">Zaloguj się</button><br>
    </form>
    <br><p>Nie masz jeszcze konta? <a href="rejestracja.php"><b>Zarejestruj się</b></a></p>
    <p><a href="index.php"><b>Wróć na stronę główną</b></a></p>
</body>
</html>