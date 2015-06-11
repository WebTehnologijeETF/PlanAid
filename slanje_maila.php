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
		<a onclick="PrikaziStranicu('registracija')">Registracija</a>
	</div>

	<div id="submenu_admin" class="submenu_invisible">
		<a href="PrikaziStranicu('admin_panel')">Novosti</a>
		<a href="prikazi_komentare.php">Komentari</a>
		<a href="korisnici.php">Korisnici</a>
	</div>
	
	<section id="glavni">
			<?php
				require('sendgrid-php/sendgrid-php.php');
				ini_set('display_errors', 'On');
				error_reporting(E_ALL);
				if($_POST) {

						$eol = PHP_EOL;
						$message = 'Ime i prezime: ' . $_GLOBALS['ime'] . ' ' . $_GLOBALS['prezime'] . "\r\n" . 'Email: ' . $_GLOBALS['email'] . "\r\n" . 'URL: ' . $_GLOBALS['url'] . "\r\n" . "\r\n" . "\r\n" . $_GLOBALS['poruka'];
                        

						$service_plan_id = "sendgrid_e2d43"; // your OpenShift Service Plan ID
						$account_info = json_decode(getenv($service_plan_id), true);

						$sendgrid = new SendGrid($account_info['username'], $account_info['password']);
						$email    = new SendGrid\Email();

						$email->addTo("aploco1@etf.unsa.ba")
							  ->addCc("vljubovic@etf.unsa.ba")
						      ->setReplyTo($_GLOBALS['email'])
						      ->setFrom($_GLOBALS['email'])
						      ->setSubject("Kontakt forma")
						      ->setText($message);

						try
						{
							$sendgrid->send($email);
							echo '<script>alert("Zahvaljujemo se što ste nas kontaktirali!");</script>';
							header("location: ../index.php");
						}
						catch (\SendGrid\Exception $e)
						{
							echo $e->getCode();
						    foreach($e->getErrors() as $er) {
						        echo $er;
    						}
						}
				}
			?>
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

