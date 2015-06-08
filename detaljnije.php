<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Event planning</title>
		<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
		<link rel="shortcut icon" href="photos/logo.ico">
	</head>

	<body class="body_vijesti">
		<br>
		<div id="cijela_vijest_detalji"></div>
		<br><br>
		<div class="frejm-text">
			<form method="GET">
				<input type="button" value="Komentari" class="svi_buttoni" name="komentari"
				id="komentari" onclick="PokreniStranicu()">
			</form><br>
			<form method="POST">
				Komentar:<br>
				<textarea class="komentar" name="komentar" rows="8" cols="1" id="komentar"></textarea><br><br>
				<input type="button" value="Komentariši" class="svi_buttoni" name="komentarisi"
				id="komentarisi" onclick="DodajKomentar()">
			</form>
		</div>
	</body>
</html>