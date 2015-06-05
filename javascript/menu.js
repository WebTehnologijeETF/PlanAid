function PrikaziVijesti(loc) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("frejm").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open('GET', loc, true);
    xmlhttp.send();
}

function PrikaziNaslovnicu() {
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu_invisible";
	document.getElementById("submenu_desavanja").className="submenu_invisible";
	document.getElementById("submenu_naslovnica").className="submenu";
    document.getElementById("submenu_admin").className="submenu_invisible";
}

function PrikaziDesavanja() {
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu_invisible";
	document.getElementById("submenu_desavanja").className="submenu";
    document.getElementById("submenu_admin").className="submenu_invisible";
}

function PrikaziLokacije() {
	document.getElementById("submenu_prijava").className="submenu_invisible";
	document.getElementById("submenu_desavanja").className="submenu_invisible";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu";
    document.getElementById("submenu_admin").className="submenu_invisible";
}

function PrikaziPrijavu() {
	document.getElementById("submenu_desavanja").className="submenu_invisible";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu";
    document.getElementById("submenu_admin").className="submenu_invisible";
}

function PrikaziAdmin() {
    document.getElementById("submenu_desavanja").className="submenu_invisible";
    document.getElementById("submenu_naslovnica").className="submenu_invisible";
    document.getElementById("submenu_lokacije").className="submenu_invisible";
    document.getElementById("submenu_prijava").className="submenu_invisible";
    document.getElementById("submenu_admin").className="submenu";
}

function SakrijSubmenu() {
	document.getElementById("submenu_desavanja").className="submenu_sakrij";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu_invisible";
    document.getElementById("submenu_admin").className="submenu_invisible";
}

function PrikaziStranicu(stranica, detalji) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(detalji === 1) {
                document.getElementById("frejm").innerHTML = xmlhttp.responseText;
            }
            else {
                document.getElementById("glavni").innerHTML = xmlhttp.responseText;
            }
        }
    };

    xmlhttp.open('GET', stranica + '.php', true);
    xmlhttp.send();
    if(stranica === 'naslovnica_novevijesti') {
    	PrikaziVijesti('nove_vijesti.php');
    }
    else if(stranica === 'naslovnica_svevijesti') {
    	PrikaziVijesti('sve_vijesti.php');
    }
    else if(stranica === 'naslovnica_najcitanije') {
    	PrikaziVijesti('najcitanije_vijesti.php');
    } 
}

var objekti = [];
function DodajRed(ime, slika, datum, indeks) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio" value="1" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var imetd = document.createElement('td');
    imetd.innerHTML = ime;
    red.appendChild(imetd);
    var slikatd = document.createElement('td');
    slikatd.innerHTML = slika;
    red.appendChild(slikatd);
    var datumtd = document.createElement('td');
    datumtd.innerHTML = datum;
    red.appendChild(datumtd);
    var tabela = document.getElementById("moja_desavanja");
    tabela.appendChild(red);
}

function PopuniTabelu() {
    for(var i = 0; i < objekti.length; i++) {
        DodajRed(objekti[i].naziv, objekti[i].url, objekti[i].opis, i);
    }
}

function Posalji() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
    };
    var item = {
        naziv: document.getElementById("ime_desavanja").value,
        url: document.getElementById("url").value,
        opis: document.getElementById("opis").value
    };
    xmlhttp.open('POST', 'http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16476', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('akcija=dodavanje&proizvod=' + JSON.stringify(item));
}

function PovuciSaServera() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekti = JSON.parse(xmlhttp.responseText);
            PopuniTabelu();
        }
    };

    xmlhttp.open('POST', 'http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16476', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('');
}

var selektovani_objekat;
function LoadIzmijeni() {
    var radios = document.getElementsByTagName('input');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            selektovani_objekat = objekti[parseInt(radios[i].id)];
            break;
        }
    }

    if(selektovani_objekat != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("glavni").innerHTML = xmlhttp.responseText;
                document.getElementById("ime_desavanja").value = selektovani_objekat.naziv;
                document.getElementById("url").value = selektovani_objekat.url;
                document.getElementById("opis").value = selektovani_objekat.opis;
            }
        };
        xmlhttp.open('GET', 'izmijeni_desavanje.php', true);
        xmlhttp.send();
    }
}

function LoadDesavanja() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open('GET', 'moja_desavanja.php', true);
    xmlhttp.send();
}

function Sacuvaj() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            LoadDesavanja();
        }
    };

    selektovani_objekat.naziv = document.getElementById("ime_desavanja").value;
    selektovani_objekat.url = document.getElementById("url").value;
    selektovani_objekat.opis = document.getElementById("opis").value;
    xmlhttp.open('POST', 'http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16476', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('akcija=promjena&proizvod=' + JSON.stringify(selektovani_objekat));
}

function Obrisi() {
    var radios = document.getElementsByTagName('input');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            selektovani_objekat = objekti[parseInt(radios[i].id)];
            break;
        }
    }

    if(selektovani_objekat != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("moja_desavanja").innerHTML =
                '<tr>' + 
                '<td class="red1"></td>' +
                '<td class="red1">Ime dešavanja</td>' +
                '<td class="red1">Slika dešavanja</td>' +
                '<td class="red1">Datum i lokacija</td>' +
                '</tr>';
                PovuciSaServera();
            }
        };
        xmlhttp.open('POST', 'http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16476', true);
        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xmlhttp.send('akcija=brisanje&proizvod=' + JSON.stringify(selektovani_objekat));
    }
}