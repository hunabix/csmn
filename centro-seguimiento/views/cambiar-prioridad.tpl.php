<?php
require_once("includes/session.php"); 
confirm_logged_in(); //revisa si el operador ha ingresado 
require_once("includes/connection.php"); 
require_once("includes/functions.php"); 

// cambia la prioridad del caso
if (isset($_POST['accion-ind-btn'])) { 
	// ------------------------------------------------------------------------//
	// ---- SE PROCESA LA INFORMACIÓN DEL INTERESADO --------------------------//
	// ------------------------------------------------------------------------//
	$id_interesado = $_POST['accion-ind-btn'];
	$prioridad = $_GET['color'];		
	// ------------------------------------------------------------ ------------//
	// ---------  ACTUALIZO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//
	$consulta = "UPDATE  interesado_cs 
				 SET prioridad = '$prioridad'
				 WHERE ID = '$id_interesado'";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
}

?>
<script type="text/javascript">
			setTimeout(redirige(), '',0);
			function redirige() {
				window.location="http://localhost/dev.musinetwork.com/centro-seguimiento/";
			}
		</script>

<?php
//Cierro la conexion a la BD
	if(isset($connection)) {
		mysql_close($connection);
	}
?>