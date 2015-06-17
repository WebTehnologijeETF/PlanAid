var korisnici;
var desavanja;
var sesija_username;

var naziv_v = false;
var datum_v = false;
var lokacija_v = false;
var validiranod = false;

function DodajRedKorisnici(username, email, indeks, ime_tabele) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio1" value="' + indeks + '" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var usernametd = document.createElement('td');
    usernametd.innerHTML = username;
    red.appendChild(usernametd);
    var emailtd = document.createElement('td');
    emailtd.innerHTML = email;
    red.appendChild(emailtd);
    var tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function DodajRedTextBoxKorisnici(username, email, indeks, ime_tabele) {
    if(username === null || email === null || indeks === null) {
        return;
    }
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio2" value="' + indeks +'" ' + 'id="' + indeks + '" class="textboxtabela">';
    red.appendChild(radiotd);
    var usernametd = document.createElement('td');
    usernametd.innerHTML = '<input type="text" name="usernametextbox' + indeks + '" value="' + username + '" ' + 'id="' + indeks + '" class="textboxtabela">';
    red.appendChild(usernametd);
    var emailtd = document.createElement('td');
    emailtd.innerHTML = '<input type="email" name="emailtextbox' + indeks + '" value="' + email + '" ' + 'id="' + indeks + '" class="textboxtabela">';
    red.appendChild(emailtd);
    var tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function PopuniTabeluKorisnici(ime_tabele, textbox) {
    for(var i = 1; i < korisnici.length; i++) {
        if(textbox === 1) {
            DodajRedTextBoxKorisnici(korisnici[i]['username'], korisnici[i]['email'], korisnici[i]['id'], ime_tabele);
        }
        else {
            DodajRedKorisnici(korisnici[i]['username'], korisnici[i]['email'], korisnici[i]['id'], ime_tabele);
        }
    }
}

function IsprazniTabeluKorisnici(ime_tabele) {
    var elmtTable = document.getElementById(ime_tabele);
    var tableRows = elmtTable.getElementsByTagName('tr');
    var rowCount = tableRows.length;

    for (var i = rowCount - 1; i > 0; i--) {
       elmtTable.removeChild(tableRows[i]);
    }
}

function PrikaziKorisnike() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            korisnici = JSON.parse(xmlhttp.responseText);
            if(document.getElementById('editovanje_korisnika') !== null
                || document.getElementById('brisanje_korisnika') !== null) {
                IsprazniTabeluKorisnici("editovanje_korisnika", 1);
                IsprazniTabeluKorisnici("brisanje_korisnika");
                PopuniTabeluKorisnici("editovanje_korisnika", 1);
                PopuniTabeluKorisnici("brisanje_korisnika");
            }
        }
    };

    xmlhttp.open('GET', 'servis/korisnici_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function EditujKorisnika() {
    var radios = document.getElementsByName('radio2');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            if(document.getElementsByName('usernametextbox' + id)[0].length < 5) {
                alert("Minimalno 5 karaktera za korisničko ime");
                return;
            }
            var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
            var email = document.getElementsByName('emailtextbox' + id)[0].value;
            if(!regex.test(email)) {
                alert("Morate unijeti ispravan email");
                return;
            }

            var novi_username = document.getElementsByName('usernametextbox' + id)[0].value;
            var novi_email = document.getElementsByName('emailtextbox' + id)[0].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    PrikaziKorisnike();
                }
            };

            xmlhttp.open('PUT', 'servis/korisnici_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id + '&username=' + novi_username + '&email=' + novi_email);
        }
    }
}

function ObrisiKorisnika() {
    var radios = document.getElementsByName('radio1');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    PrikaziKorisnike();
                }
            };

            xmlhttp.open('DELETE', 'servis/korisnici_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
        }
    }
}

function DodajKorisnika() {
    if(document.getElementById('korisnicko_ime').length < 5) {
        alert("Minimalno 5 karaktera za korisničko ime");
        return;
    }
    if(document.getElementById('sifra').length < 6) {
        alert("Minimalno 6 karaktera za šifru");
        return;
    }
    var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
    var email = document.getElementById('email').value;
    if(!regex.test(email)) {
        alert("Morate unijeti ispravan email");
        return;
    }
    var username = document.getElementById('korisnicko_ime').value;
    var sifra = document.getElementById('sifra').value;
    var sifra_ponovo = document.getElementById('sifra_ponovo').value;
    if(sifra !== sifra_ponovo) {
        alert("Šifre se ne poklapaju");
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            PrikaziKorisnike();
        }
    };

    xmlhttp.open('POST', 'servis/korisnici_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('username=' + username + '&email=' + email + '&sifra=' + sifra);
}

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

function PrikaziStranicu(stranica, detalji) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(detalji === 1) {
                document.getElementById("frejm").innerHTML = xmlhttp.responseText;
            }
            else {
                document.getElementById("glavni").innerHTML = xmlhttp.responseText;
                if(stranica === "korisnici") {
                    PrikaziKorisnike();
                }
                else if(stranica === "moja_desavanja") {
                    PrikaziDesavanjaTabela();
                }
                else if(stranica === "kalendar") {
                    PokreniKalendar();
                }
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
    if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
        document.getElementById("username_lijevo").value = "";
        document.getElementById("sifra_lijevo").value = "";
    }
}

function ValidirajNazivDesavanja() {
    var naziv_desavanja = document.getElementById("naziv_desavanja").value;
    if(naziv_desavanja.length < 5) {
        document.getElementById("uzvicnik_naziv_desavanja").className="uzvicnik";
        document.getElementById("tekst_naziv_desavanja").className="tekst";
        naziv_v = false;
        return false;
    }
    else {
        document.getElementById("uzvicnik_naziv_desavanja").className="uzvicnik_invisible";
        document.getElementById("tekst_naziv_desavanja").className="tekst_invisible";
        naziv_v = true;
        ValidirajDesavanje();
        return true;
    }
}

function ValidirajDatumDesavanja() {
    var datum_desavanja = document.getElementById("datum_desavanja").value;
    var regex = /^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])\s(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/;
    if(!regex.test(datum_desavanja)) {
        document.getElementById("uzvicnik_datum_desavanja").className="uzvicnik";
        document.getElementById("tekst_datum_desavanja").className="tekst";
        datum_v = false;
        return false;
    }
    if(datum_desavanja[5] === "0" && datum_desavanja[6] === "2") {
        if(datum_desavanja[8] === "3") {
            document.getElementById("uzvicnik_datum_desavanja").className="uzvicnik";
            document.getElementById("tekst_datum_desavanja").className="tekst";
            datum_v = false;
            return false;
        }
    }
    if(datum_desavanja[6] === "4" || datum_desavanja[6] === "6" ||
        datum_desavanja[6] === "9" || (datum_desavanja[5] === "1" && datum_desavanja[6] === "1")) {
        if(datum_desavanja[8] === "3" && datum_desavanja[9] === "1") {
            document.getElementById("uzvicnik_datum_desavanja").className="uzvicnik";
            document.getElementById("tekst_datum_desavanja").className="tekst";
            datum_v = false;
            return false;
        }
    }
    document.getElementById("uzvicnik_datum_desavanja").className="uzvicnik_invisible";
    document.getElementById("tekst_datum_desavanja").className="tekst_invisible";
    datum_v = true;
    ValidirajDesavanje();
    return true;
}

function ValidirajLokacijaDesavanja() {
    var lokacija_desavanja = document.getElementById("lokacija_desavanja").value;
    if(lokacija_desavanja.length < 5) {
        document.getElementById("uzvicnik_lokacija_desavanja").className="uzvicnik";
        document.getElementById("tekst_lokacija_desavanja").className="tekst";
        lokacija_v = false;
        return false;
    }
    else {
        document.getElementById("uzvicnik_lokacija_desavanja").className="uzvicnik_invisible";
        document.getElementById("tekst_lokacija_desavanja").className="tekst_invisible";
        lokacija_v = true;
        ValidirajDesavanje();
        return true;
    }
}

function ValidirajDesavanje() {
    if(naziv_v && datum_v && lokacija_v) {
        validiranod = true;
    }
    else {
        validiranod = false;
    }
}

function DodajRedDesavanja(naziv, datum, lokacija, indeks, ime_tabele) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio" value="' + indeks + '" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var nazivtd = document.createElement('td');
    nazivtd.innerHTML = naziv;
    red.appendChild(nazivtd);
    var datumtd = document.createElement('td');
    datumtd.innerHTML = datum;
    red.appendChild(datumtd);
    var lokacijatd = document.createElement('td');
    lokacijatd.innerHTML = lokacija;
    red.appendChild(lokacijatd);
    var tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function DodajRedTextBoxDesavanja(naziv, datum, lokacija, indeks, ime_tabele) {
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio3" value="' + indeks +'" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var nazivtd = document.createElement('td');
    var naziv_uzvicnik = document.createElement('img');
    naziv_uzvicnik.src = "photos/exclamation_point.png";
    naziv_uzvicnik.id = "uzvicnik_naziv_desavanja" + indeks;
    naziv_uzvicnik.className = "uzvicnik_invisible";
    naziv_uzvicnik.alt = "uzvicnik";
    var nazivtextbox = document.createElement('input');
    nazivtextbox.name = "nazivtextbox" + indeks;
    nazivtextbox.value = naziv;
    nazivtextbox.id = "naziv_desavanja" + indeks;
    nazivtextbox.className = "textboxtabela";
    var indeks_naziva = document.createElement('div');
    indeks_naziva.id = "naziv_v"+indeks;
    indeks_naziva.className = "nevidljivo";
    nazivtextbox.onblur = function() {
        var naziv_desavanja = document.getElementById("naziv_desavanja" + indeks).value;
        if(naziv_desavanja.length < 5) {
            document.getElementById("uzvicnik_naziv_desavanja"+indeks).className="uzvicnik";
            indeks_naziva.innerHTML = "false";
            return false;
        }
        else {
            document.getElementById("uzvicnik_naziv_desavanja"+indeks).className="uzvicnik_invisible";
            indeks_naziva.innerHTML = "true";
            ValidirajDesavanje();
            return true;
        }
    }
    nazivtd.appendChild(indeks_naziva);
    nazivtd.appendChild(nazivtextbox);
    nazivtd.appendChild(naziv_uzvicnik);
    red.appendChild(nazivtd);
    var datumtd = document.createElement('td');
    var datum_uzvicnik = document.createElement('img');
    datum_uzvicnik.src = "photos/exclamation_point.png";
    datum_uzvicnik.id = "uzvicnik_datum_desavanja" + indeks;
    datum_uzvicnik.className = "uzvicnik_invisible";
    datum_uzvicnik.alt = "uzvicnik";
    var datumtextbox = document.createElement('input');
    datumtextbox.name = "datumtextbox" + indeks;
    datumtextbox.value = datum;
    datumtextbox.id = "datum_desavanja" + indeks;
    datumtextbox.className = "textboxtabela";
    var indeks_datuma = document.createElement('div');
    indeks_datuma.id = "datum_v"+indeks;
    indeks_datuma.className = "nevidljivo";
    datumtextbox.onblur = function() {        
        var datum_desavanja = document.getElementById("datum_desavanja" + indeks).value;
        var regex = /^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])\s(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/;
        if(!regex.test(datum_desavanja)) {
            document.getElementById("uzvicnik_datum_desavanja"+indeks).className="uzvicnik";
            indeks_datuma.innerHTML = "false";
            datum_v = false;
            return false;
        }
        if(datum_desavanja[5] === "0" && datum_desavanja[6] === "2") {
            if(datum_desavanja[8] === "3") {
                document.getElementById("uzvicnik_datum_desavanja"+indeks).className="uzvicnik";
                indeks_datuma.innerHTML = "false";
                datum_v = false;
                return false;
            }
        }
        if(datum_desavanja[6] === "4" || datum_desavanja[6] === "6" ||
            datum_desavanja[6] === "9" || (datum_desavanja[5] === "1" && datum_desavanja[6] === "1")) {
            if(datum_desavanja[8] === "3" && datum_desavanja[9] === "1") {
                document.getElementById("uzvicnik_datum_desavanja"+indeks).className="uzvicnik";
                indeks_datuma.innerHTML = "false";
                datum_v = false;
                return false;
            }
        }
        document.getElementById("uzvicnik_datum_desavanja"+indeks).className="uzvicnik_invisible";
        indeks_datuma.innerHTML = "true";
        datum_v = true;
        ValidirajDesavanje();
        return true;
    }
    datumtd.appendChild(indeks_datuma);
    datumtd.appendChild(datumtextbox);
    datumtd.appendChild(datum_uzvicnik);
    red.appendChild(datumtd);
    var lokacijatd = document.createElement('td');
    var lokacija_uzvicnik = document.createElement('img');
    lokacija_uzvicnik.src = "photos/exclamation_point.png";
    lokacija_uzvicnik.id = "uzvicnik_lokacija_desavanja" + indeks;
    lokacija_uzvicnik.className = "uzvicnik_invisible";
    lokacija_uzvicnik.alt = "uzvicnik";
    var lokacijatextbox = document.createElement('input');
    lokacijatextbox.name = "lokacijatextbox" + indeks;
    lokacijatextbox.value = lokacija;
    lokacijatextbox.id = "lokacija_desavanja" + indeks;
    lokacijatextbox.className = "textboxtabela";
    var indeks_lokacije = document.createElement('div');
    indeks_lokacije.id = "lokacija_v"+indeks;
    indeks_lokacije.className = "nevidljivo";
    lokacijatextbox.onblur = function() {
        var lokacija_desavanja = document.getElementById("lokacija_desavanja" + indeks).value;
        if(lokacija_desavanja.length < 5) {
            document.getElementById("uzvicnik_lokacija_desavanja"+indeks).className="uzvicnik";
            indeks_lokacije.innerHTML = "false";
            lokacija_v = false;
            return false;
        }
        else {
            document.getElementById("uzvicnik_lokacija_desavanja"+indeks).className="uzvicnik_invisible";
            indeks_lokacije.innerHTML = "true";
            lokacija_v = true;
            ValidirajDesavanje();
            return true;
        }
    }
    lokacijatd.appendChild(indeks_lokacije);
    lokacijatd.appendChild(lokacijatextbox);
    lokacijatd.appendChild(lokacija_uzvicnik);
    red.appendChild(lokacijatd);
    var tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function PopuniTabeluDesavanja(ime_tabele, textbox) {
    for(var i = 0; i < desavanja.length; i++) {
        if(textbox === 1) {
            DodajRedTextBoxDesavanja(desavanja[i]['naziv'], desavanja[i]['datum'], desavanja[i]['lokacija'], desavanja[i]['id'], ime_tabele);
        }
        else {
            DodajRedDesavanja(desavanja[i]['naziv'], desavanja[i]['datum'], desavanja[i]['lokacija'], desavanja[i]['id'], ime_tabele);
        }
    }
}

function IsprazniTabeluDesavanja(ime_tabele) {
    var elmtTable = document.getElementById(ime_tabele);
    var tableRows = elmtTable.getElementsByTagName('tr');
    var rowCount = tableRows.length;

    for (var i = rowCount - 1; i > 0; i--) {
       elmtTable.removeChild(tableRows[i]);
    }
}

function PrikaziDesavanjaTabela() {
    if(document.getElementById("editovanje_desavanja") == null) {
        return;
    }
    if(document.getElementById("sesija") == null) {
        alert("Istekla je sesija. Logujte se ponovo");
        return;
    }
    else {
        sesija_username = document.getElementById("sesija").innerHTML;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            desavanja = JSON.parse(xmlhttp.responseText);
            if(document.getElementById('editovanje_desavanja') !== null
                && document.getElementById('brisanje_desavanja') !== null) {
                IsprazniTabeluDesavanja("editovanje_desavanja");
                IsprazniTabeluDesavanja("brisanje_desavanja");
                PopuniTabeluDesavanja("editovanje_desavanja", 1);
                PopuniTabeluDesavanja("brisanje_desavanja");
            }
        }
    };

    xmlhttp.open('GET', 'servis/desavanja_rest.php?username='+sesija_username, true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function DodajDesavanje() {
    if(document.getElementById("naziv_desavanja") == null) {
        return;
    }
    if(document.getElementById("sesija") == null) {
        alert("Istekla je sesija. Logujte se ponovo");
        return;
    }
    else {
        sesija_username = document.getElementById("sesija").innerHTML;
    }
    if(!validiranod) {
        alert("Niste unijeli ispravne podatke");
        return;
    }

    var naziv = document.getElementById("naziv_desavanja").value;
    var datum = document.getElementById("datum_desavanja").value;
    var lokacija = document.getElementById("lokacija_desavanja").value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            PrikaziStranicu("moja_desavanja");
        }
    };

    xmlhttp.open('POST', 'servis/desavanja_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('naziv='+naziv+'&datum='+datum+'&lokacija='+lokacija+'&username='+sesija_username);
}

function EditujDesavanje() {
    if(document.getElementById("editovanje_desavanja") == null) {
        return;
    }
    if(document.getElementById("sesija") == null) {
        alert("Istekla je sesija. Logujte se ponovo");
        return;
    }
    else {
        sesija_username = document.getElementById("sesija").innerHTML;
    }
    var radios = document.getElementsByName('radio3');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            if(document.getElementById("naziv_v"+id).innerHTML === "false"
                || document.getElementById("datum_v"+id).innerHTML === "false"
                || document.getElementById("lokacija_v"+id).innerHTML === "false") {
                alert("Niste unijeli ispravne podatke");
                return;
            }
            var novi_naziv = document.getElementsByName('nazivtextbox' + id)[0].value;
            var novi_datum = document.getElementsByName('datumtextbox' + id)[0].value;
            var nova_lokacija = document.getElementsByName('lokacijatextbox' + id)[0].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    PrikaziDesavanjaTabela();
                }
            };

            xmlhttp.open('PUT', 'servis/desavanja_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id='+id+'&naziv='+novi_naziv+'&datum='+novi_datum+'&lokacija='+nova_lokacija+'&username='+sesija_username);
        }
    }
}

function ObrisiDesavanje() {
    var radios = document.getElementsByName('radio');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var id = radios[i].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    PrikaziDesavanjaTabela();
                }
            };

            xmlhttp.open('DELETE', 'servis/desavanja_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
        }
    }
}

/***********************************************
* Basic Calendar-By Brian Gosselin at http://scriptasylum.com/bgaudiodr/
* Script featured on Dynamic Drive (http://www.dynamicdrive.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var themonths=['Januar','Februar','Mart','April','Maj','Juni',
'Juli','August','Septembar','Oktobar','Novembar','Decembar'];

var todaydate=new Date();
var curmonth=todaydate.getMonth()+1; //get current month (1-12)
var curyear=todaydate.getFullYear(); //get current year

function updatecalendar(theselection){
    var themonth=parseInt(theselection[theselection.selectedIndex].value)+1;
    var calendarstr=buildCal(themonth, curyear, "main", "month", "daysofweek", "days", 0);
    if (document.getElementById)
        document.getElementById("calendarspace").innerHTML=calendarstr;
    }

function buildCal(m, y, cM, cH, cDW, cD, brdr){
    var mn=['Januar','Februar','Mart','April','Maj','Juni','Juli','August','Septembar','Oktobar','Novembar','Decembar'];
    var dim=[31,0,31,30,31,30,31,31,30,31,30,31];

    var oD = new Date(y, m-1, 1); //DD replaced line to fix date bug when current day is 31st
    oD.od=oD.getDay()+1; //DD replaced line to fix date bug when current day is 31st

    var todaydate=new Date(); //DD added
    var scanfortoday=(y==todaydate.getFullYear() && m==todaydate.getMonth()+1)? todaydate.getDate() : 0 //DD added

    dim[1]=(((oD.getFullYear()%100!=0)&&(oD.getFullYear()%4==0))||(oD.getFullYear()%400==0))?29:28;
    var t='<div class="'+cM+'"><table class="'+cM+'" cols="7" cellpadding="0" border="'+brdr+'" cellspacing="0"><tr align="center">';
    t+='<td colspan="7" align="center" class="'+cH+'">'+mn[m-1]+' - '+y+'</td></tr><tr align="center">';
    for(s=0;s<7;s++)t+='<td class="'+cDW+'">'+"NPUSČPS".substr(s,1)+'</td>';
    t+='</tr><tr align="center">';
    for(i=1;i<=42;i++){
    var x=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? i-oD.od+1 : '&nbsp;';
    if (x==scanfortoday) //DD added
    x='<span id="today">'+x+'</span>' //DD added
    t+='<td class="'+cD+'">'+x+'</td>';
    if(((i)%7==0)&&(i<36))t+='</tr><tr align="center">';
    }
    return t+='</tr></table></div>';
}

function DodajOpcije() {
    var opcija1 = document.createElement('option');
    opcija1.value = i;
    opcija1.innerHTML = themonths[i]+' '+curyear;
    opcija1.className = "opcije";
    comboboxkalendar.appendChild(opcija1);
}

function PokreniKalendar() {
    var opcija = document.createElement('option');
    opcija.value = (curmonth-1);
    opcija.selected = "yes";
    opcija.innerHTML = "Trenutni Mjesec";
    opcija.className = "opcije";
    var space = document.createElement('div');
    space.innerHTML = '<br>';
    var comboboxkalendar = document.getElementById("comboboxkalendar");
    comboboxkalendar.appendChild(opcija);
    comboboxkalendar.appendChild(space);
    for(i = 0; i < 12; i++) {
        DodajOpcije();
    }
    document.getElementById("calendarspace").innerHTML = buildCal(curmonth, curyear, "main", "month", "daysofweek", "days", 0);
}