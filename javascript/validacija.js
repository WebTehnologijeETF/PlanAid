function ValidirajIme() {
	var ime = document.getElementById("ime").value;
	var regex = /^[a-zšđčćž]+$/i;
	if(!regex.test(ime)) {
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
	var regex = /^[a-zšđčćž]+$/i;
	if(!regex.test(prezime)) {
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
	var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	if(!regex.test(email)) {
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

function ValidirajURL() {
	var url = document.getElementById("url").value;
	var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
	if(!regex.test(url)) {
		document.getElementById("uzvicnik_url").className="uzvicnik";
		document.getElementById("tekst_url").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_url").className="uzvicnik_invisible";
		document.getElementById("tekst_url").className="tekst_invisible";
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
	return true;
	return (ValidirajIme() && ValidirajPrezime() && ValidirajEmail()
	 && ValidirajPoruku())
}

function ResetujKontakt() {
    document.getElementById("ime").value = "";
    document.getElementById("prezime").value = "";
    document.getElementById("email").value = "";
    document.getElementById("url").value = "";
    document.getElementById("poruka").value = "";
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
	if(document.getElementById("sifra").value === document.getElementById("sifra_ponovo").value) {
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

var mjestoValidirano = false;
//var stanje = 0;

function ValidirajMjesto() {
	var mjesto = document.getElementById("mjesto").value;
	var opcina = document.getElementById("opcina");
	var opcina_tekst = opcina.options[opcina.selectedIndex].text;
	var rezultat;

	var xmlhttp = new XMLHttpRequest();
	//stanje = 1;    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            rezultat = xmlhttp.responseText;
            if(rezultat.indexOf("greska") > -1) {
				document.getElementById("uzvicnik_mjesto").className="uzvicnik";
				document.getElementById("tekst_mjesto").className="tekst";
				mjestoValidirano = false;
				return false;
			}
			else {
				document.getElementById("uzvicnik_mjesto").className="uzvicnik_invisible";
				document.getElementById("tekst_mjesto").className="tekst_invisible";
				mjestoValidirano = true;
				return true;
			}
        }
        //stanje = 2;
    }
    
    xmlhttp.open('GET', 'http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=' + opcina_tekst + '&mjesto=' + mjesto, true);
    xmlhttp.send();
}

function ValidirajPrijavu() {
	return (ValidirajKorisnickoIme() && ValidirajEmail() && ValidirajSifru()
	 && ValidirajSifruPonovo());
}

function ValidirajImeDesavanja() {
	var ime_desavanja = document.getElementById("ime_desavanja").value;
	if(ime_desavanja.length < 5) {
		document.getElementById("uzvicnik_ime_desavanja").className="uzvicnik";
		document.getElementById("tekst_ime_desavanja").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_ime_desavanja").className="uzvicnik_invisible";
		document.getElementById("tekst_ime_desavanja").className="tekst_invisible";
		return true;
	}
}

function ValidirajOpis() {
	var opis = document.getElementById("opis").value;
	var regex = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})+( \w+)+$/;
	if(!regex.test(opis)) {
		document.getElementById("uzvicnik_opis").className="uzvicnik_poruka";
		document.getElementById("tekst_opis").className="tekst_poruka";
		return false;
	}
	else {
		document.getElementById("uzvicnik_opis").className="uzvicnik_poruka_invisible";
		document.getElementById("tekst_opis").className="tekst_poruka_invisible";
		return true;
	}
}

function ValidirajDesavanje() {
	return (ValidirajImeDesavanja() && ValidirajURL() && ValidirajOpis())
}

function ValidirajAdmin() {
	document.getElementById("adminmenu").className="admin_visible";
}

function ValidirajAutor() {
	var autor = document.getElementById("autor").value;
	if(autor.length < 3) {
		document.getElementById("uzvicnik_autor").className="uzvicnik";
		document.getElementById("tekst_autor").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_autor").className="uzvicnik_invisible";
		document.getElementById("tekst_autor").className="tekst_invisible";
		return true;
	}
}

function ValidirajNaslov() {
	var naslov = document.getElementById("naslov").value;
	if(autor.length < 1) {
		document.getElementById("uzvicnik_naslov").className="uzvicnik";
		document.getElementById("tekst_naslov").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_naslov").className="uzvicnik_invisible";
		document.getElementById("tekst_naslov").className="tekst_invisible";
		return true;
	}
}

function ValidirajSliku() {
	var slika = document.getElementById("slika").value;
	var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
	if(!regex.test(slika)) {
		document.getElementById("uzvicnik_slika").className="uzvicnik";
		document.getElementById("tekst_slika").className="tekst";
		return false;
	}
	else {
		document.getElementById("uzvicnik_slika").className="uzvicnik_invisible";
		document.getElementById("tekst_slika").className="tekst_invisible";
		return true;
	}
}

function ValidirajTekst() {
	var tekst = document.getElementById("tekst").value;
	if(tekst.length < 1) {
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

function ObrisiPolja() {
    if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
        document.getElementById("username_lijevo").value = "";
        document.getElementById("sifra_lijevo").value = "";
    }
}

ObrisiPolja();