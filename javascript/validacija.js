function ValidirajIme() {
	var ime = document.getElementById("ime").value;
	var regex = /[A-Z][a-zA-Z]*/;
	if(!regex.test(ime)) {
		document.getElementById("uzvicnik_ime").className="uzvicnik_ime";
		return false;
	}
	else {
		document.getElementById("uzvicnik_ime").className="uzvicnik_ime_invisible";
		return true;
	}
}

function ValidirajPrezime() {
	var prezime = document.getElementById("prezime").value;
	var regex = /[A-Z][a-zA-Z]*/;
	if(!regex.test(prezime)) {
		document.getElementById("uzvicnik_prezime").className="uzvicnik_prezime";
		return false;
	}
	else {
		document.getElementById("uzvicnik_prezime").className="uzvicnik_prezime_invisible";
		return true;
	}
}

function ValidirajEmail() {
	var email = document.getElementById("email").value;
	if(email.length <= 0) {
		document.getElementById("uzvicnik_email").className="uzvicnik_email";
		return false;
	}
	else {
		document.getElementById("uzvicnik_email").className="uzvicnik_email_invisible";
		return true;
	}
}

function ValidirajPoruku() {
	var poruka = document.getElementById("poruka").value;
	if(poruka.length <= 0) {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka";
		return false;
	}
	else {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka_invisible";
		return true;
	}
}

function ValidirajKontakt() {
	return (ValidirajIme() && ValidirajPrezime() && ValidirajEmail()
	 && ValidirajPoruku())
}

function ValidirajKorisnickoIme() {
	var korisnicko_ime = document.getElementById("korisnicko_ime").value;
	if(korisnicko_ime.length < 5) {
		document.getElementById("uzvicnik_korisnicko_ime").className="uzvicnik_korisnicko_ime";
		return false;
	}
	else {
		document.getElementById("uzvicnik_korisnicko_ime").className="uzvicnik_korisnicko_ime_invisible";
		return true;
	}
}

function ValidirajSifru() {
	var sifra = document.getElementById("sifra").value;
	if(sifra.length < 6) {
		document.getElementById("uzvicnik_sifra").className="uzvicnik_sifra";
		return false;
	}
	else {
		document.getElementById("uzvicnik_sifra").className="uzvicnik_sifra_invisible";
		return true;
	}
}

function ValidirajSifruPonovo() {
	var sifra_ponovo = document.getElementById("sifra_ponovo").value;
	if(sifra_ponovo.length < 6) {
		document.getElementById("uzvicnik_sifra_ponovo").className="uzvicnik_sifra_ponovo";
		return false;
	}
	else {
		if(document.getElementById("sifra") === document.getElementById("sifra_ponovo")) {
			document.getElementById("uzvicnik_sifra_ponovo").className="uzvicnik_sifra_ponovo_invisible";
			return true;
		}
		else {
			document.getElementById("uzvicnik_sifra_ponovo").className="uzvicnik_sifra_ponovo";
			return false;
		}
	}
}

function ValidirajPrijavu() {
	return (ValidirajKorisnickoIme() && ValidirajEmail() && ValidirajSifru()
	 && ValidirajSifruPonovo())
}