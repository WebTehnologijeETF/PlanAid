<form method="POST" action="provjeri_podatke.php">
	<h3>Već ste član? Prijavite se!</h3>
	<div>
		Korisničko ime:<br>
		<input type="text" name="korisnicko_ime" id="korisnicko_ime" value="admin" onblur="ValidirajKorisnickoIme()">
		<img src="photos/exclamation_point.png" id="uzvicnik_korisnicko_ime" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_korisnicko_ime" class="tekst_invisible">Minimalno 5 karaktera</span>
	</div><br>
  	<div>
		Šifra:<br>
		<input type="password" name="sifra" id="sifra" value="adminpass" onblur="ValidirajSifru()">
		<img src="photos/exclamation_point.png" id="uzvicnik_sifra" class="uzvicnik_invisible" alt="uzvicnik">
		<span id="tekst_sifra" class="tekst_invisible">Minimalno 6 karaktera!</span>
	</div><br>
		<input type="submit" value="Pošalji" name="submit" id="submit" onclick="ValidirajAdmin()" class="svi_buttoni"></form>
		<form><br><input type="submit" value="Zaboravljena šifra" name="submit" id="submit" class="svi_buttoni"></form>