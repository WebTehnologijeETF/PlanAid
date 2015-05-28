<?php
    require("phpskripte/podaci_baza.php");
?>

<?php

try {
    $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $datum = date("d.m.Y H:i:s");
    $autor = htmlspecialchars($_REQUEST['imeKomentar'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_REQUEST['emailKomentar'], ENT_QUOTES, 'UTF-8');
    $tekst = htmlspecialchars($_REQUEST['komentar'], ENT_QUOTES, 'UTF-8');
    $vijest = htmlspecialchars($_REQUEST['idVijesti'], ENT_QUOTES, 'UTF-8');

    $upit = $konekcija->prepare("INSERT INTO komentari (datum, autor, email, tekst, vijest) 
    VALUES (:datum, :autor, :email, :tekst, :vijest)");
    $upit->bindParam(':datum', $datum);
    $upit->bindParam(':autor', $autor);
    $upit->bindParam(':email', $email);
    $upit->bindParam(':tekst', $tekst);
    $upit->bindParam(':vijest', $vijest);
    $upit->execute();
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

    $fidVijesti = $_GET['idVijesti'];

    header("Location: komentari.php?id=".$fidVijesti);
?>