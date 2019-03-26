<?php
	date_default_timezone_set('UTC');
	date_default_timezone_set("America/Mexico_City");
 	// session_start();
	header("Content-Type: text/html;charset=utf-8");
	if(isset($_POST['opc'])){
		$opc = $_POST['opc'];
	}elseif (isset($_GET['opc'])) {
		$opc = $_GET['opc'];
	}
	switch ($opc) {
		case 'checkout':
			checkout();
			break;		
		case 'get_usuarios':
			get_usuarios();
			break;
		case 'get_nom_usuarios':
			get_nom_usuarios();
			break;
		case 'guardar_usuario':
			guardar_usuario();
			break;
		case 'get_tipo_usuarios':
			get_tipo_usuarios();
			break;
		case 'get_departamentos':
			get_departamentos();
			break;
		case 'get_usuario':
			get_usuario();
			break;
		case 'get_tabla_insidencias':
			get_tabla_insidencias();
			break;
		case 'carga_excel':
			carga_excel();
			break;
		case 'suc_x_usuario':
			suc_x_usuario();
			break;
		case 'get_config':
			get_config();
			break;
		case 'get_empresas':
			get_empresas();
			break;
		case 'nvo_cliente':
			nvo_cliente();
			break;
		case 'get_ventas':
			get_ventas();
			break;
		case 'get_usuarios_sucursal':
			get_usuarios_sucursal();
			break;
		case 'cerrar_caja':
			cerrar_caja();
			break;
		case 'estatus_suc':
			estatus_suc();
			break;
		case 'estatus_producto':
			estatus_producto();
			break;
		case 'delete_us':
			delete_us();
			break;
		case 'info_empresa':
			info_empresa();
			break;
		case 'guardar_productos':
			guardar_productos();
			break;
		case 'info_producto':
			info_producto();
			break;
		case 'insert_usuario':
			insert_usuario();
			break;
		case 'insert_gasto':
			insert_gasto();
			break;
		case 'insert_sucursal':
			insert_sucursal();
			break;
		case 'cobrar':
			cobrar();
			break;
		case 'info_caja':
			info_caja();
			break;
		case 'abrir_caja':
			abrir_caja();
			break;
		case 'set_usuario_empresa':
			set_usuario_empresa();
			break;
		case 'estatusUsuario':
			estatusUsuario();
			break;
		case 'get_sucursales':
			get_sucursales();
			break;
		case 'get_venta_sucursales':
			get_venta_sucursales();
			break;
		case 'cambiar_password':
			cambiar_password();
			break;
		case 'logout':
			logout();
			break;
		case 'update_logo':
			update_logo();
			break;
		default:
			# code...
			break;
	}

	function conexion(){
		$mysqli = new mysqli("localhost", "root", "", "bd_conalep_credenciales");
		$mysqli->set_charset("utf8");
		// $mysqli = new mysqli("mx42.hostgator.mx", "	boonwaya_inve", "Irvin1394", "boonwaya_inveshop");
		// mysqli_query("SET NAMES 'utf8'");
		/* check connection */
		if (!$mysqli->connect_errno) {
			return $mysqli;
		}

	}

	function logout(){
		session_start();
		session_unset();
		session_destroy();
		header('location: ../login.php');
	}

	function checkout(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$usuarios = "";
		$id_plantel = 1;
		$horas = [];
		$codigo_barras = $_POST['codigo'];
		$check_falso = true;

		$query = "select u.id_usuario, 
		u.nombres, 
        u.apellido_pat, 
        u.apellido_mat, 
        u.puesto, 
        img_foto, 
        file_foto, 
        d.nombre_departamento, 
        h.id_horario 
			from usuarios u 
            LEFT JOIN 
				departamentos d 
                on 
				d.id_departamento = u.id_departamento 
			LEFT JOIN horario_x_usuario hu
				on hu.id_usuario = u.id_usuario
			LEFT JOIN horarios h 
				ON h.id_horario = hu.id_horario
		Where 
	u.id_plantel = '$id_plantel' && u.codigo_barras = '$codigo_barras'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se realizo la consulta";
		}
		$row = mysqli_fetch_array($result);
		$usuario = array('id_usuario' => $row['id_usuario'],
					  'nombres' => $row['nombres'],
					  'apellido_pat' => $row['apellido_pat'],
					  'apellido_mat' => $row['apellido_mat'],
					  'puesto' => $row['puesto'],
					  'departamento' => $row['nombre_departamento'],
					  'img_foto' => $row['img_foto'],
					  'file_foto' => $row['file_foto'],
					  'id_horario' => $row['id_horario']
					  );
		
		
		$fecha = $_POST['fecha'];
		$dia_semana = $_POST['dia_semana'];
		$hora = $_POST['hora'];

		if($row['id_usuario'] !== null){
			$check = guardar_checkout($row['id_usuario'],$row['id_horario'],$fecha,$dia_semana,$hora);	
			$check_falso = false;
		}

		


		// // DESCOMENTAR PARA FUNCION DE RETARDOS
		// $query = "Select h.* from horas h 
		// LEFT join 
  //       horas_x_horario hxh 
		// 	ON 
		// h.id_hora =  hxh.id_hora
		// LEFT JOIN 
		// horarios hs 
  //           ON 
		// hxh.id_horario = hs.id_horario
		// 	LEFT JOIN 
		// horario_x_usuario hu
  //           on hu.id_horario = hs.id_horario
  //       Where hu.id_usuario =".$row['id_usuario']." group BY h.id_hora";
		// $result = $mysqli->query($query);
		// if(!$result){
		// 	$success = false;
		// 	$message = "No se realizo la consulta";
		// }

		$hora_cercana = "";
		$horachecada = "";
		$h = "";
		$check = '';
		$show_message = false;

		// while ($row = mysqli_fetch_array($result)){

		// 	$horaEntrada = new DateTime($row['h_entrada']);
		// 	$horaSalida = new DateTime($row['h_salida']);
		// 	$horachecada = new DateTime($hora);
		// 	$interval_entrada = $horachecada->diff($horaEntrada);
		// 	$interval_salida = $horachecada->diff($horaSalida);

			
		// 	$difE = $interval_entrada->format('%H');
		// 	$difE = $difE*60;


		// 	$difS = $interval_salida->format('%H');
		// 	$difS = $difS*60;
			
		// 	if($difE < 50){
		// 		$hora_cercana = $horaEntrada;
		// 		$check = 'E';
		// 		$h = $difE;
		// 	}
		// 	if($difS < 50){
		// 		$hora_cercana = $horaSalida;
		// 		$check = 'S';
		// 		$h = $difS;
		// 	}
		// 	// $interval = $horaInicio->diff($horaTermino);
		// 	// $h = $interval->format('%H horas %i minutos %s seconds');

		// }


		// if($hora_cercana == ""){
		// 	$message = "Fuera de Tiempo Permitido";
		// 	$show_message = true;
		// }else{
		// 	$diff = $horachecada->diff($hora_cercana);
		// 	if($check == 'E'){
		// 		if($hora_cercana < $horachecada){
		// 			$message = "retardo de ".$diff->format('%H horas %i minutos');
		// 		}
		// 	}
		// 	if($check == 'S'){
		// 		if($hora_cercana > $horachecada){
		// 			$message = "Estas Saliendo ".$diff->format('%H horas %i minutos')." antes";
		// 		}
		// 	}
		
			
		// }


		$usuario['horario'] = $horas;
		$usuario['h_horario'] = $hora_cercana;
		$usuario['h_c'] = $horachecada;


		$json = array('success' => $success,
					  'message' => $message,
					  'show_message' => $show_message,
					  'check_falso' => $check_falso,
					  'data' => $usuario);
		echo json_encode($json);
	}

	function guardar_checkout($id_usuario,$id_horario,$fecha,$dia_semana,$hora){
		$mysqli = conexion();
		$success = true;
		$id_horario = 1;
		$query = "INSERT INTO insidencias (id_usuario,id_horario,fecha,dia_semana,h_checkout) VALUES  ('$id_usuario','$id_horario','$fecha','$dia_semana','$hora')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		return $success;
	}

	function get_usuarios(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$usuarios = [];
		$id_plantel = 1;


		$query = "SELECT u.*,tu.nombre_tipo_usuario, p.nombre_p, d.nombre_departamento FROM usuarios u inner join tipo_usuarios tu On u.id_tipo_usuario = tu.id_tipo_usuario INNER JOIN planteles p ON p.id_plantel = u.id_plantel INNER JOIN departamentos d ON d.id_departamento = u.id_departamento WHERE u.id_plantel =".$id_plantel;
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}
		while ($row = mysqli_fetch_array($result)) {
			$usuarios[] = array('id_usuario' => $row['id_usuario'],
						  'nombres' => $row['nombres'],
						  'apellido_pat' => $row['apellido_pat'],
						  'apellido_mat' => $row['apellido_mat'],
						  'puesto' => $row['puesto'],
						  'img_foto' => $row['img_foto'],
						  'file_foto' => $row['file_foto'],
						  'id_contrato' => $row['id_tipo_contrato'],
						  'id_departamento' => $row['id_departamento'],
						  'tipo_usuario' => $row['nombre_tipo_usuario'],
						  'plantel' => $row['nombre_p'],
						  'departamento' => $row['nombre_departamento']
						  );
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $usuarios);
		echo json_encode($json);
	}

	function get_nom_usuarios(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$usuarios = [];
		$id_plantel = 1;
		$id_tipo = $_POST['id_tipo'];


		$query = "SELECT id_usuario, nombres, apellido_pat, apellido_mat from usuarios WHERE id_tipo_usuario = $id_tipo AND id_plantel =".$id_plantel;
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}else{
			while ($row = mysqli_fetch_array($result)) {
			$usuarios[] = array('id_usuario' => $row['id_usuario'],
						  'nombres' => $row['nombres'],
						  'apellido_pat' => $row['apellido_pat'],
						  'apellido_mat' => $row['apellido_mat']
						  );
			}	
		}
		
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $usuarios);
		echo json_encode($json);
	}

	function guardar_usuario(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$message = "Informacion Guardada Correctamente.";
		$success = true;
		$nombreFoto = "";
		$fileIMG = "";
		$save_imagen = false;

		
		$id_usuario = $_POST['id_usuario'];	
		$id_plantel = 1;
		$nombres = strtoupper($_POST['nombres']);
		$apellido_pat = strtoupper($_POST['apellido_pat']);
		$apellido_mat = strtoupper($_POST['apellido_mat']);
		$puesto = strtoupper($_POST['puesto']);
		$is_admin = 0;

		$id_tipo_usuario = $_POST['tipo_usuario'];
		$id_departamento = $_POST['departamento'];
		$id_tipo_contrato = 1;
		$codigo_barras = uniqid(10);

		$clave = "";
		$pass = "";


		$img1 = ""; 
		$img2 = "";
		$img3 = "";

		$admin1 = "";
		$admin2 = "";
		$admin3 = "";

		if(isset($_POST['admin'])){
			$clave = $_POST['nombre_usuario'];
			$pass = md5($_POST['password']);

			$is_admin = 1;

			$admin1 = "clave_sesion,pass_sesion,";
			$admin2 = "'$clave','$pass',";
			$admin3 = "clave_sesion = '$clave', pass_sesion = '$pass',";
		}


		if(isset($_FILES["foto_usuario"]["name"]) && isset($_FILES["foto_usuario"]["name"][0])){
			$file = $_FILES["foto_usuario"];
			
			/* Nombre de la foto original */
			$nombreFoto = $file["name"];
			$tipo = $file["type"];
		    $ruta_provisional = $file["tmp_name"];
			$size = $file["size"];

		    $carpeta = "../img/usuarios/";
		    if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif'){
		        $message = "El archivo ".$nombreFoto." no es una imagen.";
		        $success = false;
		    }
		    // else 
		    // if($size > 1024*1024){
		    //     $message = "El archivo ".$nombreFoto." tiene un peso mayor a 1Mb.";
		    //     $success = false;
		    // }
		    else{
		    	$ext = pathinfo($nombreFoto, PATHINFO_EXTENSION);
				$fileIMG = uniqid().".".$ext;
				$src = $carpeta.$fileIMG;
		        if(move_uploaded_file($ruta_provisional, $src)){
					$message = "Foto Cargada";
					$save_imagen = true;
	        	}else{
	        		$message = "La imagen no se pudo guardar";
	        		$success = false;
	        	}
	        }
		}

		
		if($save_imagen){
				$img1 = 'img_foto,file_foto,';
				$img2 = "'$nombreFoto','$fileIMG',";
				$img3 = "img_foto = '$nombreFoto', file_foto = '$fileIMG',";
		}

		$query = "INSERT INTO usuarios (id_usuario,id_tipo_usuario,id_plantel,nombres,apellido_pat,apellido_mat,puesto,".$img1."admin,".$admin1."id_tipo_contrato,id_departamento,codigo_barras)
			VALUES
			('$id_usuario','$id_tipo_usuario','$id_plantel','$nombres','$apellido_pat','$apellido_mat','$puesto',".$img2."'$is_admin',".$admin2."'$id_tipo_contrato','$id_departamento','$codigo_barras')
			ON DUPLICATE KEY UPDATE
			id_tipo_usuario = '$id_tipo_usuario', id_plantel = '$id_plantel', nombres = '$nombres', apellido_pat = '$apellido_pat', apellido_mat = '$apellido_mat', puesto = '$puesto',".$img3." admin = '$is_admin',".$admin3." id_tipo_contrato = '$id_tipo_contrato', id_departamento = '$id_departamento'";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
	    $json = array('success' => $success,
	    			  'message' => $message );
		echo json_encode($json);
	}

	function get_tipo_usuarios(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$tipos = [];


		$query = "SELECT * FROM tipo_usuarios";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}
		while ($row = mysqli_fetch_array($result)) {
			$tipos[] = array(
							'id_tipo' => $row['id_tipo_usuario'],
							'nombre_tipo' => $row['nombre_tipo_usuario']
						);
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $tipos);
		echo json_encode($json);
	}
	function get_departamentos(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$tipos = [];

		$id_institucion =1;


		$query = "SELECT * FROM departamentos Where id_institucion = $id_institucion";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}
		while ($row = mysqli_fetch_array($result)) {
			$tipos[] = array(
							'id_departamento' => $row['id_departamento'],
							'nombre_departamento' => $row['nombre_departamento']
						);
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $tipos);
		echo json_encode($json);
	}

	function get_tabla_insidencias(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$insidencias = [];
		$id_plantel = 1;
		$fecha_i = $_POST['fecha_i'];
		$fecha_f = $_POST['fecha_f'];
		$id_usuario = $_POST['usuario'];
		$tipo_usuario = $_POST['tipo_usuario'];
		$filtro = "";
		if($id_usuario !== '0'){
			$filtro = " AND id_usuario = $id_usuario";
		}

		$query = "SELECT i.*,u.nombres, u.apellido_pat,u.apellido_mat, u.puesto, u.file_foto from insidencias i INNER JOIN usuarios u on u.id_usuario = i.id_usuario INNER JOIN tipo_usuarios tu ON tu.id_tipo_usuario = u.id_tipo_usuario Where (fecha BETWEEN '$fecha_i' AND '$fecha_f')".$filtro;
		// $query = "SELECT u.*,tu.nombre_tipo_usuario, p.nombre_p, d.nombre_departamento FROM usuarios u inner join tipo_usuarios tu On u.id_tipo_usuario = tu.id_tipo_usuario INNER JOIN planteles p ON p.id_plantel = u.id_plantel INNER JOIN departamentos d ON d.id_departamento = u.id_departamento WHERE u.id_plantel =".$id_plantel;
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}
		while ($row = mysqli_fetch_array($result)) {
			$insidencias[] = array('id_insidencia' => $row['id_insidencia'],
						  'id_usuario' => $row['id_usuario'],
						  'nombres' => $row['nombres'],
						  'apellido_pat' => $row['apellido_pat'],
						  'apellido_mat' => $row['apellido_mat'],
						  'fecha' => $row['fecha'],
						  'dia' => $row['dia_semana'],
						  'check' => $row['h_checkout'],
						  'puesto' => $row['puesto'],
						  'foto' => $row['file_foto']
						  );
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $insidencias);
		echo json_encode($json);
	}

	function get_usuario(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id_usuario = $_POST['idu'];
		$success = true;
		$message = "OK";
		$usuarios = "";
		$id_plantel = 1;


		$query = "SELECT u.*,tu.nombre_tipo_usuario, p.nombre_p, d.nombre_departamento FROM usuarios u inner join tipo_usuarios tu On u.id_tipo_usuario = tu.id_tipo_usuario INNER JOIN planteles p ON p.id_plantel = u.id_plantel INNER JOIN departamentos d ON d.id_departamento = u.id_departamento WHERE u.id_plantel =".$id_plantel." && u.id_usuario = ".$id_usuario;
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados de usuarios";
		}
		$row = mysqli_fetch_array($result);
		$usuarios = array('id_usuario' => $row['id_usuario'],
						'nombres' => $row['nombres'],
						'apellido_pat' => $row['apellido_pat'],
						'apellido_mat' => $row['apellido_mat'],
						'puesto' => $row['puesto'],
						'img_foto' => $row['img_foto'],
						'file_foto' => $row['file_foto'],
						'admin' => $row['admin'],
						'clave' => $row['clave_sesion'],
						'password' => $row['pass_sesion'],
						'id_contrato' => $row['id_tipo_contrato'],
						'id_departamento' => $row['id_departamento'],
						'tipo_usuario' => $row['nombre_tipo_usuario'],
						'plantel' => $row['nombre_p'],
						'departamento' => $row['nombre_departamento']
						);
		$json = array('success' => $success,
					  'message' => $message,
					  'data' => $usuarios);
		echo json_encode($json);
	}

	/* function guardar_checkout(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id_usuario = $_POST['id_usuario'];
		$id_horario = $_POST['id_horario'];
		$fecha = $_POST['fecha'];
		$dia_semana = $_POST['dia_semana'];
		$hora = $_POST['hora'];
		
		$message = "Consulta realizada con éxito.";
		$success = true;

		if($checkout == 'Entrada'){
			$ch = ',h_entrada';
		}
		if($checkout == 'Salida'){
			$ch = ',h_salida';
		}

		$query = "INSERT INTO insidencias (id_usuario,id_horario,fecha,dia_semana".$ch.")
			VALUES 
			('$id_usuario','$id_horario','$fecha','$dia_semana','$hora')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	} */

	/* Funciones Pendientes */

	function cambiar_password(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id = $_POST['id'];

		$nvo_password = (isset($_POST['nvo_password'])) ? md5($_POST['nvo_password']) : '';
		$confirm_password = (isset($_POST['confirm_reset_password'])) ? md5($_POST['confirm_reset_password']) : '';

		if($nvo_password !== $confirm_password){
			$json = array('success' => false,
			              'message' => 'Las contraseñas no coinciden.');
			echo json_encode($json);
			exit();	
		}

		$message = "Contraseña actualizada con éxito.";
		$success = true;

		$query = "UPDATE usuarios set password = '$nvo_password'  WHERE id = '$id'";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function get_empresas(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$id_usuario = $_SESSION['id_usuario'];

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$query = "SELECT e.* from empresa e inner join usuarios_empresa ue on ue.id_empresa = e.id Where ue.id_usuario = '$id_usuario' && e.estatus = 'Activo'";

		if($_SESSION['tipo_usuario'] == 'superadmin'){
			$query = "SELECT * from empresa";
		}
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "Error en la consulta.";
		}
		if($result->num_rows >= 1){
			while ($row = mysqli_fetch_array($result)){
				$logo = $row['logo'];
				if($row['logo'] == null || $row['logo'] == ""){
					$logo = "not-available-es.png";
				}
				$datos[] = array('id' => $row['id'],
								 'nombre' => $row['nombre'],
								 'logo' => $logo,
								 'estatus' => $row['estatus'],
								 'dueno' => $row['dueno'],
								 'correo' => $row['correo'],
								 'telefono' => $row['telefono']);
			}
		}else{
			$success = false;
			$message = "No se encontraron empresas Activas";	
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function get_config(){
		$datos = array('print' => $_SESSION['print_ticket'],
					   'busquedaxc' => $_SESSION['busqcodbarr']);

		$json = array('success' => true,
					  'message' =>"OK",
					  'data' => $datos);

		echo json_encode($json);

	}

	// function buscar_producto(){
	// 	$mysqli = conexion();
	// 	$datos = "";
	// 	$success = true;
	// 	$message = "OK";

	// 	if(!$mysqli){
	// 		$json = array('success' => false,
	// 		              'message' => 'Error al conectar con la BD');
	// 		echo json_encode($json);
	// 		exit();
	// 	}

	// 	if(isset($_POST['codigo'])){
	// 		$codigo = $_POST['codigo'];
	// 		query = "SELECT * from productos Where codigo = '$codigo'";
	// 	}
	// 	if(isset($_POST['nombre_producto'])){
	// 		$nombre = $_POST['nombre_producto'];
	// 		query = "SELECT * from productos Where nombre LIKE '%".$nombre."%' ";
	// 	}

	// 	$result = $mysqli->query($query);
	// 	if(!$result){
	// 		$success = false;
	// 		$message = "No se encontraron resultados";
	// 	}

	// 	if($result->num_rows >= 1){
	// 		$row = mysqli_fetch_array($result);
	// 		$datos = array('id' => $row['id'],
	// 						 'codigo' => $row['codigo'],
	// 						 'nombre' => $row['nombre'],
	// 						 'precio_compra' => $row['precio_compra'],
	// 						 'utilidad' => $row['utilidad'],
	// 						 'precio_venta' => $row['precio_venta'],
	// 						 'estatus' => $row['estatus'],
	// 						 'id_categoria' => $row['id_categoria'],
	// 						 'id_unidad_medida' => $row['id_unidad_medida']

	// 		);	
	// 	}else{
	// 		$success = false;
	// 		$message = "No se encontraron resultados";
	// 	}
		
	// 	$json = array('success' => $success,
	// 				  'message' =>$message,
	// 				  'data' => $datos);

	// 	echo json_encode($json);
	// }

	function buscar_producto(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$id_empresa = $_SESSION['id_empresa'];

		// if(isset($_SESSION['id_sucursal'])){
		// 	$id_sucursal = $_SESSION['id_sucursal'];
		// 	$filtro_suc = " && id_sucursal = '$id_sucursal'";	
		// }

		if(isset($_POST['id_empresa'])){
			$id_empresa = $_POST['id_empresa'];
			$query = "SELECT * from productos Where id_empresa = '$id_empresa'";
		}
		

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		if(isset($_POST['codigo'])){
			$codigo = $_POST['codigo'];
			$query = "SELECT * from productos Where codigo = '$codigo' && id_empresa = '$id_empresa'";
		}
		if(isset($_POST['nombre_producto'])){
			$nombre = $_POST['nombre_producto'];
			$query = "SELECT * from productos Where nombre LIKE '%".$nombre."%' && id_empresa = '$id_empresa'";
		}
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}

		if($result->num_rows >= 1){
			while ($row = mysqli_fetch_array($result)) {
				$datos[] = array('id' => $row['id'],
							 'codigo' => $row['codigo'],
							 'nombre' => $row['nombre'],
							 'precio_compra' => $row['precio_compra'],
							 'utilidad' => $row['utilidad'],
							 'precio_venta' => $row['precio_venta'],
							 'estatus' => $row['estatus'],
							 'id_categoria' => $row['id_categoria'],
							 'id_unidad_medida' => $row['id_unidad_medida']);
			}
		}else{
			$datos[] = array('id' => '',
							 'codigo' => "No se encontraron resultados",
							 'nombre' => "No se encontraron resultados");
			$success = false;
			$message = "No se encontraron resultados";
		}
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);

		echo json_encode($json);
	}

	// function get_gastos(){
	// 	$mysqli = conexion();
	// 	$datos = [];
	// 	$success = true;
	// 	$message = "OK";
	// 	$id_usuario = $_SESSION['id_usuario'];
	// 	$id_caja = $_SESSION['id_caja'];

	// 	if(!$mysqli){
	// 		$json = array('success' => false,
	// 		              'message' => 'Error al conectar con la BD');
	// 		echo json_encode($json);
	// 		exit();
	// 	}

	// 	$query = "SELECT * FROM gastos WHERE id_usuario = '$id_usuario' && id_caja = '$id_caja'";
	// 	$result = $mysqli->query($query);
	// 	if(!$result){
	// 		$success = false;
	// 		$message = "No se encontraron resultados";
	// 	}
	// 	while ($row = mysqli_fetch_array($result)){
	// 		$datos[] = array('id' => $row['id'],
	// 						 'fecha' => $row['fecha'],
	// 						 'hora' => $row['hora'],
	// 						 'tipo_gasto' => $row['tipo_gasto'],
	// 						 'motivo_gasto' => $row['motivo_gasto'],
	// 						 'importe' => $row['importe'],
	// 						 'usuario' => $row['usuario']);
	// 	}
	// 	$json = array('success' => $success,
	// 				  'message' =>$message,
	// 				  'data' => $datos);
	// 	echo json_encode($json);
	// }

	function get_ventas(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$suma_total = 0;
		$id_sucursal = $_SESSION['id_sucursal'];
		$id_caja = $_SESSION['id_caja'];
		$id_usuario = $_SESSION['id_usuario'];

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT v.*, c.nombre AS nom_cliente, c.app, c.apm, u.nombre_usuario FROM ventas v LEFT JOIN clientes c ON c.id = v.id_cliente INNER JOIN caja_turno ct on ct.id = v.id_caja INNER JOIN usuarios u ON u.id = ct.id_usuario WHERE ct.id = '$id_caja' && ct.id_sucursal = '$id_sucursal' && ct.id_usuario = '$id_usuario' && ct.estatus = 'Abierta'";
		// $query = "SELECT v.*,c.nombre as nom_cliente,c.app, c.apm, u.nombre_usuario from ventas v inner join clientes c on c.id= v.id_cliente inner join usuarios u on u.id = v.id_usuario where id_usuario = '$id_usuario' && id_caja = '$id_caja' && id_sucursal = '$id_sucursal'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "Fallo la consulta de ventas";
		}

		$query_g = "SELECT sum(importe) as total_gastos from gastos Where id_sucursal = '$id_sucursal' && id_caja = '$id_caja'";		
		$result_g = $mysqli->query($query_g);
		if(!$result_g){
			$success = false;
			$message = "Fallo la consulta del total de gastos";
		}

		$total_gastos = mysqli_fetch_array($result_g);

		if($total_gastos['total_gastos'] == ""){
			$t_gastos = 0;
		}else{
			$t_gastos = $total_gastos['total_gastos'];
		}

		//$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$suma_total = $suma_total+$row['total'];

			$f = explode("-",$row['fecha']);
			$fecha = $f[2]."/".$f[1]."/".$f[0];

			$datos[] = array('id' => $row['id'],
							 'folio' => $row['folio'],
							 'id_cliente' => $row['id_cliente'],
							 'id_usuario' => $row['id_usuario'],
							 'fecha' => $fecha,
							 'hora' => $row['hora'],
							 'subtotal' => $row['subtotal'],
							 'descuento' => $row['descuento'],
							 'total' => $row['total'],
							 'forma_pago' => $row['forma_pago'],
							 'importe_efectivo' => $row['importe_efectivo'],
							 'importe_tarjeta' => $row['importe_tarjeta'],
							 'motivo_descuento' => $row['motivo_descuento'],							
							 'nom_cliente' => $row['nom_cliente']." ".$row['app']." ".$row['apm'],
							 'usuario' => $row['nombre_usuario']);
		}
		
		$neto = $suma_total-$_SESSION['fondo_inicial'];
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos,
					  'gastos' => $t_gastos,
					  'suma_total' => $suma_total,
					  'fondo_inicial' => $_SESSION['fondo_inicial'],
					  'venta_neta' => $neto);
		echo json_encode($json);
	}

	function estatusUsuario(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id = $_POST['id'];
		$estatus = $_POST['estatus'];
		$message = "Consulta realizada con éxito.";
		$success = true;

		$query = "UPDATE usuarios set estatus = '$estatus' WHERE id = '$id'";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function info_caja(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$success = true;
		$message = "OK";
		$id_caja = $_SESSION['id_caja'];

		$query = "SELECT apertura, corte, total_efectivo, total_tarjeta, total_gastos FROM caja_turno ct LEFT JOIN (SELECT id_caja, SUM(importe_efectivo) AS total_efectivo, SUM(importe_tarjeta) AS total_tarjeta FROM ventas WHERE id_Caja = '$id_caja') importes ON ct.id = importes.id_caja LEFT JOIN (SELECT id_caja, SUM(importe) AS total_gastos FROM gastos WHERE id_caja = '$id_caja') gastos ON importes.id_caja = gastos.id_caja WHERE ct.id = '$id_caja'";

		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}

		$query_sucursal = "SELECT s.* from sucursales s inner join caja_turno ct on ct.id_sucursal = s.id Where ct.id = '$id_caja'";
		$res = $mysqli->query($query_sucursal);
		if(!$res){
			$success = false;
			$message = "No se encontraron resultados";
		}
		$suc = mysqli_fetch_array($res);

		$row = mysqli_fetch_array($result);
		$datos = array('total_efectivo' => $row['total_efectivo'],
					   'total_tarjeta' => $row['total_tarjeta'],
					   'total_gastos' => ($row['total_gastos'] != null) ? $row['total_gastos'] : 0,
					   'fondo_inicial' => $_SESSION['fondo_inicial'],
					   'apertura' => $row['apertura'],
					   'cierre' => $row['corte'],
					   'direccion' => $suc['direccion'],
					   'colonia' => $suc['col'],
					   'ciudad' => $suc['ciudad'],
					   'estado' => $suc['estado'],
					   'tel' => $suc['tel']);

		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function estatus_producto(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$codigo = $_POST['codigo'];
		$estatus = $_POST['estatus'];
		$id_empresa = $_POST['id_empresa'];

		if(isset($_SESSION['id_empresa'])){
			$id_empresa = $_SESSION['id_empresa'];
		}


		$message = "Consulta realizada con éxito.";
		$success = true;

		$query = "UPDATE productos set estatus = '$estatus' WHERE codigo = '$codigo' && id_empresa = '$id_empresa'";

		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function estatus_suc(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id = $_POST['id'];
		$estatus = $_POST['estatus'];
		$message = "Consulta realizada con éxito.";
		$success = true;

		$query = "UPDATE sucursales set estatus = '$estatus' WHERE id = '$id'";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function abrir_caja(){
		$mysqli = conexion();
		$message = "Caja Abierta correctamente";
		$success = true;


		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$fondo_inicial = $_POST['fondo_inicial'];
		$id_sucursal = $_POST['id_sucursal_caja'];
		$id_usuario = $_POST['id_usuario'];
		$fecha_caja = $_POST['fecha_caja'];

		$aux = explode("/",$fecha_caja);
		$fecha = $aux[2]."-".$aux[1]."/".$aux[0];

		$query = "INSERT INTO caja_turno values ('','$fecha','$fondo_inicial','','','$id_sucursal','$id_usuario','Abierta')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);		
	}

	function insert_usuario(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id = $_POST['id_usuario'];
		$nombre_completo = $_POST['nombre_completo'];
		$nombre_usuario = $_POST['nombre_usuario'];		
		$rol = $_POST['tipo_usuario'];
		$num_contacto = $_POST['numero_contacto'];
		$id_empresa = $_SESSION['id_empresa'];
		if(isset($_POST['id_empresa'])){
			$id_empresa = $_POST['id_empresa'];
		}

		$password = (isset($_POST['password_usuario'])) ? md5($_POST['password_usuario']) : '';
		$c_password = (isset($_POST['confirm_password'])) ? md5($_POST['confirm_password']) : '';
		// $password = md5($_POST['password_usuario']);
		// $c_password = md5($_POST['confirm_password']);
		if($password !== $c_password){
			$json = array('success' => false,
			              'message' => 'Las contraseñas no coinciden.');
			echo json_encode($json);
			exit();	
		}
		$message = "Informacion almacenada con éxito.";
		$success = true;

		$query = "INSERT INTO usuarios values ('$id','$nombre_completo','$nombre_usuario','$password','$rol','Activo','$num_contacto') ON DUPLICATE KEY UPDATE nombre_completo = '$nombre_completo', nombre_usuario = '$nombre_usuario',tipo_usuario = '$rol', tel_contacto = '$num_contacto'";
		if(!$mysqli->query($query)){
			$json = array('success' => false,
			              'message' => 'No se pudo ingresar la información.');
			echo json_encode($json);
			exit();	
		}
		if($id == ""){
			$id = $mysqli->insert_id;	
		}

		$qrows = "SELECT * from usuarios_empresa Where id_usuario = '$id' && id_empresa = '$id_empresa'";
		$resrows = $mysqli->query($qrows);
		if($resrows->num_rows <= 0){
			$query_u_e = "INSERT INTO usuarios_empresa values('$id','$id_empresa')";
			if(!$mysqli->query($query_u_e)){
				$success = false;
				$message = "Ocurrio un error al asignar la empresa al usuario";
			}
		}

		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function get_venta_sucursales(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$id_empresa = $_SESSION['id_empresa'];

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT v.id_sucursal, s.nombre, s.estatus as estatus_sucursal, ct.estatus as estatus_caja, SUM(v.total) AS venta_total FROM ventas v INNER JOIN sucursales s ON s.id = v.id_sucursal INNER JOIN empresa e on e.id = s.id_empresa LEFT JOIN caja_turno ct ON ct.id_sucursal = s.id WHERE e.id = '$id_empresa' GROUP BY id_sucursal";
		
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		//$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$datos[] = array('id_sucursal' => $row['id_sucursal'],
							 'nombre_sucursal' => $row['nombre'],
							 'estatus_sucursal' => $row['estatus_sucursal'],
							 'estatus_caja' => $row['estatus_caja'],
							 'venta_total' => $row['venta_total']);
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function insert_sucursal(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id = $_POST['id_sucursal'];
		$nombre = $_POST['nombre_sucursal'];
		$direccion = $_POST['direccion_sucursal'];
		$colonia = $_POST['colonia_sucursal'];
		$ciudad = $_POST['ciudad_sucursal'];
		$estado = $_POST['estado_sucursal'];
		$tel = $_POST['telefono_sucursal'];
		$email = $_POST['email_sucursal'];
		$id_empresa = $_POST['id_empresa'];
		$empresa = $_POST['empresa'];

		$message = "Consulta realizada con éxito.";
		$success = true;

		$query = "INSERT INTO sucursales values ('$id','$nombre','$direccion','$colonia','$ciudad','$estado','$tel','$email','Activo','$id_empresa') ON DUPLICATE KEY UPDATE nombre = '$nombre', direccion = '$direccion', col = '$colonia', ciudad = '$ciudad', estado = '$estado', tel = '$tel', email = '$email'";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "Ocurrio un error en la consulta, intentalo mas tarde";
		}
		if($id == ""){
			$id = $mysqli->insert_id;
			$publico_general = "INSERT INTO clientes VALUES ('','Publico General','','','','','1','$id_empresa','$id')";
			if(!$mysqli->query($publico_general)){
				$message = "NO se creo publico General para esta sucursales";
			}
			$folio_e = substr($empresa, 0,3);
			$folio_s = substr($nombre, 0,3);
			$set_folio = "INSERT INTO folios values('','$id_empresa','$id','$folio_e','$folio_s','1')";
			if(!$mysqli->query($publico_general)){
				$message = "NO se creo Crear El folio";
			}

		}

		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function set_usuario_empresa(){
		$mysqli = conexion();
		$success = true;
		$message = "OK";

		$id_sucursal = $_POST['id_sucursal'];
		$id_usuario = $_POST['id_usuario'];

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$q = "SELECT * from usuarios_sucursal WHERE id_usuario = '$id_usuario' && id_sucursal = '$id_sucursal'";
		$result = $mysqli->query($q);
		if($result->num_rows >= 1){
			$json = array('success' => false,
			              'message' => 'Ya se ha asignado este usuario a esta sucursal.');
			echo json_encode($json);
			exit();
		}

		$query = "INSERT INTO usuarios_sucursal values ('$id_usuario','$id_sucursal')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "NO se pudo guardar la información";
		}
		$json = array('success' => $success,
					  'message' => $message);
		echo json_encode($json);
	}

	function info_producto(){
		$mysqli = conexion();
		$success = true;
		$message = "información Guardada Correctamente.";

		$codigo = $_POST['codigo'];
		$nombre = $_POST['nombre_producto'];
		$precio_compra = $_POST['precio_compra'];
		$utilidad = $_POST['utilidad'];
		$precio_venta = $_POST['precio_venta'];
		$fecha = date("Y-m-d");

		$id_empresa = $_POST['id_empresa'];

		if(isset($_SESSION['id_empresa'])){
			$id_empresa = $_SESSION['id_empresa'];
		}


		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}



		$query = "INSERT INTO productos (codigo,nombre,precio_compra,utilidad,precio_venta,estatus,id_categoria,id_unidad_medida,creado,id_empresa) VALUES ('$codigo','$nombre','$precio_compra','$utilidad','$precio_venta','Activo','1','1','$fecha','$id_empresa') ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), precio_compra = VALUES(precio_compra), utilidad = VALUES(utilidad), precio_venta = VALUES(precio_venta), actualizado = VALUES(creado)";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se pudo guardar la información";
		}

		$json = array('success' => $success,
					  'message' =>$message);
		echo json_encode($json);
	}

	function info_empresa(){
		$mysqli = conexion();
		$success = true;
		$message = "información Guardada Correctamente.";
		$nombre = $_POST['nombre_empresa'];
		$dueno = $_POST['dueno_empresa'];
		$telefono = $_POST['telefono_empresa'];
		$correo = $_POST['correo_empresa'];
		$id_empresa = $_SESSION['id_empresa'];
		$estatus = "Baja";

		if(isset($_POST['estatus_empresa'])){
			$estatus = $_POST['estatus_empresa'];	
		}

		if(isset($_POST['id_empresa'])){
			$id_empresa = $_POST['id_empresa'];
		}

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "INSERT INTO empresa values ('$id_empresa','$nombre','','$estatus','$dueno','$correo','$telefono') ON DUPLICATE KEY UPDATE nombre = '$nombre', dueno = '$dueno', correo = '$correo', telefono = '$telefono', estatus = '$estatus'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se pudo actualizar la información";
		}

		if($id_empresa == ""){
			$id_empresa = $mysqli->insert_id;
		}

		if(isset($_POST['print_ticket']) && isset($_POST['codigo_barras'])){
			$print = $_POST['print_ticket'];
			$codigo_barra = $_POST['codigo_barras'];
			$config = "INSERT INTO config_empresa values ('','$id_empresa','$print','$codigo_barra') ON DUPLICATE KEY UPDATE print_ticket = '$print', codigo_barras = '$codigo_barra'";
			$res = $mysqli->query($config);
			if(!$res){
				$success = false;
				$message = "No se guardo informacion de configuración";
			}
		}


		$json = array('success' => $success,
					  'message' =>$message);
		echo json_encode($json);
	}

	function buscar_cliente(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$nombre = $_POST['nombre'];
		$id_empresa = $_SESSION['id_empresa'];
		$id_sucursal = $_SESSION['id_sucursal'];

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT * from (SELECT id, CONCAT(nombre,' ',app,' ',apm) as nombre_completo, direccion from clientes) c  Where c.nombre_completo like '%".$nombre."%' && id_empresa = '$id_empresa' && id_sucursal = '$id_sucursal'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		//$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$datos[] = array('id' => $row['id'],
							 'nombre_completo' => $row['nombre_completo'],
							 'direccion' => $row['direccion']);
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function get_info(){
		$mysqli = conexion();
		$datos = "";
		$success = true;
		$message = "OK";

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT e.*, c.print_ticket,c.codigo_barras from empresa e left join config_empresa c on c.id_empresa = e.id Where e.id =".$_SESSION['id_empresa'];
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		//$i = 0;
		$row = mysqli_fetch_array($result);
		$datos = array('id' => $row['id'],
						 'nombre' => $row['nombre'],
						 'logo' => $row['logo'],
						 'dueno' => $row['dueno'],
						 'correo' => $row['correo'],
						 'telefono' => $row['telefono'],
						 'estatus' => $row['estatus'],
						 'print' => $row['print_ticket'],
						 'codigo_barras' => $row['codigo_barras']);
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);

		echo json_encode($json);
	}

	function get_folio(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$folio = "";
		$contador = "";
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$id_empresa = $_SESSION['id_empresa'];
		$id_sucursal = $_SESSION['id_sucursal'];
		$query = "SELECT * from folios Where id_empresa = '$id_empresa' AND id_sucursal = '$id_sucursal'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}else{
			if($result->num_rows > 0){
				$row = mysqli_fetch_array($result);
				$num = substr('0000000000'.$row['contador'], 1, 10);
				$folio = $row['prefijo_e']."-".$row['prefijo_s']."-".$num;
				$contador = $row['contador'];
			}else{
				$success = false;
				$message = "No se puede obtener folio";
			}
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'folio' => $folio,
					  'contador' => $contador);
		echo json_encode($json);
	}


	function get_gastos(){ 
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$id_sucursal = $_POST['id_sucursal'];
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT * from gastos Where id_sucursal  = '$id_sucursal'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		while ($row = mysqli_fetch_array($result)) {
			$datos[] = array('id' => $row['id'],
							 'fecha' => $row['fecha'],
							 'hora' => $row['hora'],
							 'tipo_gasto' => $row['tipo_gasto'],
							 'motivo' => $row['motivo_gasto'],
							 'importe' => $row['importe'],
							 'usuario' => $row['usuario']);
		}
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function nvo_cliente(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$nombres = $_POST['nombres'];
		$app = $_POST['apellidopat'];
		$apm = $_POST['apellidomat'];
		$tel = $_POST['telefono'];
		$dir = $_POST['direccion'];


		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$query = "INSERT INTO clientes values ('','$nombres','$app','$apm','$tel','$dir','1')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "NO se pudo crear la información";
		}else{
			$info = array('id' => $mysqli->insert_id,
						  'nombre' => $nombres." ".$app." ".$apm
						);
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'info' => $info);
		echo json_encode($json);
	}

	function cobrar(){
		$mysqli = conexion();
		$data = json_decode($_POST['venta']);
		$id_cliente = $data->id_cliente;
		if($id_cliente == ""){
			$id_cliente = 1;
		}

		$success = true;
		$message = "Venta Realizada con exito";
		$id_usuario = $_SESSION["id_usuario"];
		$subtotal = $data->subtotal;
		$descuento = $data->descuento;
		$total = $data->total;
		$id_caja = $_SESSION['id_caja'];
		$forma_pago = $data->forma_pago;
		$importe_efectivo = ($data->importe_efectivo != "") ? $data->importe_efectivo : 0;
		$importe_tarjeta = ($data->importe_tarjeta != "") ?  $data->importe_tarjeta : 0;
		$motivo_descuento = $data->motivo_descuento;
		$cambio = $data->cambio;
		$id_empresa = $_SESSION['id_empresa'];
		$id_sucursal = $_SESSION['id_sucursal'];
		$folio = $data->folio;
		$contador = $data->contador;
		$contador++;


		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$query = "INSERT INTO ventas values ('','$folio','$id_cliente','$id_usuario',NOW(),NOW(),'$subtotal','$descuento','$total','$id_caja','$forma_pago','$importe_efectivo','$importe_tarjeta','$motivo_descuento','$id_sucursal')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "NO se pudo Guardar la informacion de venta";
		}else{		
			$id_venta = $mysqli->insert_id;
			$update = "UPDATE folios set contador = '$contador' Where id_empresa = '$id_empresa' && id_sucursal = '$id_sucursal'";
			if(!$mysqli->query($update)){
				$success = false;
				$message = "No se Actualizo el folio";
			}
			$detalles = insert_detalles_venta($id_venta,$data->detalles);
			$info = array('id' => $mysqli->insert_id,
						  'subtotal' => $total,
						  'descuento' => $descuento,
						  'total' => $total,
						  'forma_pago' => $forma_pago,
						  'efectivo' => $importe_efectivo,
						  'tarjeta' => $importe_tarjeta,
						  'cambio' => $cambio,
						  'sucursal' => $id_sucursal,
						  'detalles' => $detalles);
			
		}
		$json = array('success' => $success,
					  'message' => $message,
					  'cambio' => $cambio,
					  'info' => $info,
					  'forma_pago' => $forma_pago);

		echo json_encode($json);
	}

	function insert_gasto(){
		$mysqli = conexion();

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$data = json_decode($_POST['gasto']);
		$success = true;
		$detalles_compra = true;
		$message = "Compra almacenada correctamente";

		$tipo_gasto = $data->tipo_gasto;
		$motivo = $data->motivo_gasto;
		$importe = $data->importe;
		$id_sucursal = $data->id_sucursal;
		$id_usuario = $_SESSION['id_usuario'];

		if(!isset($_SESSION['id_caja'])){
			$q_caja = "SELECT * from caja_turno Where id_sucursal = '$id_sucursal' && id_usuario = '$id_usuario' && estatus = 'Abierta'";
			$res = $mysqli->query($q_caja);
			if(!$res){
				$json = array('success' => false,
			              	  'message' => 'Error en la consulta');
				echo json_encode($json);
				exit();
			}
			if($res->num_rows <= 0){
				$json = array('success' => false,
			              	  'message' => 'NO existe Caja abierta En esta sucursal.');
				echo json_encode($json);
				exit();	
			}
			$row_caja = mysqli_fetch_array($res);
			$id_caja = $row_caja['id'];
		}else{
			$id_caja = $_SESSION['id_caja'];
		}

		$usuario = $_SESSION['usuario'];

		$query = "INSERT INTO gastos VALUES ('',NOW(),NOW(),'$tipo_gasto','$motivo','$importe','$id_sucursal','$id_usuario','$id_caja','$usuario')";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "NO se pudo Guardar la informacion de venta";
		}else{
			if($tipo_gasto == 'compra'){
				$id_compra = $mysqli->insert_id;
				$detalles_compra = insert_detalles_compra($id_compra,$data->detalles);
			}

			if(!$detalles_compra){
				$message = "Compra guardada correctamente, pero no se guardaron los detalles"; 
			}	
		}
		$json = array('success' => $success,
					  'message' =>$message);
		echo json_encode($json);
	}

	function insert_detalles_compra($id_compra,$detalles){
		$mysqli = conexion();
		$success = true;
		foreach ($detalles as $detalle) {
			$id_producto = $detalle->id;
			$cantidad = $detalle->cantidad;
			$costo = $detalle->precio;
			$total = $costo*$cantidad;
			$query_detalles = "INSERT INTO detalles_compra VALUES ('','$id_compra','$id_producto','$cantidad','$costo','$total')";
			if(!$mysqli->query($query_detalles)){
				$success = false;
			}
			return $success;
		}
	}

	function insert_detalles_venta($id_venta,$detalles){
		$mysqli = conexion();
		$det = [];
		foreach ($detalles as $detalle) {
			$id_producto = $detalle->id;
			$producto = $detalle->producto;
			$cantidad = $detalle->cantidad;
			$precio = $detalle->precio;
			$total = $precio*$cantidad;
			$query_detalles = "INSERT INTO detalles_venta VALUES ('','$id_venta','$id_producto','$cantidad','$precio','$total')";
			if($mysqli->query($query_detalles)){
				$det[] = array('id_venta' => $id_venta,
							   'id_producto' => $id_producto,
							   'producto' => $producto,
							   'cantidad' => $cantidad,
							   'precio' => $precio,
							   'total' => $total
							);
			}
		}
		return $det;
	}

	function suc_x_usuario(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}

		$id_empresa = $_SESSION['id_empresa'];
		$id_usuario = $_SESSION['id_usuario'];
		$query = "SELECT s.*, ct.id as id_caja, ct.estatus as estatus_caja from usuarios_sucursal us inner join sucursales s on s.id = us.id_sucursal LEFT JOIN caja_turno ct on ct.id_sucursal = s.id Where us.id_usuario = '$id_usuario' && s.estatus = 'Activo' && ct.estatus = 'Abierta' group by s.id";

		if($_SESSION['tipo_usuario'] == 'admin'){
			$query = "SELECT s.*,ct.id as id_caja, ct.estatus as estatus_caja from sucursales s LEFT JOIN caja_turno ct on ct.id_sucursal = s.id  Where id_empresa = '$id_empresa' && s.estatus ='Activo'";
			 // && estatus = 'Activo'";
		}
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		while ($row = mysqli_fetch_array($result)) {
			$caja = false;
			$id_caja = "";
			if($row['id_caja'] != null){
				$id_caja = $row['id_caja'];
				$caja = true;
			}
			$datos[] = array('id' => $row['id'],
							 'nombre_sucursal' => $row['nombre'],
							 'id_caja' => $row['id_caja'],
						     'caja' => $caja);
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function get_sucursales(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";
		$id_empresa = $_SESSION['id_empresa'];

		if(isset($_POST['id_empresa'])){
			$id_empresa = $_POST['id_empresa'];
		}

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$query = "SELECT * from sucursales Where id_empresa = '$id_empresa'";

		// $query = "SELECT s.*, ct.id as id_caja, ct.estatus as estatus_caja from sucursales s LEFT JOIN caja_turno ct ON ct.id_sucursal = s.id Where id_empresa = '$id_empresa'";
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		//$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$qc = "SELECT * from caja_turno Where id_sucursal = ".$row['id']." order by id desc limit 1;";
			$res = $mysqli->query($qc);
			if(!$result){
				$success = false;
				$message = "Ocurrio un error de consulta";
			}

			$r = mysqli_fetch_array($res);
			$datos[] = array('id' => $row['id'],
							 'nombre_sucursal' => $row['nombre'],
							 'direccion' => $row['direccion'],
							 'colonia' => $row['col'],
							 'ciudad' => $row['ciudad'],
							 'estado' => $row['estado'],
							 'telefono' => $row['tel'],
							 'email' => $row['email'],
							 'estatus' => $row['estatus'],
							 'id_caja' => $r['id'],
							 'estatus_caja' => $r['estatus']);
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function get_usuarios_sucursal(){
		$mysqli = conexion();
		$datos = [];
		$success = true;
		$message = "OK";

		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$filtro = "";
		$id_sucursal = $_POST['id_sucursal'];

		if(isset($_POST['txt'])){
			$filtro = " AND u.nombre_completo LIKE '%".$_POST['txt']."%' ";
		}

		$query = "SELECT u.* from usuarios u INNER JOIN usuarios_sucursal us on u.id = us.id_usuario Where us.id_sucursal = '$id_sucursal'".$filtro;
		$result = $mysqli->query($query);
		if(!$result){
			$success = false;
			$message = "No se encontraron resultados";
		}
		//$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$datos[] = array('id' => $row['id'],
							 'nombre_completo' => $row['nombre_completo'],
							 'estatus' => $row['estatus'],
							 'tipo_usuario' => $row['tipo_usuario'],
							 'tel_contacto' => $row['tel_contacto']);
		}
		
		$json = array('success' => $success,
					  'message' =>$message,
					  'data' => $datos);
		echo json_encode($json);
	}

	function update_logo(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$message = "Foto actualizada.";
		$success = true;
		$nombreFoto = "";
		$fileIMG = "";

		if(isset($_FILES["logo_empresa"])){
			$file = $_FILES["logo_empresa"];
		    $nombreFoto = $file["name"];
		    $tipo = $file["type"];
		    $ruta_provisional = $file["tmp_name"];
		    $size = $file["size"];
		    $carpeta = "../img/logos_empresas/";
		    if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif'){
		        $message = "El archivo ".$nombreFoto." no es una imagen.";
		        $success = false;
		    }else if($size > 1024*1024){
		        $message = "El archivo ".$nombreFoto." tiene un peso mayor a 1Mb.";
		        $success = false;
		    }else{
		    	$ext = pathinfo($nombreFoto, PATHINFO_EXTENSION);
				$fileIMG = uniqid().".".$ext;
		        $src = $carpeta.$fileIMG;
		        if(move_uploaded_file($ruta_provisional, $src)){
		        	$success = true;
		        	$message = "Foto Cargada ";
		        	$save_img = bd_logo($fileIMG);
		        	if(!$save_img){
		        		$message.= "pero no se logro guardar en BD.";
		        	}else{;
		        		$message.= " y actualizada.";
		        	};
	        	}else{
	        		$message = "La imagen no se pudo guardar";
	        		$success = false;
	        	}
	        	
	        }
	    }
	    $json = array('success' => $success,
	    			  'message' => $message );
		echo json_encode($json);
	}

	function carga_excel(){
		$datos = "";
		$success = true;
		$message = "OK";
		if(isset($_FILES["excel"])){
			$file = $_FILES["excel"];
		    $nombre_excel = $file["name"];
		    $tipo = $file["type"];
		    $archivotmp = $file["tmp_name"];
		    $tamanio = $file["size"];
		    $carpeta = "../excel/";

		    $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		    if(in_array($tipo,$mimes)){
		        $message = "El archivo ".$nombre_excel." no es un archivo de excel.";
		        $success = false;		        
		    }else if($tamanio > 1024*1024){
		        $message = "El archivo ".$nombre_excel." tiene un peso mayor a 1Mb.";
		        $success = false;
		    }else{
		        $src = $carpeta.$nombre_excel;
		        if(move_uploaded_file($archivotmp, $src)){
		        	$success = true;
		        	$datos = datos_excel($src);
	        	}else{
	        		$message = "No se pudo cargar el archivo. Intentalo mas tarde";
	        		$success = false;
	        	}
	        	
	        }

	        $json = array('success' => $success,
	        			  'message' => $message,
	        			  'data' => $datos);
	        echo json_encode($json);
		}


	}

	function datos_excel($file){
		include '../simplexlsx/simplexlsx.class.php';			
		$xlsx = new SimpleXLSX( $file );
		$continuar = true;

		$datos = [];
		$i = 0;
		foreach ($xlsx->rows() as $fields){
			if($i > 0){
				if($fields[0] == ""){
				$continuar = false;
				}

				if($continuar == false){
					break;
					exit();
				}

				$datos[] = array('codigo' => $fields[0],
								 'nombre_producto' => $fields[1],
								 'precio_compra' => $fields[2],
								 'utilidad' => $fields[3],
								 'precio_venta' => $fields[4]);
			}
			$i++;
		}
		return $datos;
	}

	function bd_logo($img){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id_empresa = $_SESSION['id_empresa'];
		$query = "UPDATE empresa set logo = '$img' WHERE id = '$id_empresa'";
	    if($mysqli->query($query)){
			$success = true;
		}else{
			$success = false;
		}
		return $success;
	}

	function delete_us(){
		$mysqli = conexion();
		if(!$mysqli){
			$json = array('success' => false,
			              'message' => 'Error al conectar con la BD');
			echo json_encode($json);
			exit();
		}
		$id_sucursal = $_POST['id_sucursal'];
		$id_usuario = $_POST['id_usuario'];

		$query = "DELETE FROM `usuarios_sucursal` WHERE id_sucursal = '$id_sucursal' && id_usuario = '$id_usuario'";

	    if(!$mysqli->query($query)){
			$success = false;
			$message = "No se puso realizar la consulta";
		}else{
			$success = true;
			$message = "Elemento eliminado de la sucursal";
		}
		$json = array('success' => $success,
	    			  'message' => $message );
		echo json_encode($json);
	}

	function cerrar_caja(){
		$mysqli = conexion();
		$success = true;
		$detalles_compra = true;
		$message = "Caja cerrada Correctamente";

		$venta_total = $_POST['venta_total'];
		$gastos = $_POST['gastos'];
		$fondo_inicial = $_POST['fondo_inicial'];
		$ganancia = $_POST['ganancia'];
		$id_caja = $_SESSION['id_caja'];

		$query = "INSERT INTO corte_caja VALUES ('','$id_caja','$venta_total','$fondo_inicial','$gastos','$ganancia',NOW(),NOW())";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "No Pudo cerrarse la caja, intentalo mas tarde";
		}else{
			$query_cc = "UPDATE caja_turno set corte = NOW(), estatus = 'Cerrada' Where id = '$id_caja'"; 
			if(!$mysqli->query($query_cc)){
				$success = false;
				$message = "Caja Cerrada; BD Desactualizada";
			}
			$_SESSION['caja_abierta'] = false;
		}
		$json = array('success' => $success,
					  'message' =>$message,
					  'id_caja' => $id_caja
					);
		echo json_encode($json);
	}


	function guardar_productos(){
		$mysqli = conexion();
		$success = true;
		$message = "Información almacenada Correctamente";

		if(isset($_SESSION['id_empresa'])){
			$id_empresa = $_SESSION['id_empresa'];	
		}
		if(isset($_POST['id_empresa'])){
			$id_empresa = $_POST['id_empresa'];	
		}
		

		$datos = json_decode($_POST['datos']);

		$q = "INSERT INTO productos (codigo,nombre,precio_compra,utilidad,precio_venta,estatus,id_categoria,id_unidad_medida,creado,id_empresa) VALUES ";
		$continuar_query = "";
		$fecha = date("Y-m-d");

		foreach ($datos as $row) {
			$codigo = $row->codigo;
			$nombre_producto = $row->nombre_producto;
			$compra = $row->precio_compra;
			$utilidad = $row->utilidad;
			$venta = $row->precio_venta;

			if($continuar_query != ""){
				$continuar_query .= ",";
			}
			$continuar_query .= " ('$codigo','$nombre_producto','$compra','$utilidad','$venta','Activo','1','1','$fecha','$id_empresa')";
		}
		$query = $q.$continuar_query." ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), precio_compra = VALUES(precio_venta), utilidad = VALUES(utilidad), precio_venta = VALUES(precio_venta), actualizado = VALUES(creado);";
		if(!$mysqli->query($query)){
			$success = false;
			$message = "No se pudo cargar la información";
		}

		$json = array('success' => $success,
					  'message' =>$message);
		echo json_encode($json);
	}

 ?>