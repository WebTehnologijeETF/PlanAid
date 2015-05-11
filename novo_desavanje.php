<form>
	<h3>Dodajte novo dešavanje</h3>
	<div>
		Ime:<br>
		<input type="text" name="ime_desavanja" id="ime_desavanja" onblur="ValidirajImeDesavanja()">
		<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_ime_desavanja" class="tekst_invisible">Isključivo slova</span>
	</div><br>
	<div>
  		URL slike:<br>
  		<input type="url" name="url" id="url" onblur="ValidirajURL()">
  		<img src="photos/exclamation_point.png" id="uzvicnik_url" class="uzvicnik_invisible" alt="uzvicnik">
  		<span id="tekst_url" class="tekst_invisible">Neispravan URL</span>
  	</div><br>
  	<div>
		Datum i lokacija:<br>
		<textarea class="poruka" name="opis" rows="8" cols="1" id="opis" onblur="ValidirajOpis()"></textarea>
		<img src="photos/exclamation_point.png" id="uzvicnik_opis" class="uzvicnik_poruka_invisible" alt="uzvicnik">
		<span id="tekst_opis" class="tekst_poruka_invisible">Morate unijeti opis</span>
	</div><br>
		<input type="button" value="Pošalji" name="button" id="dodaj" onclick="Posalji()">
</form>