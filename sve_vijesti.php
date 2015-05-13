<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Event planning</title>
	<link rel="stylesheet" type="text/css" href="css/zadaca1.css">
	<link rel="shortcut icon" href="photos/logo.ico">
</head>

<body onload="SakrijSubmenu()" class="body_vijesti">
	<section id="frejm">
		<?php
			header('Content-Type: text/html; charset=UTF-8');
			$vijesti = array();
			$lista_fajlova = scandir("php/novosti/sve_vijesti");
			$lista_vijesti = array();
			for ($i = 0; $i < count($lista_fajlova); $i++) {
				if (!is_dir('php/novosti/sve_vijesti/' . $lista_fajlova[$i])) {
					$sadrzaj_fajla = file('php/novosti/sve_vijesti/' . $lista_fajlova[$i]);
					array_push($vijesti, $sadrzaj_fajla);
					array_push($lista_vijesti, $lista_fajlova[$i]);
				}
			}
			usort ($vijesti, function($a, $b) { 	
						$datum1 = date('Y-m-d H:i:s', strtotime($a[0]));
						$datum2 = date('Y-m-d H:i:s', strtotime($b[0]));
						return $datum1 < $datum2;
					});
			foreach ($vijesti as $news) {
				$sadrzaj_stranice = '<br><div>';
					if($news[3] != "") {
						$sadrzaj_stranice .= '<div class="frejm-image">' .
						'<table class="frejm-image">' .
						'<tr>' . 
							'<td class="frejm-image">' .
								'<img src="' . htmlspecialchars($news[3], ENT_QUOTES, 'UTF-8') . '" class="frejm-image" alt="slika">' .
							'</td>' .
						'</tr>' .
						'</table>' .
						'</div>';
					}
					else {
						$sadrzaj_stranice .= '<div class="frejm-image">' .
						'<table class="frejm-image">' .
						'<tr>' . 
							'<td class="frejm-image">' .
								'<img src="../photos/noimage.gif" class="frejm-image" alt="slika">' .
							'</td>' .
						'</tr>' .
						'</table>' .
						'</div>';
					}
					$sadrzaj_stranice .= '<div class="frejm-text">' . 
						htmlspecialchars($news[0], ENT_QUOTES, 'UTF-8') . 
						'<br>' .
						htmlspecialchars($news[1], ENT_QUOTES, 'UTF-8') . 
						'<br><br>' .
						htmlspecialchars(strtoupper(substr($news[2], 0, 1)) . strtolower(substr($news[2], 1)), ENT_QUOTES, 'UTF-8') . 
						'<br><br>';
					$brojac = count($news);
					for ($i = 4; $i < count($news); $i++) {
						if (substr($news[$i], 0, 2) == '--') {
							$brojac = $i;
							break;
						}
						$sadrzaj_stranice .= htmlspecialchars($news[$i], ENT_QUOTES, 'UTF-8');
					}					
					if ($brojac != count($news)) {	
						$ime_detalji = 'php/novosti/sve_vijesti/detalji/' .
							substr($lista_vijesti[array_search($news, $vijesti)], 0, -4);
						$sadrzaj_fajla_detalji = $sadrzaj_stranice;					
						$sadrzaj_stranice .= ' <a class="frejm" onclick="PrikaziStranicu(\'' . $ime_detalji . '\', 1)">' . ' Detaljnije...' . '</a>';
						$brojac++;
						$detalji = '';
						for ($j = $brojac; $j < count($news); $j++) {
							$detalji .= $news[$j];
						}			
						$sadrzaj_fajla_detalji .= $detalji;	
						$sadrzaj_fajla_detalji .= '</div>' . '</div>';
						$fajl_detalji = fopen($ime_detalji . '.php', 'w+');
						fwrite($fajl_detalji, $sadrzaj_fajla_detalji);
					}	
					$sadrzaj_stranice .= '</div>' . '<br>' . 
							'<hr>' .
							'</div>';
					echo html_entity_decode(htmlspecialchars($sadrzaj_stranice, ENT_QUOTES, 'UTF-8'));		
			}
		?>
	</section>
	<script src="javascript/menu.js"></script>
</body>

</html>

