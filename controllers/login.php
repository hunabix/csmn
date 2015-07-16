<?php
/*
* Controlador del Login
*/

//echo $data['tipo-accion'];

//echo print_array($_POST);

//COMIENZA A PROCESAR EL DOCUMENTO
if (isset($_POST['ingreso'])) { // el formulario ha sido enviado

	// recibo la información		
	
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	
	//reviso en la base de datos si el usuario existe
	$consulta =  "SELECT *
					FROM operador_mn
					WHERE usuario = '$usuario'
					AND clave = '$clave'
					LIMIT 1";
	global $connection;
	$operador_set = mysql_query($consulta, $connection);
	confirm_query($operador_set);
	
	if (mysql_num_rows($operador_set) ==1) {
		// autentificado!!!!!!!!!!
		$operador = mysql_fetch_array($operador_set);
		$_SESSION['user_id'] = $operador['ID'];
		$_SESSION['username'] = $operador['usuario'];
		$_SESSION['nombre'] = $operador['nombre'];
		$_SESSION['tipo'] = $operador['tipo']; 
		$_SESSION['email'] = $operador['email']; 
		$_SESSION['imagen'] = $operador['imagen']; 
		//redirijo por javascript a index
		header('Location: ' . cs_url);
		exit;
	}
	else {
		//$mensaje = "Nombre de usuario o contraseña incorrecto";
		header('Location: ' . cs_url . '/login');
		exit;
	}
	
} else { // el formulario no ha sido enviado
		//header('Location: ' . cs_url . '/login');
		//exit;
}
			
 	

//Llamando una vista
view('login');

