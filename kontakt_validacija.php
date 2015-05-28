<?php
	require('phpskripte/validacija.php');
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu()">

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
		<a class="admin" id="adminmenu" onmouseover="PrikaziAdmin()">Admin</a>
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
			<?php
				if($_GLOBALS['validno']) {
					echo '<h3>Provjerite da li ste ispravno popunili kontakt formu</h3>';
					echo '<ul><li class="linkovi">Ime: ' . htmlspecialchars($_GLOBALS['ime'], ENT_QUOTES, 'UTF-8') . '</li><li class="linkovi">Prezime: ' . htmlspecialchars($_GLOBALS['prezime'], ENT_QUOTES, 'UTF-8') .
					'</li><li class="linkovi">Email: ' . htmlspecialchars($_GLOBALS['email'], ENT_QUOTES, 'UTF-8') . '</li><li class="linkovi">URL: ' .
					htmlspecialchars($_GLOBALS['url'], ENT_QUOTES, 'UTF-8') . '</li><li class="linkovi">Poruka: ' . htmlspecialchars($_GLOBALS['poruka'], ENT_QUOTES, 'UTF-8') . '</li></ul>';
					echo '<h4>Da li ste sigurni da želite poslati ove podatke?</h4>';
					echo '<form method="POST" action="slanje_maila.php"><input type="text" name="ime" id="ime" class="nevidljivo" value="' . htmlspecialchars($_GLOBALS['ime'], ENT_QUOTES, 'UTF-8') . '">' .
							'<input type="text" name="prezime" id="prezime" class="nevidljivo" value="' . htmlspecialchars($_GLOBALS['prezime'], ENT_QUOTES, 'UTF-8') . '">' .
							'<input type="email" name="email" id="email" class="nevidljivo" value="' . htmlspecialchars($_GLOBALS['email'], ENT_QUOTES, 'UTF-8') . '">' . 
							'<input type="url" name="url" id="url" class="nevidljivo" value="' . htmlspecialchars($_GLOBALS['url'], ENT_QUOTES, 'UTF-8') . '">' . 
							'<textarea name="poruka" rows="8" cols="1" id="poruka" class="nevidljivo">' . htmlspecialchars($_GLOBALS['poruka'], ENT_QUOTES, 'UTF-8') . '</textarea>' . 
							'<input type="submit" value="Siguran sam" name="Siguran" id="Siguran" class="svi_buttoni"></form>';
					echo '<h4>Ako ste pogrešno popunili formu, možete ispod prepraviti unesene podatke</h4>';
					?>
			<form method="POST" action="kontakt_validacija.php">
					<?php
					echo '<div>
							Ime:<br>
							<input type="text" name="ime" id="ime" value="' . htmlspecialchars($_GLOBALS['ime'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajIme()">
							<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
							<span id="tekst_ime" class="tekst_invisible">Isključivo slova</span>
						</div><br>
						<div>
							Prezime:<br>
							<input type="text" name="prezime" id="prezime" value="' . htmlspecialchars($_GLOBALS['prezime'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajPrezime()">
							<img src="photos/exclamation_point.png" id="uzvicnik_prezime" class="uzvicnik_invisible" alt="uzvicnik">
							<span id="tekst_prezime" class="tekst_invisible">Isključivo slova</span>
						</div><br>
						<div>
							E-mail:<br>
  							<input type="email" name="email" id="email" value="' . htmlspecialchars($_GLOBALS['email'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajEmail()">
  							<img src="photos/exclamation_point.png" id="uzvicnik_email" class="uzvicnik_invisible" alt="uzvicnik">
  							<span id="tekst_email" class="tekst_invisible">Neispravan e-mail</span>
  						</div><br>
  						<div>
  							URL:<br>
  							<input type="url" name="url" id="url" value="' . htmlspecialchars($_GLOBALS['url'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajURL()">
  							<img src="photos/exclamation_point.png" id="uzvicnik_url" class="uzvicnik_invisible" alt="uzvicnik">
  							<span id="tekst_url" class="tekst_invisible">Neispravan URL</span>
  						</div><br>
  						<div>
							Poruka:<br>
							<textarea class="poruka" name="poruka" rows="8" cols="1" id="poruka" onblur="ValidirajPoruku()">' . htmlspecialchars($_GLOBALS['poruka'], ENT_QUOTES, 'UTF-8') . '</textarea>
							<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
							<span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
						</div><br>';
				}

				else {
					echo '<div>
							Ime:<br>
							<input type="text" name="ime" id="ime" value="' . htmlspecialchars($_GLOBALS['ime'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajIme()">
							<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="';
					if ($_GLOBALS['ime_validno']) {
						echo 'uzvicnik_invisible';
					}
					else {
						echo 'uzvicnik';
					}
					echo '" alt="uzvicnik"><span id="tekst_ime" class="';
					if ($_GLOBALS['ime_validno']) {
						echo 'tekst_invisible';
					}
					else {
						echo 'tekst';
					}
					echo '">Isključivo slova</span>
						</div><br>
						<div>
							Prezime:<br>
							<input type="text" name="prezime" id="prezime" value="' . htmlspecialchars($_GLOBALS['prezime'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajPrezime()">
							<img src="photos/exclamation_point.png" id="uzvicnik_prezime" class="';
					if ($_GLOBALS['prezime_validno']) {
						echo 'uzvicnik_invisible';
					}
					else {
						echo 'uzvicnik';
					}
					echo '" alt="uzvicnik"><span id="tekst_prezime" class="';
					if ($_GLOBALS['prezime_validno']) {
						echo 'tekst_invisible';
					}
					else {
						echo 'tekst';
					}
						echo '">Isključivo slova</span>
						</div><br>
						<div>
							E-mail:<br>
  							<input type="email" name="email" id="email" value="' . htmlspecialchars($_GLOBALS['email'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajEmail()">
  							<img src="photos/exclamation_point.png" id="uzvicnik_email" class="';
  					if ($_GLOBALS['email_validno']) {
						echo 'uzvicnik_invisible';
					}
					else {
						echo 'uzvicnik';
					}
					echo '" alt="uzvicnik"><span id="tekst_email" class="';
					if ($_GLOBALS['email_validno']) {
						echo 'tekst_invisible';
					}
					else {
						echo 'tekst';
					}
  						echo '">Neispravan e-mail</span>
  						</div><br>
  						<div>
  							URL:<br>
  							<input type="url" name="url" id="url" value="' . htmlspecialchars($_GLOBALS['url'], ENT_QUOTES, 'UTF-8') . '" onblur="ValidirajURL()">
  							<img src="photos/exclamation_point.png" id="uzvicnik_url" class="';
  					if ($_GLOBALS['url_validno']) {
						echo 'uzvicnik_invisible';
					}
					else {
						echo 'uzvicnik';
					}
					echo '" alt="uzvicnik"><span id="tekst_url" class="';
					if ($_GLOBALS['url_validno']) {
						echo 'tekst_invisible';
					}
					else {
						echo 'tekst';
					}
  						echo '">Neispravan URL</span>
  						</div><br>
  						<div>
							Poruka:<br>
							<textarea class="poruka" name="poruka" rows="8" cols="1" id="poruka" onblur="ValidirajPoruku()">' . htmlspecialchars($_GLOBALS['poruka'], ENT_QUOTES, 'UTF-8') . '</textarea>
							<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="';
					if ($_GLOBALS['poruka_validno']) {
						echo 'uzvicnik_poruka_invisible';
					}
					else {
						echo 'uzvicnik_poruka';
					}
					echo '" alt="uzvicnik"><span id="tekst_poruka" class="';
					if ($_GLOBALS['poruka_validno']) {
						echo 'tekst_poruka_invisible';
					}
					else {
						echo 'tekst_poruka';
					}
						echo '">Morate unijeti poruku</span>
						</div><br>';
				}
			?>
				<input type="submit" value="Pošalji" name="Posalji" id="Posalji" onclick="return ValidirajKontakt()" class="svi_buttoni">
				<input type="button" value="Resetuj" name="Resetuj" id="Resetuj" onclick="ResetujKontakt()" class="svi_buttoni">
		</form>
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

