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

        $answer = $_REQUEST['radio'];  
        $selektovani_objekat;
        if ($answer === $_REQUEST($id_vijesti)) {          
            $selektovani_objekat = $vijest;
        }

        $vijesti = array();  

        $upit2 = 'SELECT naslov
                        FROM novosti
                        WHERE vrsta_novosti = :vrsta_novosti';
                $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $statement2->execute(array(':vrsta_novosti' => 'nove_vijesti'));
                $vijesti = $statement2->fetchAll();  

        

        echo '<h3>Komentari</h3><form method="POST" action="prikazi_komentare.php">
        <div>
        Naslov vijesti:<br>
        <select id="news">';
            foreach($vijesti as $news) {
                echo '<option name="combobox" value="' . htmlspecialchars($news['id'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($news['naslov'], ENT_QUOTES, 'UTF-8') . '</option>';
            }
        echo '</select>
            </div><br>
            <input type="submit" value="Prikaži komentare" name="prikazi" class="svi_buttoni" onclick="return ValidirajID()"></form>';
?>