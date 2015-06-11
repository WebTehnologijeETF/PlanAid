<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Event planning</title>
		<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
		<link rel="shortcut icon" href="photos/logo.ico">
	</head>
	<body>
		<aside class="login-body">
			<form method="GET"><br>
				<h4>Korisničko ime:</h4>
				<input type="text" id="username_lijevo" name="username_lijevo"><br>
				<br><h4>Šifra:</h4>
				<input type="password" id="sifra_lijevo" name="sifra_lijevo"><br><br>
				<input type="button" id="login_lijevo" name="login_lijevo" class="svi_buttoni"
				value="Pošalji" onclick="ProvjeriPodatke()">
			</form>
		</aside>
	</body>
	<script src="javascript/korisnici_login.js"></script>
</html>