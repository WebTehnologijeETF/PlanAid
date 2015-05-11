<form onsubmit="return ValidirajPrijavu()">
	<h3>Postanite novi član!</h3>
	<div>
		Korisničko ime:<br>
		<input type="text" name="korisnicko_ime" id="korisnicko_ime" onblur="ValidirajKorisnickoIme()">
		<img src="photos/exclamation_point.png" id="uzvicnik_korisnicko_ime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_korisnicko_ime" class="tekst_invisible">Minimalno 5 karaktera</span>
	</div><br>
	<div>
		E-mail:<br>
  		<input type="email" name="email" id="email" onblur="ValidirajEmail()">
  		<img src="photos/exclamation_point.png" id="uzvicnik_email" class="uzvicnik_invisible" alt="uzvicnik">
  		<span id="tekst_email" class="tekst_invisible">Niste unijeli e-mail</span>
  	</div><br>
  	<div>
		Unesite šifru:<br>
		<input type="password" name="sifra" id="sifra" onblur="ValidirajSifru()">
		<img src="photos/exclamation_point.png" id="uzvicnik_sifra" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_sifra" class="tekst_invisible">Minimalno 6 karaktera!</span>
	</div><br>
	<div>
		Ponovite šifru:<br>
		<input type="password" name="sifra_ponovo" id="sifra_ponovo" onblur="ValidirajSifruPonovo()">
		<img src="photos/exclamation_point.png" id="uzvicnik_sifra_ponovo" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_sifra_ponovo" class="tekst_invisible">Neispravan unos</span>
	</div><br>
	<div>
		Općina:<br>
		<select id="opcina">
  			<option value="Ilidza">Ilidža</option>
 			<option value="Centar">Centar</option>
  			<option value="NoviGrad">Novi Grad</option>
  			<option value="StariGrad">Stari Grad</option>
		</select>
	</div><br>
	<div>
		Mjesto:<br>
		<input type="text" name="mjesto" id="mjesto" onblur="ValidirajMjesto()">
		<img src="photos/exclamation_point.png" id="uzvicnik_mjesto" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_mjesto" class="tekst_invisible">Greška!</span>
	</div><br>
		<input type="submit" value="Pošalji" name="submit" id="submit" onclick="return ValidirajPrijavu()">
</form>