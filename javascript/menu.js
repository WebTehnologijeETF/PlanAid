function PrikaziVijesti(loc) {
	document.getElementById("frejm").src = loc;
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