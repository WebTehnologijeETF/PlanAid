function PrikaziVijesti(loc) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	//document.open();
            //document.write(xmlhttp.responseText);
            //document.close();
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
}

function PrikaziDesavanja() {
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu_invisible";
	document.getElementById("submenu_desavanja").className="submenu";
}

function PrikaziLokacije() {
	document.getElementById("submenu_prijava").className="submenu_invisible";
	document.getElementById("submenu_desavanja").className="submenu_invisible";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu";
}

function PrikaziPrijavu() {
	document.getElementById("submenu_desavanja").className="submenu_invisible";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu";
}

function SakrijSubmenu() {
	document.getElementById("submenu_desavanja").className="submenu_sakrij";
	document.getElementById("submenu_naslovnica").className="submenu_invisible";
	document.getElementById("submenu_lokacije").className="submenu_invisible";
	document.getElementById("submenu_prijava").className="submenu_invisible";
}

function PrikaziStranicu(stranica) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        	//document.open();
            //document.write(xmlhttp.responseText);
            //document.close();
            document.getElementById("glavni").innerHTML = xmlhttp.responseText;
        }
    };

    xmlhttp.open('GET', stranica + '.html', true);
    //xmlhttp.open('GET', 'http://localhost/PlanAid/' + stranica + '.html', true);
    xmlhttp.send();
    if(stranica === 'naslovnica_novevijesti') {
    	PrikaziVijesti('nove_vijesti.html');
    }
    else if(stranica === 'naslovnica_svevijesti') {
    	PrikaziVijesti('sve_vijesti.html');
    }
    else if(stranica === 'naslovnica_najcitanije') {
    	PrikaziVijesti('najcitanije_vijesti.html');
    } 
}

function Izmijeni() {
	document.getElementById("dodaj").className="sacuvaj_invisible";
	document.getElementById("sacuvaj").className="sacuvaj";
}

function ValidirajPromjene() {

}