<?php
	
	require_once("../mpdf/mpdf.php");
	
	

	$mpdf = new mPDF('utf-8',array(100,160), 0, '', 0, 0,0,0);
	$mpdf->mirroMargins = true;




			switch ($row['plantel']) {
				case 'Merida-1':
					$plantel = 'Mérida-1';
					$dir = "
					Calle 55 No. 729. <br>
					Frac. Pacabtun <br>
					C.P. 97160 <br>
					Mérida, Yuc. <br>
					Tels (999) 9822915/9822918";
					break;
				case 'Merida-2':
					$plantel = 'Mérida-2';
					$dir = "
					Calle 108 No. 917 por Avenida Itzaes Sur. <br>
					Colonia: Sambulá <br>
					C.P. 97259 <br>
					Mérida, Yuc. <br>
					Tels (999) 9842496/9842498";
					break;
				case 'Merida-3':
					$plantel = 'Mérida-3';
					$dir = "
					Tablaje Catastral 31,800. <br>
					Entre km. 38 y 39. <br>
					Col. Polígono Chuburná. <br>
					C.P. 97203 <br>
					Mérida, Yuc. <br>
					Tels (999) 919-55-35";
					break;
				case 'Valladolid':
					$plantel = 'Valladolid';
					$dir = "
					Carretera Valladolid - Puerto Juárez 
					Lim. Zona Urbana. <br>
					Colonia: Militar <br>
					C.P. 97780 <br>
					Valladolid, Yuc. <br>
					Tels (985) 856 28 19 / 856 14 93";
					break;
				case 'TIZIMIN':
					$plantel = 'Tizimín';
					$dir = "
					Km. 25 carretera Tizimín - Buctzotz <br>
					C.P. 97700 <br>
					Tizimín, Yuc. <br>
					(986) 863 37 39 y 863 34 33";
					break;
				case 'Tizimin':
					$plantel = 'Tizimín';
					$dir = "
					Km. 25 carretera Tizimín - Buctzotz <br>
					C.P. 97700 <br>
					Tizimín, Yuc. <br>
					(986) 863 37 39 y 863 34 33";
					break;
				case 'Direccion-general':
					$plantel = 'Dirección general';
					$dir = "
					Calle 25 x 12 #189b <br>
					Colonia García Ginerés <br>
					C.P. 97070 <br>
					Mérida, Yucatán <br>
					(999) 925-78-81 / 85";
					break;
				
				default:
					# code...
					break;
			}

			$mpdf->AddPage();        	
			
        	$html_nom ='
				<img src="img/credenciales/admin.png" />
				';

			$mpdf->WriteHTML($html_nom);

		// echo $query;
	

	$mpdf->Output();


?>