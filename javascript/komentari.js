var komentari;
var tabelak;
var vijesti;
var tabelav;

function DodajRedK(datum, autor, tekst, indeks, ime_tabele) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio2" value="' + indeks + '" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var datumtd = document.createElement('td');
    datumtd.innerHTML = datum;
    red.appendChild(datumtd);
    var autortd = document.createElement('td');
    autortd.innerHTML = autor;
    red.appendChild(autortd);
    var teksttd = document.createElement('td');
    teksttd.innerHTML = tekst;
    red.appendChild(teksttd);
    tabelak = document.getElementById(ime_tabele);
    tabelak.appendChild(red);
}

function PopuniTabeluK(ime_tabele) {
    for(var i = 0; i < komentari.length; i++) {
    	if(komentari[i]['autor'] == 0) {
    		var autor = "Anonymous";
    		DodajRedK(komentari[i]['datum'], autor, komentari[i]['tekst'], komentari[i]['id'], ime_tabele);
    	}
    	else {
    		DodajRedK(komentari[i]['datum'], komentari[i]['username'], komentari[i]['tekst'], komentari[i]['id'], ime_tabele);
    	}
    }
}

function IsprazniTabeluK(ime_tabele) {
	var elmtTable = document.getElementById(ime_tabele);
	var tableRows = elmtTable.getElementsByTagName('tr');
	var rowCount = tableRows.length;

	for (var i = rowCount - 1; i > 0; i--) {
	   elmtTable.removeChild(tableRows[i]);
	}
}

function PrikaziKomentareAdmin() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
            IsprazniTabeluK("brisanje_komentara");
            PopuniTabeluK("brisanje_komentara");
        }
    };
    xmlhttp.open('GET', "admin_komentari.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function ObrisiKomentar() {
    var radios = document.getElementsByName('radio2');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                }
            };

            xmlhttp.open('DELETE', 'servis/komentari_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
            alert("Uspješno ste obrisali komentar");
            PrikaziKomentareAdmin();
        }
    }
}

function IzaberiVijest() {
	var radios = document.getElementsByName('radio1');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                	komentari = JSON.parse(xmlhttp.responseText);
                	PrikaziKomentareAdmin();
                }
            };

            xmlhttp.open('GET', 'servis/komentari_rest.php?vijest='+id, true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send();
        }
    }
}

function DodajRedV(datum, autor, naslov, indeks, ime_tabele) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio1" value="' + indeks + '" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var datumtd = document.createElement('td');
    datumtd.innerHTML = datum;
    red.appendChild(datumtd);
    var autortd = document.createElement('td');
    autortd.innerHTML = autor;
    red.appendChild(autortd);
    var naslovtd = document.createElement('td');
    naslovtd.innerHTML = naslov;
    red.appendChild(naslovtd);
    tabelav = document.getElementById(ime_tabele);
    tabelav.appendChild(red);
}

function PopuniTabeluV(ime_tabele) {
    for(var i = 0; i < vijesti.length; i++) {
        DodajRedV(vijesti[i]['datum'], vijesti[i]['autor'], vijesti[i]['naslov'], vijesti[i]['id'], ime_tabele);
    }
}

function IsprazniTabeluV(ime_tabele) {
	var elmtTable = document.getElementById(ime_tabele);
	var tableRows = elmtTable.getElementsByTagName('tr');
	var rowCount = tableRows.length;

	for (var i = rowCount - 1; i > 0; i--) {
	   elmtTable.removeChild(tableRows[i]);
	}
}

function PopuniVijest() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            vijesti = JSON.parse(xmlhttp.responseText);
            if(document.getElementById('moje_vijesti') !== null) {
            	IsprazniTabeluV("moje_vijesti");
                PopuniTabeluV("moje_vijesti");
            }
        }
    };

    xmlhttp.open('GET', 'servis/vijesti_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}