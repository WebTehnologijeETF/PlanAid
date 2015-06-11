var vijesti;
var ids = [];
var brojac = 0;
var sesija_autor;

function DodajSliku(slika) {
	var imgdiv = document.createElement('div');
	imgdiv.className="frejm-image";
	var tabela = document.createElement('table');
	tabela.className="frejm-image";
	var red = document.createElement('tr');
	var redtd = document.createElement('td');
	redtd.className="frejm-image";
	var slikaimg = document.createElement('img');
	slikaimg.className="frejm-image";
	slikaimg.src = slika;
	redtd.appendChild(slikaimg);
	red.appendChild(redtd);
	tabela.appendChild(red);
	imgdiv.appendChild(tabela);
	return imgdiv;
}

function DodajTekst(id, datum, autor, naslov, tekst, vrsta_novosti) {
	var textdiv = document.createElement('div');
	textdiv.className="frejm-text";
	var datumdiv = document.createElement('div');
	datumdiv.innerHTML = datum;
	textdiv.appendChild(datumdiv);
	var autordiv = document.createElement('div');
	autordiv.innerHTML = autor;
	textdiv.appendChild(autordiv);

	var divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	textdiv.appendChild(divspace);

	var naslovdiv = document.createElement('div');
	var n1 = naslov.substr(0, 1).toUpperCase();
	var n2 = naslov.substr(1).toLowerCase();
	var n = n1 + n2;
	naslovdiv.innerHTML = n;
	textdiv.appendChild(naslovdiv);

	divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	textdiv.appendChild(divspace);

	var tekstdiv = document.createElement('div');
	tekstdiv.innerHTML = tekst;
	detaljnijelink = document.createElement('a');
	detaljnijelink.id = "detaljnijelink";
	detaljnijelink.className = "frejm";
	detaljnijelink.innerHTML = "Detaljnije...";
	detaljnijelink.onclick = function () {
		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("frejm").innerHTML = xmlhttp.responseText;
	        }
	    };
	    PrebrojKomentare(id);
	    PrikaziDetalje(id);

	    xmlhttp.open('GET', "detaljnije.php", true);
	    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	    xmlhttp.send();

	}
	tekstdiv.appendChild(detaljnijelink);
	textdiv.appendChild(tekstdiv);
	return textdiv;
}

var idvijest;
function DodajDetalje(id, datum, autor, naslov, tekst, detaljnije, vrsta_novosti) {
	if(detaljnije == null) return;
	idvijest = id;
	var textdiv = document.createElement('div');
	textdiv.className="frejm-text";
	var datumdiv = document.createElement('div');
	datumdiv.innerHTML = datum;
	textdiv.appendChild(datumdiv);
	var autordiv = document.createElement('div');
	autordiv.innerHTML = autor;
	textdiv.appendChild(autordiv);

	var divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	textdiv.appendChild(divspace);

	var naslovdiv = document.createElement('div');
	var n1 = naslov.substr(0, 1).toUpperCase();
	var n2 = naslov.substr(1).toLowerCase();
	var n = n1 + n2;
	naslovdiv.innerHTML = n;
	textdiv.appendChild(naslovdiv);

	divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	textdiv.appendChild(divspace);

	var tekstdiv = document.createElement('div');
	tekstdiv.innerHTML = tekst;
	var detaljnijediv = document.createElement('div');
	detaljnijediv.innerHTML = detaljnije;
	tekstdiv.appendChild(detaljnijediv);

	sakrijlink = document.createElement('a');
	sakrijlink.className = "frejm";
	sakrijlink.innerHTML = "Sakrij";
	sakrijlink.onclick = function () {
		var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("frejm").innerHTML = xmlhttp.responseText;
	        }
	    };
	    
	    PrikaziVijest();

	    if(vrsta_novosti === "nove_vijesti") {
	    	xmlhttp.open('GET', "nove_vijesti.php", true);
	    }
	    else if(vrsta_novosti === "sve_vijesti") {
	    	xmlhttp.open('GET', "sve_vijesti.php", true);
	    }
	    else if(vrsta_novosti === "najcitanije_vijesti") {
	    	xmlhttp.open('GET', "najcitanije_vijesti.php", true);
	    }
	    else return;
	    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	    xmlhttp.send();
	}
	detaljnijediv.appendChild(sakrijlink);
	divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	tekstdiv.appendChild(divspace);

	var kombtn = document.createElement('button');
	var btntxt = brojac.toString() + " komentara";
	var komtxt = document.createTextNode(btntxt);
	kombtn.appendChild(komtxt);
	kombtn.className = "svi_buttoni";
	kombtn.onclick = function() {
		PokreniStranicu();
	}
	textdiv.appendChild(tekstdiv);
	textdiv.appendChild(kombtn);
	return textdiv;
}

function DodajDiv(id, datum, autor, slika, naslov, tekst, vrsta_novosti) {	
	var br = document.createElement('br');
	var hr = document.createElement('hr');
	
	var imgdiv = DodajSliku(slika);
	var textdiv = DodajTekst(id, datum, autor, naslov, tekst, vrsta_novosti);
	
	var tempdiv = document.createElement('div');
	tempdiv.appendChild(imgdiv);
	tempdiv.appendChild(textdiv);
	tempdiv.appendChild(br);
	tempdiv.appendChild(hr);

	var div = document.getElementById("cijela_vijest");
	div.appendChild(tempdiv);
}

function DodajDivD(id, datum, autor, slika, naslov, tekst, detaljnije, vrsta_novosti) {
	if(detaljnije == null) return;	
	var br = document.createElement('br');
	var hr = document.createElement('hr');
	
	var imgdiv = DodajSliku(slika);
	var textdiv = DodajDetalje(id, datum, autor, naslov, tekst, detaljnije, vrsta_novosti);
	
	var tempdiv = document.createElement('div');
	tempdiv.appendChild(imgdiv);
	tempdiv.appendChild(textdiv);
	var div = document.getElementById("cijela_vijest_detalji");
	var divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	div.appendChild(tempdiv);
	div.appendChild(divspace);
	divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	div.appendChild(divspace);
}

function PrikaziVijest() {	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            vijesti = JSON.parse(xmlhttp.responseText);
            for(var i = 0; i < vijesti.length; i++) {
            	ids.push(vijesti[i]['id']);
            	DodajDiv(vijesti[i]['id'], vijesti[i]['datum'], vijesti[i]['autor'], vijesti[i]['slika'],
            		vijesti[i]['naslov'], vijesti[i]['tekst'], vijesti[i]['vrsta_novosti']);
            }
        }
    };

    xmlhttp.open('GET', 'servis/vijesti_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PrikaziDetalje(id) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            vijesti = JSON.parse(xmlhttp.responseText);
            for(var i = 0; i < ids.length; i++) {
            	if(vijesti[i]['detaljnije'] == null) return;
            	if(ids[i] === id) {
            		DodajDivD(vijesti[i]['id'], vijesti[i]['datum'], vijesti[i]['autor'], vijesti[i]['slika'],
            		vijesti[i]['naslov'], vijesti[i]['tekst'], vijesti[i]['detaljnije'], vijesti[i]['vrsta_novosti']);
            		break;
            	}
            }
        }
    };

    xmlhttp.open('GET', 'servis/vijesti_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PrikaziDivKomentar(id, datum, autor, email, vijest, tekst) {
	var divdatum = document.createElement('div');
	divdatum.innerHTML = datum;
	var divautor = document.createElement('div');
	if(autor == 0) {
		divautor.innerHTML = "Anonymous";
	}
	else {
		divautor.innerHTML = document.getElementById("sesija");
		console.log(document.getElementById("sesija"));
	}
	var divemail = document.createElement('div');
	if(email === "") {
		divemail.innerHTML = "";
	}
	else {
		divemail.innerHTML = email;
	}

	var divspace = document.createElement('div');
	divspace.innerHTML = "<br>";

	var divkomentar = document.createElement('div');
	divkomentar.innerHTML = tekst;
	var div = document.getElementById('svi_komentari');
	div.className="frejm";
	div.appendChild(divdatum);
	div.appendChild(divautor);
	div.appendChild(divemail);
	div.appendChild(divspace);
	div.appendChild(divkomentar);

	var hr = document.createElement('hr');
	divspace = document.createElement('div');
	divspace.innerHTML = "<br>";
	div.appendChild(divspace);
	div.appendChild(hr);
	div.appendChild(divspace);
}

function SaznajAutora() {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            sesija_autor = JSON.parse(xmlhttp.responseText);
        }
    };
    xmlhttp.open('GET', 'servis/komentari_rest.php?vijest=' + idvijest + '&autor=0', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PrikaziKomentare() {	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            komentari = JSON.parse(xmlhttp.responseText);
            for(var i = 0; i < komentari.length; i++) {
            	if(sesija_autor != null) {
            		komentari[i]['autor'] = sesija_autor;
            	}
            	if(komentari[i]['autor'] == 0) {
		    		var username = "Anonymous";
		    		PrikaziDivKomentar(komentari[i]['id'], komentari[i]['datum'], username, komentari[i]['email'],
        			komentari[i]['vijest'], komentari[i]['tekst']);
		    	}
		    	else {
		    		PrikaziDivKomentar(komentari[i]['id'], komentari[i]['datum'], komentari[i]['autor'], komentari[i]['email'],
        			komentari[i]['vijest'], komentari[i]['tekst']);
		    	}
            }
        }
    };
    xmlhttp.open('GET', 'servis/komentari_rest.php?vijest=' + idvijest, true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PokreniStranicu() {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("frejm").innerHTML = xmlhttp.responseText;
            PrikaziKomentare();
        }
    };
    xmlhttp.open('GET', "komentari.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function DodajKomentar() {
	var k = document.getElementById('komentar');
	var kom = document.getElementById('komentar').value;
	if(k.length === 0) {
		alert('Morate ostaviti neku poruku');
		return;
	}
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	PokreniStranicu();
        }
    };
    xmlhttp.open('POST', 'servis/komentari_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('vijest=' + idvijest + '&tekst=' + kom);
}

function PrebrojKomentare(idvijest) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	brojac = 0;
            komentari = JSON.parse(xmlhttp.responseText);
            for(var i = 0; i < komentari.length; i++) {
        		brojac++;
            }
        }
    };
    xmlhttp.open('GET', 'servis/komentari_rest.php?vijest=' + idvijest, true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function ObrisiPolja() {
    if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
        document.getElementById("username_lijevo").value = "";
        document.getElementById("sifra_lijevo").value = "";
    }
}

ObrisiPolja();