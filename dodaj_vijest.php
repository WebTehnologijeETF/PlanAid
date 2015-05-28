<?php
	$ime_servera = "localhost";
	$username = "zloco";
	$sifra = "wtplanaid";
	$ime_baze = "planaid";

try {
    $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $username, $sifra);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $datetime = new DateTime();
    $datum = $datetime->format('Y.m.d H:i:s');
    $autor = htmlspecialchars($_REQUEST['autor'], ENT_QUOTES, 'UTF-8');
    $naslov = htmlspecialchars($_REQUEST['naslov'], ENT_QUOTES, 'UTF-8');
    $slika = htmlspecialchars($_REQUEST['slika'], ENT_QUOTES, 'UTF-8');
    $tekst = htmlspecialchars($_REQUEST['tekst'], ENT_QUOTES, 'UTF-8');
    $detaljnije = htmlspecialchars($_REQUEST['detaljnije'], ENT_QUOTES, 'UTF-8');
    $vrsta_novosti = "nove_vijesti";


    $upit = $konekcija->prepare("INSERT INTO novosti (datum, autor, naslov, slika, tekst, detaljnije, vrsta_novosti) 
    VALUES (:datum, :autor, :naslov, :slika, :tekst, :detaljnije, :vrsta_novosti)");
    $upit->bindParam(':datum', $datum);
    $upit->bindParam(':autor', $autor);
    $upit->bindParam(':naslov', $naslov);
    $upit->bindParam(':slika', $slika);
    $upit->bindParam(':tekst', $tekst);
    $upit->bindParam(':detaljnije', $detaljnije);
    $upit->bindParam(':vrsta_novosti', $vrsta_novosti);
    $upit->execute();
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

    header("Location: admin_panel.php");
?>