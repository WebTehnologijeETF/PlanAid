<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        die("Niste ulogovani kao admin");
    }
    require("phpskripte/podaci_baza.php");
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Event planning</title>
    <link rel="stylesheet" type="text/css" href="css/zadaca1.css">
    <link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu();
    <?php
        if(isset($_GET['poruka'])) {
        echo "alert('" . $_GET['poruka'] . "');";
    }
    ?>
">

    <header class="logo">
        <img src="photos/logo.png" class="logo-image" alt="logo">
        <a href="index.php" class="logo-text">PlanAid</a>
    </header>
    
    <nav class="menu">
        <a class="kursor" onmouseover="PrikaziNaslovnicu()">Naslovnica</a>
        <a class="kursor" onmouseover="PrikaziDesavanja()">Dešavanja</a>
        <a class="kursor" onmouseover="PrikaziLokacije()">Lokacije</a>
        <a class="kursor" onmouseover="PrikaziPrijavu()">Prijava</a>
        <a onclick="PrikaziStranicu('kontakt')" onmouseover="SakrijSubmenu()">Kontakt</a>
        <a class="admin_visible" id="adminmenu" onmouseover="PrikaziAdmin()">Admin</a>
    </nav>

<section>
    <div id="submenu_naslovnica" class="submenu_invisible">
        <a onclick="PrikaziStranicu('naslovnica_novevijesti')">Najnovije vijesti</a>
        <a onclick="PrikaziStranicu('naslovnica_najcitanije')">Najčitanije vijesti</a>
        <a onclick="PrikaziStranicu('naslovnica_svevijesti')">Sve vijesti</a>
    </div>

    <div id="submenu_desavanja" class="submenu_invisible">
        <a onclick="PrikaziStranicu('kalendar')">Pregled kalendara</a>
        <a onclick="PrikaziStranicu('novo_desavanje')">Novo dešavanje</a>
        <a onclick="PrikaziStranicu('moja_desavanja')">Moja dešavanja</a>
    </div>

    <div id="submenu_lokacije" class="submenu_invisible">
        <a onclick="PrikaziStranicu('linkovi')">Sarajevo</a>
        <a onclick="PrikaziStranicu('linkovi_zenica')">Zenica</a>
        <a onclick="PrikaziStranicu('linkovi_mostar')">Mostar</a>
    </div>

    <div id="submenu_prijava" class="submenu_invisible">
        <a onclick="PrikaziStranicu('login')">Login</a>
        <a onclick="PrikaziStranicu('registracija')">Registracija</a>
    </div>

    <div id="submenu_admin" class="submenu_invisible">
        <a href="admin_panel.php">Novosti</a>
        <a href="prikazi_komentare.php">Komentari</a>
        <a href="korisnici.php">Korisnici</a>
    </div>
    
    <section id="glavni">
    <h3>Korisnici</h3>
        <?php
        header('Content-Type: text/html; charset=UTF-8');

        try {
            $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $korisnici = array();

        $upit1 = 'SELECT *
                    FROM korisnici';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute();
        $korisnici = $statement1->fetchAll();

        echo '<form method="POST" action="izmjena_korisnika.php">
            <table id="moja_desavanja" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Username</td>
                    <td class="red1">Email</td>
                </tr>';
                $id;
                foreach($korisnici as $user) {
                    if($user['id'] !== "1") {
                        $id = htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');
                    echo '<tr><td><input type="radio" name="radio" value="' .
                            $id . '" checked="checked"></td><td>' .
                            htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
                            htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</td></tr>';
                    }
                }
            echo '</table><br>
                <input type="submit" value="Izmijeni" name="izmijeni" class="svi_buttoni"></form>
            <form method="POST" action="brisanje_korisnika.php">
            <table id="moja_desavanja" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Username</td>
                    <td class="red1">Email</td>
                </tr>';
                $id;
                foreach($korisnici as $user) {
                    if($user['id'] !== "1") {
                        $id = htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');
                    echo '<tr><td><input type="radio" name="radio" value="' .
                            $id . '" checked="checked"></td><td>' .
                            htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
                            htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</td></tr>';
                    }
                }
            echo '</table><br>
                <input type="submit" value="Obriši" name="obrisi" class="svi_buttoni">
        </form>';
        ?>
    </section>
        
    <aside class="reklame">
        <aside class="reklame-body">
            Generalni sponzori<br><br>
            <a href="http://www.klix.ba" target="_blank">
                <img src="photos/klix.png" alt="klix">
            </a>
            <a href="http://www.tuborg.com/gl/en/" target="_blank">
                <img src="photos/tuborg.png" alt="tuborg">
            </a>
        </aside>
    </aside>
</section>
    <script src="javascript/menu.js"></script>
    <script src="javascript/validacija.js"></script>
</body>

</html>