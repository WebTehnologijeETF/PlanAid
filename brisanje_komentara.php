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
                        FROM komentari';
                $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $statement1->execute();
                $komentari = $statement1->fetchAll();  

        $id = $_POST['radio'];
            foreach($komentari as $kom) {
            if ($id === $kom['id']) {
                try {
                    $upit2 = 'DELETE
                        FROM komentari
                        WHERE id = :id';
                    $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement2->execute(array(':id' => $id));
                    $komentari2 = $statement2->fetchAll();
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
         }
        header("Location: prikazi_komentare.php");
?>