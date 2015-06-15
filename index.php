<?php
	session_start();
	if(isset($_SESSION['username'])) {
		echo '<div id="sesija" class="nevidljivo">' . $_SESSION['username'] .'</div>';
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

<body onload="Pokreni()">

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

<div>
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
		<a onclick="PrikaziStranicu('registracija')">Registracija</a>
	</div>

	<div id="submenu_admin" class="submenu_invisible">
		<a onclick="PrikaziStranicu('admin_panel')">Novosti</a>
		<a onclick="PrikaziStranicu('prikazi_komentare')">Komentari</a>
		<a onclick="PrikaziStranicu('korisnici')">Korisnici</a>
	</div>

	<aside id="nije_ulogovan" class="login">
		<aside class="login-body">
			<form method="GET"><br>
				<h4>Korisničko ime:</h4>
				<input type="text" id="username_lijevo" name="username_lijevo"><br>
				<br><h4>Šifra:</h4>
				<input type="password" id="sifra_lijevo" name="sifra_lijevo"><br><br>
				<input type="button" id="login_lijevo" name="login_lijevo" class="svi_buttoni"
				value="Pošalji" onclick="ProvjeriPodatke()">
			</form>
		</aside>
	</aside>

	<aside id="ulogovan" class="ulogovan_invisible">
		<aside class="ulogovan-body">
			<form method="GET"><br>
				<h4>Korisničko ime:</h4><br>
				<div id="korisnicko_ime_lijevo"></div><br><br>
				<input type="button" id="logout_lijevo" name="logout_lijevo" class="svi_buttoni"
				value="Odjava" onclick="Odjava()">
			</form>
		</aside>
	</aside>
	
	<section id="glavni">
		<iframe id="frejm" src="nove_vijesti.php" class="frejm"></iframe>
	</section>
		
	<aside class="reklame">
		<aside class="reklame-body">
			<h3>Generalni sponzori</h3>
			<a href="http://www.klix.ba" target="_blank">
				<img src="photos/klix.png" alt="klix">
			</a>
			<a href="http://www.tuborg.com/gl/en/" target="_blank">
				<img src="photos/tuborg.png" alt="tuborg">
			</a>
		</aside>
	</aside>
</div>
	<script src="javascript/menu.js"></script>
	<script src="javascript/validacija.js"></script>
	<script src="javascript/vijesti.js"></script>
	<script src="javascript/korisnici_login.js"></script>	
	<script src="javascript/korisnici.js"></script>
	<script src="javascript/vijesti_admin.js"></script>
	<script src="javascript/komentari.js"></script>
</body>

</html>