<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    if(!empty($_SESSION['alert'])) {
        echo '<script>alert("'.$_SESSION['alert'].'")</script>';
    }
    $_SESSION['alert'] = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST['temat']) && !empty($_POST['message'])) {
            $temat = $_POST['temat'];
            $msg = $_POST['message'];
            if($_SESSION['logged']==true) {
                $query = "INSERT INTO wiadomosci VALUES(DEFAULT, '$temat', '$msg', $_SESSION[id]);";
                mysqli_query($link, $query);
            } else {
                $_SESSION['alert'] = "Musisz się zalogować żeby wysłać zapytanie!";
                header('location: index.php');
            }
        } 
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.png">
    <title>Salon samochodowy - RajCar</title>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://kit.fontawesome.com/b4c26f2dd6.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>  
    <header id="head">
        <h1>RajCar</h1>
        <h3>Twój ulubiony salon samochodowy</h3>
        <p class="login">
        <?php
            if(!empty($_SESSION['login'])) {
                echo "Zalogowany jako: <a href='update.php?oid=$_SESSION[login]'><b>".$_SESSION['login']."</a></b><a href='wyloguj.php'>"." "."(Wyloguj się)</a><br>";
            } else {
                echo '<a href="logowanie.php"><b>Zaloguj się</b></a>';
            }
        ?>
        </p>
    </header>   
    <nav id="navigation">
        <a href="index.php">Strona główna</a>
        <a href="pojazdy.php">Oferta</a>
        <a href="#contact">Kontakt</a>
    </nav>
    <h2>O nas</h2>
    <article id="about">
        <div class="abt">
            RajCar to salon samochodowy powstały w 2021 roku.
            Pomimo swojej krótkiej działalności szybko zyskaliśmy zaufanie klientów.
            Nasz salon ciągle się rozwija i poszukuje nowych rozwiązań.
            Aktualnie w naszej ofercie znajdują się jedynie samochody używane, aczkolwiek w przyszłości będą pojawiały się nowe samochody.<br>
            Naszym głównym celem jest zadowolenie klienta i umilenie mu przyszłej podróży samochodem!<br>
            Zachęcamy do sprawdzenia naszej aktualnej oferty w zakładce oferta i skontaktowanie się z nami poprzez formularz kontaktowy.<br>
            DISCLAIMER: Aby wysłać wiadomość należy być zalogowanym!

        </div>
        <div class="gallery">
            <button onclick="plusDiv(-1)">&#10094;</button>
                <div class="gallery">
                    <img class="image" src="images/1/plus.jpg">
                    <img class="image" src="images/2/suzuki.jpg" style="display:none;">
                    <img class="image" src="images/3/bmw.jpg" style="display:none;">
                    <img class="image" src="images/4/golf.jpg" style="display:none;">
                </div>
                <button onclick="plusDiv(1)">&#10095;</button>
        </div>
    </article>
    <article id="contact">
        <h2>Kontakt</h2>
        <?php
            if(!empty($_GET)) {
                $query = "SELECT model, marka FROM samochody WHERE id_car = $_GET[oid]";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($result); 
            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <p>Temat: </p><input type="text" name="temat" placeholder="temat" <?php if(!empty($row)) {echo "value='$row[marka] $row[model]'";}?>required><br>
            <p>Wiadomość: </p><textarea name="message" placeholder="wiadomość" required></textarea><br>
            <button type="submit">Wyślij pytanie</button><br>
        <form>
    </article>
    <footer>
        <div id="links">
            <a class="social-link" href="mailto:business@rajczykszymon.pl"><i class="fa fa-envelope-open fa-2x"></i></a>
            <a class="social-link" target="_blank" href="https://www.instagram.com/salonrajcar/"><i class="fa fa-instagram fa-2x"></i></a>
        </div>
        <p>&copy Szymon Rajczyk 2021</p>
    </footer>
    <a href="#head"><i class="fa fa-chevron-circle-up fa-2x btt"></i></a>
</body>
</html>