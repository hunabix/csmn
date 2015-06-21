<?php
/*
* Controlador de Configuración
*/

confirm_logged_in(); //revisa si el operador ha ingresado

$data = readRawPost(array_values($_POST));

global $connection;

//COMIENZA A PROCESAR EL DOCUMENTO

// ------------------------------------------------------------ ------------//
// ---------  SE INICIALIZAN LAS VARIABLES  --------------------------------//
// -------------------------------------------------------------------------//
$temporada = ""; $inicio_ins = ""; $inicio_cur = ""; $ciclo_esc = ""; $form_procesado = ""; 
$tmpa = ""; $tmpb = ""; $tmpc = ""; $tmpd = ""; $tmpe = ""; $tmpf = ""; 
$cl1 = ""; $cl2 = ""; $cl3 = ""; $cl4 = "";

// -------------------------------------------------------------------------//
// ---------  SE COMPRUEBA SI SE ENVIÓ EL FORMULARIO -----------------------//
// -------------------------------------------------------------------------//
if (isset($data['configuracion-btn'])) { // el formulario ha sido enviado
	if(isset($data['inicio-ins'])){ $inicio_ins = $data['inicio-ins']; }
	if(isset($data['inicio-cur'])){ $inicio_cur = $data['inicio-cur']; }
	if(isset($data['ciclo-esc'])){ $ciclo_esc = $data['ciclo-esc']; }
	if(isset($data['temporada'])){ $temporada = $data['temporada']; }	
	
	// ----------------------------------------------------------------------------//
	// ------  Actualiza recordatorios si el operador actualiza la temporada ------//
	// ----------------------------------------------------------------------------//
	$configuracion = obten_configuracion();
	if ($configuracion['temporada'] != $temporada ) {
		// obtengo los casos de seguimiento actuales y entro a un loop
		$casos_set = obten_casos();
		while ($caso = mysql_fetch_array($casos_set)) {
			// Obtengo los datos que decesito de cada caso
			$id_interesado = $caso["ID"];
			$rec_pers =$caso['rec_pers'];
			$interacciones = obten_utima_interaccion($id_interesado);
			$estatus = mysql_fetch_array($interacciones); 
			$tipo = utf8_encode($estatus['tipo']);
			$fecha = $estatus['fecha'];			
			// actualiza los recordatorios de los distintos casos de acuerdo a la nueva temporada
			actualiza_recordatorio($temporada, $tipo, $fecha, $id_interesado, $rec_pers);
		}
	}
	
	// ------------------------------------------------------------ ------------//
	// ---------  ALMACENO INFORMACIÓN EN BD -----------------------------------//
	// -------------------------------------------------------------------------//

	// ---------  Se guardan en BD los datos generales del caso en interesado_cs --------------//

	$consulta = "UPDATE configuracion_cs
				SET	temporada='$temporada',
				 inicio_ins='$inicio_ins',
				 inicio_cur='$inicio_cur',
				 ciclo_esc='$ciclo_esc'
				 WHERE id = 1";
	$resultado = mysql_query($consulta, $connection);
	confirm_query($resultado);
	
	$form_procesado = 'si';

} //TERMINA COMPROBACION DE ENVIO DEL FORMULARIO








// ---------  Se obtiene la última info guardada en la tabla --------------//
$configuracion = obten_configuracion();
	
	
switch ($configuracion['temporada'] ) {
	case $configuracion['temporada'] == 'Temporada A';
	$tmpa = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada B';
	$tmpb = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada C';
	$tmpc = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada D';
	$tmpd = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada E';
	$tmpe = 'selected';
	break;
	case $configuracion['temporada'] == 'Temporada F';
	$tmpf = 'selected';
	break;
}
switch ($configuracion['ciclo_esc'] ) {
	case $configuracion['ciclo_esc'] == 'ENERO - MARZO';
	$cl1 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'ABRIL - JUNIO';
	$cl2 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'JULIO - SEPTIEMBRE';
	$cl3 = 'selected';
	break;
	case $configuracion['ciclo_esc'] == 'OCTUBRE - DICIEMBRE';
	$cl4 = 'selected';
	break;
}



?>

<div id="content">
	<h1 class="titulo">Configuración</h1>  
	<?php if ($form_procesado == 'si' ) {
		echo '<h1 class="aviso">Se ha guardado y enviado la información con éxito</h1>';
	}?>
	<div id="configuracion" class="contenedor">
		<form method="post" action="">
			<label style="margin-right:41px;" for="temporada"><strong>Elige la temporada:</strong></label>
            <select name="temporada">
				<option value="Temporada A" <?php echo $tmpa ;?>>Temporada A</option>
				<option value="Temporada B" <?php echo $tmpb ;?>>Temporada B</option>
				<option value="Temporada C" <?php echo $tmpc ;?>>Temporada C</option>
				<option value="Temporada D" <?php echo $tmpd ;?>>Temporada D</option>
				<option value="Temporada E" <?php echo $tmpe ;?>>Temporada E</option>
				<option value="Temporada F" <?php echo $tmpf ;?>>Temporada F</option>
			</select>
            <br /><br />
            <label style="margin-right:11px;" for="inicio-ins"><strong>Inicio de inscripciones:</strong></label>
            <input name="inicio-ins" value="<?php echo $configuracion['inicio_ins'] ;?>" type="text" id="datepickerins">
            <br /><br />
            <label style="margin-right:61px;" for="inicio-cur"><strong>Inicio de cursos:</strong></label>
            <input name="inicio-cur" value="<?php echo $configuracion['inicio_cur'] ;?>" type="text" id="datepickercur">    
            <br /><br />
            <label style="margin-right:84px;" for="ciclo-esc"><strong>Ciclo escolar:</strong></label>
            <select name="ciclo-esc">
				<option value="ENERO - MARZO" <?php echo $cl1 ;?>>ENERO - MARZO</option>
				<option value="ABRIL - JUNIO" <?php echo $cl2 ;?>>ABRIL - JUNIO</option>
				<option value="JULIO - SEPTIEMBRE" <?php echo $cl3 ;?>>JULIO - SEPTIEMBRE</option>
				<option value="OCTUBRE - DICIEMBRE" <?php echo $cl4 ;?>>OCTUBRE - DICIEMBRE</option>
			</select>
            <br /><br />
			<input name="configuracion-btn" type="submit" id="submit" value="Actualizar temporada" class="btn"/>
		</form>
		<script>
		$(function() {
			$( "#datepickercur, #datepickerins" ).datepicker({ dateFormat: "yy-mm-dd", minDate: 0, maxDate: "+12M +10D" });
		});
		function doSomething(form) {
			form.action = form.inp.value;
			return true;
		}
		</script>
	</div><!-- fin #casos -->

</div><!-- fin #content-->  
<?php



//Llamando una vista
view('configuracion', compact('data'));