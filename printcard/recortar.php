<?php 
require_once('../class/conexion.php'); 
	require_once("../mpdf/mpdf.php");
	include_once ("../phpqrcode/qrlib.php");
	$mysqli = conectar();

$query = "SELECT * from empleados Where id_credencial in (5,48)";
$res = $mysqli->query($query);
while ($row = mysqli_fetch_assoc($res)) {
	echo "<img src='../uploads/".$row['folder']."/".$row['foto']."' style='width:200px;'/><br>";

	$targ_w =  180;
	$targ_h = 200;
	$jpeg_quality = 90;
	$src = "../uploads/".$row['folder']."/".$row['foto'];
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
	imagecopyresampled($dst_r, $img_r, 0, 0, 60, 0, $targ_w, $targ_h, 180, 200);
	header('Content-type: image/jpeg');
	$imagen_recortada = "../uploads/".$row['folder']."/copia.jpg";

	imagejpeg($dst_r, $imagen_recortada, $jpeg_quality);

	// if(isset($imagen_recortada)){
	 echo "<img src=".$imagen_recortada."/><br>";
	// }

}
 ?>