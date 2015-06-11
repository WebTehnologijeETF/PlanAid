var sesija_username;

var pokrenuto = false;
function PokrenutaSesija() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            korisnici = JSON.parse(xmlhttp.responseText);
            if(korisnici.length === 0) {
                pokrenuto = true;
            }
        }
    };

    xmlhttp.open('GET', 'servis/korisnik_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function SakrijSubmenu() {
    if(pokrenuto) {
        ObicniKorisnik();
    }
    document.getElementById("submenu_desavanja").className="submenu_sakrij";
    document.getElementById("submenu_naslovnica").className="submenu_invisible";
    document.getElementById("submenu_lokacije").className="submenu_invisible";
    document.getElementById("submenu_prijava").className="submenu_invisible";
    document.getElementById("submenu_admin").className="submenu_invisible";
    if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
        document.getElementById("username_lijevo").value = "";
        document.getElementById("sifra_lijevo").value = "";
    }
}

function OtvoriAdminPanel(username) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("nije_ulogovan").className="login_invisible";
            document.getElementById("ulogovan").className="ulogovan";
            document.getElementById("korisnicko_ime_lijevo").value = username;
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open('GET', "admin_panel.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PostaviAside(username) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ulogovan").innerHTML = xmlhttp.responseText;
            document.getElementById("korisnicko_ime_lijevo").innerHTML = username;
            if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
                document.getElementById("username_lijevo").value = "";
                document.getElementById("sifra_lijevo").value = "";
            }
        }
    };
    xmlhttp.open('GET', "aside_ulogovan.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PostaviAsidePocetna() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("nije_ulogovan").innerHTML = xmlhttp.responseText;
            if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
                document.getElementById("username_lijevo").value = "";
                document.getElementById("sifra_lijevo").value = "";
            }
        }
    };
    xmlhttp.open('GET', "aside_login.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function ObicniKorisnik() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(sesija_username == null) {
                sesija_username = document.getElementById("sesija").innerHTML;
            }
            PostaviAside(sesija_username);
            if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
                document.getElementById("username_lijevo").value = "";
                document.getElementById("sifra_lijevo").value = "";
            }
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
            document.getElementById("ulogovan").className = "ulogovan";
            document.getElementById("nije_ulogovan").className = "login_invisible";
        }
    };
    xmlhttp.open('GET', "naslovnica_novevijesti.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function ProvjeriPodatke() {
    var username = document.getElementById("username_lijevo").value;
    var sifra = document.getElementById("sifra_lijevo").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            korisnici = JSON.parse(xmlhttp.responseText);
            if(korisnici.length === 1) {
                sesija_username = korisnici[0]['username'];
                if(korisnici[0]['admin'] === true) {
                    document.getElementById("adminmenu").className="admin_visible";
                    OtvoriAdminPanel(korisnici[0]['username']);
                    return;
                }
                else {
                    document.getElementById("adminmenu").className="admin";
                    ObicniKorisnik();
                    return;
                }
            }
            else {
                alert("Neispravni podaci");
                return;
            }
        }
    };

    xmlhttp.open('GET', 'servis/korisnik_rest.php?username='+username+'&sifra='+sifra, true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function PrikaziPocetnu() {
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
            if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
                document.getElementById("username_lijevo").value = "";
                document.getElementById("sifra_lijevo").value = "";
            }
            document.getElementById("glavni").innerHTML = xmlhttp1.responseText;
            document.getElementById("ulogovan").className = "ulogovan_invisible";
            document.getElementById("nije_ulogovan").className = "login";
            PostaviAsidePocetna();
        }
    };
    xmlhttp1.open('GET', "naslovnica_novevijesti.php", true);
    xmlhttp1.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp1.send();
}

function Odjava() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
                document.getElementById("username_lijevo").value = "";
                document.getElementById("sifra_lijevo").value = "";
            }
            PrikaziPocetnu();
        }
    };

    xmlhttp.open('POST', 'servis/korisnik_rest.php', true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

PokrenutaSesija();