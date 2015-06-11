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
     onload="PrikaziKorisnike();this.parentNode.removeChild(this);" />
    <h3>Korisnici</h3>
        <form method="PUT">
            <table id="editovanje_korisnika" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Username</td>
                    <td class="red1">Email</td>
                </tr>
            </table><br>
            <input type="button" value="Izmijeni" name="izmijeni" class="svi_buttoni" onclick="EditujKorisnika()">
        </form>
        <form method="DELETE">
            <table id="brisanje_korisnika" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Username</td>
                    <td class="red1">Email</td>
                </tr>
            </table><br>
            <input type="button" value="Obriši" name="obrisi" class="svi_buttoni" onclick="ObrisiKorisnika()">
        </form>
    <script src="javascript/korisnici.js"></script>
</body>

</html>