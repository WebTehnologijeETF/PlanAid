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
			$statement1->execute(array(':vrsta_novosti' => 'sve_vijesti'));
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

	function rest_error ($request) { 
		$poruka = array("greska"=>"Pogresni parametri");
		echo json_encode($poruka);
	}
	
	$method = $_SERVER['REQUEST_METHOD'];
	$request = $_SERVER['REQUEST_URI'];
	switch ($method) {
		case 'GET':
			zag (); $data = $_GET; rest_get($request, $data); break;
		default :
			header("{$_SERVER ['SERVER_PROTOCOL']} 404 Not Found");
			rest_error($request); break;
	}
?>