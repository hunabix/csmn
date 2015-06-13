<?php require_once("includes/header.php"); ?>
<?php //confirm_logged_in(); //revisa si el operador ha ingresado ?>
<?php 
if (isset($_POST['id_caso'])) { // el formulario ha sido enviado
	$id_interesado = $_POST['id_caso'];
	$casos_set = obten_caso_x_id($id_interesado);
	$caso = mysql_fetch_array($casos_set);
	//se almacena la consulta en variables
	$nombre = utf8_encode($caso['nombre']);	
	$email = utf8_encode($caso['email']);
	$tel = $caso['telefono'];
	$pais = utf8_encode($caso['pais']);
	$ciudad = utf8_encode($caso['ciudad']);
	$instrumento = utf8_encode($caso['instrumento']);
}
?>

<?php //COMIENZA A PROCESAR LA ACTUALIZACIÓN

if (isset($_POST['actualizar-registro-btn'])) { // el formulario ha sido enviado

	// ------------------------------------------------------------ ------------//
	// ---------  SI ESTA CORRECTO TODO, SE PROCESA LA INFORMACIÓN  ------------//
	// -------------------------------------------------------------------------//
	if(isset($_POST['nombre'])){ $nombre = utf8_decode($_POST['nombre']); }
	if(isset($_POST['mail'])){ $email = $_POST['mail']; }
	if(isset($_POST['telefono'])){ $tel = $_POST['telefono']; }
	if(isset($_POST['instrumento'])){ $instrumento = utf8_decode($_POST['instrumento']); }
	if(isset($_POST['pais'])){ $pais = utf8_decode($_POST['pais']); }
	if(isset($_POST['ciudad'])){ $ciudad = utf8_decode($_POST['ciudad']); }
	if(isset($_POST['id-interesado'])){ $id_interesado = $_POST['id-interesado']; }
	
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//
	
	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//
	$consulta = "UPDATE interesado_cs
				SET nombre='$nombre',
				 email='$email',
				 telefono='$tel',
				 pais='$pais',
				 ciudad='$ciudad',
				 instrumento='$instrumento'
				 WHERE ID ='$id_interesado'";
				 
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado); 
	
?>
	<div id="content">
		<h1 class="aviso">Se ha guardado y enviado la información con éxito</h1>
			
		<script type="text/javascript">
			setTimeout(redirige(), '',5000);
			function redirige() {
				window.location="<?php echo cs_url; ?>/";
			}
		</script>
	</div><!-- fin #content-->
	
<?php } else  { ?>

<div id="content">
	<h1 class="titulo">Editar información general del interesado</h1>  
	<div id="nuevo-registro">
		<form method="post" action="">	
			<div id="info-general" class="contenedor full">
				<h3 class="titulo">Datos generales</h3>		
				<input type="text" name="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre completo" required/> 
				<input type="email" name="mail" value="<?php echo $email; ?>" placeholder="Correo electrónico" required/> 
				<input type="text" name="telefono" value="<?php echo $tel; ?>" placeholder="Teléfono(s)" /> 
				<input type="text" name="instrumento" value="<?php echo $instrumento; ?>" placeholder="Instrumento"/> 
				<select name="pais">
					<option value="<?php echo $pais; ?>"><?php echo $pais; ?></option>
					<?php imprime_paises_2(); ?>
				</select>
				<input type="text" name="ciudad" value="<?php echo $ciudad; ?>" placeholder="Ciudad"/>
                <input type="hidden"  name="id-interesado" value="<?php echo $id_interesado; ?>" />
			</div><!-- fin #info-general -->

			<input name="actualizar-registro-btn" type="submit" id="submit" value="Finalizar" class="btn"/>
		</form>
	</div><!-- #nuevo-registro -->
	
	
</div><!-- fin #content-->  

<?php } require_once("includes/footer.php"); ?>