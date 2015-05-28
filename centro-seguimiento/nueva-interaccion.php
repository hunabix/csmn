<?php require_once("includes/header.php"); ?>
<?php //confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php // se reciben parametros de componer-mensaje

if (isset($_POST['nuevo-mensaje'])) { 
	// ------------------------------------------------------------------------//
	// ---- SE PROCESA LA INFORMACIÓN PARA CADA UNO DE LOS INTERESADOS --------//
	// ------------------------------------------------------------------------//
	if(isset($_POST['interesados'])){  $interesados = $_POST['interesados']; }
	for ($i = 1; $i <= $interesados; $i++) {
		if(isset($_POST['id_interesado' . $i])){ $id_interesado[$i] = $_POST['id_interesado' . $i]; }
		if(isset($_POST['nombre' . $i])){  $nombre[$i] = $_POST['nombre' . $i]; }
		if(isset($_POST['email' .  $i])){  $email[$i] = $_POST['email' . $i]; }
		if(isset($_POST['tipo'])){   $tipo = utf8_decode($_POST['tipo']); }
		if(isset($_POST['comentarios'])){  $comentarios = utf8_decode($_POST['comentarios']); }
			
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//	
	// ---------  Se guardan los datos de la nueva interacción  --------------//
	
	$fecha = date("Y-m-d H:i:s");
	$consulta = "INSERT 
				 INTO interaccion_cs (
				 tipo,
				 id_interesado,
				 fecha,
				 mensaje_op,
				 mensaje_int,
				 observaciones
				)
				VALUES ('$tipo','$id_interesado[$i]', '$fecha', '', '', '$comentarios')";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	// ---------  Si se agrega a lista o se inscribe el interesado se desactiva de la lista de seguimiento  --------------//
	if ($tipo == 'Se ha agregado a la lista general' || $tipo == 'Se ha inscrito en Musinetwork') {
		$consulta = "UPDATE interesado_cs
					 SET  activo = 'No'
					 WHERE ID = '$id_interesado[$i]'";
		$resultado = mysql_query($consulta, $connection);
		confirm_query($resultado);
	}
	// ---------  Si se realizó llamada se actualiza el recordatorio  --------------//
	$tipo_estatus = utf8_encode($tipo);
	if ($tipo_estatus == 'Se llamó al interesado') {		
		$configuracion = obten_configuracion();		
		actualiza_recordatorio($configuracion['temporada'], $tipo_estatus, $fecha, $id_interesado[$i], 0);
	}
	
	
} //fin del loop que recibe la información de c/u de los interesados
?>
	<div id="content">
		<h1 class="aviso">Se ha guardado y enviado la información con éxito</h1>
				
		<script type="text/javascript">
			setTimeout(redirige(), '',5000);
			function redirige() {
				window.location="http://dev.musinetwork.com/centro-seguimiento/";
			}
		</script>
	</div><!-- fin #content-->
	
<?php } else  {  

// se reciben parametros de index.php
$tipo_respuesta = '';

if (isset($_POST['btn-casos-seguimiento-col'])) { // el formulario ha sido enviado
	// recibo parametro get para saber que tipo de respuesta se pidio redactar
	if (isset($_GET['tipo'])) {  $tipo_respuesta = $_GET['tipo']; };
	
	$num_casos = $_POST['num_casos'];
	$casos = array();
	for ($i = 1; $i <= $num_casos; $i++) {
		if (isset($_POST['caso' . $i])) { $casos[$i] = $_POST['caso' . $i]; }
	}
}
if (isset($_POST['accion-ind-btn'])) { // el formulario ha sido enviado
	if (isset($_GET['tipo'])) {  $tipo_respuesta = $_GET['tipo']; };
	$num_casos = 1;
	$casos = array();	
	$casos[1] = $_POST['accion-ind-btn']; 	
}

//se obtienen los nombres y mails de los casos a enviar mensaje 
$interesados = 0;
for ($i = 1; $i <= $num_casos; $i++) { 	
	if (isset($casos[$i])) { 
		$casos_set = obten_caso_x_id($casos[$i]);
		$caso = mysql_fetch_array($casos_set);
		$email[$i] = utf8_encode($caso['email']);
		$nombre[$i] = utf8_encode($caso['nombre']);	
		$id_interesado[$i] = $caso['ID'];
		$interesados = $interesados + 1;
	} 
} 	 
 ?>


<div id="content">
	<h1 class="titulo">Realizar una nueva interacción con los siguientes casos</h1>
	<form method="post" action="nueva-interaccion.php">	
		
		
		<div id="destinatarios" class="group">
			<ul>
				<?php  $ni = 1;
				for ($i = 1; $i <= $num_casos; $i++) {  if (isset($casos[$i])) { ?>
					<li><span class="accion-ind-ico"><img src="imagenes/email-16.png" /></span>
					<?php echo '<strong>'.$nombre[$i] . '</strong> (' . $email[$i] . ')'; ?></li>
					<input type="hidden" name="id_interesado<?php echo $ni; ?>" value="<?php echo $id_interesado[$i]; ?>"/>
					<input type="hidden" name="nombre<?php echo $ni; ?>" value="<?php echo $nombre[$i]; ?>"/>
					<input type="hidden" name="email<?php echo $ni; ?>" value="<?php echo $email[$i]; ?>"/>
					<input type="hidden" name="interesados" value="<?php echo $interesados; ?>"/>
				<?php $ni = $ni + 1; } }?>	
			</ul>
		</div> <!-- fin #destinatarios-->
		
		<div id="mensaje" class="contenedor full">
		<h3 class="titulo">Tipo de acción a realizar</h3>
		<div id="tipo-mensaje"class="group">
			<label><input name="tipo" value="Se llamó al interesado" type="radio" 
			<?php if ($tipo_respuesta == 'llamada') { echo 'checked'; } ?>>
			Registrar llamada</label> 
			
			<label><input name="tipo" value="Se ha agregado a la lista general" type="radio"
			<?php if ($tipo_respuesta == 'lista') { echo 'checked'; } ?>>
			Agregar a lista general</label> 
			
			<label><input name="tipo" value="Se ha inscrito en Musinetwork" type="radio"
			<?php if ($tipo_respuesta == 'inscribir') { echo 'checked'; } ?>>
			Inscribir a Musinetwork</label> 
			
			<label><input name="tipo" value="Nota personalizada del operador" type="radio"
			<?php if ($tipo_respuesta == 'nota') { echo 'checked'; } ?>>
			Agregar nota personalizada</label> 
			
			
		</div><!-- fin #tipo mensaje -->
				
		<h2 class="titulo"><strong>Comentarios adicionales</strong></h2>
		<div id="mensaje-int">
			<textarea name="comentarios"></textarea>
		</div>	
		
		
		<input name="nuevo-mensaje" type="submit" id="submit" value="Finalizar" class="btn"/>
		</div><!-- fin #mensaje -->

		
	</form>
	

</div><!-- fin #content-->  

<?php } require_once("includes/footer.php"); ?>