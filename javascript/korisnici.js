var korisnici;

function DodajRed(username, email, indeks, ime_tabele) {
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

function DodajRedTextBox(username, email, indeks, ime_tabele) {
    if(username === null || email === null || indeks === null || ime_tabele === null) {
        return;
    }
    var red = document.createElement('tr');
    var radiotd = document.createElement('td');
    radiotd.innerHTML = '<input type="radio" name="radio2" value="' + indeks +'" ' + 'id="' + indeks + '">';
    red.appendChild(radiotd);
    var usernametd = document.createElement('td');
    usernametd.innerHTML = '<input type="text" name="usernametextbox' + indeks + '" value="' + username + '" ' + 'id="' + indeks + '">';
    red.appendChild(usernametd);
    var emailtd = document.createElement('td');
    emailtd.innerHTML = '<input type="text" name="emailtextbox' + indeks + '" value="' + email + '" ' + 'id="' + indeks + '">';
    red.appendChild(emailtd);
    var tabela = document.getElementById(ime_tabele);
    tabela.appendChild(red);
}

function PopuniTabelu(ime_tabele, textbox) {
    for(var i = 1; i < korisnici.length; i++) {
        if(textbox === 1) {
            DodajRedTextBox(korisnici[i]['username'], korisnici[i]['email'], korisnici[i]['id'], ime_tabele);
        }
        else {
            DodajRed(korisnici[i]['username'], korisnici[i]['email'], korisnici[i]['id'], ime_tabele);
        }
    }
}

function PrikaziKorisnike() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            korisnici = JSON.parse(xmlhttp.responseText);
            if(document.getElementById('editovanje_korisnika') !== null
                || document.getElementById('brisanje_korisnika') !== null) {
                PopuniTabelu("editovanje_korisnika", 1);
                PopuniTabelu("brisanje_korisnika");
            }
        }
    };

    xmlhttp.open('GET', 'servis/korisnik_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function EditujKorisnika() {
    var radios = document.getElementsByName('radio2');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === 'radio' && radios[i].checked) {
            var novi_id = radios[i].value;
            var novi_username = document.getElementsByName('usernametextbox' + novi_id)[0].value;
            var novi_email = document.getElementsByName('emailtextbox' + novi_id)[0].value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    console.log(xmlhttp.responseText);
                }
            };

            xmlhttp.open('PUT', 'servis/korisnik_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + novi_id + '&username=' + novi_username + '&email=' + novi_email);
            alert("Uspješno ste editovali korisnika.");
            break;
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

            xmlhttp.open('DELETE', 'servis/korisnik_rest.php', true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send('id=' + id);
            alert("Uspješno ste obrisali korisnika.");
            break;
        }
    }
}

function DodajKorisnika() {
    var username = document.getElementById('korisnicko_ime').value;
    var email = document.getElementById('email').value;
    var sifra = document.getElementById('sifra').value;
    var sifra_ponovo = document.getElementById('sifra_ponovo').value;
    if(username == null || email == null || sifra == null || sifra_ponovo == null) {
        alert("Morate unijeti username, email i sifru dvaput");
        return;
    }
    if(sifra !== sifra_ponovo) {
        alert("Sifre se ne poklapaju");
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            
        }
    };

    xmlhttp.open('POST', 'servis/korisnik_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send('username=' + username + '&email=' + email + '&sifra=' + sifra);
    alert("Uspješno ste dodali korisnika.");
}

PrikaziKorisnike();