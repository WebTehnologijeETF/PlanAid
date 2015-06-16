<?php
	require('sendgrid-php/sendgrid-php.php');
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	function zag () {
		header ("{$_SERVER [ 'SERVER_PROTOCOL' ] } 200 OK");
		header ('ContentType: text/html');
		header ('AccessControlAllowOrigin:*');
	}
	
	function rest_get ($request, $data) { 
		
	}
	function rest_post ($request, $data) { 
		$eol = PHP_EOL;
		$message = 'Ime i prezime: ' . $data['ime'] . ' ' . $data['prezime'] . "\r\n" . 'Email: ' . $data['email'] . "\r\n" . 'URL: ' . $data['url'] . "\r\n" . "\r\n" . "\r\n" . $data['poruka'];
        

		$service_plan_id = "sendgrid_e2d43"; // your OpenShift Service Plan ID
		$account_info = json_decode(getenv($service_plan_id), true);

		$sendgrid = new SendGrid($account_info['username'], $account_info['password']);
		$email    = new SendGrid\Email();

		$email->addTo("aploco1@etf.unsa.ba")
			  ->addCc("vljubovic@etf.unsa.ba")
		      ->setReplyTo($data['email'])
		      ->setFrom($data['email'])
		      ->setSubject("Kontakt forma")
		      ->setText($message);

		try
		{
			$sendgrid->send($email);
		}
		catch (\SendGrid\Exception $e)
		{
			echo $e->getCode();
		    foreach($e->getErrors() as $er) {
		        echo $er;
			}
		}
	}
	function rest_delete ($request, $data) { }
	function rest_put ($request, $data) { }
	function rest_error ($request) { }
	
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