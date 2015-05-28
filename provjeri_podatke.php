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

    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: admin_panel.php");
    }
    else if(isset($_REQUEST['sifra']) && isset($_REQUEST['korisnicko_ime'])) {
        $upit = 'SELECT *
            FROM korisnici
            WHERE username = :username';
        $statement = $konekcija->prepare($upit, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->execute(array(':username'=>$username));
        $sifra_iz_baze = $statement->fetchAll();
        if($sifra_iz_baze[0]['sifra'] === $sifra) {
            setcookie("username", $username);
            $_SESSION['username'] = $username;
            header("Location: admin_panel.php");
        }
        else {
            die("Neispravni podaci");
        }
    }
    else {
        die("Morate unijeti neke podatke");
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>