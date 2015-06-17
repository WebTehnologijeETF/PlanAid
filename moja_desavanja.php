<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		die("Morate biti logovani.");
	}
?>

<h3>Prikaz Vaših dešavanja</h3>
<form method="PUT">
	<table id="editovanje_desavanja" class="moja_desavanja">
		<tr>
			<td class="red1"></td>
			<td class="red1">Naziv</td>
			<td class="red1">Datum i vrijeme</td>
			<td class="red1">Lokacija</td>
		</tr>
	</table><br>
		<input type="button" value="Izmijeni" name="izmijeni" class="svi_buttoni" onclick="EditujDesavanje()">
</form>
<form method="DELETE">
	<table id="brisanje_desavanja" class="moja_desavanja">
		<tr>
			<td class="red1"></td>
			<td class="red1">Naziv</td>
			<td class="red1">Datum i vrijeme</td>
			<td class="red1">Lokacija</td>
		</tr>
	</table><br>
		<input type="button" value="Obriši" name="obrisi" class="svi_buttoni" onclick="ObrisiDesavanje()">
</form>
<script src="javascript/korisnici.js"></script>