<h3>Prikaz Vaših dešavanja</h3>
<form>
	<input type="button" value="Povuci sa servera" name="button" onclick="PovuciSaServera()" class="svi_buttoni">
	<table id="moja_desavanja" class="moja_desavanja">
		<tr>
			<td class="red1"></td>
			<td class="red1">Ime dešavanja</td>
			<td class="red1">Slika dešavanja</td>
			<td class="red1">Datum i lokacija</td>
		</tr>
	</table><br>
		<input type="button" value="Izmijeni" name="button" onclick="LoadIzmijeni()" class="svi_buttoni">
		<input type="button" value="Obriši" name="button" onclick="Obrisi()" class="svi_buttoni">
</form>