var korisnici;

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
                }
            };

            xmlhttp.open('PUT', 'servis/korisnici_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id + '&username=' + novi_username + '&email=' + novi_email);
            alert("Uspješno ste editovali korisnika");
            PrikaziKorisnike();
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
                    
                }
            };

            xmlhttp.open('DELETE', 'servis/korisnici_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
            alert("Uspješno ste obrisali korisnika");
            PrikaziKorisnike();
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
            
        }
    };

    xmlhttp.open('POST', 'servis/korisnici_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('username=' + username + '&email=' + email + '&sifra=' + sifra);
    alert("Uspješno ste dodali korisnika");
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