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
	}	
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