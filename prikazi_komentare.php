<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        die("Istekla je sesija. Logujte se ponovo.");
    }
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Event planning</title>
    <link rel="stylesheet" type="text/css" href="css/zadaca1.css">
    <link rel="shortcut icon" href="photos/logo.ico">
</head>

<body>
    <img src="photos/bullet.png" alt="slika" 
     onload="PopuniVijest();this.parentNode.removeChild(this);" />
    <h3>Komentari</h3>
    <form method="GET">
        Izaberite vijest:
        <table id="moje_vijesti" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Datum</td>
                    <td class="red1">Autor</td>
                    <td class="red1">Naslov</td>
                </tr>
        </table><br>
        <input type="button" value="Prikaži komentare" name="prikazi" class="svi_buttoni" onclick="IzaberiVijest()">
    </form>
</body>
    <script src="javascript/komentari.js"></script>
</html>