<?php
    session_start();
    $link = mysqli_connect("localhost","root", "", "rajcar");
    if(!empty($_SESSION['alert'])) {
        echo '<script>alert("'.$_SESSION['alert'].'")</script>';
    }
    $_SESSION['alert'] = "";
    $query = "DELETE from SAMOCHODY where id_car = $_GET[oid]";
    mysqli_query($link, $query);
    header('location: pojazdy.php');
?>