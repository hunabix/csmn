<?php
session_start(); 

// redirecciona al HOME si no ha iniciado sesión
function logged_in() {
	return isset($_SESSION['user_id']);				
}
	
function confirm_logged_in() {
	if (!logged_in()) {
		header("Location: ".cs_url."/login");
		exit;
	} else {
		



		$user_id = $_SESSION['user_id'];


		//check if user has changed info
		$consulta =  "SELECT *
						FROM operador_mn
						WHERE ID = '$user_id'
						LIMIT 1";
		global $connection;
		$operador_set = mysql_query($consulta, $connection);
		confirm_query($operador_set);
		
		if (mysql_num_rows($operador_set) ==1) {
			// autentificado!!!!!!!!!!
			$operador = mysql_fetch_array($operador_set);
			$_SESSION['username'] = $operador['usuario'];
			$_SESSION['nombre'] = $operador['nombre'];
			$_SESSION['tipo'] = $operador['tipo']; 
			$_SESSION['email'] = $operador['email']; 
			$_SESSION['imagen'] = $operador['imagen']; 
			//redirijo por javascript a index
			//header('Location: ' . cs_url);
			//exit;
		}
		else {
			echo $mensaje = "Nombre de usuario o contraseña incorrecto";
			//die;
			header('Location: ' . cs_url . '/login');
			exit;
		}








		
		return $_SESSION;
	}
	//print_array($_SESSION);
}
		
function panel_sesion ($usuario, $area) {
	$cadena = "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"3\">
                <tr  >
                  <td id=\"fila_reporte2\" ><h4 align=\"center\"><strong>Usuario:</strong></h4>
                      <h4 align=\"center\">"
                        . htmlentities($usuario) .
                    "</h4></td>
                </tr>
                <tr>
                  <td id=\"fila_reporte2\" ><a href=\"logout.php\">Cerrar sesion</a></td>
                </tr>
            </table>";
			return $cadena;
	
}


?>