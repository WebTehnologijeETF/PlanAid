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

        $id = htmlspecialchars($_REQUEST['combobox'], ENT_QUOTES, 'UTF-8');

        $upit1 = 'SELECT datum, autor, email, tekst, vijest, id
                FROM komentari
                WHERE vijest = :vijest';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute(array(':vijest' => $id));
        $komentari = $statement1->fetchAll();
        header("Location: admin_komentari.php?komentari=".$komentari);
?>