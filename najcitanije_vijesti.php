<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu()" class="body_vijesti">

	<section id="frejm"><br>
		<?php
			header('Content-Type: text/html; charset=UTF-8');
			$vijesti = array();
			$lista_fajlova = scandir("php/novosti/najcitanije_vijesti");
			for ($i = 2; $i < count($lista_fajlova); $i++) {
				$sadrzaj_fajla = file('php/novosti/najcitanije_vijesti/' . $lista_fajlova[$i]);
				array_push($vijesti, $sadrzaj_fajla);
			}
			usort ($vijesti, function($a, $b) { 	
						$datum1 = date('Y-m-d H:i:s', strtotime($a[0]));
						$datum2 = date('Y-m-d H:i:s', strtotime($b[0]));
						return $datum1 < $datum2;
					});
			foreach ($vijesti as $news) {
				echo '<div>';
					if($news[3] != "") {
						echo '<div class="frejm-image">' .
						'<table class="frejm-image">' .
						'<tr>' . 
							'<td class="frejm-image">' .
								'<img src="' . $news[3] . '" class="frejm-image" alt="slika">' .
							'</td>' .
						'</tr>' .
						'</table>' .
						'</div>';
					}
					echo '<div class="frejm-text">' . 
						$news[0] . 
						'<br>' .
						$news[1] . 
						'<br><br>' .
						$news[2] . 
						'<br><br>';
					$brojac = count($news);
					for ($i = 4; $i < count($news); $i++) {
						if (substr($news[$i], 0, 2) == '--') {
							$brojac = $i;
							break;
						}
						echo $news[$i];
					}
					if ($brojac != count($news)) {
						echo ' <a href="#" class="frejm">' . ' Detaljnije...' . '</a>';
					}		
					echo '</div>' . '<br>' . 
							'<hr>' .
							'</div>';			
			}
		?>
	</section>
	<script src="javascript/menu.js"></script>
</body>

</html>

