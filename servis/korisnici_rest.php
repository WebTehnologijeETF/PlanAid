<?php
	require("podaci_baza.php");
	function zag () {
		header ("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
		header ('ContentType: text/html');
		header ('AccessControlAllowOrigin:*');
	}
	
	function rest_get ($request, $data) {     
		try {
            $konekcija = new PDO("mysql:host=" . $GLOBALS['ime_servera'] .
            	";dbname=" . $GLOBALS['ime_baze'], $GLOBALS['usrnm'], $GLOBALS['password']);
            $konekcija->exec("set names utf8");
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $korisnici = array();
        if(count($data) === 0) {
        	$upit1 = 'SELECT *
                    FROM korisnici
                    WHERE id <> :id';
	        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	        $statement1->execute(array(':id' => 1));
	        $korisnici = $statement1->fetchAll();

	        echo json_encode($korisnici);
        }
        else {
        	if(isset($data['id'])) {
                $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');                
                $upit1 = 'SELECT *
                        FROM korisnici
                        WHERE id = :id';
                $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $statement1->execute(array(':id' => $id));
                $korisnici = $statement1->fetchAll();
        		echo json_encode($korisnici);
        	}
        	else {
                rest_error($request);
                return;
            }
        }
	}

	function rest_post ($request, $data) { 
		if(!isset($data['username']) || !isset($data['sifra']) || !isset($data['email'])) {
        	rest_error($request);
        	return;
        }
		try {
            $konekcija = new PDO("mysql:host=" . $GLOBALS['ime_servera'] .
            	";dbname=" . $GLOBALS['ime_baze'], $GLOBALS['usrnm'], $GLOBALS['password']);
            $konekcija->exec("set names utf8");
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
	    $sifra = htmlspecialchars($data['sifra'], ENT_QUOTES, 'UTF-8');
	    $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');

        $upit1 = 'SELECT *
                FROM korisnici
                WHERE username = :username';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute(array(':username'=>$username));
        $korisnicka_imena = $statement1->fetchAll();    
        $brojac1 = count($korisnicka_imena);
        $postoji1 = false;
        if($brojac1 != 0) {
            $postoji1 = true;
        }

        $upit2 = 'SELECT *
        FROM korisnici
        WHERE email = :email';
        $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement2->execute(array(':email'=>$email));
        $emailovi = $statement2->fetchAll();
        $brojac2 = count($emailovi);
        $postoji2 = false;
        if($brojac2 != 0) {
            $postoji2 = true;
        }

        $username_validno = $postoji1;
        $email_validno = $postoji2;
        $validno = $username_validno && $email_validno;

    	if(!$validno) {
            $upit = $konekcija->prepare("INSERT INTO korisnici (username, sifra, email) 
            VALUES (:username, :sifra, :email)");
            $upit->bindParam(':username', $username);
            $upit->bindParam(':sifra', $sifra);
            $upit->bindParam(':email', $email);
            $upit->execute();
        }
        else {
            rest_error($request);
            return;
        }
	}

	function rest_delete ($request, $data) { 
		if(!isset($data['id'])) {
        	rest_error($request);
        	return;
        }
		try {
            $konekcija = new PDO("mysql:host=" . $GLOBALS['ime_servera'] .
            	";dbname=" . $GLOBALS['ime_baze'], $GLOBALS['usrnm'], $GLOBALS['password']);
            $konekcija->exec("set names utf8");
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $korisnici = array();
        $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');

        $upit2 = 'DELETE
                FROM korisnici
                WHERE id = :id';
        $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement2->execute(array(':id' => $id));
        $korisnici = $statement2->fetchAll();
	}

	function rest_put ($request, $data) { 
		if(!isset($data['username']) || !isset($data['id']) || !isset($data['email'])) {
        	rest_error($request);
        	return;
        }
		try {
            $konekcija = new PDO("mysql:host=" . $GLOBALS['ime_servera'] .
            	";dbname=" . $GLOBALS['ime_baze'], $GLOBALS['usrnm'], $GLOBALS['password']);
            $konekcija->exec("set names utf8");
            $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
	    $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
	    $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');

    	$upit = $konekcija->prepare('UPDATE korisnici
                                     SET username = :username,
                                        email = :email
                                    WHERE id = :id');
        $upit->bindParam(':username', $username);
        $upit->bindParam(':email', $email);
        $upit->execute();
	}

	function rest_error ($request) { 
		$poruka = array("greska"=>"Pogresni parametri");
		echo json_encode($poruka);
	}
	
	$method = $_SERVER['REQUEST_METHOD'];
	$request = $_SERVER['REQUEST_URI'];
	switch ($method) {
		case 'PUT':
			parse_str (file_get_contents('php://input'), $put_vars);
			zag (); $data = $put_vars; rest_put($request, $data); break;
		case 'POST':
			zag (); $data = $_POST; rest_post($request, $data); break;
		case 'GET':
			zag (); $data = $_GET; rest_get($request, $data); break;
		case 'DELETE':
            parse_str (file_get_contents('php://input'), $del_vars);
			zag (); $data = $del_vars; rest_delete($request, $data); break;
		default :
			header("{$_SERVER ['SERVER_PROTOCOL']} 404 Not Found");
			rest_error($request); break;
	}
?>