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

        $desavanja = array();	

        if(count($data) === 0) {
        	$upit1 = 'SELECT *
			    	FROM desavanja
			    	ORDER BY datum ASC';
			$statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement1->execute();
			$desavanja = $statement1->fetchAll();

			echo json_encode($desavanja);
        }
        else if(isset($data['id'])) {
        	$id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');
        	$upit1 = 'SELECT *
                    FROM desavanja
                    WHERE id = :id';
	        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	        $statement1->execute(array(':id' => $id));
	        $desavanja = $statement1->fetchAll();

	        echo json_encode($desavanja);
        }
        else if(isset($data['username'])) {
            $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
            $upit1 = 'SELECT d.id, d.naziv, d.datum, d.lokacija, k.username
                    FROM desavanja d
                    JOIN korisnici k ON d.autor = k.id
                    WHERE k.username = :username
                    ORDER BY datum ASC';
            $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $statement1->execute(array(':username' => $username));
            $desavanja = $statement1->fetchAll();

            echo json_encode($desavanja);
        }
        else {
            rest_error($request);
            return;
        }
	}

	function rest_post ($request, $data) { 
		if(!isset($data['username']) || !isset($data['naziv']) || !isset($data['datum']) || !isset($data['lokacija'])) {
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
	    $naziv = htmlspecialchars($data['naziv'], ENT_QUOTES, 'UTF-8');
	    $datum = htmlspecialchars($data['datum'], ENT_QUOTES, 'UTF-8');
	    $lokacija = htmlspecialchars($data['lokacija'], ENT_QUOTES, 'UTF-8');

        $upit1 = 'SELECT d.autor
                FROM desavanja d
                JOIN korisnici k ON d.autor = k.id
                WHERE k.username = :username';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute(array(':username' => $username));
        $autor = $statement1->fetchAll();

	    $upit = $konekcija->prepare("INSERT INTO desavanja (naziv, datum, lokacija, autor) 
	    VALUES (:naziv, :datum, :lokacija, :autor)");
	    $upit->bindParam(':datum', $datum);
	    $upit->bindParam(':autor', $autor[0]['autor']);
	    $upit->bindParam(':naziv', $naziv);
	    $upit->bindParam(':lokacija', $lokacija);
	    $upit->execute();
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

        $desavanja = array();
        $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');
        $upit2 = 'DELETE
                FROM desavanja
                WHERE id = :id';
        $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement2->execute(array(':id' => $id));
        $desavanja = $statement2->fetchAll();
	}

	function rest_put ($request, $data) {
		if(!isset($data['username']) || !isset($data['naziv']) || !isset($data['lokacija']) || !isset($data['id']) || !isset($data['datum'])) {
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

        $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
        $naziv = htmlspecialchars($data['naziv'], ENT_QUOTES, 'UTF-8');
        $datum = htmlspecialchars($data['datum'], ENT_QUOTES, 'UTF-8');
        $lokacija = htmlspecialchars($data['lokacija'], ENT_QUOTES, 'UTF-8');

        $upit1 = 'SELECT d.autor
                FROM desavanja d
                JOIN korisnici k ON d.autor = k.id
                WHERE k.username = :username';
        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement1->execute(array(':username' => $username));
        $autor = $statement1->fetchAll();

        $upit = $konekcija->prepare("UPDATE desavanja
                                    SET datum = :datum,
                                        naziv = :naziv,
                                        lokacija = :lokacija
                                    WHERE id = :id");
        $upit->bindParam(':id', $id);
        $upit->bindParam(':datum', $datum);
        $upit->bindParam(':naziv', $naziv);
        $upit->bindParam(':lokacija', $lokacija);
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