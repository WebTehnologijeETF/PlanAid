<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu()" class="body_vijesti">

	<section id="frejm">
		<?php
			header('Content-Type: text/html; charset=UTF-8');
			$ime_servera = "localhost";
			$username = "zloco";
			$sifra = "wtplanaid";
			$ime_baze = "planaid";

			try {
				$konekcija = new PDO("mysql:dbname=" . $ime_baze . ";host=" . $ime_servera, $username, $sifra);
				$konekcija->exec('set names utf8');
			}
			catch (PDOException $e) {
				echo "Greska! : " . $e->getMessage() . "<br>";
				die();
			}

			$komentari = array();
			session_start();
			$_REQUEST['idVijesti'] = $_GET['id'];

			$vijest = htmlspecialchars($_REQUEST['idVijesti'], ENT_QUOTES, 'UTF-8');

			$upit = 'SELECT datum, autor, email, tekst
					    	FROM komentari
					    	WHERE vijest= :vijest';
					$statement = $konekcija->prepare($upit, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$statement->execute(array(':vijest'=>$vijest));
					$komentari = $statement->fetchAll();
			usort ($komentari, function($a, $b) { 	
				$datum1 = date('Y-m-d H:i:s', strtotime($a[0]));
				$datum2 = date('Y-m-d H:i:s', strtotime($b[0]));
				return $datum1 > $datum2;
			});

			foreach ($komentari as $kom) {
				$sadrzaj_stranice = '<br><div>';
					$sadrzaj_stranice .= '<div class="frejm-text">' . 
						htmlspecialchars($kom[0], ENT_QUOTES, 'UTF-8') . 
						'<br>' .
						htmlspecialchars($kom[1], ENT_QUOTES, 'UTF-8') . 
						'<br>' .
						htmlspecialchars($kom[2], ENT_QUOTES, 'UTF-8') .
						'<br><br>';			
					$sadrzaj_stranice .= htmlspecialchars($kom[3], ENT_QUOTES, 'UTF-8');
					$sadrzaj_stranice .= '</div>' . '<br>';

					$sadrzaj_stranice .= '<hr>' . '</div>';
					echo html_entity_decode(htmlspecialchars($sadrzaj_stranice, ENT_QUOTES, 'UTF-8'));		
			}
		?>
	</section>
	<script src="javascript/menu.js"></script>
</body>

</html>