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

        $vijesti = array();	

        if(count($data) === 0) {
        	$upit1 = 'SELECT *
			    	FROM novosti
			    	WHERE vrsta_novosti = :vrsta_novosti
			    	ORDER BY datum DESC';
			$statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement1->execute(array(':vrsta_novosti' => 'nove_vijesti'));
			$vijesti = $statement1->fetchAll();

			echo json_encode($vijesti);
        }
        else {
        	if(!isset($data['id'])) {
        		rest_error($request);
        		return;
        	}
        	$id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');
        	$upit1 = 'SELECT *
                    FROM novosti
                    WHERE id = :id';
	        $statement1 = $konekcija->prepare($upit1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	        $statement1->execute(array(':id' => $id));
	        $vijesti = $statement1->fetchAll();

	        echo json_encode($vijesti);
        }
	}

	function rest_post ($request, $data) { 
		if(!isset($data['autor']) || !isset($data['naslov']) || !isset($data['slika'])
			|| !isset($data['tekst'])) {
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
	    $datum = $datetime->format('d.m.y H:i:s');
	    $autor = htmlspecialchars($data['autor'], ENT_QUOTES, 'UTF-8');
	    $naslov = htmlspecialchars($data['naslov'], ENT_QUOTES, 'UTF-8');
	    $slika = htmlspecialchars($data['slika'], ENT_QUOTES, 'UTF-8');
	    $tekst = htmlspecialchars($data['tekst'], ENT_QUOTES, 'UTF-8');
	    $vrsta_novosti = "nove_vijesti";

	    $upit = $konekcija->prepare("INSERT INTO novosti (datum, autor, naslov, slika, tekst, detaljnije, vrsta_novosti) 
	    VALUES (:datum, :autor, :naslov, :slika, :tekst, :detaljnije, :vrsta_novosti)");
	    $upit->bindParam(':datum', $datum);
	    $upit->bindParam(':autor', $autor);
	    $upit->bindParam(':naslov', $naslov);
	    $upit->bindParam(':slika', $slika);
	    $upit->bindParam(':tekst', $tekst);
	    $upit->bindParam(':vrsta_novosti', $vrsta_novosti);
	    $upit->bindParam(':detaljnije', "");
	    if(isset($data['detaljnije'])) {
	    	$detaljnije = htmlspecialchars($data['detaljnije'], ENT_QUOTES, 'UTF-8');
	    	$upit->bindParam(':detaljnije', $detaljnije);
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

        $vijesti = array();
        $id = htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8');

        foreach($vijesti as $news) {
            if ($id === $news['id']) {
                try {
                    $upit3 = 'DELETE
                                FROM komentari
                                WHERE vijest = :vijest';
                    $statement3 = $konekcija->prepare($upit3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $statement3->execute(array(':vijest' => $id));
                    $upit2 = 'DELETE
			                FROM novosti
			                WHERE id = :id';
			        $statement2 = $konekcija->prepare($upit2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			        $statement2->execute(array(':id' => $id));
			        $vijesti = $statement2->fetchAll();
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
		}
	}

	function rest_put ($request, $data) {
		if(!isset($data['autor']) || !isset($data['naslov']) || !isset($data['slika'])
			|| !isset($data['tekst']) || !isset($data['id'])) {
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
	    $autor = htmlspecialchars($data['autor'], ENT_QUOTES, 'UTF-8');
	    $naslov = htmlspecialchars($data['naslov'], ENT_QUOTES, 'UTF-8');
	    $slika = htmlspecialchars($data['slika'], ENT_QUOTES, 'UTF-8');
	    $tekst = htmlspecialchars($data['tekst'], ENT_QUOTES, 'UTF-8');
	    $vrsta_novosti = "nove_vijesti";

	    $upit = $konekcija->prepare('UPDATE novosti
                                 SET datum = :datum,
                                    autor = :autor,
                                    naslov = :naslov,
                                    slika = :slika,
                                    tekst = :tekst,
                                    detaljnije = :detaljnije,
                                    vrsta_novosti = :vrsta_novosti
                                WHERE id = :id');
        $upit->bindParam(':datum', $datum);
        $upit->bindParam(':autor', $autor);
        $upit->bindParam(':naslov', $naslov);
        $upit->bindParam(':slika', $slika);
        $upit->bindParam(':tekst', $tekst);
        $upit->bindParam(':vrsta_novosti', $vrsta_novosti);
        $upit->bindParam(':detaljnije', "");
	    if(isset($data['detaljnije'])) {
	    	$detaljnije = htmlspecialchars($data['detaljnije'], ENT_QUOTES, 'UTF-8');
	    	$upit->bindParam(':detaljnije', $detaljnije);
	    }
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