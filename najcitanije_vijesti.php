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

			$vijesti = array();			
			$lista_vijesti = array();

			$upit = 'SELECT datum, autor, naslov, slika, tekst, detaljnije, id
			    	FROM novosti
			    	WHERE vrsta_novosti = :vrsta_novosti';
			$statement = $konekcija->prepare($upit, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement->execute(array(':vrsta_novosti' => 'najcitanije_vijesti'));
			$vijesti = $statement->fetchAll();
			
			usort ($vijesti, function($a, $b) { 	
						$datum1 = date('Y-m-d H:i:s', strtotime($a[0]));
						$datum2 = date('Y-m-d H:i:s', strtotime($b[0]));
						return $datum1 < $datum2;
					});
			foreach ($vijesti as $news) {
				$sadrzaj_stranice = '<br><div>';
					if($news[3] != "") {
						$sadrzaj_stranice .= '<div class="frejm-image">' .
						'<table class="frejm-image">' .
						'<tr>' . 
							'<td class="frejm-image">' .
								'<img src="' . htmlspecialchars($news[3], ENT_QUOTES, 'UTF-8') . '" class="frejm-image" alt="slika">' .
							'</td>' .
						'</tr>' .
						'</table>' .
						'</div>';
					}
					else {
						$sadrzaj_stranice .= '<div class="frejm-image">' .
						'<table class="frejm-image">' .
						'<tr>' . 
							'<td class="frejm-image">' .
								'<img src="../photos/noimage.gif" class="frejm-image" alt="slika">' .
							'</td>' .
						'</tr>' .
						'</table>' .
						'</div>';
					}
					$sadrzaj_stranice .= '<div class="frejm-text">' . 
						htmlspecialchars($news[0], ENT_QUOTES, 'UTF-8') . 
						'<br>' .
						htmlspecialchars($news[1], ENT_QUOTES, 'UTF-8') . 
						'<br><br>' .
						htmlspecialchars(strtoupper(substr($news[2], 0, 1)) . strtolower(substr($news[2], 1)), ENT_QUOTES, 'UTF-8') . 
						'<br><br>';				
					$sadrzaj_stranice .= htmlspecialchars($news[4], ENT_QUOTES, 'UTF-8');				
					if ($news[5] !== '') {	
						$ime_detalji = 'phpskripte/novosti/najcitanije_vijesti/detalji/' .
							$news[2];
						$sadrzaj_fajla_detalji = $sadrzaj_stranice;					
						$sadrzaj_stranice .= ' <a class="frejm" onclick="PrikaziStranicu(\'' . $ime_detalji . '\', 1)">' . ' Detaljnije...' . '</a>';
						$detalji = $news[5];		
						$sadrzaj_fajla_detalji .= $detalji;	
						try {
							$konekcija = new PDO("mysql:dbname=" . $ime_baze . ";host=" . $ime_servera, $username, $sifra);
							$konekcija->exec('set names utf8');
						}
						catch (PDOException $e) {
							echo "Greska! : " . $e->getMessage() . "<br>";
							die();
						}

						$upit = 'SELECT *
			    		FROM komentari
			    		WHERE id = :id';
						$statement = $konekcija->prepare($upit, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
						$statement->execute(array(':id'=>$news[6]));
						$komentari = $statement->fetchAll();
						$brojac = count($komentari);
						$sadrzaj_fajla_detalji .= '<br><br><form method="get" action="/PlanAid/komentari2.php"><input type="hidden" name="idVijesti" value="' .
						$news[6] . '"><input type="submit" value="' . $brojac . ' Komentara' . '" name="komentari" id="komentari" class="svi_buttoni"></form>';
						$sadrzaj_fajla_detalji .= '<br><br><form method="get" action="/PlanAid/napisi_komentar.php">' . 
						'Ime:<br><input type="text" name="imeKomentar"><br><br>Email:<br><input type="text" name="emailKomentar"><br><br>' . 
						'<textarea class="komentar" name="komentar" rows="8" cols="1" id="komentar"></textarea><br><br>' .
						'<input type="hidden" name="idVijesti" value="' . $news[6] . '">' .
						'<input type="submit" value="Komentariši" name="komentarisi" id="Komentarisi" class="svi_buttoni"></form>';
						$sadrzaj_fajla_detalji .= '</div>' . '</div>';
						$fajl_detalji = fopen($ime_detalji . '.php', 'w+');
						fwrite($fajl_detalji, $sadrzaj_fajla_detalji);
					}	
					$sadrzaj_stranice .= '</div>' . '<br>' . 
							'<hr>' .
							'</div>';
					echo html_entity_decode(htmlspecialchars($sadrzaj_stranice, ENT_QUOTES, 'UTF-8'));		
			}
		?>
	</section>
	<script src="javascript/menu.js"></script>
</body>

</html>

