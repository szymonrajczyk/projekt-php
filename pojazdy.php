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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.png">
    <title>Oferta samochodów - RajCar</title>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://kit.fontawesome.com/b4c26f2dd6.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>  
    <header id="head">
        <h1>RajCar</h1>
        <h3>Oferta samochodowa</h3>
        <p class="login">
        <?php
            if(!empty($_SESSION['login'])) {
                echo "Zalogowany jako: <b>".$_SESSION['login']."</b><a href='wyloguj.php'>"." "."(Wyloguj się)</a><br>"; 
                if($_SESSION['id'] == 1) {
                    echo "<a href='dodaj.php'><b>Dodaj nowe ogłoszenie</b></a>";
                }
            } else {
                echo '<a href="logowanie.php"><b>Zaloguj się</b></a>';
            }
        ?>
        </p>
    </header>   
    <nav id="navigation">
        <a href="index.php">Strona główna</a>
    </nav>
    <main>
    <?php
        $query = "SELECT * FROM samochody;";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($result)) {
            echo <<<res
            <div class="ogloszenie">
            <img src="images/$row[id_car]/$row[zdjecie]" alt="auto" class="image">
            <p class="spec"><b id="titlecar">$row[marka] $row[model]</b><br>
            <b>Rocznik:</b> $row[rocznik]<br>
            <b>Rodzaj paliwa:</b> $row[paliwo]<br>
            <b>Cena:</b> $row[cena] zł<br>
            <b>Przebieg:</b> $row[przebieg] km</p>
res;
            if(!empty($_SESSION['logged']) && $_SESSION['id']!=1) {
                echo "<p><a class='ask' href='index.php?oid=$row[id_car]#contact'><b>Zapytaj</b></a></p>";
            }
            if(!empty($_SESSION['id']) && $_SESSION['id']==1) {
                echo "<p><a class='ask' href='usun.php?oid=$row[id_car]'><b>Usuń</b></a></p>";
            }
            echo "</div>";
        }
    ?>
        
    </main>
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