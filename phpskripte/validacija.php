<?php
	function ValidirajIme($ime) {
		$pattern = "/^[a-zšđčćž]+$/i";
		$rezultat = preg_match($pattern, $ime);
		return $rezultat == 1;
	}

	function ValidirajPrezime($prezime) {
		$pattern = "/^[a-zšđčćž]+$/i";
		$rezultat = preg_match($pattern, $prezime);
		return $rezultat == 1;
	}

	function ValidirajEmail($email) {
		$rezultat = filter_var($email, FILTER_VALIDATE_EMAIL);
		return $rezultat;
	}

	function ValidirajURL($url) {
		$rezultat = filter_var($url, FILTER_VALIDATE_URL);
		return $rezultat;
	}

	function ValidirajPoruku($poruka) {
		$duzina = strlen($poruka);
		return $duzina != 0;
	}

	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$email = $_POST['email'];
	$url = $_POST['url'];
	$poruka = $_POST['poruka'];

	$ime_validno = ValidirajIme($ime);
	$prezime_validno = ValidirajPrezime($prezime);
	$email_validno = ValidirajEmail($email);
	$url_validno = ValidirajURL($url);
	$poruka_validno = ValidirajPoruku($poruka);
	$validno = $ime_validno && $prezime_validno && $email_validno
		&& $url_validno && $poruka_validno;

	$_GLOBALS['validno'] = $validno;
	$_GLOBALS['ime_validno'] = $ime_validno;
	$_GLOBALS['prezime_validno'] = $prezime_validno;
	$_GLOBALS['email_validno'] = $email_validno;
	$_GLOBALS['url_validno'] = $url_validno;
	$_GLOBALS['poruka_validno'] = $poruka_validno;
	$_GLOBALS['ime'] = $ime;
	$_GLOBALS['prezime'] = $prezime;
	$_GLOBALS['email'] = $email;
	$_GLOBALS['url'] = $url;
	$_GLOBALS['poruka'] = $poruka;

	/*echo ($ime_validno==TRUE)?"true":"false";
	echo ($prezime_validno==TRUE)?"true":"false";
	echo ($email_validno==TRUE)?"true":"false";
	echo ($url_validno==TRUE)?"true":"false";
	echo ($poruka_validno==TRUE)?"true":"false";*/
?>