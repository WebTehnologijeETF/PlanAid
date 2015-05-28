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

    $username = htmlspecialchars($_REQUEST['username'], ENT_QUOTES, 'UTF-8');
    $sifra = htmlspecialchars($_REQUEST['sifra'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_REQUEST['email'], ENT_QUOTES, 'UTF-8');

    $id = $_REQUEST['idv'];
    foreach($korisnici as $user) {
        if($user['id'] == $id) {
            try {
                $upit = $konekcija->prepare('UPDATE korisnici
                                         SET username = :username,
                                            sifra = :sifra,
                                            email = :email
                                        WHERE id = :id');
                $upit->bindParam(':username', $username);
                $upit->bindParam(':sifra', $sifra);
                $upit->bindParam(':email', $email);
                $upit->bindParam(':id', $id);
                $upit->execute();
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    header("Location: korisnici.php");
?>