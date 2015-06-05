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

        $id = htmlspecialchars($_POST['radio'], ENT_QUOTES, 'UTF-8');
            foreach($vijesti as $news) {
            if ($id === $news['id']) {
                try {
                    $upit3 = 'DELETE
                                FROM komentari
                                WHERE vijest = :vijest';
                    $statement3 = $konekcija->prepare($upit3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement3->execute(array(':vijest' => $id));
                    $upit2 = 'DELETE
                        FROM novosti
                        WHERE id = :id';
                    $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement2->execute(array(':id' => $id));
                    $vijesti2 = $statement2->fetchAll();
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
         }
        header("Location: admin_panel.php");
?>