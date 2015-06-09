<?php require_once("includes/header.php"); ?>
<?php 
// si se ha seleccionado borrar casos de manera colectiva
if (isset($_POST['btn-casos-seguimiento-col'])) { 
	$num_casos = $_POST['num_casos'];
	$casos = array();
	for ($i = 1; $i <= $num_casos; $i++) {
		if (isset($_POST['caso' . $i])) { 
			$casos[$i] = $_POST['caso' . $i]; 
			// ------------------------------------------------------------ ------------//
			// ---------  BORRO INFORMACIÓN EN BD -----------------------------------//
			// -------------------------------------------------------------------------//	
			$consulta = "DELETE  
						 FROM interesado_cs 
						 WHERE ID = '$casos[$i]'";
			$resultado = mysql_query($consulta, $connection);
			confirm_query($resultado);
		}
	}
}
// si se ha seleccionado borrar casos de manera individual
if (isset($_POST['accion-ind-btn'])) { 
	$num_casos = 1;
	$casos = array();	
	$casos[1] = $_POST['accion-ind-btn']; 	
	
	// ------------------------------------------------------------ ------------//
	// ---------  BORRO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//	
	$consulta = "DELETE  
				 FROM interesado_cs 
				 WHERE ID = '$casos[1]'";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
}
?>
	<div id="content">
		<h1 class="aviso">Se ha borrado el caso con éxito</h1>
				
		<script type="text/javascript">
			setTimeout(redirige(), '',5000);
			function redirige() {
				window.location="http://localhost/dev.musinetwork.com/centro-seguimiento/";
			}
		</script>
	</div><!-- fin #content-->

<?php require_once("includes/footer.php"); ?>