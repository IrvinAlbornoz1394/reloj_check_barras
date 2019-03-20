<?php

    // require('fpdf/fpdf.php');
    require('fpdf/code128.php');
    

    /* Si hay valores Creamos el PDF */
    if(isset($_GET['ids'])){

        $fpdf =  new PDF_Code128();

        $ids = json_decode($_GET['ids']);
		$credenciales =  $ids->credenciales;
		$i = 0;
		foreach ($credenciales as $c) {
			if($i == 0){
				$array = $c;
			}else{
				$array = $array.",".$c;
			}
			$i++;
		}
    }

        $mysqli = new mysqli("localhost", "root", "", "bd_conalep_credenciales");
		$mysqli->set_charset("utf8");
		// $mysqli = new mysqli("mx42.hostgator.mx", "	boonwaya_inve", "Irvin1394", "boonwaya_inveshop");
		// mysqli_query("SET NAMES 'utf8'");
		/* check connection */
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id_plantel = 1;


		$query = "SELECT u.*,tu.nombre_tipo_usuario, p.nombre_p, d.nombre_departamento FROM usuarios u inner join tipo_usuarios tu On u.id_tipo_usuario = tu.id_tipo_usuario INNER JOIN planteles p ON p.id_plantel = u.id_plantel INNER JOIN departamentos d ON d.id_departamento = u.id_departamento WHERE u.id_plantel =".$id_plantel." && u.id_usuario IN (".$array.")";
		$result = $mysqli->query($query);
		if(!$result){
			$json = array('success' => false,
			              'message' => 'La consulta Fallo');
			echo json_encode($json);
			exit();
		}
        $row = mysqli_fetch_array($result);
        while ($row = mysqli_fetch_array($result)) {
            /* VALORES PARAMOSTRAR */
            $foto = "img/usuarios/".$row['file_foto'];
            if($row['file_foto'] == "" || $row['file_foto'] == null){
                $foto = "img/usuarios/usuario.png";
            }

            $nombre = $row['nombres']." ".$row['apellido_pat']." ".$row['apellido_mat'];

            $plantel = $row['nombre_p'];

            $puesto = $row['puesto'];

            $codigo = $row['codigo_barras'];


            /* COMENZAMOS A CREAR EL PDF */


            $fpdf->AddPage();
            /* barcode('img/123456789.png', '123456789', 20, 'horizontal', 'code128', true); */
            $fpdf->Image('img/credenciales/admin.PNG',10,10,118);
            $fpdf->Image($foto,40,22,27);
            $fpdf->SetFont('Helvetica','B',11);
            $fpdf->Ln(12);

            $domicilio = $dir = "
            Calle 55 No. 729.
            Frac. Pacabtun 
            C.P. 97160 
            Mérida, Yuc. 
            Tels: (999)9822915 /9822918";
            
            $fpdf->SetFont('Helvetica','B',9);
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Domicilio"));
            $fpdf->Ln();
            $fpdf->SetFont('Helvetica','',9);
            $fpdf->SetFont('Helvetica','',9);
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Tablaje Catastral 31,800"));
            $fpdf->Ln();
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Entre km. 38 y 39."));
            $fpdf->Ln();
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Col. Polígono Chuburná"));
            $fpdf->Ln();
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Mérida, Yuc. C.P. 97203"));
            $fpdf->Ln();
            $fpdf->Cell(63,50,"",0,0,'L');
            $fpdf->Cell(60, 5,utf8_decode( "Tels: Tels (999) 9195535 / 9195536"));
            $fpdf->Ln(18);
            $fpdf->Cell(63,50,"",0,0,'C');
            $fpdf->Cell(55, 5,utf8_decode( "C.P. Arturo Sabido Gongora"),0,0,"C");
            $fpdf->Ln();
            $fpdf->Cell(58,50,"",0,0,'L');
            $fpdf->Cell(63, 5,utf8_decode( "Director del Plantel"),0,0,"C");
            $fpdf->Ln(10);


            $fpdf->Code128(76,80,$codigo,45,15);
            

            // new barCodeGenrator($codigo,1,'img/codigo_barras/'.$nombre.'.jpg',105, 42,true);            
            // $fpdf->Image('img/codigo_barras/'.$nombre.'.jpg');
            

            
            $fpdf->SetY(20); 
            $fpdf->SetLeftMargin(13);
            $fpdf->SetFont('Helvetica','B',12);
            $fpdf->cell(40,8,"Nombre:");
            $fpdf->Ln();
            $fpdf->SetFont('Helvetica','',9);
            $fpdf->SetLeftMargin(13);
            $fpdf->MultiCell(23, 5, $nombre);
            // $fpdf->Ln(11);
            
            $fpdf->setY(60);
            $fpdf->SetTextColor(255,255,255);
            $fpdf->SetFont('Helvetica','B',10);
            $fpdf->cell(45,5,"Unidad Administrativa");
            $fpdf->Ln();
            $fpdf->cell(15,4,"Plantel:");
            $fpdf->SetFont('Helvetica','',10);
            $fpdf->cell(20,4,utf8_decode($plantel));

            $fpdf->Ln(7);
            $fpdf->SetFont('Helvetica','B',11);
            $fpdf->SetTextColor(0,0,0);
            $fpdf->cell(15,4,"Puesto:");
            $fpdf->Ln();
            $fpdf->SetFont('Helvetica','',7);
            $fpdf->MultiCell(30,4,$puesto,0,"L");




        }

    
    $fpdf->OutPut();

?>