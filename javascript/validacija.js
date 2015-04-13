function ValidirajIme() {
	var ime = document.getElementById("ime").value;
	var regex = /[a-zA-Z]*/;
	if(!regex.test(ime) || ime.length === 0) {
		document.getElementById("uzvicnik_ime").className="uzvicnik";
		document.getElementById("tekst_ime").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_ime").className="uzvicnik_invisible";
		document.getElementById("tekst_ime").className="tekst_invisible";
		return true;
	}
}

function ValidirajPrezime() {
	var prezime = document.getElementById("prezime").value;
	var regex = /[a-zA-Z]*/;
	if(!regex.test(prezime) || prezime.length === 0) {
		document.getElementById("uzvicnik_prezime").className="uzvicnik";
		document.getElementById("tekst_prezime").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_prezime").className="uzvicnik_invisible";
		document.getElementById("tekst_prezime").className="tekst_invisible";
		return true;
	}
}

function ValidirajEmail() {
	var email = document.getElementById("email").value;
	if(email.length === 0) {
		document.getElementById("uzvicnik_email").className="uzvicnik";
		document.getElementById("tekst_email").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_email").className="uzvicnik_invisible";
		document.getElementById("tekst_email").className="tekst_invisible";
		return true;
	}
}

function ValidirajPoruku() {
	var poruka = document.getElementById("poruka").value;
	if(poruka.length === 0) {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka";
		document.getElementById("tekst_poruka").className="tekst_poruka";
		return false;
	}
	else {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka_invisible";
		document.getElementById("tekst_poruka").className="tekst_poruka_invisible";
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
		document.getElementById("uzvicnik_korisnicko_ime").className="uzvicnik";
		document.getElementById("tekst_korisnicko_ime").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_korisnicko_ime").className="uzvicnik_invisible";
		document.getElementById("tekst_korisnicko_ime").className="tekst_invisible";
		return true;
	}
}

function ValidirajSifru() {
	var sifra = document.getElementById("sifra").value;
	if(sifra.length < 6) {
		document.getElementById("uzvicnik_sifra").className="uzvicnik";
		document.getElementById("tekst_sifra").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_sifra").className="uzvicnik_invisible";
		document.getElementById("tekst_sifra").className="tekst_invisible";
		return true;
	}
}

function ValidirajSifruPonovo() {
	var sifra_ponovo = document.getElementById("sifra_ponovo").value;
	if(document.getElementById("sifra") === document.getElementById("sifra_ponovo")) {
		document.getElementById("uzvicnik_sifra_ponovo").className="uzvicnik_invisible";
		document.getElementById("tekst_sifra_ponovo").className="tekst_invisible";
		return true;
	}
	else {
		document.getElementById("uzvicnik_sifra_ponovo").className="uzvicnik";
		document.getElementById("tekst_sifra_ponovo").className="tekst";
		return false;
	}
}

function ValidirajPrijavu() {
	return (ValidirajKorisnickoIme() && ValidirajEmail() && ValidirajSifru()
	 && ValidirajSifruPonovo())
}