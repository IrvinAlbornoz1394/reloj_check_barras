<?php
require_once('../class/conexion.php'); 
if ($_SESSION['id_perfil'] != 1) {
  header("location: ../");
}
?>
<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="utf-8">
	<title>Conalep | Credeniales</title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../css/estilos.css"> -->
  <style type="text/css" media="print">
  body{
    padding: 0;
    margin: 0;
  }
  * {
    color: #000 !important;
    text-shadow: none !important;
    background: transparent !important;
    box-shadow: none !important;
  }
  img {
    /*page-break-inside: avoid;*/
    max-width: 100% !important;
    max-height: 100% !important;
    margin: 0;
    padding: 0;
  }  
  #btn-print{
    display: none;
  }
  </style>
</head>
<body>
  <img src="../img/back/front_new.png" width="425" height="669" id="setPic-1">
  <img src="../img/back/back_new.png" width="425" height="669" id="setPic-2" >
  <input type="button" id="btn-print" value="Confirmar" onclick="confirmPrint(<?= $_GET['id'] ?>, 1);">
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  <script type="text/javascript" src="<?= ROOT;?>js/funciones.js"></script>
</body>
</html>