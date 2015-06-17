<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		die("Morate biti logovani.");
	}
?>

<h3>Dodajte novo dešavanje</h3>
<form>
	<div>
		Naziv:<br>
		<input type="text" name="naziv_desavanja" id="naziv_desavanja" onblur="ValidirajNazivDesavanja()">
		<img src="photos/exclamation_point.png" id="uzvicnik_naziv_desavanja" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_naziv_desavanja" class="tekst_invisible">Minimalno 5 karaktera</span>
	</div><br>
	<div>
		Datum:<br>
		<input type="text" name="datum_desavanja" id="datum_desavanja" onblur="ValidirajDatumDesavanja()">
		<img src="photos/exclamation_point.png" id="uzvicnik_datum_desavanja" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_datum_desavanja" class="tekst_invisible">yyyy-mm-dd HH:mm:ss</span>
	</div><br>
  	<div>
		Lokacija:<br>
		<input type="text" name="lokacija_desavanja" id="lokacija_desavanja" onblur="ValidirajLokacijaDesavanja()">
		<img src="photos/exclamation_point.png" id="uzvicnik_lokacija_desavanja" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_lokacija_desavanja" class="tekst_invisible">Minimalno 5 karaktera</span>
	</div><br>
		<input type="button" value="Pošalji" name="button" id="dodaj" onclick="DodajDesavanje()" class="svi_buttoni">
</form>
<script src="javascript/korisnici.js"></script>