<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		die("Niste ulogovani kao admin");
	}
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body>
	<h3>Komentari</h3>
	<form method="DELETE">
    	<table id="brisanje_komentara" class="moja_desavanja">
	        <tr>
	            <td class="red1"></td>
	            <td class="red1">Datum</td>
	            <td class="red1">Autor</td>
	            <td class="red1">Komentar</td>
	        </tr>
	    </table><br>
    	<input type="button" value="Obriši" name="obrisi" class="svi_buttoni" onclick="ObrisiKomentar()">
	</form>
</body>
<script src="javascript/komentari.js"></script>
</html>

