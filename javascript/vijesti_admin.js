var vijesti;
var tabela;

function DodajRedVijesti(datum, autor, naslov, indeks, ime_tabele) {
    if(ime_tabele !== "brisanje_vijesti") {
        return;
    }
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
    tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function DodajRedTextBoxVijesti(autor, naslov, slika, tekst, detaljnije, indeks, ime_tabele) {
    if(autor === null || naslov === null || tekst === null || indeks === null || ime_tabele !== "editovanje_vijesti") {
        return;
    }
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio2" value="' + indeks +'" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var autortd = document.createElement('td');
    autortd.innerHTML = '<input type="text" name="autortextbox' + indeks + '" value="' + autor + '" class="textboxtabela">';
    red.appendChild(autortd);
    var naslovtd = document.createElement('td');
    naslovtd.innerHTML = '<input type="text" name="naslovtextbox' + indeks + '" value="' + naslov + '" class="textboxtabela">';
    red.appendChild(naslovtd);
    var slikatd = document.createElement('td');
    slikatd.innerHTML = '<input type="url" name="slikatextbox' + indeks + '" value="' + slika + '" class="textboxtabela">';
    red.appendChild(slikatd);
    var teksttd = document.createElement('td');
    teksttd.innerHTML = '<input type="text" name="teksttextbox' + indeks + '" value="' + tekst + '" class="textboxtabela">';
    red.appendChild(teksttd);
    var detaljnijetd = document.createElement('td');
    detaljnijetd.innerHTML = '<input type="text" name="detaljnijetextbox' + indeks + '" value="' + detaljnije + '" class="textboxtabela">';
    red.appendChild(detaljnijetd);
    tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function PopuniTabeluVijesti(ime_tabele, textbox) {
    for(var i = 0; i < vijesti.length; i++) {
        if(textbox === 1) {
            DodajRedTextBoxVijesti(vijesti[i]['autor'], vijesti[i]['naslov'], vijesti[i]['slika'],
            vijesti[i]['tekst'], vijesti[i]['detaljnije'], vijesti[i]['id'], ime_tabele);
        }
        else {
            DodajRedVijesti(vijesti[i]['datum'], vijesti[i]['autor'], vijesti[i]['naslov'], vijesti[i]['id'], ime_tabele);
        }
    }
}

function IsprazniTabeluVijesti(ime_tabele) {
	var elmtTable = document.getElementById(ime_tabele);
	var tableRows = elmtTable.getElementsByTagName('tr');
	var rowCount = tableRows.length;

	for (var i = rowCount - 1; i > 0; i--) {
	   elmtTable.removeChild(tableRows[i]);
	}
}

function PrikaziVijestiAdmin() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            vijesti = JSON.parse(xmlhttp.responseText);
            if(document.getElementById('editovanje_vijesti') !== null
                || document.getElementById('brisanje_vijesti') !== null) {
            	IsprazniTabeluVijesti("editovanje_vijesti");
            	IsprazniTabeluVijesti("brisanje_vijesti");
                PopuniTabeluVijesti("editovanje_vijesti", 1);
                PopuniTabeluVijesti("brisanje_vijesti");
            }
        }
    };

    xmlhttp.open('GET', 'servis/vijesti_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function EditujVijest() {
    var radios = document.getElementsByName('radio2');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            if(document.getElementsByName('autortextbox' + id)[0].length < 1) {
		        alert("Morate unijeti autora");
		        return;
		    }
		    else if(document.getElementsByName('naslovtextbox' + id)[0].length < 1) {
		        alert("Morate unijeti naslov");
		        return;
		    }
		    else if(document.getElementsByName('teksttextbox' + id)[0].length < 1) {
		        alert("Morate unijeti tekst");
		        return;
		    }
		    var datum = vijesti[i]['datum'];
            var novi_autor = document.getElementsByName('autortextbox' + id)[0].value;
            var novi_naslov = document.getElementsByName('naslovtextbox' + id)[0].value;
            var nova_slika = document.getElementsByName('slikatextbox' + id)[0].value;
            var novi_tekst = document.getElementsByName('teksttextbox' + id)[0].value;
            var novi_detaljnije = document.getElementsByName('detaljnijetextbox' + id)[0].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                	console.log(xmlhttp);
                }
            };

            xmlhttp.open('PUT', 'servis/vijesti_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            
            xmlhttp.send('id=' + id + '&datum=' + datum + '&autor=' + novi_autor + '&naslov=' + novi_naslov + 
            	'&slika=' + nova_slika + '&tekst=' + novi_tekst + '&detaljnije=' + novi_detaljnije);

            alert("Uspješno ste editovali vijest");
            PrikaziVijestiAdmin();
        }
    }
}

function ObrisiVijest() {
    var radios = document.getElementsByName('radio1');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                }
            };

            xmlhttp.open('DELETE', 'servis/vijesti_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
            alert("Uspješno ste obrisali vijest");
            PrikaziVijestiAdmin();
        }
    }
}

function DodajVijest() {
	var autor = document.getElementById('autor').value;
	var naslov = document.getElementById('naslov').value;
	var slika = document.getElementById('slika').value;
	var tekst = document.getElementById('tekst').value;
	var detaljnije = document.getElementById('detaljnije').value;
	var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
	if(autor.length === 0) {
		alert("Morate unijeti autora");
		return;
	}
	if(naslov.length === 0) {
		alert("Morate unijeti naslov");
		return;
	}
	if(tekst.length === 0) {
		alert("Morate unijeti tekst");
		return;
	}
	if(slika.length !== 0) {
		if(!regex.test(slika)) {
			alert("Morate unijeti ispravan URL slike");
			return;
		}
	}

	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	console.log(detaljnije);
        }
    };
    xmlhttp.open('POST', 'servis/vijesti_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('autor='+autor+'&naslov='+naslov+'&slika='+slika+
    	'&tekst='+tekst+'&detaljnije='+detaljnije);
    alert("Uspješno ste dodali vijest");
    PrikaziVijestiAdmin();
}