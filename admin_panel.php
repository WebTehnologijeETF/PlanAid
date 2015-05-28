<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		die("Niste ulogovani kao admin");
	}
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu();
	<?php
		if(isset($_GET['poruka'])) {
		echo "alert('" . $_GET['poruka'] . "');";
	}
	?>
">

	<header class="logo">
		<img src="photos/logo.png" class="logo-image" alt="logo">
		<a href="index.php" class="logo-text">PlanAid</a>
	</header>
	
	<nav class="menu">
		<a class="kursor" onmouseover="PrikaziNaslovnicu()">Naslovnica</a>
		<a class="kursor" onmouseover="PrikaziDesavanja()">Dešavanja</a>
		<a class="kursor" onmouseover="PrikaziLokacije()">Lokacije</a>
		<a class="kursor" onmouseover="PrikaziPrijavu()">Prijava</a>
		<a onclick="PrikaziStranicu('kontakt')" onmouseover="SakrijSubmenu()">Kontakt</a>
		<a class="admin_visible" id="adminmenu" onmouseover="PrikaziAdmin()">Admin</a>
	</nav>

<section>
	<div id="submenu_naslovnica" class="submenu_invisible">
		<a onclick="PrikaziStranicu('naslovnica_novevijesti')">Najnovije vijesti</a>
		<a onclick="PrikaziStranicu('naslovnica_najcitanije')">Najčitanije vijesti</a>
		<a onclick="PrikaziStranicu('naslovnica_svevijesti')">Sve vijesti</a>
	</div>

	<div id="submenu_desavanja" class="submenu_invisible">
		<a onclick="PrikaziStranicu('kalendar')">Pregled kalendara</a>
		<a onclick="PrikaziStranicu('novo_desavanje')">Novo dešavanje</a>
		<a onclick="PrikaziStranicu('moja_desavanja')">Moja dešavanja</a>
	</div>

	<div id="submenu_lokacije" class="submenu_invisible">
		<a onclick="PrikaziStranicu('linkovi')">Sarajevo</a>
		<a onclick="PrikaziStranicu('linkovi_zenica')">Zenica</a>
		<a onclick="PrikaziStranicu('linkovi_mostar')">Mostar</a>
	</div>

	<div id="submenu_prijava" class="submenu_invisible">
		<a onclick="PrikaziStranicu('login')">Login</a>
		<a onclick="PrikaziStranicu('registracija')">Registracija</a>
	</div>

	<div id="submenu_admin" class="submenu_invisible">
		<a onclick="PrikaziStranicu('admin_novosti')">Novosti</a>
		<a onclick="PrikaziStranicu('brisanje_komentara')">Komentari</a>
		<a onclick="PrikaziStranicu('korisnici')">Korisnici</a>
	</div>
	
	<section id="glavni">
		<h3>Novosti</h3>
		<?php
		header('Content-Type: text/html; charset=UTF-8');
		$ime_servera = "localhost";
		$usrnm = "zloco";
		$password = "wtplanaid";
		$ime_baze = "planaid";

		try {
		    $konekcija = new PDO("mysql:host=$ime_servera;dbname=$ime_baze", $usrnm, $password);
		    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
	    	echo "Error: " . $e->getMessage();
		}

		$nove_vijesti = array();

		$upit1 = 'SELECT datum, autor, naslov, slika, tekst, detaljnije, id
			    	FROM novosti
			    	WHERE vrsta_novosti = :vrsta_novosti';
		$statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement1->execute(array(':vrsta_novosti' => 'nove_vijesti'));
		$nove_vijesti = $statement1->fetchAll();

		echo '<form method="POST" action="dodaj_vijest.php">
		<div>
		Autor:<br>
		<input type="text" name="autor" id="autor" onblur="ValidirajIme()">
		<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_ime" class="tekst_invisible">Isključivo slova</span>
			</div><br>
		<div>
			Naslov:<br>
			<input type="text" name="naslov" id="naslov" onblur="ValidirajPoruku()">
			<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
			<span id="tekst_ime" class="tekst_invisible">Morate unijeti naslov</span>
		</div><br>
		<div>
			Slika:<br>
			<input type="url" name="slika" id="slika" onblur="ValidirajPoruku()">
			<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
			<span id="tekst_ime" class="tekst_invisible">Morate unijeti url slike</span>
		</div><br>
		<div>
			Tekst:<br>
	  		<textarea class="poruka" name="tekst" rows="8" cols="1" id="tekst" onblur="ValidirajPoruku()"></textarea>
			<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
			<span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
	  	</div><br>
	  	<div>
	  		Detaljnije:<br>
	  		<textarea class="poruka" name="detaljnije" rows="8" cols="1" id="detaljnije" onblur="ValidirajPoruku()"></textarea>
			<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
			<span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
	  	</div><br>
	  		<input type="submit" value="Dodaj" name="dodaj" class="svi_buttoni"></form>
			<form method="POST" action="admin_panel.php">
			<table id="moja_desavanja" class="moja_desavanja">
				<tr>
					<td class="red1"></td>
					<td class="red1">Datum</td>
					<td class="red1">Autor</td>
					<td class="red1">Naslov</td>
				</tr>';
				foreach($nove_vijesti as $vijest) {
					$datetime = new DateTime($vijest['datum']);
					$datum = $datetime->format('d.m.y H:i:s');
					echo '<tr><td><input type="radio" name="radio" value="' .
							htmlspecialchars($vijest['id'], ENT_QUOTES, 'UTF-8') . '" checked="checked"></td><td>' .
							htmlspecialchars($datum, ENT_QUOTES, 'UTF-8') . '</td><td>' .
							htmlspecialchars($vijest['autor'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
							htmlspecialchars($vijest['naslov'], ENT_QUOTES, 'UTF-8') . '</td></tr>
							<input type="hidden" name="id_vijesti" value="' . $vijest['id'] . '">';
				}
			echo '</table><br>
				<input type="submit" value="Izmijeni" name="izmijeni" class="svi_buttoni"></form>
			<form method="POST" action="izmijeni_vijest.php">
			<table id="moja_desavanja" class="moja_desavanja">
				<tr>
					<td class="red1"></td>
					<td class="red1">Datum</td>
					<td class="red1">Autor</td>
					<td class="red1">Naslov</td>
				</tr>';
				foreach($nove_vijesti as $vijest) {
					$datetime = new DateTime($vijest['datum']);
					$datum = $datetime->format('d.m.y H:i:s');
					echo '<tr><td><input type="radio" name="radio" checked="checked"></td><td>' .
							htmlspecialchars($datum, ENT_QUOTES, 'UTF-8') . '</td><td>' .
							htmlspecialchars($vijest['autor'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
							htmlspecialchars($vijest['naslov'], ENT_QUOTES, 'UTF-8') . '</td></tr>';
				}
			echo '</table><br>
				<input type="submit" value="Obriši" name="obrisi" class="svi_buttoni">
		</form>';
		?>
	</section>
		
	<aside class="reklame">
		<aside class="reklame-body">
			Generalni sponzori<br><br>
			<a href="http://www.klix.ba" target="_blank">
				<img src="photos/klix.png" alt="klix">
			</a>
			<a href="http://www.tuborg.com/gl/en/" target="_blank">
				<img src="photos/tuborg.png" alt="tuborg">
			</a>
		</aside>
	</aside>
</section>
	<script src="javascript/menu.js"></script>
	<script src="javascript/validacija.js"></script>
</body>

</html>

