<h3>Korisnici</h3>
        <?php
        header('Content-Type: text/html; charset=UTF-8');
        $ime_servera = "localhost";
        $usrnm = "zloco";
        $password = "wtplanaid";
        $ime_baze = "planaid";

        try {
            $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $nove_vijesti = array();

        $upit1 = 'SELECT datum, autor, naslov, slika, tekst, detaljnije, id
                    FROM novosti
                    WHERE vrsta_novosti = :vrsta_novosti';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute(array(':vrsta_novosti' => 'nove_vijesti'));
        $nove_vijesti = $statement1->fetchAll();

        echo '<form method="POST" action="dodaj_vijest.php">
        <div>
        Autor:<br>
        <input type="text" name="autor" id="autor" onblur="ValidirajIme()">
        <img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
        <span id="tekst_ime" class="tekst_invisible">Isključivo slova</span>
            </div><br>
        <div>
            Naslov:<br>
            <input type="text" name="naslov" id="naslov" onblur="ValidirajPoruku()">
            <img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
            <span id="tekst_ime" class="tekst_invisible">Morate unijeti naslov</span>
        </div><br>
        <div>
            Slika:<br>
            <input type="url" name="slika" id="slika" onblur="ValidirajPoruku()">
            <img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
            <span id="tekst_ime" class="tekst_invisible">Morate unijeti url slike</span>
        </div><br>
        <div>
            Tekst:<br>
            <textarea class="poruka" name="tekst" rows="8" cols="1" id="tekst" onblur="ValidirajPoruku()"></textarea>
            <img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
            <span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
        </div><br>
        <div>
            Detaljnije:<br>
            <textarea class="poruka" name="detaljnije" rows="8" cols="1" id="detaljnije" onblur="ValidirajPoruku()"></textarea>
            <img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
            <span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
        </div><br>
            <input type="submit" value="Dodaj" name="dodaj" class="svi_buttoni"></form>
            <form>
            <table id="moja_desavanja" class="moja_desavanja">
                <tr>
                    <td class="red1"></td>
                    <td class="red1">Datum</td>
                    <td class="red1">Autor</td>
                    <td class="red1">Naslov</td>
                </tr>';
                foreach($nove_vijesti as $vijest) {
                    $datetime = new DateTime($vijest['datum']);
                    $datum = $datetime->format('d.m.y H:i:s');
                    echo '<tr><td><input type="radio" name="radio"></td><td>' .
                            htmlspecialchars($datum, ENT_QUOTES, 'UTF-8') . '</td><td>' .
                            htmlspecialchars($vijest['autor'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
                            htmlspecialchars($vijest['naslov'], ENT_QUOTES, 'UTF-8') . '</td></tr>';
                }
            echo '</table><br>
                <input type="submit" value="Izmijeni" name="izmijeni" class="svi_buttoni">
                <input type="submit" value="Obriši" name="obrisi" class="svi_buttoni">
        </form>';
        ?>