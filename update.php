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
    <title>Zaktualizuj informacje</title>
    <link rel="stylesheet" href="style_lr.css">
    <link rel="icon" href="icon.png">
</head>
<body>
    <form method="POST" action="change.php">
        <p>Bieżące hasło: </p><input type="password" name="current" placeholder="bieżące hasło" required><br>
        <p>Nowe hasło: </p><input type="password" name="new" placeholder="nowe hasło" required><br><br>
        <button type="submit" name="log">Zaktualizuj</button><br>
    </form>
    <br><p>Chcesz usunąć konto?
    <form method="POST" action="delete.php">    
        <button type="submit" name="usun">Usuń konto</button>
    </form>
    <p><a href="index.php"><b>Wróć na stronę główną</b></a></p>
</body>
</html>