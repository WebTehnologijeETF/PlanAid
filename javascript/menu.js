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

function ObrisiPolja() {
    if(document.getElementById("username_lijevo") != null && document.getElementById("sifra_lijevo") != null) {
        document.getElementById("username_lijevo").value = "";
        document.getElementById("sifra_lijevo").value = "";
    }
}

ObrisiPolja();