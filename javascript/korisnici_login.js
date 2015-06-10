function OtvoriAdminPanel() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open('GET', "admin_panel.php", true);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    xmlhttp.send();
}

function ProvjeriPodatke() {
    var username = document.getElementById("korisnicko_ime").value;
    var sifra = document.getElementById("sifra").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            korisnici = JSON.parse(xmlhttp.responseText);
            if(korisnici.length === 1) {
                document.getElementById("adminmenu").className="admin_visible";
                OtvoriAdminPanel();
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