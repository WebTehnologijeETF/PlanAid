<?php
    require("phpskripte/podaci_baza.php");
?>

<?php
header('Content-Type: text/html; charset=UTF-8');
try {
    $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = htmlspecialchars($_REQUEST['korisnicko_ime'], ENT_QUOTES, 'UTF-8');
    $sifra = htmlspecialchars($_REQUEST['sifra'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_REQUEST['email'], ENT_QUOTES, 'UTF-8');

    $upit1 = 'SELECT *
                FROM korisnici
                WHERE username = :username';
    $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $statement1->execute(array(':username'=>$username));
    $korisnicka_imena = $statement1->fetchAll();    
    $brojac1 = count($korisnicka_imena);
    $postoji1 = false;
    if($brojac1 != 0) {
        $postoji1 = true;
    }

    $upit2 = 'SELECT *
        FROM korisnici
        WHERE email = :email';
    $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $statement2->execute(array(':email'=>$email));
    $emailovi = $statement2->fetchAll();
    $brojac2 = count($emailovi);
    $postoji2 = false;
    if($brojac2 != 0) {
        $postoji2 = true;
    }

    $username_validno = $postoji1;
    $email_validno = $postoji2;
    $validno = $username_validno && $email_validno;

    if(!$validno) {
        $upit = $konekcija->prepare("INSERT INTO korisnici (username, sifra, email) 
        VALUES (:username, :sifra, :email)");
        $upit->bindParam(':username', $username);
        $upit->bindParam(':sifra', $sifra);
        $upit->bindParam(':email', $email);
        $upit->execute();
        echo "<script type='text/javascript'>alert('Uspješno ste dodali korisnika');</script>";
        $poruka_korisniku = "Uspjesno ste dodali korisnika!";
    }
    else {
        echo "<script type='text/javascript'>alert('Već postoji korisnik');</script>";
        $poruka_korisniku = "Vec postoji korisnik!";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

    header("Location: index.php?poruka=".$poruka_korisniku);
?>