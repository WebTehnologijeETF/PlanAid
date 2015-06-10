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

        $komentari = array();	        

        if(count($data) === 0) {
        	$upit1 = 'SELECT kom.id, kom.email, kom.tekst, kom.vijest, kom.autor, kom.datum, kor.username
                    FROM komentari kom
                    JOIN korisnici kor ON kom.autor = kor.id';
	        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	        $statement1->execute();
	        $komentari = $statement1->fetchAll();

	        echo json_encode($komentari);
        }
        else if(count($data) !== 0 && isset($data['vijest'])) {
        	$vijest = htmlspecialchars($data['vijest'], ENT_QUOTES, 'UTF-8');
        	$upit1 = 'SELECT kom.id, kom.email, kom.tekst, kom.vijest, kom.autor, kom.datum, kor.username
                    FROM komentari kom
                    JOIN korisnici kor ON kom.autor = kor.id
			    	WHERE kom.vijest = :vijest
			    	ORDER BY kom.datum ASC';
			$statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement1->execute(array(':vijest' => $vijest));
			$komentari = $statement1->fetchAll();

			echo json_encode($komentari);
        }
        else {
        	rest_error($request);
        	return;
        }
	}

	function rest_post ($request, $data) { 
		if(!isset($data['vijest'])	|| !isset($data['tekst'])) {
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

        $datetime = new DateTime();
	    $datum = $datetime->format('Y.m.d H:i:s');
	    $vijest = htmlspecialchars($data['vijest'], ENT_QUOTES, 'UTF-8');
	    $tekst = htmlspecialchars($data['tekst'], ENT_QUOTES, 'UTF-8');

	    $upit = $konekcija->prepare("INSERT INTO komentari (datum, autor, email, vijest, tekst) 
	    VALUES (:datum, :autor, :email, :vijest, :tekst)");
	    $upit->bindParam(':datum', $datum);
	    $upit->bindParam(':vijest', $vijest);
	    $upit->bindParam(':tekst', $tekst);    
	    
	    if(isset($data['autor'])) {
	    	$autor = htmlspecialchars($data['autor'], ENT_QUOTES, 'UTF-8');
	    	$upit->bindParam(':autor', $autor);
	    }
	    else {
	    	$autor = 0;
	    	$upit->bindParam(':autor', $autor);
	    }
	    if(isset($data['email'])) {
	    	$email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
	    	$upit->bindParam(':email', $email);
	    }
	    else {
	    	$email = "";
	    	$upit->bindParam(':email', $email);
	    }
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

        $komentari = array();
        $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');
        $vijest = htmlspecialchars($data['vijest'], ENT_QUOTES, 'UTF-8');

        foreach($komentari as $kom) {
            if ($id === $kom['id']) {
                try {
                    $upit3 = 'DELETE
                                FROM komentari
                                WHERE vijest = :vijest';
                    $statement3 = $konekcija->prepare($upit3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement3->execute(array(':vijest' => $vijest));
                    $komentari = $statement3->fetchAll();
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
		}
	}

	function rest_put ($request, $data) {
		//ne trebaju se azurirati komentari?
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