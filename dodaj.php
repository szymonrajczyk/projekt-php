<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    if(!empty($_SESSION['alert'])) {
        echo '<script>alert("'.$_SESSION['alert'].'")</script>';
    }
    $_SESSION['alert'] = "";
    if($_SESSION['id']!="1") {
        $_SESSION['alert'] = "Nie posiadasz wymaganych uprawnień!";
        header('location: index.php');
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($_POST['marka']) && !empty($_POST['model']) && !empty($_POST['rocznik']) && !empty($_POST['paliwo']) && !empty($_POST['przebieg']) && !empty($_POST['cena'])) {
            $marka = $_POST['marka'];
            $model = $_POST['model'];
            $rocznik = $_POST['rocznik'];
            $paliwo = $_POST['paliwo'];
            $przebieg = $_POST['przebieg'];
            $cena = $_POST['cena'];
            $zdjecie = $_FILES['image']['name'];
            $query = "INSERT INTO samochody VALUES (DEFAULT, '$marka', '$model', '$rocznik', '$paliwo', '$przebieg', '$cena', '$zdjecie');";
            mysqli_query($link, $query);
            $query = mysqli_query($link,"SELECT LAST_INSERT_ID() FROM samochody");
                $row = mysqli_fetch_row($query);
                $directory = "./images/$row[0]/";
                mkdir($directory);
                move_uploaded_file($_FILES['image']['tmp_name'], $directory.basename($_FILES['image']['name']));
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
    <link rel="stylesheet" href="style_lr.css">
    <title>Dodaj pojazd</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <p>Marka: </p><input type="text" name="marka" placeholder="marka" required><br>
        <p>Model: </p><input type="text" name="model" placeholder="model" required><br>
        <p>Rocznik: </p><select name="rocznik">
            <?php
                for($i = 2000; $i<=2021; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select><br>
        <p>Rodzaj paliwa: </p><select name="paliwo">
            <option value="benzyna">Benzyna</option>
            <option value="diesel">Diesel</option>
            <option value="gaz">Gaz</option>
        </select><br>
        <p>Przebieg: </p><input type="number" name="przebieg" placeholder="przebieg" required><br>
        <p>Cena: </p><input type="number" name="cena" placeholder="cena" required><br>
        <p>Zdjęcie pojazdu: </p><input type="file" name="image" accept="image/*" value=""/><br>
        <button type="submit">Dodaj ogłoszenie</button><br>
        <p><a href="index.php"><b>Wróć na stronę główną</b></a></p>
    </form>
</body>
</html>