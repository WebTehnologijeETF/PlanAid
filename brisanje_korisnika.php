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

        $korisnici = array();  

        $upit1 = 'SELECT *
                        FROM korisnici
                        WHERE id <> :id';
                $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $statement1->execute(array(':id' => "1"));
                $korisnici = $statement1->fetchAll();  


        if(isset($_REQUEST['radio'])) {
            foreach($korisnici as $user) {
            if ($_REQUEST['idv'] == $user['id']) {
                $answer = $_REQUEST['idv'];
                try {
                    $upit2 = 'DELETE
                        FROM korisnici
                        WHERE id = :id';
                    $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement2->execute(array(':id' => $answer));
                    $vijesti2 = $statement2->fetchAll();
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
         }
        }
        header("Location: korisnici.php");
?>