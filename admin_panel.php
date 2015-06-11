<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		die("Istekla je sesija. Logujte se ponovo.");
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
	<body>
		<img src="photos/bullet.png" alt="slika" 
     onload="PrikaziVijestiAdmin();this.parentNode.removeChild(this);" />
		<h3>Novosti</h3>
		<form method="POST">
		<div>
			Autor:<br>
			<input type="text" name="autor" id="autor" onblur="ValidirajAutor()">
			<img src="photos/exclamation_point.png" id="uzvicnik_autor" class="uzvicnik_invisible" alt="uzvicnik">
			<span id="tekst_autor" class="tekst_invisible">Minimalno 3 karaktera</span>
		</div><br>
		<div>
			Naslov:<br>
			<input type="text" name="naslov" id="naslov" onblur="ValidirajNaslov()">
			<img src="photos/exclamation_point.png" id="uzvicnik_naslov" class="uzvicnik_invisible" alt="uzvicnik">
			<span id="tekst_naslov" class="tekst_invisible">Morate unijeti naslov</span>
		</div><br>
		<div>
			Slika:<br>
			<input type="url" name="slika" id="slika" onblur="ValidirajSliku()">
			<img src="photos/exclamation_point.png" id="uzvicnik_slika" class="uzvicnik_invisible" alt="uzvicnik">
			<span id="tekst_slika" class="tekst_invisible">Morate unijeti url slike</span>
		</div><br>
		<div>
			Tekst:<br>
				<textarea class="poruka" name="tekst" rows="8" cols="1" id="tekst" onblur="ValidirajTekst()"></textarea>
			<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
			<span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
			</div><br>
			<div>
				Detaljnije:<br>
				<textarea class="poruka" name="detaljnije" rows="8" cols="1" id="detaljnije"></textarea>
			</div><br>
				<input type="button" value="Dodaj" name="dodaj" class="svi_buttoni" onclick="DodajVijest()"></form>
			<form method="PUT">
			<table id="editovanje_vijesti" class="moja_desavanja">
				<tr>
					<td class="red1"></td>
					<td class="red1">Autor</td>
					<td class="red1">Naslov</td>
					<td class="red1">Slika</td>
					<td class="red1">Tekst</td>
					<td class="red1">Detaljnije</td>
				</tr>
			</table><br>
				<input type="button" value="Izmijeni" name="izmijeni" class="svi_buttoni" onclick="EditujVijest()">
			</form>
			<form method="DELETE">
			<table id="brisanje_vijesti" class="moja_desavanja">
				<tr>
					<td class="red1"></td>
					<td class="red1">Datum</td>
					<td class="red1">Autor</td>
					<td class="red1">Naslov</td>
				</tr>
			</table><br>
				<input type="button" value="Obriši" name="obrisi" class="svi_buttoni" onclick="ObrisiVijest()">
		</form>
	</body>
	<script src="javascript/vijesti_admin.js"></script>
</html>