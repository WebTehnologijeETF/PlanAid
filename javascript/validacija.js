var ime_v = false;
var prezime_v = false;
var email_v = false;
var url_v = false;
var poruka_v = false;
var validiranok = false;

function ValidirajIme() {
	var ime = document.getElementById("ime").value;
	var regex = /^[a-zšđčćž]+$/i;
	if(!regex.test(ime)) {
		document.getElementById("uzvicnik_ime").className="uzvicnik";
		document.getElementById("tekst_ime").className="tekst";
		ime_v = false;
	}
	else {
		document.getElementById("uzvicnik_ime").className="uzvicnik_invisible";
		document.getElementById("tekst_ime").className="tekst_invisible";
		ime_v = true;
		ValidirajKontakt();
	}
}

function ValidirajPrezime() {
	var prezime = document.getElementById("prezime").value;
	var regex = /^[a-zšđčćž]+$/i;
	if(!regex.test(prezime)) {
		document.getElementById("uzvicnik_prezime").className="uzvicnik";
		document.getElementById("tekst_prezime").className="tekst";
		prezime_v = false;
	}
	else {
		document.getElementById("uzvicnik_prezime").className="uzvicnik_invisible";
		document.getElementById("tekst_prezime").className="tekst_invisible";
		prezime_v = true;
		ValidirajKontakt();
	}
}

function ValidirajEmail() {
	var email = document.getElementById("email").value;
	var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	if(!regex.test(email)) {
		document.getElementById("uzvicnik_email").className="uzvicnik";
		document.getElementById("tekst_email").className="tekst";
		email_v = false;
	}
	else {
		document.getElementById("uzvicnik_email").className="uzvicnik_invisible";
		document.getElementById("tekst_email").className="tekst_invisible";
		email_v = true;
		ValidirajKontakt();
	}
}

function ValidirajURL() {
	var url = document.getElementById("url").value;
	var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
	if(!regex.test(url) && url.length !== 0) {
		document.getElementById("uzvicnik_url").className="uzvicnik";
		document.getElementById("tekst_url").className="tekst";
		url_v = false;
	}
	else {
		document.getElementById("uzvicnik_url").className="uzvicnik_invisible";
		document.getElementById("tekst_url").className="tekst_invisible";
		url_v = true;
		ValidirajKontakt();
	}
}

function ValidirajPoruku() {
	var poruka = document.getElementById("poruka").value;
	if(poruka.length === 0) {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka";
		document.getElementById("tekst_poruka").className="tekst_poruka";
		poruka_v = false;
	}
	else {
		document.getElementById("uzvicnik_poruka").className="uzvicnik_poruka_invisible";
		document.getElementById("tekst_poruka").className="tekst_poruka_invisible";
		poruka_v = true;
		ValidirajKontakt();
	}
}

function ValidirajKontakt() {
	if(ime_v && prezime_v && email_v && url_v && poruka_v) {
		validiranok = true;
	}
	else {
		validiranok = false;
	}
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

function ValidirajPrijavu() {
	return (ValidirajKorisnickoIme() && ValidirajEmail() && ValidirajSifru()
	 && ValidirajSifruPonovo());
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

function PosaljiMail() {
	if(validiranok) {
		var ime = document.getElementById("ime").value;
		var prezime = document.getElementById("prezime").value;
		var email = document.getElementById("email").value;
		var url = document.getElementById("url").value;
		var poruka = document.getElementById("poruka").value;

		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	        	console.log(xmlhttp);
	            alert("Zahvaljujemo se što ste nas kontaktirali!");
	        }
	    };

	    xmlhttp.open('POST', 'servis/mail_rest.php', true);
	    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	    xmlhttp.send('ime='+ime+'&prezime='+prezime+'&email='+email+
	    	'&url='+url+'&poruka='+poruka);
	}
	else {
		alert("Neispravni podaci");
	}
}

ObrisiPolja();