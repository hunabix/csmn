<?php require_once("includes/header.php"); ?>
<?php //confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php // se reciben parametros de componer-mensaje

if (isset($_POST['nuevo-mensaje'])) { 
	// ------------------------------------------------------------------------//
	// ---- SE PROCESA LA INFORMACIÓN PARA CADA UNO DE LOS INTERESADOS --------//
	// ------------------------------------------------------------------------//

		if(isset($_POST['id_interesado' . $i])){ $id_interesado[$i] = $_POST['id_interesado' . $i]; }
		if(isset($_POST['nombre' . $i])){  $nombre[$i] = $_POST['nombre' . $i]; }
		if(isset($_POST['email' .  $i])){  $email[$i] = $_POST['email' . $i]; }
		if(isset($_POST['tipo'])){  $tipo = utf8_decode($_POST['tipo']); }
		if(isset($_POST['mensaje_op'])){ $mensaje_op = stripslashes(utf8_decode($_POST['mensaje_op'])); }
		if(isset($_POST['comentarios'])){  $comentarios = utf8_decode($_POST['comentarios']); }
			
?>
	<div id="content">
		<h1 class="aviso">Se ha guardado y enviado la información con éxito</h1>
				
<?php echo $mensaje_op; ?>
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
	<h1 class="titulo">Componer mensaje a interesado(s)</h1>  
	
		
	<form method="post" action="recibeckeditor.php">	
		
		
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
		<h3 class="titulo">Configuración del mensaje</h3>
		<h2 class="titulo">Tipo de correo electrónico a redactar</h2>	
		<div id="tipo-mensaje"class="group">
			<label><input name="tipo" value="Respuesta personalizada" type="radio" 
			<?php if ($tipo_respuesta == 'responder') { echo 'checked'; } ?>>
			Respuesta personalizada</label> 
			
			<label><input name="tipo" value="Correo de información" type="radio"
			<?php if ($tipo_respuesta == 'informacion') { echo 'checked'; } ?>>
			Información</label> 
			
			<label><input name="tipo" value="Correo de seguimiento" type="radio"
			<?php if ($tipo_respuesta == 'seguimiento') { echo 'checked'; } ?>>
			Seguimiento</label> 
			
			<label><input name="tipo" value="Correo de inicio de cursos" type="radio"
			<?php if ($tipo_respuesta == 'inicio') { echo 'checked'; } ?>>
			Inicio de cursos</label> 	
			
			<label><input name="tipo" value="Recordatorio de pago" type="radio"
			<?php if ($tipo_respuesta == 'recordatorio') { echo 'checked'; } ?>>
			Recordatorio de pago</label> 	
		</div><!-- fin #tipo mensaje -->
		<h2 class="titulo">Mensaje personalizado al interesado</h2>	
		<!-- SECCIÓN DEL WYSIWYG -->
        <div id="mensaje-op">
        <!-- Se manda a llamar la API de KCeditor -->
        <script src="http://dev.musinetwork.com/centro-seguimiento/ckeditor/ckeditor.js"></script>
        <!-- Se coloca un <textarea> cualquiera y se le asigna un identificador en el nombre -->
        <textarea name="mensaje_op"></textarea>
        <!-- Se coloca el textarea por una instancia de KCeditor colocando el identificador en la llamada al API -->
        <script>CKEDITOR.replace( 'mensaje_op', {
			uiColor: '#5CBFDB',
			toolbar : [
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
			{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
				{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
				{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
				{ name: 'others', items: [ '-' ] },
				{ name: 'about', items: [ 'About' ] },
			]
			} );
		</script>
			<?php  //require_once("tinymce/tinymce.php"); ?>
		</div><!-- #mensaje-op -->
		
		<h2 class="titulo"><strong>Comentarios adicionales</strong></h2>
		<div id="mensaje-int">
			<textarea name="comentarios"></textarea>
		</div>	
		
		
		<input name="nuevo-mensaje" type="submit" id="submit" value="Finalizar" class="btn"/>
		</div><!-- fin #mensaje -->

		
	</form>
	
</div><!-- fin #content-->  

<?php } require_once("includes/footer.php"); ?>