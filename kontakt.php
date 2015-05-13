<form method="POST" action="kontakt_validacija.php">
	<h3>Imate neko pitanje? Kontaktirajte nas!</h3>
	<div>
		Ime:<br>
		<input type="text" name="ime" id="ime" onblur="ValidirajIme()">
		<img src="photos/exclamation_point.png" id="uzvicnik_ime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_ime" class="tekst_invisible">Isključivo slova</span>
	</div><br>
	<div>
		Prezime:<br>
		<input type="text" name="prezime" id="prezime" onblur="ValidirajPrezime()">
		<img src="photos/exclamation_point.png" id="uzvicnik_prezime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_prezime" class="tekst_invisible">Isključivo slova</span>
	</div><br>
	<div>
		E-mail:<br>
  		<input type="email" name="email" id="email" onblur="ValidirajEmail()">
  		<img src="photos/exclamation_point.png" id="uzvicnik_email" class="uzvicnik_invisible" alt="uzvicnik">
  		<span id="tekst_email" class="tekst_invisible">Neispravan e-mail</span>
  	</div><br>
  	<div>
  		URL:<br>
  		<input type="url" name="url" id="url" onblur="ValidirajURL()">
  		<img src="photos/exclamation_point.png" id="uzvicnik_url" class="uzvicnik_invisible" alt="uzvicnik">
  		<span id="tekst_url" class="tekst_invisible">Neispravan URL</span>
  	</div><br>
  	<div>
		Poruka:<br>
		<textarea class="poruka" name="poruka" rows="8" cols="1" id="poruka" onblur="ValidirajPoruku()"></textarea>
		<img src="photos/exclamation_point.png" id="uzvicnik_poruka" class="uzvicnik_poruka_invisible" alt="uzvicnik">
		<span id="tekst_poruka" class="tekst_poruka_invisible">Morate unijeti poruku</span>
	</div><br>
		<input type="submit" value="Pošalji" name="Posalji" id="Posalji" onclick="return ValidirajKontakt()" class="svi_buttoni">
		<input type="button" value="Resetuj" name="Resetuj" id="Resetuj" onclick="ResetujKontakt()" class="svi_buttoni">
</form>