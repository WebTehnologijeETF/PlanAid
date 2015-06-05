<?php
    require("phpskripte/podaci_baza.php");
?>

<?php

    try {
        $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
        $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $vijesti = array();
    $upit1 = 'SELECT *
            FROM novosti
            WHERE vrsta_novosti = :vrsta_vijesti';
    $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $statement1->execute(array(':vrsta_vijesti' => 'nove_vijesti'));
    $vijesti = $statement1->fetchAll();

    $datetime = new DateTime();
    $datum = $datetime->format('Y.m.d H:i:s');
    $autor = htmlspecialchars($_REQUEST['autor'], ENT_QUOTES, 'UTF-8');
    $naslov = htmlspecialchars($_REQUEST['naslov'], ENT_QUOTES, 'UTF-8');
    $slika = htmlspecialchars($_REQUEST['slika'], ENT_QUOTES, 'UTF-8');
    $tekst = htmlspecialchars($_REQUEST['tekst'], ENT_QUOTES, 'UTF-8');
    $detaljnije = htmlspecialchars($_REQUEST['detaljnije'], ENT_QUOTES, 'UTF-8');
    $vrsta_novosti = "nove_vijesti";

    $id = $_REQUEST['idv'];
    foreach($vijesti as $news) {
        if($news['id'] == $id) {
            try {
                $upit = $konekcija->prepare('UPDATE novosti
                                         SET datum = :datum,
                                            autor = :autor,
                                            naslov = :naslov,
                                            slika = :slika,
                                            tekst = :tekst,
                                            detaljnije = :detaljnije,
                                            vrsta_novosti = :vrsta_novosti
                                        WHERE id = :id');
                $upit->bindParam(':datum', $datum);
                $upit->bindParam(':autor', $autor);
                $upit->bindParam(':naslov', $naslov);
                $upit->bindParam(':slika', $slika);
                $upit->bindParam(':tekst', $tekst);
                $upit->bindParam(':detaljnije', $detaljnije);
                $upit->bindParam(':vrsta_novosti', $vrsta_novosti);
                $upit->bindParam(':id', $id);
                $upit->execute();
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    header("Location: admin_panel.php");
?>